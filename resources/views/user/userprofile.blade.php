<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @if (!$editmode)
      @php $subtitle=__('auth.userregister'); @endphp
      @else
      @php $subtitle=__('welcome.profileedit'); @endphp
      @endif

      @include('components.subtitle')



      <section class="ts-contact-form">
        @if (!$editmode)
        @php $action= route('registerconfirm') ; @endphp
        @else
        @php $action= route('edituser') ; @endphp
        @endif

        <form id="registeruserform" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                      @if (!$editmode)
                        {{ __('求人会社無料登録') }}
                      @else
                        {{ __('auth.profileedit') }}
                      @endif

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                    @if ($editmode)
                    <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                    @endif


                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{ __('auth.mailaddress') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                 type="email" value="{{ old('email') ?? $edituser['email'] ?? '' }}" >
                                <p style="display:none" class="email error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="pwd"><b>{{ __('auth.password') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password"
                                 type="password"  autocomplete="new-password" value="{{ $edituser['password'] ?? '' }}">
                                <p style="display:none" class="password error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="pwdagain"><b>{{ __('auth.confirmpassword') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                 type="password" value="{{ $edituser['password'] ?? '' }}">
                                <p style="display:none" class="password_confirmation  error text-danger"></p>
                           </div>
                        </div>
                     </div>                     
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname"><b>{{ __('auth.namekanji') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.namekanji') }}" name="name" id="name"
                                 type="text"value="{{ old('name') ?? $edituser['name'] ?? '' }}"  autofocus >
                                <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div>         
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname_furi"><b>{{ __('auth.compname') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.compname') }}" name="compname" id="compname"
                                 type="text" value="{{ old('compname') ?? $edituser['compname'] ?? '' }}"  autofocus>
                                <p style="display:none" class="compname error text-danger"></p>
                            </div>
                        </div>
                     </div>   

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="entity_select"><b>{{ __('auth.compentity') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="entity" id="entity_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.entity') as $key => $value)
                                  <option value="{{$key}}" {{ old('entity') == $key ? "selected" : "" }} @if(!empty($edituser['entity']) && ($edituser['entity'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="entity error text-danger"></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="purpose_select"><b>{{ __('auth.purpose') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="purpose" id="purpose_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.purpose') as $key => $value)
                                  <option value="{{$key}}" {{ old('purpose') == $key ? "selected" : "" }} @if(!empty($edituser['purpose']) && ($edituser['purpose'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="purpose error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="compindustry_select"><b>{{ __('auth.industry') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="compindustry" id="compindustry_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.compindustry') as $key => $value)
                                  <option value="{{$key}}" {{ old('compindustry') == $key ? "selected" : "" }} @if(!empty($edituser['compindustry']) && ($edituser['compindustry'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="compindustry error text-danger"></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="position_select"><b>{{ __('auth.position') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="position" id="position_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.position') as $key => $value)
                                  <option value="{{$key}}" {{ old('position') == $key ? "selected" : "" }} @if(!empty($edituser['position']) && ($edituser['position'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="position error text-danger"></p>
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
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="membernumber_select"><b>{{ __('従業員数') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="membernumber" id="membernumber_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                  <option value="{{'0'}}" {{ old('membernumber') == '0' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '0')) selected @endif >{{__('選択してください')}}</option>
                                  <option value="{{'1'}}" {{ old('membernumber') == '1' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '1')) selected @endif >{{__('10名以下')}}</option>
                                  <option value="{{'2'}}" {{ old('membernumber') == '2' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '2')) selected @endif >{{__('11名　～　20名')}}</option>
                                  <option value="{{'3'}}" {{ old('membernumber') == '3' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '3')) selected @endif >{{__('21名　～　30名')}}</option>
                                  <option value="{{'4'}}" {{ old('membernumber') == '4' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '4')) selected @endif >{{__('30名　～　40名')}}</option>
                                  <option value="{{'5'}}" {{ old('membernumber') == '5' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '5')) selected @endif >{{__('41名　～　50名')}}</option>
                                  <option value="{{'6'}}" {{ old('membernumber') == '6' ? "selected" : "" }} @if(!empty($edituser['membernumber']) && ($edituser['membernumber'] == '6')) selected @endif >{{__('50名以上')}}</option>
                              </select>
                                <p style="display:none" class="membernumber error text-danger"></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="position_select"><b>{{ __('設立年月') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('設立年月') }}" name="dob" id="dob"
                                 type="month" @if(!empty($edituser['dob'])) value="{{ old('dob') ?? date('Y-m', strtotime($edituser['dob'])) }}" @else value="{{ old('dob') ?? '' }}"  @endif>
                                <p style="display:none" class="dob error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="companyinfo"><b>事業内容</b> <span class="badge badge-danger">{{ __('auth.required') }}</span> </label>
                              <textarea class="form-control form-control-message" id="companyinfotextarea" placeholder="{{ __('事業内容') }}" rows="8">{!! str_replace("<br />","&#013;",old('companyinfo') ?? $edituser['companyinfo'] ?? '')  !!}</textarea>
                                   <p style="display:none" class="companyinfo error text-danger"></p>                                 
                                   <input type="hidden" name="companyinfo" id="companyinfo" value="{!! old('companyinfo') ?? $edituser['companyinfo'] ?? '' !!}">
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picture"><b>{{ __('イメージ画像') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <input type="file" name="image" id="image" class="form-control" >
                              <img id="preview-image-before-upload" alt="{{ __('auth.profileimg') }}"  
                                @if(!empty($edituser['profileimg']))
                                      style="max-height: 200px;" 
                                      src="{{ asset('images/avatar/'.$edituser['profileimg'] ) }}"
                                @else
                                      style="max-height: 200px; display: none;" 
                                @endif
                              />
                                <p style="display:none" class="image error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="URL"><b>URL</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <input class="form-control form-control-password" placeholder="URL" name="url" id="url"
                                 type="text" value="{{ old('url') ?? $edituser['url'] ?? '' }}">
                                <p style="display:none" class="url error text-danger"></p>
                           </div>
                        </div>
                     </div>  
                    
                    @if (!$editmode)  
                     <div class="col-md-5 mx-auto" style="text-align: center;">
                        <div class="form-group" style="font-size: 16px;">
                           <label class="form-check-label" style="padding-left: unset;">
                              <input type="checkbox" class="form-check-input" style="width: 16px;height: 16px;" name="check" id="check_id" value="1"> 
                              <a style="color: inherit;" href="{{ url('/privacy') }}">{{ __('auth.policy') }}</a></label><p style="display:none" class="check error text-danger"></p>
                        </div>
                     </div> 
                    @endif

                     <div class="text-center">
                        <button class="btn btn-submit" type="button">
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

         <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="deleteConfirmModalLabel">
                  {{ __('auth.confirmchange?') }}
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
                  {{ __('auth.yeschange') }}
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

        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-image-before-upload').attr('src', e.target.result); 
              $('#preview-image-before-upload').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });

        $('textarea').on('input', function() {
         id = $( this ).attr("id");
         inputname = id.replace("textarea","");
            // alert(inputname);
            text = $( this ).val();
            text = text.replace(/\r?\n/g, '<br />')
            $('#'+inputname).val(text);
        });

        $("#password,#password_confirmation").on("input", function(){
            $('#password').attr('name', 'password');
            $('#password_confirmation').attr('name', 'password_confirmation');
        });


        $(".btn-submit").click(function(e){
          // alert("aaa");
            e.preventDefault();


      var _token = $("input[name='_token']").val();

      
let formData = new FormData(registeruserform);

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
                        // $('#detailModal').modal('show');

                          @if (!$editmode)
                            $( "#registeruserform" ).submit();
                          @else
                            $('#detailModal').modal('show');
                          @endif

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