    <x-guest-layout>

      @php $subtitle="ゼミナビについて"; @endphp
      @include('components.subtitle')

    
    <!-- ts intro start -->
    <section class="ts-about-intro section-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-title">
              <!-- <span>ゼミナビに参加しよう</span> -->
              参加する理由
            </h2>
          </div><!-- section title end-->
        </div><!-- col end-->
        <div class="row">
          <div class="col-lg-4">
            <div class="about-intro-text text-right mb-60 mr-70">
              <i class="icon-speaker"></i>
               <h3 class="ts-title">好きな講座が受講できる</h3>
               <p>
                  オンラインゼミなので、国と場所の制限なく、主催者（講師）の講座が受講できる。
               </p>
            </div><!-- single intro text end-->

            <div class="about-intro-text text-right mr-70">
              <i class="icon-netwrorking"></i>
              <h3 class="ts-title">IBT試験の受験ができる</h3>
              <p>
                  IBT試験なので、国と場所の制限なく、受けてみたい各種IBT試験に参加できる。
              </p>
            </div><!-- single intro text end-->
            <div class="border-shap left"></div>
          </div><!-- col end-->
          <div class="col-lg-4 align-self-center">
            <div class="about-video">
              <img class="img-fluid" src="images/about/about_img1.jpg" alt="">
              <a href="{{ $setting['aboutuspagevideo'] ?? 'https://www.youtube.com/watch?v=Bey4XXJAqS8' }}" class="video-btn ts-video-popup"><i class="icon icon-play"></i></a>
            </div><!-- entro video end-->
          </div><!-- col end-->
          <div class="col-lg-4">
            <div class="about-intro-text mb-60 ml-70">
              <i class="icon-people"></i>
               <h3 class="ts-title">市場開拓ができる</h3>
               <p>
                  主催会社は、オンラインゼミとIBT試験を企画して、新規市場の開拓ができる。
               </p>
            </div><!-- single intro text end-->

            <div class="about-intro-text ml-70">
              <i class="icon-fun"></i>
              <h3 class="ts-title">ファンが増える</h3>
              <p>
                主催者（講師）は、オンラインゼミを通して、世界中からファンを増やすことができる。
              </p>
            </div><!-- single intro text end-->
            <div class="border-shap left"></div>
          </div><!-- col end-->
        </div><!-- row end-->
      </div><!-- container end-->
    </section>
    <!-- ts intro end-->

    <section class="ts-event-outcome">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="">
              <div class="outcome-content ts-exp-content">
                <h2 class="column-title">
                  <span>ゼミナビを通して</span>
                  新しいことを学び、人々とつながる
                </h2>
                <p class="text-white">
                  最新のテクノロジーと消費者の消費と習慣が、どのうように変化していくのか、主催者（講師）から直接聞けます。
                </p>
                <!-- <a href="#" class="btn">Buy Ticket</a> -->
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="outcome-content">
              <div class="outcome-img overlay">
                <img class="" src="images/about/learn_img.jpg" alt="">
              </div>
              <h3 class="img-title text-white">物事を学ぶ</h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="outcome-content">
              <div class="outcome-img overlay">
                <img class="" src="images/about/connect_img.jpg" alt="">
              </div>
              <h3 class="img-title text-white">人とつながる</h3>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ts speaker start-->
    <section id="ts-speakers" class="ts-schedule" style="background-image:url(./images/speakers/speaker_bg.png)">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="section-title text-center">
              <!-- <span>聞きましょう</span> -->
              主催者（講師）
            </h2>
          </div><!-- col end-->
        </div><!-- row end-->
        <div class="row">

               @foreach( $hosts as $key => $host )
               <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
                  <div class="ts-speaker">
                     <div class="speaker-img">
                        <img class="img-fluid" src="{{ asset('images/avatar/'.($host->profileimg ?? 'defaultavatar.jpg') ) }}" alt="">
                        <a href="#popup_{{$loop->index}}" class="view-speaker ts-image-popup" data-effect="mfp-zoom-in">
                                    <i class="icon icon-plus"></i>
                                </a>
                     </div>
                     <div class="ts-speaker-info">
                        <h3 class="ts-title"><a href="#">{{ $host->name }}</a></h3>
                        <p>
                           {{ $host->furiname }}
                        </p>
                     </div>
                  </div>
                  <!-- popup start-->
                  <div id="popup_{{$loop->index}}" class="container ts-speaker-popup mfp-hide">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="ts-speaker-popup-img">
                              <img src="{{ asset('images/avatar/'.($host->profileimg ?? 'defaultavatar.jpg') ) }}" alt="">
                           </div>
                        </div><!-- col end-->
                        <div class="col-lg-6">
                           <div class="ts-speaker-popup-content">
                              <h3 class="ts-title">{{ $host->name }}</h3>
                              <span class="speakder-designation">{{ $host->profile }}</span>
                              @if(!empty($host->hcompanylogo))
                              <img class="company-logo" src="{{ asset('images/avatar/'.$host->hcompanylogo) }}" alt="">
                              @endif
                              <p>
                                 {{ $host->hcompanybunrui }}
                              </p>

                              @if(count($host->nextsem) > 0)
                              <h4 class="session-name">
                                 次のゼミ
                              </h4>
                              <div class="row">
                                 @foreach( $host->nextsem as $k => $nextsem )
                                 <div class="col-lg-6">
                                    <div class="speaker-session-info">
                                       <h4>{{ date('Y\年m\月d\日', strtotime($nextsem->start)) }}</h4>
                                       <span>
                                             {{ date('H:i', strtotime($nextsem->start)) }} - {{ date('H:i', strtotime($nextsem->end)) }}
                                       </span>
                                          <p>{{ $nextsem->name}}</p>
                                       <!-- <a href="{{ url('/seminardetail/'.rand ( 10000 , 99999 ).$nextsem->id ) }}">
                                       </a> -->
                                    </div>
                                 </div>
                                 @endforeach
                              </div>
                              @endif
                              <!-- <div class="ts-speakers-social">
                                 <a href="#"><i class="fa fa-facebook"></i></a>
                                 <a href="#"><i class="fa fa-twitter"></i></a>
                                 <a href="#"><i class="fa fa-instagram"></i></a>
                                 <a href="#"><i class="fa fa-google-plus"></i></a>
                                 <a href="#"><i class="fa fa-linkedin"></i></a>
                              </div> -->
                           </div><!-- ts-speaker-popup-content end-->
                        </div><!-- col end-->
                     </div><!-- row end-->
                  </div><!-- popup end-->
               </div> <!-- col end-->
               @endforeach

            </div><!-- row end-->


            <div class="schedule-listing-btn">
               <a href="{{ url('/hostlisting' ) }}" class="btn">主催者一覧へ</a>
            </div>

      </div><!-- container end-->

      <!-- shap img-->
      <!-- <div class="speaker-shap">
      <img class="shap1" src="images/shap/home_speaker_memphis1.png" alt="">
      <img class="shap2" src="images/shap/home_speaker_memphis2.png" alt="">
      <img class="shap3" src="images/shap/home_speaker_memphis3.png" alt="">
    </div> -->
      <!-- shap img end-->
    </section>
    <!-- ts speaker end-->

    <section class="ts-funfact" style="background-image: url(./images/funfact_bg.jpg)">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="ts-single-funfact">
              <h3 class="funfact-num"><span class="counterUp" data-counter="{{$setting['ttlteacher']}}">{{$setting['ttlteacher']}}</span>+</h3>
              <h4 class="funfact-title">主催者（講師）</h4>
            </div>
          </div><!-- col end-->
          <div class="col-lg-3 col-md-6">
            <div class="ts-single-funfact">
              <h3 class="funfact-num"><span class="counterUp" data-counter="{{$setting['ttlhcompany']}}">{{$setting['ttlhcompany']}}</span></h3>
              <h4 class="funfact-title">主催会社</h4>
            </div>
          </div><!-- col end-->
          <div class="col-lg-3 col-md-6">
            <div class="ts-single-funfact">
              <h3 class="funfact-num"><span class="counterUp" data-counter="{{$setting['ttlseminar']}}">{{$setting['ttlseminar']}}</span>+</h3>
              <h4 class="funfact-title">ゼミ</h4>
            </div>
          </div><!-- col end-->
          <div class="col-lg-3 col-md-6">
            <div class="ts-single-funfact">
              <h3 class="funfact-num"><span class="counterUp" data-counter="{{$setting['ttluser']}}">{{$setting['ttluser']}}</span>+</h3>
              <h4 class="funfact-title">参加者</h4>
            </div>
          </div><!-- col end-->
        </div><!-- row end-->
      </div><!-- container end-->
    </section>

      <!-- ts sponsors start-->
      <section class="ts-intro-sponsors section-bg">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <h2 class="section-title">
                     <!-- <span>Who helps us</span> -->
                     主催会社
                  </h2><!-- section title end-->
               </div><!-- col end-->
            </div><!-- row end-->
            <div class="row">
               <div class="col-lg-12">
                  <div class="sponsors-logo text-center">
                     @foreach( $hcompany as $key => $list )
                     <a href=""><img src="{{ asset('images/avatar/'.$list->profileimg ) }}" alt=""></a>
                     @endforeach
                     <div class="sponsor-btn text-center">
                        <a href="{{ url('/sponsors') }}" class="btn">主催会社一覧へ</a>
                     </div>
                  </div><!-- sponsors logo end-->
               </div><!-- col end-->
            </div><!-- row end-->
         </div><!-- container end-->
      </section>
      <!-- ts sponsors end-->

      <!-- ts map direction start-->
      <section class="ts-map-direction wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
         <div class="container">
            <div class="row">
               <div class="col-lg-5">
                  <h2 class="column-title">
                     <span>運営会社</span>
                      Asia Human Development, Inc.
                  </h2>

                  <div class="ts-map-tabs">
                     <ul class="nav" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">所在地</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">会社名</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#references" role="tab" data-toggle="tab">問い合わせ窓口</a>
                        </li>
                     </ul>

                     <!-- Tab panes -->
                     <div class="tab-content direction-tabs">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                           <div class="direction-tabs-content">
                              <!-- <h3>アジア人材開発株式会社</h3> -->
                              <p class="derecttion-vanue">
                                 〒171-0014 東京都豊島区池袋4-27-5 和田ビル502号
                              </p>
                                 <!-- <div class="row">
                                    <div class="col-md-6">
                                       <div class="contact-info-box">
                                          <h3>主催会社情報 </h3>
                                          <p><strong>Name:</strong> ゼミ事務局</p>
                                          <p><strong>Phone:</strong> (+81)　03-3981-5090</p>
                                          <p><strong>Email: </strong> info@asia-hd.com</p>
                                       </div>

                                    </div>
                                    <div class="col-md-6">
                                       <div class="contact-info-box">
                                          <h3>スケジュール </h3>
                                          <p><strong>Name:</strong> ゼミ事務局</p>
                                          <p><strong>Phone:</strong> (+81)　03-3981-5090</p>
                                          <p><strong>Email: </strong> info@asia-hd.com</p>
                                       </div>
                                    </div>
                                 </div> --><!-- row end-->
                           </div><!-- direction tabs end-->
                        </div><!-- tab pane end-->
                        <div role="tabpanel" class="tab-pane fade" id="buzz">
                           <div class="direction-tabs-content">
                              <h3>アジア人材開発株式会社</h3>
                              <!-- <p class="derecttion-vanue">
                                 〒171-0014 東京都豊島区池袋4-27-5 和田ビル502号
                              </p>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="contact-info-box">
                                          <h3>主催会社情報 </h3>
                                          <p><strong>Name:</strong> ゼミ事務局</p>
                                          <p><strong>Phone:</strong> (+81)　03-3981-5090</p>
                                          <p><strong>Email: </strong> info@asia-hd.com</p>
                                       </div>

                                    </div>
                                    <div class="col-md-6">
                                       <div class="contact-info-box">
                                          <h3>スケジュール </h3>
                                          <p><strong>Name:</strong> ゼミ事務局</p>
                                          <p><strong>Phone:</strong> (+81)　03-3981-5090</p>
                                          <p><strong>Email: </strong> info@asia-hd.com</p>
                                       </div>
                                    </div>
                                 </div> --><!-- row end-->
                           </div><!-- direction tabs end-->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="references">
                           <div class="direction-tabs-content">
                              <!-- <h3>アジア人材開発株式会社</h3>
                              <p class="derecttion-vanue">
                                 〒171-0014 東京都豊島区池袋4-27-5 和田ビル502号
                              </p> -->
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="contact-info-box">
                                          <h3>主催会社について </h3>
                                          <p><strong>Name:</strong> ゼミ事務局</p>
                                          <p><strong>Phone:</strong> (+81)　03-3981-5090</p>
                                          <p><strong>Email: </strong> info@asia-hd.com</p>
                                       </div>

                                    </div>
                                    <div class="col-md-6">
                                       <div class="contact-info-box">
                                          <h3>ゼミについて </h3>
                                          <p><strong>Name:</strong> ゼミ事務局</p>
                                          <p><strong>Phone:</strong> (+81)　03-3981-5090</p>
                                          <p><strong>Email: </strong> info@asia-hd.com</p>
                                       </div>
                                    </div>
                                 </div><!-- row end-->
                           </div><!-- direction tabs end-->
                        </div>
                     </div>

                  </div><!-- map tabs end-->

               </div><!-- col end-->
               <div class="col-lg-6 offset-lg-1">
                  <div class="ts-map">
                     <div class="mapouter">
                        <div class="gmap_canvas">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.522331054998!2d139.70833496520183!3d35.73796443446593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601892a013f0b07b%3A0x6f4bc2df48460141!2z77yI5qCq77yJ44OZ44K544OI44O744Kz44Og!5e0!3m2!1sja!2sjp!4v1614314769884!5m2!1sja!2sjp"></iframe>
                        </div>

                     </div>
                  </div>
               </div>
            </div><!-- col end-->
         </div><!-- container end-->
         <div class="speaker-shap">
            <img class="shap1" src="images/shap/Direction_memphis3.png" alt="">
            <img class="shap2" src="images/shap/Direction_memphis2.png" alt="">
            <img class="shap3" src="images/shap/Direction_memphis4.png" alt="">
            <img class="shap4" src="images/shap/Direction_memphis1.png" alt="">
         </div>
      </section>
      <!-- ts map direction end-->

    </x-guest-layout>