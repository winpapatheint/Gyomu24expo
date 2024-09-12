    <x-guest-layout>

      @php $subtitle=__('hostlisting.influencerinfo'); @endphp
      @include('components.subtitle')
      <!-- ts speaker start-->


    <!-- ts speaker start-->
    <section id="ts-speakers" class="ts-schedule speaker-classic" style="background-image:url(./images/speakers/speaker_bg.png);">
        <div class="container">
           <div class="row">
              <div class="col-lg-8 mx-auto">
                 <h2 class="section-title text-center">
                    {{ __('hostlisting.influencer') }}
                 </h2>
              </div><!-- col end-->
           </div><!-- row end-->

           @if(count($hosts) > 0)
           <div class="row">


            @foreach( $hosts as $key => $influencer )
              <div class="col-lg-3 col-md-6">
                 <div class="ts-speaker">
                    <div class="speaker-img">
                       <img class="img-fluid" src="{{ asset('images/avatar/'.$influencer->profileimg ) }}" alt="">
                       <a href="#popup_{{ $influencer->id }}" class="view-speaker ts-image-popup" data-effect="mfp-zoom-in">
                                   <i class="icon icon-plus"></i>
                               </a>
                    </div>
                    <div class="ts-speaker-info">
                       <h3 class="ts-title"><a href="#">{{ __(config('global.agerange')[$influencer->agerange]) }}</a></h3>
                       <p>
                          {{ __(config('global.infcmedia')[$influencer->infcmedia]) }}
                       </p>
                    </div>
                 </div>
              </div> <!-- col end-->
            @endforeach
            @php $influencers = $hosts; @endphp
            @include('components.influencerdetail')

           </div><!-- row end-->
            @else
             <div style="text-align: center;">
                   <p>登録された主催者がありません</p>
             </div>
            @endif



        </div><!-- container end-->

        @include('components.pagination')
        <!-- shap img-->
        <div class="speaker-shap">
           <img class="shap1" src="images/shap/home_speaker_memphis1.png" alt="">
           <img class="shap2" src="images/shap/home_speaker_memphis2.png" alt="">
        </div>
        <!-- shap img end-->
    </section>
    <!-- ts speaker end-->


    </x-guest-layout>