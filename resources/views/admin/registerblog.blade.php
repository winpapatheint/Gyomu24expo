<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="新着情報管理"; @endphp
      @php 
        if($editmode) {
          if ($editother) {
            $subtitle="新着情報管理"; 
          } else {
            $subtitle="基本情報"; 
          }
        } else {
          $subtitle="新着情報管理";
        }
      @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('registerblog'); @endphp

                  <form id="registerblog" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $blog->id }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if ($editmode)
                      @if ($editother)
                      新着情報修正
                      @else
                      基本情報修正
                      @endif
                    @else
                    新着情報登録
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
                              <label for="email"><b>題名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-email" placeholder="題名" name="title" id="title"
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

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                             <div class="form-group">
                              <label for="category"><b>分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="category" id="category" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">分類を選択してください</option>
                                <option value="1" {{ old('category') == "1" ? "selected" : "" }} {{ $blog->category ?? '' == "1" ? "selected" : "" }} >新着情報</option>
                                <option value="2" {{ old('category') == "2" ? "selected" : "" }} {{ $blog->category ?? '' == "2" ? "selected" : "" }} >お知らせ</option>
                              </select>
                              <p style="display:none" class="category error text-danger"></p>
                                @if (!empty($error['category']))
                                    @foreach ($error['category'] as  $key => $value)
                                        <p class="category error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>
     

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picture"><b>イメージ写真</b> <span class="badge badge-danger">必須</span></label>
                              <input type="file" name="image" id="image" class="form-control" >
                              <img id="preview-image-before-upload" alt="your image" 
                              @if(!empty($blog->headimg))
                              src="{{ asset('images/'.($blog->headimg ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="image error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="content"><b>内容</b> <span class="badge badge-danger">必須</span></label>
                              <textarea class="form-control form-control-message" id="bodytextarea"  placeholder="内容をご記入してください"
                           rows="6">{!! str_replace("<br />","&#013;",old('content') ?? $blog->content ?? '')  !!}</textarea>
                                <p style="display:none" class="content error text-danger"></p>
                                @if (!empty($error['content']))
                                    @foreach ($error['content'] as  $key => $value)
                                        <p class="content error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                                <input type="hidden" name="content" id="content" value="{!! old('content') ?? $blog->content ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="text-center">
                        <button class="btn btn-submit" type="button" role="button" 
                        @if (!$editmode)
                        data-askconfirmtitle="新着情報の登録" data-askconfirmtext="登録しますか？" data-yes="登録する"
                        @else
                        data-askconfirmtitle="新着情報の修正" data-askconfirmtext="修正しますか？" data-yes="修正する"
                        @endif
                        >
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

                  </form><!-- Contact form end -->

         <div class="speaker-shap">
            <img class="shap1" src="{{ asset('images/shap/home_schedule_memphis2.png') }}" alt="">
         </div>
        </section>

<script type="text/javascript">
       
   $('#bodytextarea').on('input', function() {
     text = $('#bodytextarea').val();
     text = text.replace(/\r?\n/g, '<br />')
     // alert(text);
     $('#content').val(text);
   });

  $(document).ready(function() {

      $('#image').change(function(){
          let reader = new FileReader();
          reader.onload = (e) => { 
            $('#preview-image-before-upload').attr('src', e.target.result); 
            $('#preview-image-before-upload').show();
          }
          reader.readAsDataURL(this.files[0]); 
      });
     
  });

   $('.btn-submit').click(function() {
      $('.error').hide()
      // alert('sas');

      if ($.trim($("#title").val()) === "" || $.trim($("#category").val()) === "" || $.trim($("#image").val()) === "" || $.trim($("#content").val()) === "") {
          
         if ($.trim($("#title").val()) === "") {
              $('.error.title').text('題名を入力してください')
              $('.error.title').show()
         }

         if ($.trim($("#category").val()) === "0") {
              $('.error.category').text('分類を選択してください')
              $('.error.category').show()
         }

         if ($.trim($("#image").val()) === "") {
              $('.error.image').text('イメージ写真を選択してください')
              $('.error.image').show()
         }

         if ($.trim($("#content").val()) === "") {
              $('.error.content').text('内容を入力してください')
              $('.error.content').show()
         }

         return false;
      } else {
        askconfirmboxshow($(this),'registerblog');
      }

   });


</script>

</x-auth-layout>