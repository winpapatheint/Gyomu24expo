    <x-guest-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
       
    $(document).ready(function() {

            var category = '{{ $_GET['bunrui'] ?? "all" }}';

            var selector = '.'+category;
            $('.ts-grid-item').isotope({
                filter:selector
            });

            // console.log(category);
            $("#"+category).show();
            
            $(":button").click(function() {
                $("div.pagi-area").hide();
                var cate = $(this).attr('data-filter').replace('.', '');
                $("#"+cate).show();
            });

        });
    </script>

  <style>
      .ts-gallery {
         padding-bottom: 120px;
      }

      .ts-footer {
         padding-top: 50px;
      }

      .mix-item-menu button.active, .mix-item-menu button:hover, .mix-item-menu button:active {
         border: 1px solid #3b1d82;
      }
      
      .mix-item-menu button {   
         border: 1px solid transparent;
         background-color: transparent;
         background-image: none;
         border-color: #f8f9fa;
         color: #3b1d82;
         outline: medium none;
         display: inline-block;
         font-family: "Poppins",sans-serif;
         font-weight: 600;
         margin: 0 2px 5px;
         padding: 8px 15px;
         position: relative;
         text-transform: uppercase;
         transition: all 0.35s ease-in-out;
         -webkit-transition: all 0.35s ease-in-out;
         -moz-transition: all 0.35s ease-in-out;
         -ms-transition: all 0.35s ease-in-out;
         -o-transition: all 0.35s ease-in-out;
     }      
   </style>


      @php $subtitle="写真集"; 
      $arrlabel = array( 'all' => 'ALL',
            'bunrui1' => '教育支援',
            'bunrui2' => '芸術/デザイン',
            'bunrui3' => 'サービス',
            'bunrui4' => '製造'
               );
      @endphp
      @include('components.subtitle')

   
      <section id="main-container" class="main-container ts-gallery">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center" style="margin-bottom: 25px;">
                      写真集
                  </h2>
              </div><!-- col end-->
          </div>
               <div class="row">
                  <div class="col-md-12 mx-auto text-center" style="margin-bottom: 20px;">
                     <div class="mix-item-menu">
                        @foreach( $gallery as $key => $value )

                        @php


                        if(empty($_GET['bunrui']) AND $key == 'all'){
                            $active = 'active';
                        } else if (!empty($_GET['bunrui']) AND $key == $_GET['bunrui']) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }

                        @endphp
                        <button class="{{$active}}" data-filter=".{{$key}}">{{ $arrlabel[$key] }}</button>
                        @endforeach

                     </div>
                  </div>
               </div>

        <div class="grid ts-grid-item">




                      @foreach( $gallery as $key => $value )

                      @php

                      $lists = $value['lists'];

                      if(empty($_GET['bunrui']) AND $key == 'all'){
                          $active = 'active';
                      } else if (!empty($_GET['bunrui']) AND $key == $_GET['bunrui']) {
                          $active = 'active';
                      } else {
                          $active = '';
                      }

                      $ttlpage = $value['ttlpage'];
                      $bunruicode = $key;

                      @endphp


                                  @if(count($lists) > 0)
                                       @foreach( $lists as $key => $list )
          <div class="grid-item {{ $bunruicode }}">
              <a href="{{ asset('images/'.($list->value)   ) }}" id="{{ $key }}" class="ts-popup"><img src="{{ asset('images/'.($list->value)   ) }}" alt="" /></a>
          </div>

                                       @endforeach
                                    @endif






                      @endforeach


        </div>

                      @foreach( $gallery as $key => $value )

                      @php

                      $ttlpage = $value['ttlpage'];

                      @endphp
                      <div class="pagi-area" id="{{ $key }}" style="display: none;">
                @if ($ttlpage > 0)
                <!-- Pagination -->
                <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">
                  <div class="pages mt-60">
                     <nav aria-label="Page navigation ">
                        <ul class="pagination mx-auto">

                            @php if(empty($_GET['page']))$_GET['page']=1; $set=ceil($_GET['page']/5);@endphp
                            @php $ppage=($_GET['page']-1); $npage=($_GET['page']+1);@endphp

                            <li @if($_GET['page'] < 2) style="display: none" @endif class="page-item"><a class="page-link" href="{{ request()->fullUrlWithQuery(['bunrui' => $key , 'page' => $ppage]) }}"><i class="fa fa-long-arrow-left"></i></a></li>
                            

                            @php $m = 5; if($ttlpage<5)$m=$ttlpage; @endphp
                            
                            @php $k=5*($set-1); @endphp
                            @for ($i = ($k)+1; $i <= (($k)+5); $i++)
                                @if($i<=$ttlpage)
                                    @if($i < (($k)+5))
                                    <li class="page-item @if($_GET['page'] == $i) active @endif"><a class="page-link" href="{{ request()->fullUrlWithQuery(['bunrui' => $key , 'page' => $i]) }}">{{$i}}</a></li>
                                    @endif
                                @endif
                            @endfor
                            
                            <li @if($_GET['page'] == $ttlpage) style="display: none" @endif class="page-item"><a class="page-link" href="{{ request()->fullUrlWithQuery(['bunrui' => $key , 'page' => $npage]) }}"><i class="fa fa-long-arrow-right"></i></a></li>

                        </ul>
                     </nav>
                  </div>
                </div>
                @endif
                      </div>

                      @endforeach        
             <!-- Pagination end -->
      </div><!-- Conatiner end -->
    </section><!-- Main container end --> 

    <!-- ts footer area start-->
    <div class="footer-area">




    </x-guest-layout>