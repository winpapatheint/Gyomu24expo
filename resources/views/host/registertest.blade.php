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


    </script>

    <style type="text/css">
      
    a:not([href]):not([tabindex]) {
         color: white; 
    }

    </style>


      @php 
      $dataopen=false; 
      if(!empty($data->id)){
          $editmode=true;
            if(($data->open == '1')){
              $dataopen=true; 
            }
      } else {
          $editmode=false;
      }
      @endphp

      @php $subtitle="試験管理"; @endphp
      @include('layouts.subtitle')
      

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     	@if($editmode)
                     		@if(($dataopen))
                     			試験新規作成
                     		@else
                     			試験修正
                     		@endif
                     	@else
                     		試験登録
                     	@endif
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  @php $error = $errors->toArray(); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('registertest') }}">
                  @csrf

                      <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="testname"><b>試験名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-email" placeholder="テスト名" name="testname" id="testname"
                                 type="text" value="{{ old('testname') ?? $data->name ?? '' }}">
                                @if (!empty($error['testname']))
                                    @foreach ($error['testname'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="startdt"><b>開始日時</b> <span class="badge badge-danger">必須</span></label>
                              @php if(isset($data->start)) $data->startdt = date('Y-m-d\TH:i', strtotime($data->start)); @endphp  
                              <input class="form-control form-control-password" placeholder="開始日時" name="startdt" id="startdt"
                                 type="datetime-local" value="{{ old('startdt') ?? $data->startdt ?? '' }}">
                                 <!-- value="2017-06-01T08:30" -->
                                @if (!empty($error['startdt']))
                                    @foreach ($error['startdt'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="enddt"><b>終了日時</b> <span class="badge badge-danger">必須</span></label>
                              @php if(isset($data->end)) $data->enddt = date('Y-m-d\TH:i', strtotime($data->end)); @endphp 
                              <input class="form-control form-control-password" placeholder="終了日時" name="enddt" id="enddt"
                                 type="datetime-local" value="{{ old('enddt') ?? $data->enddt ?? '' }}">
                                @if (!empty($error['enddt']))
                                    @foreach ($error['enddt'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div> 

                     <div class="row ">

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="testminute"><b>試験時間(分)</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="試験時間(分)" name="testminute" id="testminute"
                                 type="text" value="{{ old('testminute') ?? $data->testminute ?? '' }}">
                                @if (!empty($error['testminute']))
                                    @foreach ($error['testminute'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>

                     </div> 

                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                @php
                                if (!empty(old('b_type')) OR old('b_type') === '0' ) {
                                    $b_type = old('b_type');
                                } else if(!empty($data->semtype_id)) {
                                    $b_type = $data->semtype_id;
                                } else {
                                    $b_type = "";
                                }
                                @endphp
                              <label for="daibunrui_select"><b>大分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="b_type" id="b_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value=".b3" selected>IBT試験</option>                                    
                              </select>
                                @if (!empty($error['b_type']))
                                    @foreach ($error['b_type'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="participant_limit"><b>制限人数</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="制限人数" name="participant_limit" id="participant_limit"
                                 type="text" value="{{ old('participant_limit') ?? $data->limit ?? '' }}">
                                @if (!empty($error['participant_limit']))
                                    @foreach ($error['participant_limit'] as  $key => $value)
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
                                if (!empty(old('m_type')) OR old('m_type') === '0' ) {
                                    $m_type = old('m_type');
                                } else if(!empty($data->semtype_id)) {
                                    $m_type = $data->semtype_id;
                                } else {
                                    $m_type = "";
                                }
                                @endphp
                              <label for="chuubunrui_select"><b>中分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="m_type" id="m_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">大分類を選択してください</option>
                              </select>
                                @if (!empty($error['m_type']))
                                    @foreach ($error['m_type'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                @php
                                if (!empty(old('s_type')) OR old('s_type') === '0' ) {
                                    $s_type = old('s_type');
                                } else if(!empty($data->semtype_id)) {
                                    $s_type = $data->semtype_id;
                                } else {
                                    $s_type = "";
                                }
                                @endphp
                              <label for="s_type_select"><b>小分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="s_type" id="s_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">中分類を選択してください</option>
                              </select>
                                @if (!empty($error['s_type']))
                                    @foreach ($error['s_type'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>


                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="description"><b>試験内容</b> <span class="badge badge-secondary">任意</span></label>
                              <textarea class="form-control form-control-message" name="description" 
                                       id="editor" placeholder="注釈" rows="6">{{ old('description') ?? $data->description ?? '' }}</textarea>
                           </div>
                        </div>
                     </div> 

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="passkey"><b>予約許可番号</b> <span class="badge badge-secondary">任意</span></label>
                              <input class="form-control" name="passkey" id="passkey"
                                 type="text" value="{{ old('passkey') ?? $data->passkey ?? '' }}" placeholder="最大6桁半角数字を入力してください">
                                @if (!empty($error['passkey']))
                                    @foreach ($error['passkey'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                      @if(isset($lists))

                      <div class="row">

                         <div class="table-responsive">
                            <table id="quelist" class="table" style="text-align: center;">
                               <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">問題名</th>
                                    <th style="min-width: 152px" scope="col">アクション</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach( $lists as $key => $list )
                                  <tr id="que{{$list->id}}" data-queid="{{$list->id}}" class="questiontr">
                                    <th scope="row">{{ ($loop->index)+1 }}　</th>
                                    <td data-label="問題名" >{{ $list->name }}</td>

                                    <td data-label="アクション">
                                      <!-- <input type="button" value="move up" class="move up" />
                                      <input type="button" value="move down" class="move down" /> -->
                                        <a class="btnlist btn-danger move up" role="button"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                        <a class="btnlist btn-danger move down" role="button"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                        <a class="btnlist btn-danger" role="button" onclick="return removeque('{{ $list->id }}');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <!-- <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal">詳細</a> -->
                                        <!-- <a class="btn btn-success" href="#" role="button" data-toggle="modal" data-target="#confirmbook">チケット設定</a> -->
                                    </td>
                                  </tr>
                                  @endforeach                                                                    
                                </tbody>
                            </table>

                            @if(!empty($data->testquestion))
                            <input type="hidden" name="testquestion" id="testquestion" value="{{ '.'.implode('.', json_decode($data->testquestion)) }}">
                            @endif

                            @if(count($lists) < 1)
                            <div style="text-align: center; margin-bottom: 50px">
                            登録された問題がありません。
                            </div>
                            @endif 
                          </div>
                      </div>
                      @endif



                     <div class="text-center">
                        @if((!$dataopen))
                        <button class="btn" type="submit"><i class="fa fa-plus" aria-hidden="true"></i>
                           @if($editmode)修正@else登録@endifする</button>
                        @endif 
                        @if(($dataopen))
                        <button class="btn" name="makenew" value="1"><i class="fa fa-plus" aria-hidden="true"></i>試験を新規作成する</button>
                        @endif
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

     function removeque($queid) {
     	// alert($queid);
     	$("#que"+$queid).slideUp("slow");
     	
     	$("#que"+$queid).remove();

      updatetestque();
     }

     function updatetestque() {
        var testquestion = "";
        $("tr.questiontr").each(function() {
            testquestion = testquestion + '.' + $(this).attr("data-queid");  
        })
        $('#testquestion').val(testquestion);
     }

    $(document).ready(function() {

    $('#quelist a.move').click(function() {
        var row = $(this).closest('tr');
        console.log($( "tbody tr" ).first());
        if ($(this).hasClass('up'))
            if (row.prev().length) {
                row.prev().before(row);
            } else {
                $( "tbody tr" ).last().after(row);
            }
        else
            if (row.next().length) {
                row.next().after(row);
            } else {
                $( "tbody tr" ).first().before(row);
            }

        updatetestque();

    });





      let b_type = $('#b_type').val();
      
      let m_type = '{{ $m_type }}';

      let s_type = '{{ $s_type }}';

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
       
        $('#passkey').change(function(){
        var text  = $(this).val();
        var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
                  return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
                  });
        $(this).val(hen);
        });
       
    });


</script>

</x-auth-layout>