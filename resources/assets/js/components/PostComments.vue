<!-- HTML TEMPLATE -->
<template>
    <div>
        <div class="comment">
            <div class="view-more-comments">
                    <a href="#" v-show="hasPreviousComments" v:on:click="getPreviousComments">View more comments</a>
                    <span class="old-comment-status">
                        <img v-if="isRequestingAjax" style="width:12px;" src="/images/loader.gif" alt="loading...">
                        <span v-if="previousCommentsHasError" class="text-danger"> Something went wrong. Try again.</span>
                    </span>
            </div>
            <div class="userComments" v-for="user in users | orderBy 'timestamp'">
                    <span class="user-profile-image">
                            <img :src="user.profile_picture" class="pull-left" />
                    </span>
                    <span class="user-message"> <a href="javascript:void();">
                         {{ user.user_name }}</a> {{ user.message }}
                     <p><a class="text-muted" href="javascript:void();">{{ user.timestamp | formatProperDate }}</a></p>
                    </span>
            </div>
            <div class="write-a-comment">
                <img src="/images/32.png" class="pull-left" />
                    <textarea rows=1 :disabled="isSubmitted" v-bind:style="commentStyle" autofocus v-model="comment.message" @keydown="leaveComment($event)" v-bind:class="[classTextbox]" class="commentbox-area" name="comments" placeholder="Write a comment ..."></textarea>
             </div>
            </div>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
         props: ['postMetaData'],
         ready(){
                this.comments_count = this.postMetaData.comments_count; //currrent count of comments
                this.post_id = this.postMetaData.post_id; // post id
                this.user_id = this.postMetaData.user_id; // user id of post's creator
         },
         computed:{
                hasPreviousComments(){
                    return this.comments_count > 0;
                },
                isRequestingAjax(){
                    return !! this.ajax;
                },
                previousCommentsHasError()
                {
                    return this.previousCommentsError.length > 0;
                }
         },
         data(){
            return {
                ajax: false,
                comments_count : 0,
                comment_url : 'api/posts/' + this.post_id+ '/comments',
                previousCommentsError: [],
                errors : [],
                users: [], // is the collection of users comments
                comment: [], // this is the comment which get pushed onto users array only if is saved in db
            };
         },
         events: {
            initiatingAjaxRequest(){
                this.ajax = true;
            },
            finishedAjaxRequest(){
                this.ajax = false;
            },
            leavingComment(){
                 this.commentStyle.disabled = true;
            },
            commentCallBackFinished(){
                 if( ! this.comment.left )
                {
                    this.commentStyle.borderColor = 'red';
                }
                    this.commentStyle.disabled = false;
            }
         },

         methods: {
                getPreviousComments(){
                    this.$dispatch('initiatingAjaxRequest');
                    this
                        .get(this.getCommentUrl())
                        .then(function(success){

                        },function(failed) {

                        })
                        .finally(function(){
                            this.$dispatch('finishedAjaxRequest');
                        });
                },
                leaveAComment(){
                    this.$dispatch('leavingComment');
                    this
                        .$http
                        .post('/api/posts/'+ this.post_id + '/comment', this.comment )
                        .then( function (success) {
                            this.appendToUsers(this.comment);
                        }, function (errors) {
                            this.comments.left = false;
                        })
                        .finally(function(data) {
                            this.$dispatch('commentCallBackFinished');
                        });
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
                appendToUsers(comment){
                    this.users.push({
                            profile_picture : Application.user.image,
                            user_name : Application.user.name,
                            commented_at : Math.round(new Date().getTime()/1000),
                            message : comment.message
                    });
                },

         }
    }
</script>