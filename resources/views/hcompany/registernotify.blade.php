<x-auth-layout>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<!--     <script type="text/javascript">

        $( document ).ready(function(e) {
            // alert("222");

            $('#image').change(function(){
                // alert("sss ");
                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#preview-image-before-upload').attr('src', e.target.result); 
                  $('#preview-image-before-upload').show();
                }
                reader.readAsDataURL(this.files[0]); 
            });

tinymce.init({
  selector: '#editor',
  plugins: 'image code',
  toolbar: 'undo redo | styleselect | bold | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
  // enable title field in the Image dialog
  image_title: true, 
  // enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,
  // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
  // images_upload_url: 'postAcceptor.php',
  // here we add custom filepicker only to Image dialog
  file_picker_types: 'image', 
  // and here's our custom image picker
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    
    // Note: In modern browsers input[type="file"] is functional without 
    // even adding it to the DOM, but that might not be the case in some older
    // or quirky browsers like IE, so you might want to add it to the DOM
    // just in case, and visually hide it. And do not forget do remove it
    // once you do not need it anymore.

    input.onchange = function() {
      var file = this.files[0];
      
      var reader = new FileReader();
      reader.onload = function () {
        // Note: Now we need to register the blob in TinyMCEs image blob
        // registry. In the next release this part hopefully won't be
        // necessary, as we are looking to handle it internally.
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    input.click();
  }
});


        });


    </script> -->


      @php 
          $error = $errors->toArray();
          $subtitle="お知らせ（緊急）"; 
      @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('registerblog'); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('postnotify') }}" enctype="multipart/form-data">
                  @csrf

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    参加者及び主催者に緊急お知らせ

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  <input type="hidden" name="id" value="{{$seminarid}}">

                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>タイトル</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-email" placeholder="タイトル" name="title" id="title"
                                 type="text" value="{{ old('title') ?? $blog->title ?? '' }}" >
                                 <p style="display:none" class="title error text-danger"></p>
                                @if (!empty($error['title']))
                                    @foreach ($error['title'] as  $key => $value)
                                        <p class="title error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="content"><b>内容</b> <span class="badge badge-danger">必須</span></label>
                              <textarea class="form-control form-control-message" name="content" id="editor" placeholder="内容をご記入してください"
                           rows="6">{{ old('content') ?? $blog->content ?? '' }}</textarea>
                                <p style="display:none" class="content error text-danger"></p>
                                @if (!empty($error['content']))
                                    @foreach ($error['content'] as  $key => $value)
                                        <p class="content error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>



                     <div class="text-center">
                        <button class="btn btn-submit" type="submit" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-target="#detailModal"> -->
                          <i class="fa fa-paper-plane" aria-hidden="true"></i>
                           送信する
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
                        修正しますか？
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
                        登録する
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