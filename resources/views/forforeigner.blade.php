    <x-guest-layout>

      <style type="text/css">



      .ts-pricing-price {
          font-size: 30px !important;
      }

      @media screen and (min-width: 998px) {
         .btnbig {
             font-size: 26px !important;
             width: 50%;
             height: 80px;
             line-height: 80px;
         }
      }

      @media (max-width: 767px){

         .logoimg {
             max-width:400px;
         }
      }

      </style>

      <!-- banner start-->
      <section class="hero-area">
         <div class="banner-item" style="background-color:#253976;">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="banner-content-wrap text-center">
                        @if(!empty($topseminar->start))
                        <input type="hidden" id="topseminartime" value="{{ date('d M Y H:i:s', strtotime($topseminar->start ?? ''))  }}">
                        @endif
                        <p class="banner-info wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="500ms">{{ __('日本で働きませんか。') }}</p>
                        @if(!empty($topseminar->start))
                        <p class="banner-info wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="700ms">{{ date("Y\\年m\\月d\\日 H:i", strtotime($topseminar->start))  }} - {{ date("H:i", strtotime($topseminar->end))  }}</p>
                        @endif
                        <h1 class="banner-title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="700ms">{{ '日本には、' }}</h1>
                        <h1 class="banner-title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="700ms" style="width: 95%;">{!! 'あなたを必要とする日本企業がたくさんあります。' !!}</h1>
                        @if(!empty($topseminar->name))
                        @endif


<!--                         <div class="countdown wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="800ms">
                           <div class="counter-item">
                              <i class="icon icon-ring-1Asset-1"></i>
                              <span class="days">00</span>
                              <div class="smalltext">Days</div>

                           </div>
                           <div class="counter-item">
                              <i class="icon icon-ring-4Asset-3"></i>
                              <span class="hours">00</span>
                              <div class="smalltext">Hours</div>
                           </div>
                           <div class="counter-item">
                              <i class="icon icon-ring-3Asset-2"></i>
                              <span class="minutes">00</span>
                              <div class="smalltext">Minutes</div>
                           </div>
                           <div class="counter-item">
                              <i class="icon icon-ring-4Asset-3"></i>
                              <span class="seconds">00</span>
                              <div class="smalltext">Seconds</div>
                           </div>
                        </div> -->
                        <!-- Countdown end -->
                        <div class="banner-btn wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="800ms">
                          @if(!empty($topseminar->joinurl))
                           <a href="{{ $topseminar->joinurl }}" class="btn @if( (new DateTime() > new DateTime(date('Y-m-d H:i',strtotime('-5 minutes',strtotime($topseminar->start))) )) AND (new DateTime() < new DateTime(date('Y-m-d', strtotime($topseminar->end)) )) ) ok @else disabled @endif">{{ __('welcome.btnjoinevent') }}</a>
                          @endif
                        </div>
                     </div>
                     <!-- Banner content wrap end -->
                  </div><!-- col end-->
                  <div class="col-lg-4 align-self-end">
                     <div class="banner-img">
                        <!-- women picture -->
                        <!-- <img src="{{ asset('images/hero_area/banner_img02.png') }}" alt=""> -->

                     </div>
                  </div>
               </div><!-- row end-->
            </div>
            <!-- Container end -->
         </div>
         <!-- banner slice image-->
         <div class="tiles">
            <div class="tile" data-scale="1.1" data-image="{{ asset('images/hero_area/banner_slices.png') }}"></div>
         </div>
      </section>
      <!-- banner end-->

      <!-- ts experience start-->
      <section id="ts-speakers" class="ts-schedule speaker-classic" style="background-image:url(./images/speakers/speaker_bg.png);">
         <div class="container">
           <div class="row">
              <div class="col-lg-8 mx-auto">
                 <h2 class="section-title text-center">
                    {{ __('こんな企業で就業できます') }}
                 </h2>
              </div><!-- col end-->
           </div><!-- row end-->
            <div class="row">
               <div class="col-lg-12 align-self-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
                  <div class="ts-schedule-content">
                    <div class="row">
                      <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-02-01.jpg') }}" alt=""><p style="margin-bottom: 5px;">{!! __('①ソフトウェア開発会社') !!}</p></div>
                      <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-02-02.jpg') }}" alt=""><p style="margin-bottom: 5px;">{!! __('②ものつくりの工場') !!}</p></div>
                    </div>
                    <div class="row">
                      <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-02-03.jpg') }}" alt=""><p style="margin-bottom: 5px;">{!! __('③農家 ') !!}</p></div>
                      <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-02-04.jpg') }}" alt=""><p style="margin-bottom: 5px;">{!! __('④サービス企業') !!}</p></div>
                    </div>
                  </div>
               </div><!-- col end-->
            </div><!-- row end-->

            <div class="row">
               <div class="col-lg-12 align-self-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
                  <div class="schedule-listing-btn">
                     <a href="{{ url('/registerhost' ) }}" class="btn btnbig" style="font-weight:unset;">{{ __('求職希望の無料会員登録はこちら') }}</a>
                  </div>
               </div>
            </div>

         </div><!-- container end-->











      </section>


      <section class="ts-schedule" style="background-color: #dee1e6;">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 align-self-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
                  <div class="ts-schedule-content">
                     <h2 class="section-title">
                        <!-- <span>{{ __('初めての方') }}</span> -->
                        {{ __('就業までの流れ') }}
                     </h2>

                        <div class="row">
                          <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-03-01.png') }}" alt=""><p style="margin-bottom: 5px;">{!! __('会員登録') !!}</p></div>
                          <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-03-02.png') }}" alt=""><p style="margin-bottom: 5px;">{!! __('ログインして、求人情報を確認') !!}</p></div>
                          <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-03-03.png') }}" alt=""><p style="margin-bottom: 5px;">{!! __('オンライン面談に参加') !!}</p></div>
                          <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-03-04.png') }}" alt=""><p style="margin-bottom: 5px;">{!! __('内定書をもらう') !!}</p></div>
                          <div class="col-sm text-center"><img style="width: 100%;" class="schedule-slot-speakers" src="{{ asset('images/speakers/f-03-05.png') }}" alt=""><p style="margin-bottom: 5px;">{!! __('就業') !!}</p></div>
                        </div>

                  </div>
               </div><!-- col end-->
            </div><!-- row end-->
