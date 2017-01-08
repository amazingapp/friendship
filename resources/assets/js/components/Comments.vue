<!-- HTML TEMPLATE -->
<template>
    <div>
    <div class="comment">
    <div class="view-more-comments">
            <a href="#" v-show="hasMoreComments" v-on:click="getOldComments">View more comments</a>
            <span class="old-comment-status">
                <img v-if="oldCommentLinkClicked" style="width:12px;" src="/images/loader.gif" alt="loading...">
                <span v-if="oldCommentLinksHasError" class="text-danger"> Something went wrong. Try again.</span>
            </span>
    </div>
    <div class="userComments" v-for="user in users | orderBy 'timestamp'">
            <span class="user-profile-image">
                    <img :src="user.profile_picture" class="pull-left" />
            </span>
            <span class="user-message"> <a href="javascript:void();">
            {{ user.user_name }}</a> {{ user.message }}
             <p><a class="text-muted" href="javascript:void();">10 mins ago</a></p>
            </span>
    </div>
    <div class="write-a-comment">
        <img src="/images/32.png" class="pull-left" />
            <textarea rows=1 :disabled="isSubmitted" v-bind:style="commentStyle" autofocus v-model="comments.comment" @keydown="leaveComment($event)" v-bind:class="[classTextbox]" class="commentbox-area" name="comments" placeholder="Write a comment ..."></textarea>
     </div>
    </div>
    <div class="clearfix"></div>
    </div>
</template>

<!-- JavaScript-->
<script>
    export default {

        props: ['postMetaData'],
        /*
         * Bootstrap the component. Load the initial data.
         */
        ready: function () {
                this.comments.user_id = this.postMetaData.user_id;
                this.comments.post_id = this.postMetaData.post_id;
                autosize( document.querySelector('.autotextbox' + this._uid) );
        },
        computed: {
            hasMoreComments(){
                return this.postMetaData.comments_count > 0;
            },
           isSubmitted(){
             return this.commentStyle.disabled;
           },
           oldCommentLinkClicked() {
                return this.oldLinkClickedAttr;
           },
           oldCommentLinksHasError(){
                return this.oldCommentLinksError.length > 0 ? true: false;
           }
         },
        /*
         * Initial state of the component's data.
         */
        data: function () {
            return {
                classTextbox: 'autotextbox' + this._uid,
                users: [],
                commentStyle : {
                        borderColor : '#eeeeee',
                        disabled: false
                },
                comments : {
                    user_id : '',
                    post_id : '',
                    comment : '',
                    errors : [],
                    left: false
                },
                recent_activity:{
                    timestamp: Math.round(new Date().getTime()/1000)
                },
                oldLinkClickedAttr: false,
                oldCommentLinksError: []
            };
        },
        methods: {
            getOldComments(e){
                e.preventDefault();
                this.oldLinkClicked();
                this
                    .$http
                    .get('api/posts/'+ this.comments.post_id + '/comments?timestamp=' + this.recent_activity.timestamp)
                    .then( function (success) {
                        var data = success.data;
                        if(data.code == 77)
                        {
                            this.recent_activity.timestamp = success.data.last_timestamp;
                        }
                        _.each(success.data.users,function(user){
                            this.users.unshift(user);
                        }.bind(this));
                    }, function (errors) {
                            this.oldCommentLinksError = [{ error: "Something went wrong. Try again." }];
                    })
                    .finally(function(data) {
                        this.oldCommentLinkUnclicked();
                    });
            },
            oldLinkClicked(){
                this.oldLinkClickedAttr = true;
                this.oldCommentLinksError = [];
            },
            oldCommentLinkUnclicked(){
              this.oldLinkClickedAttr = false;
            },
            leavingComment(){
                 this.commentStyle.disabled = true;
            },
           finishedLeavingComment(){
                if( ! this.comments.left )
                {
                    this.commentStyle.borderColor = 'red';
                }
                    this.commentStyle.disabled = false;
            },
            leaveComment(event){
                if (event.keyCode == 13 && event.shiftKey) {
                    event.stopPropagation();
                    return false;
                }
                if(event.keyCode === 13) {
                    this.leaveAComment();
                }
            },
            leaveAComment(){
                this.leavingComment();
                this
                    .$http
                    .post('/api/posts/'+ this.comments.post_id + '/comment',
                     this.comments)
                    .then( function (success) {
                            this.pushToArray(this.comments);
                            this.$dispatch('leftComment');
                    }, function (errors) {
                        this.comments.left = false;
                    })
                    .finally(function(data) {
                        this.finishedLeavingComment();
                    });
            },
            pushToArray(comments){
                this.users.push({
                        profile_picture : Application.user.image,
                        user_name : Application.user.name,
                        timestamp : Math.round(new Date().getTime()/1000),
                        message : comments.comment
                });
                this.comments.left = true;
                this.comments.comment = '';
            }
        }
    }
</script>