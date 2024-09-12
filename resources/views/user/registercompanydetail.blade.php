<x-auth-layout>

      @php $subtitle=__('募集企業'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center">
                     <!-- <span>依頼</span> -->
                     {{ __('募集企業新規作成') }}
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
            @php $action = route('addcompanydetail'); @endphp

                  <form id="makeapplication" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

<!-- 
会社HP URL -->
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{ __('会社名') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-email" placeholder="{{ __('会社名') }}" name="name" id="name"
                                 type="text" value="{{ old('name') ?? $companydetail['name'] ?? '' }}" >
                                <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>{{ __('本社住所') }}</b></label>
                              <input class="form-control form-control-address" placeholder="{{ __('本社住所') }}" name="address" id="address"
                                 type="text" value="{{ old('address') ?? $edituser['address'] ?? '' }}" >
                                <p style="display:none" class="address error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="url"><b>{{ __('会社HP URL') }}</b></label>
                              <input class="form-control form-control-url" placeholder="{{ __('会社HP URL') }}" name="url" id="url"
                                 type="text" value="{{ old('url') ?? $edituser['url'] ?? '' }}" >
                                <p style="display:none" class="url error text-danger"></p>
                           </div>
                        </div>
                     </div>



                     <div class="error-container"></div>
                     <label for="email"><b>{{ __('業界') }}</b></label>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="cate1" id="cate1" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option value="0">選択してください</option>
                                  <optgroup label="IT">
                                    <option>ソフトウェア 情報処理</option>
                                    <option>インターネット関連 ゲーム</option>
                                    <option>通信</option>
                                  </optgroup>
                                  <optgroup label="商社">
                                    <option>総合商社</option>
                                    <option>専門商社</option>
                                    <option>商社（その他）</option>
                                  </optgroup>
                                </select>

                               <p class="error cate1 text-danger"></p>                            
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="cate2" id="cate2" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option value="0">選択してください</option>
                                  <optgroup label="IT">
                                    <option>ソフトウェア 情報処理</option>
                                    <option>インターネット関連 ゲーム</option>
                                    <option>通信</option>
                                  </optgroup>
                                  <optgroup label="商社">
                                    <option>総合商社</option>
                                    <option>専門商社</option>
                                    <option>商社（その他）</option>
                                  </optgroup>
                                </select>

                               <p class="error cate2 text-danger"></p>                            
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="cate3" id="cate3" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option value="0">選択してください</option>
                                  <optgroup label="IT">
                                    <option>ソフトウェア 情報処理</option>
                                    <option>インターネット関連 ゲーム</option>
                                    <option>通信</option>
                                  </optgroup>
                                  <optgroup label="商社">
                                    <option>総合商社</option>
                                    <option>専門商社</option>
                                    <option>商社（その他）</option>
                                  </optgroup>
                                </select>

                               <p class="error cate3 text-danger"></p>                            
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="cate4" id="cate4" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option value="0">選択してください</option>
                                  <optgroup label="IT">
                                    <option>ソフトウェア 情報処理</option>
                                    <option>インターネット関連 ゲーム</option>
                                    <option>通信</option>
                                  </optgroup>
                                  <optgroup label="商社">
                                    <option>総合商社</option>
                                    <option>専門商社</option>
                                    <option>商社（その他）</option>
                                  </optgroup>
                                </select>

                               <p class="error cate4 text-danger"></p>                            
                           </div>
                        </div>

                     </div>

                     <div class="row">
                        <div class="col-md-6">
                           <label for="teampax"><b>{{ __('従業員数') }}</b></label>
                           <div class="form-group">
                              <input class="form-control form-control-teampax" placeholder="{{ __('人') }}" name="teampax" id="teampax"
                                 type="text" value="{{ old('teampax') ?? $edituser['teampax'] ?? '' }}" style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <p style="display:none" class="teampax error text-danger"></p>                               
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="dob"><b>{{ __('設立年月') }}</b></label>
                           <div class="form-group">
                              <input class="form-control form-control-dob" placeholder="{{ __('人') }}" name="dob" id="dob"
                                 type="month" value="{{ old('dob') ?? $edituser['dob'] ?? '' }}" style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <p style="display:none" class="dob error text-danger"></p>                                 
                           </div>
                        </div>
                     </div>

                     <label for="companyinfo"><b>{{ __('会社概要') }}</b></label>
                     <div class="form-group">
                          <textarea class="form-control form-control-message" id="companyinfotextare" placeholder="{{ __('会社概要') }}" rows="8">{!! str_replace("<br />","&#013;",old('companyinfo') ?? '')  !!}</textarea>
                          <p style="display:none" class="companyinfo error text-danger"></p>                                 
                          <input type="hidden" name="companyinfo" id="companyinfo" value="{!! old('companyinfo') ?? '' !!}">
                     </div>

                     <label for="companycontent"><b>{{ __('事業内容') }}</b></label>
                     <div class="form-group">
                          <textarea class="form-control form-control-message" id="companycontenttextare" placeholder="{{ __('会社概要') }}" rows="8">{!! str_replace("<br />","&#013;",old('companycontent') ?? '')  !!}</textarea>
                          <p style="display:none" class="companycontent error text-danger"></p>                                 
                          <input type="hidden" name="companycontent" id="companycontent" value="{!! old('companycontent') ?? '' !!}">
                     </div>
                     
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picture"><b>企業画像</b></label>
                              <input type="file" name="image" id="image" class="form-control" >
                              <img id="preview-image-before-upload" alt="プロフィール写真"  
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

                     <div class="text-center"><br>
                        <button class="btn btn-submit" type="submit" data-askconfirmtitle="{{ __('auth.makenew') }}" data-askconfirmtext="{{ __('auth.confirmregister?') }}" data-yes="{{ __('auth.doregister') }}"> {{ __('auth.doregister') }}</button>
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

        $('#companyinfotextare').on('input', function() {
           text = $('#companyinfotextare').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#companyinfo').val(text);
        });


        $('#companycontenttextare').on('input', function() {
           text = $('#companycontenttextare').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#companycontent').val(text);
        });


        $(".btn-submit").click(function(e){

            e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(makeapplication);
   
            $.ajax({
                url: "{{ $action }}",
                type:'POST',

                data: formData,

                 contentType: false,
                 processData: false,

                success: function(data) {
                    if($.isEmptyObject(data.error)){

                          $('.error').hide()
                          askconfirmboxshow($(".btn-submit"),'makeapplication');
                    }else{
                        // alert("err");
                        console.log(data.error);
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {


                          $('.error.'+key).text(value[0])
                          $('.error.'+key).show()
                          
                        });
                    }
                },
                fail: function(data) {
                        alert("エラー：ajax error");
                }
            });
       
        });


    });


</script>
</x-auth-layout>