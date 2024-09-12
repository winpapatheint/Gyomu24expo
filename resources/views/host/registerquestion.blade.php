<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">

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
  selector: '.editor',
  plugins: 'image code',
  toolbar: 'undo redo | styleselect | bold | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
  // enable title field in the Image dialog
  image_title: true, 
  forced_root_block : "",
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


    </script>

    <style type="text/css">

    .newsection {
        border-top: 1px solid #e9ecef;
        padding-top: 10px;
    }

    </style>



      @php 
      if(!empty($data->id)){
          $editmode=true;
      } else {
          $editmode=false;
      }
      @endphp

      @php $subtitle="問題管理"; @endphp
      @include('layouts.subtitle')
      

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     問題@if($editmode)修正@else登録@endif
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  @php $error = $errors->toArray(); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('registerquestion') }}" enctype="multipart/form-data">
                  @csrf

                  @if($editmode)
                      <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                  @endif

                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="qname"><b>問題名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-email" placeholder="問題名" name="qname" id="qname"
                                 type="text" value="{{ old('qname') ?? $data->name ?? '' }}">
                                @if (!empty($error['qname']))
                                    @foreach ($error['qname'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>                     
                   
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                                @php
                                if (!empty(old('qtype')) OR old('qtype') === '0' ) {
                                    $qtype = old('qtype');
                                } else if(!empty($data->qtype)) {
                                    $qtype = $data->qtype;
                                } else {
                                    $qtype = "";
                                }
                                @endphp
                              <label for="qtype"><b>本文/質問</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="qtype" id="qtype"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">本文/質問を選択してください</option>
                                <option value="icq" @if($qtype == 'icq') selected @endif>指示文+本文+質問</option>
                                <option  value="cq" @if($qtype == 'cq') selected @endif>本文+質問</option>  
                                <option  value="iq" @if($qtype == 'iq') selected @endif>指示文+質問</option>  
                                <option   value="q" @if($qtype == 'q') selected @endif>質問</option>  
                              </select>
                                @if (!empty($error['qtype']))
                                    @foreach ($error['qtype'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                @php
                                if (!empty(old('ansformat')) OR old('ansformat') === '0' ) {
                                    $ansformat = old('ansformat');
                                } else if(!empty($data->ansformat)) {
                                    $ansformat = $data->ansformat;
                                } else {
                                    $ansformat = "";
                                }
                                @endphp
                              <label for="ansformat"><b>解答方式</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="ansformat" id="ansformat"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">解答方式を選択してください</option>
                                <option value="5" @if($ansformat == '5') selected @endif>選択5</option>                   
                                <option value="4" @if($ansformat == '4') selected @endif>選択4</option>                                    
                                <option value="2" @if($ansformat == '2') selected @endif>選択2</option>
                                <option value="1" @if($ansformat == '1') selected @endif>記入式</option>
                              </select>
                                @if (!empty($error['ansformat']))
                                    @foreach ($error['ansformat'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="qid"><b>番号</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="番号" name="qid" id="qid"
                                 type="text" value="{{ old('qid') ?? $data->qid ?? '' }}">
                                @if (!empty($error['qid']))
                                    @foreach ($error['qid'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="mark"><b>配点</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="配点" name="mark" id="mark"
                                 type="text" value="{{ old('mark') ?? $data->mark ?? '' }}">
                                @if (!empty($error['mark']))
                                    @foreach ($error['mark'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div> 

                     <div class="row newsection instruction" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="instruction"><b>指示文</b></label>
                              <textarea class="form-control form-control-message editor" name="instruction" 
                                       id="editor" placeholder="注釈" rows="6">{{ old('instruction') ?? $data->instruction ?? '' }}</textarea>
                                @if (!empty($error['instruction']))
                                    @foreach ($error['instruction'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row newsection content" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="content"><b>本文(文)</b></label>
                              <textarea class="form-control form-control-message editor" name="content" 
                                       id="editor" placeholder="注釈" rows="6">{{ old('content') ?? $data->content ?? '' }}</textarea>
                                @if (!empty($error['content']))
                                    @foreach ($error['content'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row content" style="display: none;">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="picture"><b>本文(イメージ)</b></label>
                              <input type="file" name="contentimg" id="contentimg" class="form-control" >
                              <img id="preview-contentimg-before-upload" alt="your contentimg" 
                              @if(!empty($data->value))
                              src="{{ asset('images/'.($data->value ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="contentimg error text-danger"></p>
                                @if (!empty($error['contentimg']))
                                    @foreach ($error['contentimg'] as  $key => $value)
                                        <p class="contentimg error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="picture"><b>サウンド(mp3)</b></label>
                              <input type="file" name="contentmp3" id="contentmp3" class="form-control" >
                              <img id="preview-contentmp3-before-upload" alt="your contentmp3" 
                              @if(!empty($data->value))
                              src="{{ asset('audio/'.($data->value ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="contentmp3 error text-danger"></p>
                                @if (!empty($error['contentmp3']))
                                    @foreach ($error['contentmp3'] as  $key => $value)
                                        <p class="contentmp3 error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div> 

                     <div class="row newsection question" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="question"><b>質問</b></label>
                              <textarea class="form-control form-control-message editor" name="question" 
                                       id="editor" placeholder="注釈" rows="6">{{ old('question') ?? $data->question ?? '' }}</textarea>
                                @if (!empty($error['question']))
                                    @foreach ($error['question'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row question" style="display: none;">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="picture"><b>質問(画像)</b></label>
                              <input type="file" name="questionimg" id="questionimg" class="form-control" >
                              <img id="preview-questionimg-before-upload" alt="your questionimg" 
                              @if(!empty($data->value))
                              src="{{ asset('images/'.($data->value ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="questionimg error text-danger"></p>
                                @if (!empty($error['questionimg']))
                                    @foreach ($error['questionimg'] as  $key => $value)
                                        <p class="questionimg error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="picture"><b>サウンド(mp3)</b></label>
                              <input type="file" name="questionmp3" id="questionmp3" class="form-control" >
                              <img id="preview-questionmp3-before-upload" alt="your questionmp3" 
                              @if(!empty($data->value))
                              src="{{ asset('audio/'.($data->value ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="questionmp3 error text-danger"></p>
                                @if (!empty($error['questionmp3']))
                                    @foreach ($error['questionmp3'] as  $key => $value)
                                        <p class="questionmp3 error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     @php
                     if(empty($data->correctans)){
                        $correctans = '';
                     } else {
                        $correctans = $data->correctans;
                     }
                     @endphp
                     <div class="ans1 row newsection" style="display: none;">
                        <div class="col-md-12 mx-auto">


                            @if (!empty($error['correctans']))
                                @foreach ($error['correctans'] as  $key => $value)
                                    <p class="error text-danger">{{ $value }}</p>
                                @endforeach
                            @endif
                        
                           <div class="form-group">
                              <label for="ans1"><b>選択1</b></label>
                              <input type="checkbox" value="1" name="correctans" class="anscb" @if($correctans == '1') checked @endif> 
                              <input class="form-control form-control-email" name="ans1" id="ans1"
                                 type="text" value="{{ old('ans1') ?? $data->ans1 ?? '' }}" style="display: inline-block;">
                                @if (!empty($error['ans1']))
                                    @foreach ($error['ans1'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="ans2 row" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="ans2"><b>選択2</b></label>
                              <input type="checkbox" value="2" name="correctans" class="anscb" @if($correctans == '2') checked @endif> 
                              <input class="form-control form-control-email" name="ans2" id="ans2"
                                 type="text" value="{{ old('ans2') ?? $data->ans2 ?? '' }}" style="display: inline-block;">
                                @if (!empty($error['ans2']))
                                    @foreach ($error['ans2'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="ans3 row" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="ans3"><b>選択3</b></label>
                              <input type="checkbox" value="3" name="correctans" class="anscb" @if($correctans == '3') checked @endif> 
                              <input class="form-control form-control-email" name="ans3" id="ans3"
                                 type="text" value="{{ old('ans3') ?? $data->ans3 ?? '' }}" style="display: inline-block;">
                                @if (!empty($error['ans3']))
                                    @foreach ($error['ans3'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="ans4 row" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="ans4"><b>選択4</b></label>
                              <input type="checkbox" value="4" name="correctans" class="anscb" @if($correctans == '4') checked @endif> 
                              <input class="form-control form-control-email" name="ans4" id="ans4"
                                 type="text" value="{{ old('ans4') ?? $data->ans4 ?? '' }}" style="display: inline-block;">
                                @if (!empty($error['ans4']))
                                    @foreach ($error['ans4'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="ans5 row" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="ans5"><b>選択5</b></label>
                              <input type="checkbox" value="5" name="correctans" class="anscb" @if($correctans == '5') checked @endif> 
                              <input class="form-control form-control-email" name="ans5" id="ans5"
                                 type="text" value="{{ old('ans5') ?? $data->ans5 ?? '' }}" style="display: inline-block;">
                                @if (!empty($error['ans5']))
                                    @foreach ($error['ans5'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="anskeyin row" style="display: none;">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="anskeyin"><b>正解</b></label>
                              <input class="form-control form-control-email" name="anskeyin" id="anskeyin"
                                 type="text" value="{{ old('anskeyin') ?? $data->anskeyin ?? '' }}" style="display: inline-block;">
                                @if (!empty($error['anskeyin']))
                                    @foreach ($error['anskeyin'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="howtowrite"><b>問題の解き方</b> <span class="badge badge-secondary">任意</span></label>
                              <textarea class="form-control form-control-message" name="howtowrite" 
                                       rows="6">{{ old('howtowrite') ?? $data->howtowrite ?? '' }}</textarea>
                           </div>
                        </div>
                     </div>                                           
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-plus" aria-hidden="true"></i>
                           @if($editmode)修正@else登録@endifする</button>
                     </div>
                  </form><!-- Contact form end -->
               </div>
            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>

<script type="text/javascript">
       
      function gettypechild(fval, childselectid, firstopt , selectval = '0' ) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('gettypechild') }}",
                type:'POST',
                data: {_token:_token, 
                     parentcode:fval, 
                      },

                success: function(data) {
                  console.log(data);

                    if($.isEmptyObject(data.error)){
                        $(childselectid).empty();
                        $(childselectid).append(new Option(firstopt, '0', true, false));

                        $.each(data.success, function( index, value ) {
                          // alert( index + ": " + value['name'] );
                          select = false;
                          if (selectval.includes(value['code'])) {
                            select = true;
                          }
                          // alert(selectval+" >>> "+value['code']+">>>"+select);
                          $(childselectid).append(new Option(value['name'], value['code'], true, select));
                        });;

                    }else{
                        // alert("err");
                        console.log(data.error);

                    }
                },
                fail: function(data) {
                        alert("err:code99");
                }
            });

      }

    function showsection(sectioncode) {

          var section = {
            "i": "instruction",
            "c": "content",
            "q": "question"
          };

          $.each( section, function( key, value ) {
              // alert( key + ": " + value );
              if (sectioncode.includes(key)) {
                  if($("."+value).is(":hidden")){
                      $('.'+value).slideDown("slow");
                  }
              } else {
                  if($("."+value).is(":visible")){
                      $('.'+value).slideUp("slow");
                  }
              }
          });

    }

    function showansset(ansformat) {

        if (ansformat == 1) {
            if($(".anskeyin").is(":hidden")){
                $(".anskeyin").slideDown("slow");
            }
            ansformat = 0 ;
        } else {
            if($(".anskeyin").is(":visible")){
                $(".anskeyin").slideUp("slow");
            }
        }

        for (var n = 1; n < 6; ++ n) {
          // alert(n);
            if (n <= ansformat ) {
                  // alert("show "+n);
                if($(".ans"+n).is(":hidden")){
                    $(".ans"+n).slideDown("slow");
                }
            } else {
                  // alert("hide "+n);
                if($(".ans"+n).is(":visible")){
                    $(".ans"+n).slideUp("slow");
                }
            }
        }

    }

    $(document).ready(function() {

      $('#qtype').change(function(){
        var sectioncode = $(this).val();
        showsection(sectioncode);
      })

      if ($('#qtype').val() != '') {
        showsection($('#qtype').val());
          // alert($('#qtype').val());
      }

      $('#ansformat').change(function(){
          var ansformat = $(this).val();
          showansset(ansformat);
      })

      if ($('#ansformat').val() != '') {
          showansset($('#ansformat').val());
      }

      $('input.anscb').on('change', function() {
         $('input.anscb').not(this).prop('checked', false);
      });


      let b_type = $('#b_type').val();

      if ($('#b_type').val() != '0') {
          // gettypechild($('#b_type').val(),'#m_type','中分類を選択してください',m_type);
          // alert("122");
          $.when($.ajax(gettypechild($('#b_type').val(),'#m_type','中分類を選択してください',m_type))).then(function () {

              // alert('2');
                if ($('#m_type').val() != '0') {
                    gettypechild($('#m_type').val(),'#s_type','小分類を選択してください',s_type);
                }

          });


      }


      $('#b_type').change(function(){
          gettypechild($(this).val(),'#m_type','中分類を選択してください');
          $('#s_type').empty();
          $('#s_type').append(new Option('中分類を選択してください', '0', true, true));
      })


      $('#m_type').change(function(){
          // alert($(this).val() +'   '+s_type);
          gettypechild($(this).val(),'#s_type','小分類を選択してください',s_type);

      })


        $(".btn-submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var name = $("input[name='name']").val();


            var types = $('#types').val();
            var b_type = $('#b_type').val();
            var m_type = $('#m_type').val();
      
      console.log({_token:_token, 
                     name:name, 
                     types:types, 
                     b_type:b_type, 
                     m_type:m_type, 
                     });
                // alert(check);
            $.ajax({
                url: "{{ route('registertypes') }}",
                type:'POST',
                data: {_token:_token, 
                     name:name, 
                     types:types, 
                     b_type:b_type, 
                     m_type:m_type, 
                     },

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        // alert("success");
                        // // alert(data.success);
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