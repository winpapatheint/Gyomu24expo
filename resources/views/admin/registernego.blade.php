<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="商談管理"; @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @if (!$editmode)
                  @php $action= route('registernego'); @endphp
                  @else
                  @php $action= route('registernego') ; @endphp
                  @endif

                  <form id="registernegoform" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $data['id'] }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if ($editmode)
                      商談修正
                    @else
                    商談登録
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
                              <label for="negoid"><b>{{ __('auth.negoid') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('商談番号') }}" name="negoid" id="negoid"
                                 type="text" value="{{ old('negoid') ?? $data['negoid'] ?? '' }}"  autofocus >
                                <p style="display:none" class="negoid error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="negovalue"><b>{{ __('auth.negovalue') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('商談金額') }}" name="negovalue" id="negovalue"
                                 type="text" value="{{ old('negovalue') ?? $data['negovalue'] ?? '' }}"  autofocus >
                                <p style="display:none" class="negovalue error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="discount"><b>{{ __('auth.discount') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('値引価額') }}" name="discount" id="discount"
                                 type="text" value="{{ old('discount') ?? $data['discount'] ?? '' }}"  autofocus >
                                <p style="display:none" class="discount error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="agreementnumber"><b>{{ __('auth.agreementnumber') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('契約数') }}" name="agreementnumber" id="agreementnumber"
                                 type="text" value="{{ old('agreementnumber') ?? $data['agreementnumber'] ?? '' }}"  autofocus >
                                <p style="display:none" class="agreementnumber error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="purchasevalue"><b>{{ __('auth.purchasevalue') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('仕入金額') }}" name="purchasevalue" id="purchasevalue"
                                 type="text" value="{{ old('purchasevalue') ?? $data['purchasevalue'] ?? '' }}"  autofocus >
                                <p style="display:none" class="purchasevalue error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="productname"><b>{{ __('auth.productname') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.productname') }}" name="productname" id="productname"
                                 type="text" value="{{ old('productname') ?? $data['productname'] ?? '' }}"  autofocus >
                                <p style="display:none" class="productname error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="createdate"><b>{{ __('auth.createdate') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('作成日') }}" name="createdate" id="createdate"
                                 @php if(!empty(old('createdate'))) { $date= old('createdate'); } elseif(!empty($data['createdate'])) { $date = date('Y-m-d', strtotime($data['createdate'] )); } else { $date = ''; } @endphp
                                 type="date" value="{{ $date }}"  autofocus>
                                <p style="display:none" class="createdate error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="orderdate"><b>{{ __('auth.orderdate') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('受注予定日') }}" name="orderdate" id="orderdate"
                                 @php if(!empty(old('orderdate'))) { $date= old('orderdate'); } elseif(!empty($data['orderdate'])) { $date = date('Y-m-d', strtotime($data['orderdate'] )); } else { $date = ''; } @endphp
                                 type="date" value="{{ $date }}"  autofocus>
                                <p style="display:none" class="orderdate error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="action"><b>{{ __('auth.action') }}</b> <span class="badge badge-danger">必須</span></label>
                              <textarea class="form-control form-control-message" id="actiontextarea" rows="6">{!! str_replace("<br />","&#013;",old('action') ?? $data['action'] ?? '')  !!}</textarea>
                                <p style="display:none" class="action error text-danger"></p>
                                <input type="hidden" name="action" id="action" value="{!! old('action') ?? $data['action'] ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="invoicetype_select"><b>{{ __('auth.invoicetype') }}</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="invoicetype" id="invoicetype" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.invoicetype') as $key => $value)
                                  <option value="{{$key}}" {{ old('invoicetype') == $key ? "selected" : "" }} @if(!empty($data['invoicetype']) && ($data['invoicetype'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="invoicetype error text-danger"></p>   
                           </div>
                        </div>
                     </div>
                                      
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="creater_name"><b>{{ __('作成者名') }}</b></label>
                              <input class="form-control form-control-password" placeholder="{{ __('作成者名') }}" name="creater_name" id="creater_name"
                                 type="text" value="{{ old('creater_name') ?? $data['creater_name'] ?? '' }}"  autofocus>
                                <p style="display:none" class="creater_name error text-danger"></p>
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


         $('#actiontextarea').on('input', function() {
           text = $('#actiontextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#action').val(text);
         });

         $('#remarkstextarea').on('input', function() {
           text = $('#remarkstextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#remarks').val(text);
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

      let formData = new FormData(registernegoform);

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