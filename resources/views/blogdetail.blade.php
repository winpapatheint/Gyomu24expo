    <x-guest-layout>

      @php $subtitle=__('headfoot.titleblog'); @endphp
      @include('components.subtitle')


      <section class="main-container pb-0" id="main-container">
         <div class="container">

           <div class="row">
             <div class="col-lg-12">
               <h2 class="section-title">
                 <!-- <span>セミナーナビに参加しよう</span> --> 
                  {{ __('blog.blogdetail') }}
               </h2>
             </div><!-- section title end-->
           </div><!-- col end-->

            <div class="row">
               <div class="col-lg-10 mx-auto">
                  <div class="blog-details">
                     <div class="entry-header">
                        <h2 class="entry-title text-center">
                           <a href="#">{{ $blog->title }}</a>
                        </h2>
                     </div><!-- header end -->
                     <div class="post-meta text-center">
                        <span class="post-author"><a href="#"> {{ $blog->author }}</a></span>
                        <span class="post-meta-date">{{ date('Y\年m\月d\日', strtotime($blog->created_at)) }}</span> 
                        <span class="post-cat"><a href="#"> {{ $blog->category == 1 ? __('welcome.news') : __('welcome.info') }}</a></span>
                     </div>
                     <div class="post-media post-image text-center">
                        <img class="img-fluid" src="{{ asset('images/'.($blog->headimg ?? 'blog/blog-details.jpg')   ) }}" alt="">
                     </div>
                     <div class="post-content post-single">
                        <div class="post-body clearfix">
                           <div class="entry-content">
                              <p>{!! $blog->content !!}</p>

                           </div>

                        </div>

                        <nav class="post-navigation clearfix mrtb-40">
                           @if(!empty($blogbefo))
                           <div class="post-previous" style="float: left">
                              <a href='{{ url("/blog/".$blogbefo->id ) }}'>
                                 <h3>{{ $blogbefo->title }}</h3><span><i class="fa fa-long-arrow-left"></i>{{ __('blog.next') }}</span></a>
                           </div>
                           @endif
                           @if(!empty($blognext))
                           <div class="post-next" style="float: right">
                              <a href='{{ url("/blog/".$blognext->id ) }}'>
                                 <h3>{{ $blognext->title }}</h3><span>{{ __('blog.befo') }}<i class="fa fa-long-arrow-right"></i></span></a>
                           </div>
                           @endif
                        </nav>



                     </div>
                     <!-- Post content end-->
                  </div>
               </div>
            </div>
         </div>
         <!-- Container end-->
      </section>
      

               </div>
            </div>
         </div>
      </section> 

    </x-guest-layout>