<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="担当者管理"; @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @if (!$editmode)
                  @php $action= route('registerpic'); @endphp
                  @else
                  @php $action= route('registerpic') ; @endphp
                  @endif

                  <form id="registerpicform" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $data['id'] }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if ($editmode)
                      担当者修正
                    @else
                    担当者登録
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
                              <label for="fullname"><b>{{ __('氏名') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('氏名') }}" name="name" id="name"
                                 type="text" value="{{ old('name') ?? $data['name'] ?? '' }}"  autofocus >
                                <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname"><b>{{ __('氏名（ふりかた）') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('氏名（ふりかた）') }}" name="furiname" id="furiname"
                                 type="text" value="{{ old('furiname') ?? $data['furiname'] ?? '' }}"  autofocus >
                                <p style="display:none" class="furiname error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="gender_select"><b>性別</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="gender" id="gender" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.gender') as $key => $value)
                                  <option value="{{$key}}" {{ old('gender') == $key ? "selected" : "" }} @if(!empty($data['gender']) && ($data['gender'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="gender error text-danger"></p>   
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>種類</b></label></label>
                              <select class="form-control" name="agerange" id="agerange" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.agerange') as $key => $value)
                                  <option value="{{$key}}" {{ old('agerange') == $key ? "selected" : "" }} @if(!empty($data['agerange']) && ($data['agerange'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="agerange error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="hcompany_select"><b>{{ __('所属会社名') }}</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control required" name="hcompany" id="hcompany"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0" selected>選択してください</option>
                                @foreach( $hcompanies as $key => $hcompany )
                                <option value="{{ $hcompany->id }}" @if($hcompany->id == $data["hcompany"]) selected @endif>{{ $hcompany->name }}</option>                   
                                @endforeach                                   
                              </select>
                              <p style="display:none" class="hcompany error text-danger"></p>
                           </div>

                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="postalcode"><b>{{ __('勤務先郵便番号') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('勤務先郵便番号') }}" name="postalcode" id="postalcode"
                                 type="text" value="{{ old('postalcode') ?? $data['postalcode'] ?? '' }}"  autofocus>
                                <p style="display:none" class="postalcode error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>{{ __('勤務先住所') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('勤務先住所') }}" name="address" id="address"
                                 type="text" value="{{ old('address') ?? $data['address'] ?? '' }}"  autofocus>
                                <p style="display:none" class="address error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="departmentname"><b>{{ __('部署名') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('部署名') }}" name="departmentname" id="departmentname"
                                 type="text" value="{{ old('departmentname') ?? $data['departmentname'] ?? '' }}"  autofocus>
                                <p style="display:none" class="departmentname error text-danger"></p>
                           </div>
                        </div>
                     </div>  

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="occupation_select"><b>役職</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="occupation" id="occupation" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.occupation') as $key => $value)
                                  <option value="{{$key}}" {{ old('occupation') == $key ? "selected" : "" }} @if(!empty($data['occupation']) && ($data['occupation'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="occupation error text-danger"></p>   
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="phone"><b>{{ __('電話番号') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('電話番号') }}" name="phone" id="phone"
                                 type="text" value="{{ old('phone') ?? $data['phone'] ?? '' }}"  autofocus>
                                <p style="display:none" class="phone error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="emaili"><b>{{ __('メールアドレス') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('メールアドレス') }}" name="email" id="email"
                                 type="text" value="{{ old('email') ?? $data['email'] ?? '' }}"  autofocus>
                                <p style="display:none" class="email error text-danger"></p>
                           </div>
                        </div>
                     </div>                           

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="sns"><b>{{ __('auth.sns') }}</b></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.sns') }}" name="sns" id="sns"
                                 type="text" value="{{ old('sns') ?? $data['sns'] ?? '' }}"  autofocus>
                                <p style="display:none" class="sns error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="dob"><b>{{ __('誕生日') }}</b></label>
                              <input class="form-control form-control-password" placeholder="{{ __('誕生日') }}" name="dob" id="dob"
                                 @php if(!empty(old('dob'))) { $date= old('dob'); } elseif(!empty($data['dob'])) { $date = date('Y-m-d', strtotime($data['dob'] )); } else { $date = ''; } @endphp
                                 type="date" value="{{ $date }}"  autofocus>
                                <p style="display:none" class="dob error text-danger"></p>
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

      function gethcompany(fval) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('gethcompany') }}",
                type:'POST',
                data: {_token:_token, 
                     id:fval, 
                      },

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        // console.log(data.success[0]);
                        $('#postalcode').val(data.success[0]['postalcode']);
                        $('#address').val(data.success[0]['address']);
                        // $('#phone').val(data.success[0]['phone']);

                    }else{
                        // alert("err");
                        console.log(data.error);

                    }
                },
                fail: function(data) {
                        alert("errqqqq");
                }
            });

      }

    $(document).ready(function() {

         $('#remarkstextarea').on('input', function() {
           text = $('#remarkstextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#remarks').val(text);
         });

        if ($('#hcompany').val() != '0') {
            gethcompany($('#hcompany').val());
        }

        $('#hcompany').change(function(){
           // alert($(this).val());
           gethcompany($(this).val());

        })

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

      let formData = new FormData(registerpicform);

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