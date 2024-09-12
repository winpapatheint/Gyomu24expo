<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">

    </script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="写真集管理"; @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('registergallery'); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $data->id }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if ($editmode)
                      写真集修正
                    @else
                    写真集登録
                    @endif

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  <input type="hidden" name="role" value="hcompany">

                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="title"><b>タイトル</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-title" placeholder="タイトル" name="title" id="title"
                                 type="text" value="{{ old('title') ?? $data->title ?? '' }}" >
                                 <!-- <p style="display:none" class="title error text-danger"></p> -->
                                @if (!empty($error['title']))
                                    @foreach ($error['title'] as  $key => $value)
                                        <p class="title error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     @if(Auth::user()->role == 'hcompany')
                     <input type="hidden" name="bunrui" value="{{ Auth::user()->bunrui }}">
                     @elseif(Auth::user()->role == 'admin')
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              @php 
                                if(!empty( $data->type)) {
                                  $select = $data->type;
                                } elseif(!empty(old('bunrui'))) {
                                  $select = old('bunrui');
                                } else {
                                  $select='';
                                }
                              @endphp

                              <label for="bunrui_select"><b>分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="bunrui" id="bunrui" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">分類を選択してください</option>
                                <option value="bunrui1" {{ $select == "bunrui1" ? "selected" : "" }}>教育支援</option>
                                <option value="bunrui2" {{ $select == "bunrui2" ? "selected" : "" }}>芸術・デザイン</option>
                                <option value="bunrui3" {{ $select == "bunrui3" ? "selected" : "" }}>サービス</option>
                                <option value="bunrui4" {{ $select == "bunrui4" ? "selected" : "" }}>製造</option>
                              </select>
                              <p style="display:none" class="bunrui error text-danger"></p>
                                @if (!empty($error['bunrui']))
                                    @foreach ($error['bunrui'] as  $key => $value)
                                        <p class="bunrui error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>
                     @endif

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picture"><b>イメージ</b> <span class="badge badge-danger">必須</span></label>
                              <input type="file" name="image" id="image" class="form-control" >
                              <img id="preview-image-before-upload" alt="your image" 
                              @if(!empty($data->value))
                              src="{{ asset('images/'.($data->value ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="image error text-danger"></p>
                                @if (!empty($error['image']))
                                    @foreach ($error['image'] as  $key => $value)
                                        <p class="image error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif


                           </div>
                        </div>
                     </div>



                     <div class="text-center">
                        <button class="btn btn-submit" type="submit" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-target="#detailModal"> -->
                      @if (!$editmode)  
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           登録する
                      @else
                          <i class="fa fa-edit" aria-hidden="true"></i>
                           修正する
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
                        修正しますか？
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
                        修正する
                      　@endif
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>

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

        var pwdchnge = false;
        $("#password,#password_confirmation").on("input", function(){
            pwdchnge = true;
        });


        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-image-before-upload').attr('src', e.target.result); 
              $('#preview-image-before-upload').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });

   //      $(".btn-submit").click(function(e){
   //          e.preventDefault();

			// var _token = $("input[name='_token']").val();
			// var email = $("input[name='email']").val();

   //    if (pwdchnge) {
   //    var password = $("input[name='password']").val();
   //    var password_confirmation = $("input[name='password_confirmation']").val();
   //    }

			// var name = $("input[name='name']").val();
			// var furiname = $("input[name='furiname']").val();
			// var gender = $("input[name='gender']").val();
			// var agerange = $("input[name='agerange']").val();
			// var phone = $("input[name='phone']").val();
			// var check = $('#check_id:checked').val();
			
			// console.log({_token:_token, 
   //              	   email:email, 
   //              	   password:password, 
   //              	   password_confirmation:password_confirmation, 
   //              	   name:name, 
   //              	   furiname:furiname, 
   //              	   gender:gender, 
   //              	   agerange:agerange, 
   //              	   phone:phone, 
   //              	   check:check});
   //              // alert(check);
   //          $.ajax({
   //              url: "{{ $action }}",
   //              type:'POST',
   //              data: {_token:_token, 
   //              	   email:email, 
   //              	   password:password, 
   //              	   password_confirmation:password_confirmation, 
   //              	   name:name, 
   //              	   furiname:furiname, 
   //              	   gender:gender, 
   //              	   agerange:agerange, 
   //              	   phone:phone, 
   //              	   check:check},

   //              success: function(data) {
   //                  if($.isEmptyObject(data.error)){
   //                      // alert("success");
   //                      // // alert(data.success);
   //                        $('.error').hide()
   //                      $('#detailModal').modal('show');
   //                  }else{
   //                      // alert("err");
   //                      console.log(data.error);
   //                        $('.error').hide()
   //                      $.each( data.error, function( key, value ) {
   //                        if (key == 'password') {
   //                          $.each( value, function( k, val ) {
   //                            if (val == 'パスワードが一致しません') {
   //                              $('.error.password_confirmation').text(val)
   //                              $('.error.password_confirmation').show() 
   //                              // alert('unset')
   //                            } else {
   //                              $('.error.'+key).text(val)
   //                              $('.error.'+key).show() 
   //                            }
   //                          });
   //                        } else {

   //                          $('.error.'+key).text(value[0])
   //                          $('.error.'+key).show()
   //                        }
   //                      });
   //                  }
   //              },
   //              fail: function(data) {
   //                      alert("errqqqq");
   //              }
   //          });
       
   //      }); 
       
    });


</script>

</x-auth-layout>