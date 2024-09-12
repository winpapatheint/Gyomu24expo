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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      @php $subtitle=__('会員登録'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">


               <div class="col-lg-8 mx-auto">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @php $error = $errors->toArray(); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('contact') }}" style="border:1px solid; padding:30px; border-radius: 30px;">
                  @csrf
                     <div class="error-container"></div>

                        <div class="row">
                          <div class="col-sm text-center"><img style="width: 95%; height: 212px;" class="schedule-slot-speakers" src="{{ asset('images/speakers/m-06-01.png') }}" alt=""><p style="font-size: 18px;"><input type="checkbox" data-link="register" style="width: 16px;height: 16px;"> {!! __('求人会社') !!}</p></div>
                          <div class="col-sm text-center"><img style="width: 95%; height: 212px;" class="schedule-slot-speakers" src="{{ asset('images/speakers/m-06-02.png') }}" alt=""><p style="font-size: 18px;"><input type="checkbox" data-link="registerhost" style="width: 16px;height: 16px;"> {!! __('求職希望者') !!}</p></div>
                          <!-- <div class="col-sm text-center"><img style="width: 95%; height: 212px;" class="schedule-slot-speakers" src="{{ asset('images/speakers/m-06-03.png') }}" alt=""><p style="font-size: 18px;"><input type="checkbox" data-link="registerhcompany" style="width: 16px;height: 16px;"> {!! __('法人') !!}</p></div> -->
                        </div>

                     <div class="text-center">
                        <a id="registerlink" href="">
                        <button class="btn btnbig" type="button" id="linkbtn">{{ __('今すぐ無料登録する ') }}</button>
                        </a>
                     </div>
                  </form><!-- Contact form end -->
               </div>
            </div>
         </div>
         <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div>
      </section>

<script type="text/javascript">
       

    $(document).ready(function() {
        // alert("2121");
      $('button#linkbtn').prop( "disabled", true );

      $('input[type="checkbox"]').click(function(e) {
          $('input[type="checkbox"]').prop( "checked", false );
          $(this).prop( "checked", true );
          // alert("{{URL::to('/')}}" + "/" + $(this).data('link'));
          $('a#registerlink').attr("href", "{{URL::to('/')}}" + "/" + $(this).data('link'));

        if ($('input[type="checkbox"]:checked').length >0 ){
          $('button#linkbtn').prop( "disabled", false );
        } else {
          $('button#linkbtn').prop( "disabled", true );
        }

      });
    });


</script>

    </x-guest-layout>