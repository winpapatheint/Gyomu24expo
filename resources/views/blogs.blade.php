    <x-guest-layout>

      @php $subtitle=__('headfoot.titleblog'); @endphp
      @include('components.subtitle')

      <section id="main-container" class="main-container">
         <div class="container">

            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center">
                     <!-- <span>Get Information</span> -->
                     {{ __('headfoot.titleblog') }}
                  </h2>
               </div><!-- col end-->
            </div>
            
            <div class="row">

               <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">

                  @if(count($lists) > 0)
                     @foreach( $lists as $key => $list )
                     <div class="post">
                        <div class="post-media post-image">
                           <a href="{{ url('/blog/'.$list->id ) }}"><img src="{{ asset('images/'.($list->headimg ?? 'blog/blog1.jpg' ) ) }}" class="img-fluid" alt=""></a>
                        </div>

                        <div class="post-body">
                           <div class="post-meta">
                              <span class="post-author">
                                       <a href="{{ url('/blog/'.$list->id ) }}">{{ $list->author }}</a>
                                    </span>

                              <div class="post-meta-date">
                                 {{ date('Y\年m\月d\日', strtotime($list->created_at)) }}  　{{ $list->category == 1 ? __('welcome.news') : __('welcome.info') }}
                              </div>
                           </div>
                           <div class="entry-header">
                              <h2 class="entry-title">
                                 <a href="{{ url('/blog/'.$list->id ) }}">{{ $list->title }}</a>
                              </h2>
                           </div><!-- header end -->

                           <div class="entry-content">
                              <p>{!! $list->content !!}</p>
                           </div>

                           <div class="post-footer">
                              <a href="{{ url('/blog/'.$list->id ) }}" class="btn-link">{{ __('blog.more') }}<i class="icon icon-arrow-right"></i></a>
                           </div>

                        </div><!-- post-body end -->
                     </div><!-- 1st post end -->
                     @endforeach 

                  @else
                   <div style="text-align: center;">
                         <p>登録された新着情報がありません</p>
                   </div>
                  @endif

                @include('components.pagination')

               </div><!-- Content Col end -->

            </div><!-- Main row end -->

         </div><!-- Container end -->
      </section><!-- Main container end -->

    </x-guest-layout>