<!--             <div class="row">
               <div class="col-lg-12 align-self-center wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="400ms">
                  <div class="schedule-listing-btn">
                     <a href="{{ url('/registertutor' ) }}" class="btn btnbig" style="font-weight:unset;">{{ __('無料体験希望の方はこちら') }}</a>
                  </div>
               </div>
            </div> -->
         </div><!-- container end-->
      </section>

      <section class="ts-schedule">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 " bis_skin_checked="1">
                  <div class="faq-content mb-70 " bis_skin_checked="1">
                     <h2 class="section-title">
                        よくあるご質問
                     </h2>
                     <div class="panel-group faq-item" id="accordion" role="tablist" aria-multiselectable="true" bis_skin_checked="1">

                        <div class="panel faq-list panel-default" bis_skin_checked="1">
                           <div class="panel-heading" role="tab" id="headingOne" bis_skin_checked="1">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" bis_skin_checked="1">
                                    {{ __('1. すぐにでも新しい職場で働きたいですが、どれぐらいで見つかりますか？') }}  
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne" bis_skin_checked="1">
                              <div class="panel-body" bis_skin_checked="1">
                                  {{ __('人によってさまざまですが、最初の面談から１ヶ月～３ヶ月ほどで、ご入社される方が多いです。') }} 
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default" bis_skin_checked="1">
                           <div class="panel-heading" role="tab" id="headingTwo" bis_skin_checked="1">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" bis_skin_checked="1">
                                    2. 登録を考えていますが、今の職場が忙しくて、面談にいく時間がとれません。
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" bis_skin_checked="1">
                              <div class="panel-body" bis_skin_checked="1">
                           面談は、電話やスカイプでの面談で行いますのでご安心ください。
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default" bis_skin_checked="1">
                           <div class="panel-heading" role="tab" id="heading3" bis_skin_checked="1">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3" bis_skin_checked="1">
                                    3. 内定をいただいた後に、辞退することはできますか？
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3" bis_skin_checked="1">
                              <div class="panel-body" bis_skin_checked="1">
                           可能です。転職前に不安が感じ始めることもあるかもしれません。納得の上で、転職をしていただきたいと思いますので、まずはお考えになっていることをお伝えください。内定先への辞退の連絡は、専任のエージェントが行います。
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default" bis_skin_checked="1">
                           <div class="panel-heading" role="tab" id="heading4" bis_skin_checked="1">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4" bis_skin_checked="1">
                                    4. 未経験でも応募は可能ですか？
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4" bis_skin_checked="1">
                              <div class="panel-body" bis_skin_checked="1">
                           応募可能です。
ご自分の夢と情熱を持った方には是非ご応募いただき、サポートさせていただきたいと考えております。
※経験必須の求人につきましてはご了承ください。
                              </div>
                           </div>
                        </div>


                     </div><!-- panel-group -->

                  </div>


               </div><!-- col end -->
            </div><!-- row end-->

         </div><!-- container end-->
      </section>









   
    </x-guest-layout>