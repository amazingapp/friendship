@extends('layouts.master')
@section('content')
    <div class="container container-timeline">
          <div class="row">
              <div class="col-md-8">
                  @include('users.partials.user-post')
                  @include('users.partials.user-single-timeline-post')
              </div>
              <!-- Blog Sidebar Widgets Column -->
              <div class="col-md-4">
                  <!-- Blog Categories Well -->
                  <div class="well">
                      <h4>Favourites</h4>
                      <div class="row">
                          <div class="col-lg-6">
                              <ul class="list-unstyled">
                                  <li><a href="#">News Feeds</a></li>
                                  <li><a href="#">Messages</a>
                                  </li>
                                  <li><a href="#">Events</a>
                                  </li>
                              </ul>
                          </div>
                          <!-- /.col-lg-6 -->
                      </div>
                      <!-- /.row -->
                  </div>

                  <!-- Side Widget Well -->
                  <div class="well">
                      <h4>Side Widget Well</h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                  </div>

              </div>

          </div>
          <!-- /.row -->
          <hr>

          <!-- Footer -->
          <footer>
              <div class="row">
                  <div class="col-lg-12">
                      <p>Copyright &copy; Your Website 2014</p>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
          </footer>

      </div>

@endsection
