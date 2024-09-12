    <x-guest-layout>

      @php $subtitle=__('headfoot.ttlepolicy'); @endphp
      @include('components.subtitle')

  
      <section class="ts-faq-sec">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="faq-content mb-70">
                     <h2 class="column-title">
                        {{ __('headfoot.ttlepolicy') }}
                     </h2>
                     <div class="panel-group faq-item" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel faq-list panel-default">
                           <div id="collapseZero" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingZero" style="background: none;">
                              <div class="panel-body" style="color: #3b1d82";>
                                    {{ __('policy.intro') }}
                              </div>
                           </div>
                        </div>



                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('policy.q1') }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                              <div class="panel-body">
                                    {{ __('policy.a1') }}
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingTwo">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    {{ __('policy.q2') }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo">
                              <div class="panel-body">
                                    {{ __('policy.a2') }}
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingThree">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    {{ __('policy.q3') }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                 {{ __('policy.a3') }}
                              </div>
                           </div>
                        </div>
                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingFour">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    {{ __('policy.q4') }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseFour" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFour">
                              <div class="panel-body">
                                    {{ __('policy.a4') }}
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingFive">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    {{ __('policy.q5') }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseFive" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFive">
                              <div class="panel-body">
                                    {{ __('policy.a5') }}
                              </div>
                           </div>
                        </div>

                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingSix">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    {{ __('policy.discusswindow') }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseSix" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingSix">
                              <div class="panel-body">
                                    {{ __('policy.compname') }}<br>
                                    {{ __('policy.office') }}<br>
                                    TEL： 03−3981−5090
                              </div>
                           </div>
                        </div>



                     </div><!-- panel-group -->

                  </div>
                  
               </div><!-- col end -->
               <div class="col-lg-4">
                  <div class="sidebar-widgets">
                     @php $error = $errors->toArray(); @endphp
                     @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-block" id="alert-success">
                         <button type="button" class="close" data-dismiss="alert">×</button>    
                         <strong>{{ $message }}</strong>
                     </div>
                     @endif
                     <div class="widget asq-form">
                        <form id="contact-form" class="ts-form" method="POST" action="{{ route('contact') }}">
                           @csrf
                           <input type="hidden" name="from" value="faq">
                           <input type="text" class="form-control" name="name" placeholder="{{ __('contact.name') }} " id="ts_contact_name" value="{{ old('name') }}">
                           @if (!empty($error['name']))
                                 @foreach ($error['name'] as  $key => $value)
                                     <p class="error text-danger">{{ $value }}</p>
                                 @endforeach
                           @endif
                           <input type="text" class="form-control" name="email" placeholder="{{ __('auth.mailaddress') }}" id="ts_contact_email" value="{{ old('email') }}">
                           @if (!empty($error['email']))
                                 @foreach ($error['email'] as  $key => $value)
                                     <p class="error text-danger">{{ $value }}</p>
                                 @endforeach
                           @endif
                           <textarea name="message" placeholder="{{ __('faq.fillthemessage') }}" id="x_contact_massage" class="form-control message-box"
                              cols="30" rows="10">{{ old('message') }}</textarea>
                           @if (!empty($error['message']))
                                 @foreach ($error['message'] as  $key => $value)
                                     <p class="error text-danger">{{ $value }}</p>
                                 @endforeach
                           @endif
                           <div class="ts-btn-wraper">
                              <input type="submit" class="btn" id="ts_contact_submit" value="{{ __('contact.dosend') }}">
                           </div>
                        </form>
                     </div>

                     <div class="widget social-box">
                        <h4 class="widget-title">Our services</h4>
                        <ul>
                           <li class="ts-facebook">
                              <a href="#"><i class="fa fa-facebook"></i> </a>
                           </li>
                           <li class="ts-twitter">
                              <a href="#"><i class="fa fa-twitter"></i></a>
                           </li>
                           <li class="ts-google-plus">
                              <a href="#"><i class="fa fa-google-plus"></i></a>
                           </li>
                           <li class="ts-linkedin">
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                           </li>
                           <li class="ts-instagram">
                              <a href="#"><i class="fa fa-instagram"></i></a>
                           </li>
                           <li class="ts-youtube">
                              <a href="#"><i class="fa fa-youtube"></i></a>
                           </li>

                        </ul>
                     </div><!-- .widget end -->


                  </div>
               </div><!-- col end-->

            </div><!-- row end-->
         </div><!-- .container end -->
      </section><!-- End faq section -->

    </x-guest-layout>