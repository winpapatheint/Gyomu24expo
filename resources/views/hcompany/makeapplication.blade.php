<x-auth-layout>

      @php $subtitle=__('welcome.managetask'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center">
                     <!-- <span>依頼</span> -->
                     {{ __('求人情報を入力') }}
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
            @php $action = route('savetask'); @endphp

                  <form id="makeapplication" method="POST" action="{{ $action }}">
                  @csrf
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <h4 for="email"><b>{{ __('募集ポジション') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('求人タイトル') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
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
                     </div>


                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('予定募集人数') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
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
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('募集職種') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
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
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('管理監督者求人') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                           
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group" style="font-size: 16px;">
                              <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="check" id="check_id" value="1"> 
                        </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('労働時間区分') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
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
                     </div>

                     <div class="form-group">
                          <textarea class="form-control form-control-message" id="bodytextarea" placeholder="{{ __('user.fillthemessage') }}" rows="8">{!! str_replace("<br />","&#013;",old('description') ?? '')  !!}</textarea>
                          <p style="display:none" class="description error text-danger"></p>                                 
                          <input type="hidden" name="description" id="description" value="{!! old('description') ?? '' !!}">
                     </div>

                     
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('user.inflrequest') }}</b></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
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
                     </div>

                     <div class="text-center"><br>
                        <button class="btn btn-submit" type="submit" data-askconfirmtitle="{{ __('user.applytitle') }}" data-askconfirmtext="{{ __('user.applytext') }}" data-yes="{{ __('user.dorequest') }}"> {{ __('user.dorequest') }}</button>
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
        $('#bodytextarea').on('input', function() {
           text = $('#bodytextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#description').val(text);
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