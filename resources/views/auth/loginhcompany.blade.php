<x-guest-layout>
      @php $subtitle=__('auth.hcompanylogin'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{ __('auth.hcompanylogin') }}
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                 <!-- Session Status -->
                 <x-auth-session-status class="mb-4" :status="session('status')" />

                 @php $error = $errors->toArray(); @endphp
                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('hcompany.login') }}">
      			  @csrf
                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-8 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{ __('auth.mailaddress') }}</b></label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                 type="text" value="{{ old('email') }}" autofocus>
                                   @if (!empty($error['email']))
                                       @foreach ($error['email'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif
                           </div>
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-8 mx-auto">
                           <div class="form-group">
                              <label for="pwd"><b>{{ __('auth.password') }}</b></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" name="password" id="password"
                                 type="password" autocomplete="current-password">
                                   @if (!empty($error['password']))
                                       @foreach ($error['password'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-8 mx-auto">
                           <div class="form-group">
                              <label class="form-check-label">
                                 <input id="remember_me" name="remember" type="checkbox" class="form-check-input" value="">{{ __('auth.keeplogin') }}
                              </label>                                 
                              <a href="{{ route('password.request') }}" style="float: right;">{{ __('auth.passwordforget') }}</a>
                           </div>           
                        </div>
                     </div>
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('auth.dologin') }}</button>
                        <!-- <p class="mt-4" style="font-size: 18px;"><a href="{{ route('register') }}"><i class="fa fa-user"></i> 会員を登録しませんか？</a></p> -->
                     </div>
                  </form><!-- Contact form end -->
               </div>
            </div>
         </div>
         <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div>
		</section>
</x-guest-layout>

