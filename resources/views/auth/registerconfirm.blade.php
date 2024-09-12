<x-guest-layout>

   <style>
      #user-info td, #user-info th {
         border-top: none;
      }

      .btn-info,
      .btn-info:hover {
         background-color: #138496;
      }
   </style>

      @php $subtitle=__('auth.confirmtitle'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{ __('auth.confirmtitle') }} 
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-md-8 mx-auto">
                  <table class="table table-borderless" id="user-info">
                     <tbody>
                        <tr>
                           <td><b>{{ __('auth.mailaddress') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ $request->email }}</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.password') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>●●●●●●●●●</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.confirmpassword') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>●●●●●●●●●</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.namekanji') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ $request->name }}</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.compname') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ $request->compname }}</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.compentity') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ __(config('global.entity')[$request->entity]) }}</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.purpose') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ __(config('global.purpose')[$request->purpose]) }}</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.industry') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ __(config('global.compindustry')[$request->compindustry]) }}</td>
                        </tr>
                        <tr>
                           <td><b>{{ __('auth.position') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ __(config('global.position')[$request->position]) }}</td>
                        </tr>

                        <tr>
                           <td><b>{{ __('従業員数') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>
                                  @if(!empty($request->membernumber) && ($request->membernumber == '0')) {{__('選択してください')}} @endif
                                  @if(!empty($request->membernumber) && ($request->membernumber == '1')) {{__('10名以下')}} @endif
                                  @if(!empty($request->membernumber) && ($request->membernumber == '2')) {{__('11名　～　20名')}} @endif
                                  @if(!empty($request->membernumber) && ($request->membernumber == '3')) {{__('21名　～　30名')}} @endif
                                  @if(!empty($request->membernumber) && ($request->membernumber == '4')) {{__('30名　～　40名')}} @endif
                                  @if(!empty($request->membernumber) && ($request->membernumber == '5')) {{__('41名　～　50名')}} @endif
                                  @if(!empty($request->membernumber) && ($request->membernumber == '6')) {{__('50名以上')}} @endif
                           </td>
                        </tr>

                        <tr>
                           <td><b>{{ __('auth.phone') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ $request->phone }}</td>
                        </tr>

                        <tr>
                           <td><b>{{ __('設立年月') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ $request->dob }}</td>
                        </tr>

                        <tr>
                           <td><b>{{ __('事業内容') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{!! $request->description !!}</td>
                        </tr> 

                        <tr>
                           <td><b>{{ __('auth.address') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></td>
                           <td>{{ $request->address }}</td>
                        </tr> 

                        <tr>
                           <td><b>URL</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></td>
                           <td>{{ $request->url }}</td>
                        </tr>                      
                     </tbody>
                  </table>

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('register') }}">
                  @csrf

                  <input type="hidden" name="email" value="{{ $request->email }}">
                  <input type="hidden" name="password" value="{{ $request->password }}">
                  <input type="hidden" name="name" value="{{ $request->name }}">
                  <input type="hidden" name="compname" value="{{ $request->compname }}">
                  <input type="hidden" name="entity" value="{{ $request->entity }}">
                  <input type="hidden" name="purpose" value="{{ $request->purpose }}">
                  <input type="hidden" name="compindustry" value="{{ $request->compindustry }}">
                  <input type="hidden" name="position" value="{{ $request->position }}">
                  <input type="hidden" name="membernumber" value="{{ $request->membernumber }}">
                  <input type="hidden" name="dob" value="{{ $request->dob }}">
                  <input type="hidden" name="companyinfo" value="{{ $request->companyinfo }}">
                  <input type="hidden" name="image" value="{{ $request->image }}">
                  <input type="hidden" name="phone" value="{{ $request->phone }}">
                  <input type="hidden" name="address" value="{{ $request->address }}">
                  <input type="hidden" name="url" value="{{ $request->url }}">

                  <div class="text-center">
                     <a href="#" onclick="window.history.back();" class="btn btn-info" role="button" style="margin-right: 20px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                        {{ __('auth.doback') }}</a >   
                     <button class="btn" type="submit"><i class="fa fa-user-plus" aria-hidden="true"></i>
                        {{ __('auth.doregister') }}</button>
                     
                  </div>

                  </form>
                  <div class="text-center" style="margin-top: 20px;">
                     
                  </div>
               </div>
            </div>
         </div>
         <div class="speaker-shap">
            <img class="shap1" src="{{ asset('images/shap/home_schedule_memphis2.png') }}" alt="">
         </div>
    </section>

</x-guest-layout>