    <x-guest-layout>

      @php $subtitle=__('headfoot.ttlecontact'); @endphp
      @include('components.subtitle')

      <!-- ts intro start -->
      <section class="ts-contact" style="padding-bottom: 0px;">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center">
                     <!-- <span>Get Information</span> -->
                     Contact Information
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">


            </div><!-- row end-->
         </div><!-- container end-->

      </section>
      <!-- ts contact end-->

      <section class="ts-contact-map no-padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 no-padding">
                  <div class="mapouter">
                     <div class="gmap_canvas">
                        <!-- <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Park%20Street%2C%20Jacksonville%2C%20IL%2C%20USA&t=&z=13&ie=UTF8&iwloc=&output=embed"
                           frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.522729646687!2d139.7083554155521!3d35.737954634465794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601892a013f7dbb3%3A0x5366f1c6bc45f33f!2z44CSMTcxLTAwMTQgVG9reW8sIFRvc2hpbWEgQ2l0eSwgSWtlYnVrdXJvLCA0LWNoxY1tZeKIkjI34oiSNSDlkoznlLDjg5Pjg6s!5e0!3m2!1sen!2sjp!4v1667889899507!5m2!1sen!2sjp" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                           <!-- <a href="https://www.pureblack.de">werbeagentur</a></div> -->
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center">
                     <!-- <span>お問い合わせ</span> -->
                     {{ __('headfoot.ttlecontact') }}
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">


               <div class="col-lg-8 mx-auto">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @php $error = $errors->toArray(); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('contact') }}">
                  @csrf
                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('contact.name') }}" name="name" id="name"
                                 type="text" value="{{ old('name') }}">
                                   @if (!empty($error['name']))
                                       @foreach ($error['name'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('contact.furiname') }}" name="furiname" id="furiname"
                                 type="text" value="{{ old('furiname') }}">
                                   @if (!empty($error['furiname']))
                                       @foreach ($error['furiname'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group subject">

                              <select class="form-control" name="subject" id="subject" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">{{ __('contact.subject') }}</option>
                                <option value="{{ __('contact.subject1') }}"  @if( old('subject') == __('contact.subject1') ) selected @endif  >{{ __('contact.subject1') }}</option>
                                <option value="{{ __('contact.subject2') }}"  @if( old('subject') == __('contact.subject2') ) selected @endif  >{{ __('contact.subject2') }}</option>
                                <option value="{{ __('contact.subject3') }}"  @if( old('subject') == __('contact.subject3') ) selected @endif  >{{ __('contact.subject3') }}</option>
                                <option value="{{ __('contact.subject4') }}"  @if( old('subject') == __('contact.subject4') ) selected @endif  >{{ __('contact.subject4') }}</option>
                              </select>
                                   @if (!empty($error['subject']))
                                       @foreach ($error['subject'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif                              
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                 type="text" value="{{ old('email') }}">
                                   @if (!empty($error['email']))
                                       @foreach ($error['email'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif
                           </div>
                        </div>

                     </div>
                     <div class="form-group">
                        <textarea class="form-control form-control-message" name="message" id="message" placeholder="{{ __('contact.fillthemessage') }}"
                           rows="6">{{ old('message') }}</textarea>
                                   @if (!empty($error['message']))
                                       @foreach ($error['message'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif
                     </div>
                     <div class="text-center"><br>
                        <button class="btn" type="submit">{{ __('contact.dosend') }}</button>
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