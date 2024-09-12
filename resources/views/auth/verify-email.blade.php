<x-guest-layout>
      <div id="page-banner-area" class="page-banner-area" style="background-image: url('{{ asset('images/hero_area/banner_bg01.jpg')}}');">
         
         <!-- Subpage title start -->
         <!-- <div class="page-banner-title">
            <div class="text-center">
               <h2>Contact Us</h2>
               <ol class="breadcrumb">
                  <li>
                     <a href="#">Exibit /</a>
                  </li>
                  <li>
                     Contact Us
                  </li>
               </ol>
            </div>
         </div> -->
         <!-- Subpage title end -->
      </div><!-- Page Banner end -->

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{ __('auth.mailverification') }}
                  </h2>
               </div><!-- col end-->
            </div>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('auth.thankforregister') }}
            <br>{{ __('auth.alreadysendemail') }}
            <br>{{ __('auth.pleaseclicklink') }}
            <br>{{ __('auth.ifyouneedresend') }}
        </div>

            @if (!empty($msg))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $msg }}</strong>
            </div>
            @endif

            <div class="row">
               <div class="col-lg-8 mx-auto">
                     <div class="text-center">
                        <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                            <input type="hidden" name="email" value="{{ $email ?? ''}}">
                            <button class="btn" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('auth.doresend') }}
                            </button>
                        </form>
<!-- 
                        <form method="POST" action="{{-- route('logout') --}}">
                            @csrf

                            <p class="mt-4" style="font-size: 18px;">
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{-- __('ログアウト') --}}
                                </x-dropdown-link>
                            </p>
                        </form> -->
                     </div>
               </div>
            </div>
         </div>
         <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div>
        </section>
</x-guest-layout>


               