<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="顧客管理"; @endphp
      @php 
        if($editmode) {
          if ($editother) {
            $subtitle="顧客管理"; 
          } else {
            $subtitle=__('welcome.profileedit'); 
          }
        } else {
          $subtitle="顧客管理";
        }
      @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @if (!$editmode)
                  @php $action= route('registerhcompany'); @endphp
                  @else
                  @php $action= route('registerhcompany') ; @endphp
                  @endif

                  <form id="registerhcompanyform" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if ($editmode)
                      @if ($editother)
                      顧客修正
                      @else
                      {{ __('auth.profileedit') }}
                      @endif
                    @else
                    顧客登録
                    @endif

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  <input type="hidden" name="role" value="hcompany">

                     <div class="error-container"></div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname"><b>{{ __('会社名') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.hcompanyname') }}" name="name" id="name"
                                 type="text" value="{{ old('name') ?? $edituser['name'] ?? '' }}"  autofocus >
                                <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="postalcode"><b>{{ __('auth.postalcode') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.postalcode') }}" name="postalcode" id="postalcode"
                                 type="text" value="{{ old('postalcode') ?? $edituser['postalcode'] ?? '' }}">
                                <p style="display:none" class="postalcode error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>{{ __('auth.address') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.address') }}" name="address" id="address"
                                 type="text" value="{{ old('address') ?? $edituser['address'] ?? '' }}">
                                <p style="display:none" class="address error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="addressextra"><b>{{ __('auth.addressextra') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.addressextra') }}" name="addressextra" id="addressextra"
                                 type="text" value="{{ old('addressextra') ?? $edituser['addressextra'] ?? '' }}">
                                <p style="display:none" class="addressextra error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="phonenumber"><b>{{ __('auth.phone') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.phone') }}" name="phone" id="phone"
                                 type="text" value="{{ old('phone') ?? $edituser['phone'] ?? '' }}">
                                <p style="display:none" class="phone error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{ __('auth.mailaddress') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                 type="text" value="{{ old('email') ?? $edituser['email'] ?? '' }}" >
                                 <p style="display:none" class="email error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picname"><b>{{ __('auth.picname') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.picname') }}" name="picname" id="picname"
                                 type="text" value="{{ old('picname') ?? $edituser['picname'] ?? '' }}"  autofocus>
                                <p style="display:none" class="picname error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname_furi"><b>{{ __('auth.picnamefurigana') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.picnamefurigana') }}" name="picnamefurigana" id="picnamefurigana"
                                 type="text" value="{{ old('picnamefurigana') ?? $edituser['picnamefurigana'] ?? '' }}"  autofocus>
                                <p style="display:none" class="picnamefurigana error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname_furi"><b>{{ __('auth.capital') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.capital') }}" name="capital" id="capital"
                                 type="text" value="{{ old('capital') ?? $edituser['capital'] ?? '' }}"  autofocus>
                                <p style="display:none" class="capital error text-danger"></p>
                           </div>
                        </div>
                     </div>                           

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname_furi"><b>{{ __('auth.establishdate') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.establishdate') }}" name="establishdate" id="establishdate"
                                 type="date" value="{{ old('establishdate') ?? $edituser['establishdate'] ?? '' }}"  autofocus>
                                <p style="display:none" class="establishdate error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="listed_select"><b>{{ __('auth.listed') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="listed" id="listed_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.listed') as $key => $value)
                                  <option value="{{$key}}" {{ old('listed') == $key ? "selected" : "" }} @if(!empty($edituser['listed']) && ($edituser['listed'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="listed error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="closemonth"><b>{{ __('auth.closemonth') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="closemonth" id="closemonth_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.closemonth') as $key => $value)
                                  <option value="{{$key}}" {{ old('closemonth') == $key ? "selected" : "" }} @if(!empty($edituser['closemonth']) && ($edituser['closemonth'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="closemonth error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="compindustry_select"><b>{{ __('auth.compindustry') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="compindustry" id="compindustry_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.compindustry') as $key => $value)
                                  <option value="{{$key}}" {{ old('compindustry') == $key ? "selected" : "" }} @if(!empty($edituser['compindustry']) && ($edituser['compindustry'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="compindustry error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="companycontent"><b>{{ __('事業内容') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <textarea class="form-control form-control-message" id="companycontenttextarea" rows="6">{!! str_replace("<br />","&#013;",old('companycontent') ?? $edituser['companycontent'] ?? '')  !!}</textarea>
                                <p style="display:none" class="companycontent error text-danger"></p>
                                <input type="hidden" name="companycontent" id="companycontent" value="{!! old('companycontent') ?? $edituser['companycontent'] ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="url"><b>{{ __('auth.url') }}</b></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.url') }}" name="url" id="url"
                                 type="text" value="{{ old('url') ?? $edituser['url'] ?? '' }}"  autofocus>
                                <p style="display:none" class="url error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="sns"><b>{{ __('auth.sns') }}</b></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.sns') }}" name="sns" id="sns"
                                 type="text" value="{{ old('sns') ?? $edituser['sns'] ?? '' }}"  autofocus>
                                <p style="display:none" class="sns error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="remarks"><b>{{ __('auth.remarks') }}</b></label>
                              <textarea class="form-control form-control-message" id="remarkstextarea" rows="6">{!! str_replace("<br />","&#013;",old('remarks') ?? $edituser['remarks'] ?? '')  !!}</textarea>
                                <p style="display:none" class="remarks error text-danger"></p>
                                <input type="hidden" name="remarks" id="remarks" value="{!! old('remarks') ?? $edituser['remarks'] ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="text-center">
                        <button class="btn btn-submit" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-target="#detailModal"> -->
                      @if (!$editmode)  
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           {{ __('auth.doregister') }}
                      @else
                          <i class="fa fa-edit" aria-hidden="true"></i>
                           {{ __('auth.dochange') }}
                      @endif
                         </button>

                     </div>
               </div>
            </div>
         </div>

               <div id="detailModal" class="modal fade" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">
                      　@if (!$editmode)  
                        登録しますか？
                      　@else
                        {{ __('auth.confirmchange?') }}
                      　@endif
                    　　</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                <!--      <div class="modal-body">
                        <p>選択したセミナーを削除してはよろしいですか。</p>
                     </div> -->
                     <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">
                      　@if (!$editmode)  
                        登録する
                      　@else
                        {{ __('auth.yeschange') }}
                      　@endif
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('auth.docancel') }}</button>

                     </div>
                  </div>
                  </div>
               </div>
                  </form><!-- Contact form end -->

         <div class="speaker-shap">
            <img class="shap1" src="{{ asset('images/shap/home_schedule_memphis2.png') }}" alt="">
         </div>
        </section>

<script type="text/javascript">
       
    $(document).ready(function() {

         $('#remarkstextarea').on('input', function() {
           text = $('#remarkstextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#remarks').val(text);
         });

         $('#companycontenttextarea').on('input', function() {
           text = $('#companycontenttextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#companycontent').val(text);
         });

        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-image-before-upload').attr('src', e.target.result); 
              $('#preview-image-before-upload').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });


        var pwdchnge = false;
        $("#password,#password_confirmation").on("input", function(){
            pwdchnge = true;
            $('#password').attr('name', 'password');
            $('#password_confirmation').attr('name', 'password_confirmation');
        });


        $(".btn-submit").click(function(e){
            e.preventDefault();
			
                // alert(check);

      let formData = new FormData(registerhcompanyform);

			console.log(formData);

            $.ajax({
                url: "{{ $action }}",
                type:'POST',
                data: formData,

                 contentType: false,
                 processData: false,

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        // alert("success");
                        console.log(data.success);
                          $('.error').hide()
                        $('#detailModal').modal('show');
                    }else{
                        // alert("err");
                        console.log(data.error);
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {
                          if (key == 'password') {
                            $.each( value, function( k, val ) {
                              if (val == 'パスワードが一致しません') {
                                $('.error.password_confirmation').text(val)
                                $('.error.password_confirmation').show() 
                                // alert('unset')
                              } else {
                                $('.error.'+key).text(val)
                                $('.error.'+key).show() 
                              }
                            });
                          } else {

                            $('.error.'+key).text(value[0])
                            $('.error.'+key).show()
                          }
                        });
                    }
                },
                fail: function(data) {
                        alert("errqqqq");
                }
            });
       
        }); 
       
    });


</script>

</x-auth-layout>