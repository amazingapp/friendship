<template>
  <div>
      <div class="panel panel-default" v-cloak v-for="post in timeline">
                <div class="user-post panel-body">
                              <div class="timeline-profile">
                                   <img :src="post.user.image" class="pull-left" style="height:32px;width:32px;" />
                                     <h5 class="h5bold">
                                         <a href="#"> {{ post.user.name }} </a>
                                     </h5>
                                   <small class="text-muted">
                                      <span class="glyphicon glyphicon-time"></span>&nbsp;
                                              <a class="text-muted" href="{{ post.permalink }}">
                                                <abbr title="{{ post.commented_at | formatProperDate}} ">
                                                  <span class="timestampContent"> {{ post.commented_at | moment }}</span>
                                              </abbr>
                                            </a>
                                    </small>
                                   <div class="clearfix"></div>
                              </div>
                              <div class="user-post-status">
                                  {{ post.message }}
                              </div>
                  <post-comments :post-meta-data="{ comments_count: post.comments_count, user_id: post.user.id, post_id: post.id }"></post-status-comments>
                </div>
      </div>

      <ul class="pager">
              <li v-if="isPreviousPageUrlDisabled" v-bind:class="{ 'disabled': isPreviousPageUrlDisabled }" class="previous"><span>&larr; Newer</span></li>
              <li v-if="! isPreviousPageUrlDisabled" class="previous"><a v-on:click="getPreviousPage($event)"  href="javascript::void();" rel="prev">&larr; Newer</a></li>
          <!-- Next Page Link -->
              <li v-if="! isNextPageUrlDisabled" class="next"><a v-on:click="getNextPage($event)" href="javascript::void();" rel="next">Older &rarr;</a></li>
              <li v-if="isNextPageUrlDisabled" v-bind:class="{'disabled' : isNextPageUrlDisabled}" class="next "><span>Older&rarr;</span></li>
      </ul>
  </div>
</template>

<script>
    export default {
        ready() {
            this.getTimeline();
        },
        filters: {
          formatProperDate(date){
            return moment().format("dddd, MMMM D, YYYY [at] h:mm a");
          },
          moment(date) {
            return moment(date).fromNow();
          },
          timestamp(date){
            return moment(date).unix();
          },
        },
        data(){
            return {
                timeline_url : 'api/@' +Application.User.employee_id + '/timeline',
                timeline: [],
                paginator: []
            }
        },
        computed: {
            isPreviousPageUrlDisabled(){
              return this.onFirstPage();
            },
            isNextPageUrlDisabled(){
              return this.onLastPage();
            }
         },
        events: {
            timelineRetrived(timeline){
               this.paginator = timeline;
                this.timeline = timeline.data;
            },

        },

        methods:{
            getTimeline(){
                this
                    .$http
                    .get(this.timeline_url)
                    .then(function(timeline){
                        this.$dispatch('timelineRetrived', timeline.data );
                    },function(errors) {
                            console.log(errors);
                    });
            },
            getPreviousPage(event){
              event.preventDefault();
              this.timeline_url = this.previousPageUrl().replace(/^.*\/\/[^\/]+/, '');
              this.getTimeline();
            },
            // get next page
            getNextPage(event){
                event.preventDefault();
                this.timeline_url = this.nextPageUrl().replace(/^.*\/\/[^\/]+/, '');
                this.getTimeline();
            },

            // Pagination Methods
            currentPage(){
              return this.paginator.current_page;
            },
            lastPage(){
              return this.paginator.last_page;
            },
            onFirstPage(){
               return this.currentPage() <= 1;
            },
            onLastPage(){
               return  this.currentPage() == this.lastPage();
            },
            hasMorePages(){
              return this.paginator.currentPage() < this.paginator.lastPage();
            },
            previousPageUrl(){
              return this.paginator.prev_page_url;
            },
            nextPageUrl(){
              return this.paginator.next_page_url;
            }
        }
    }
</script>
