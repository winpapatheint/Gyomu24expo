    <x-auth-layout>


    <style type="text/css">
.imgcontainer {
  position: relative;
  text-align: center;
  color: white;
}

.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}
 
    .replybox{
      background: #e0e5f1 !important;
      color:red;
      margin-right: 110px;
    }  

    .ourbox{
      background: #e7accd !important;
      margin-left: 110px;
    }

    .ourteambox{
      background: #e7accd61 !important;
      margin-left: 110px;
    }

    .comment-content p {
    color: black;
    }

   * {
     box-sizing: border-box;
   }

   .row {
     display: -ms-flexbox; /* IE10 */
     display: flex;
     -ms-flex-wrap: wrap; /* IE10 */
     flex-wrap: wrap;
     padding: 0 4px;
   }

   /* Create four equal columns that sits next to each other */
   .column {
     -ms-flex: 50%; /* IE10 */
     flex: 50%;
     max-width: 50%;
     padding: 0 4px;
   }

   .column img {
     margin-top: 8px;
     vertical-align: middle;
     width: 100%;
   }

   /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
   @media screen and (max-width: 700px) {
     .column {
       -ms-flex: 100%;
       flex: 100%;
       max-width: 100%;
     }
   }
</style>

      @php $subtitle=__('welcome.managetask'); @endphp
      @include('components.subtitle')

 
      <section class="ts-faq-sec">
         <div class="container">
            <div class="row">

               <div class="col-lg-4">
                  <div class="sidebar-widgets">


                      @include('components.leftwidget')

                     <div class="text-center">
                        <a class="disabled" data-toggle="modal" data-target="#showdetailmodal0"><button class="btn btn-primary" type="button">{{ __('message.taskdetail') }}</button></a>
                        @if(auth()->user()->role == 'admin')
                        <button class="btn btn-success" type="submit" id="confirmpage">ヒヤリング</button>
                        @endif
                     </div>


                  </div>
               </div><!-- col end-->


               <div id="messagebox" class="col-lg-8" style="border: 1px solid #e5e5e5;">
                  <div class="blog-details">
                     <div class="entry-header" style="padding-top: 20px;">
                        <h2 class="entry-title text-center">
                          @if(!empty($opponent))
                           <a href="#">{{ __('auth.msgwith', ['name' => $opponent] ?? 'ADMIN') }}</a>
                          @else
                           <a href="#">{{ __('auth.msgwithnobody') }}</a>
                          @endif
                        </h2>
                     </div><!-- header end -->

                     <div class="post-content post-single">
                           
                        <!-- Post comment start-->
                        <div class="comments-area" id="comments">

                           <ul class="comments-list">
                           @if(count($msgs) < 1)
                           <p class="text-center">{{ __('message.nomessage') }}</p>
                           @endif

                              @foreach( $msgs as $key => $msg )

                              <li>
                                 <ul class="" style="list-style: none;">
                                    <li>
                                       <div class="comment">

                                          <div class="reply-bg 
                                          @if($msg->sender == auth()->user()->id) 
                                              ourbox  
                                          @else 
                                              @if((auth()->user()->role == 'admin') AND (isset($adminids[$msg->sender])))
                                                ourteambox
                                              @else 
                                                replybox @if(empty($msg->updated_at)) msgread @endif
                                              @endif 
                                          @endif" data-msgid='{{$msg->id}}'>

                                             <div class="meta-data">
                                                <span class="comment-author">{{ $msg->title }}</span>
                                                <span class="comment-date">
                                                送信日：{{ date('Y/m/d H:i', strtotime($msg->created_at)) }}　　　　　
                                                @if((auth()->user()->role == 'admin') AND (isset($adminids[$msg->sender])) AND ($msg->sender != auth()->user()->id) )
                                                <label style="float: right;">送信者：{{ $adminids[$msg->sender] }}</label>
                                                @endif
                                                </span>
                                             </div>
                                             <div class="comment-content">
                                                <p>{!! $msg->body !!}</p>
                                                
                                                @if( $msg->type ==  'fileupl' )
                                                @php 
                                                   $filearr = json_decode($msg->attachment);
                                                @endphp

                                                <div class="row"> 
                                                  <div class="column">
                                                    @for ($i=0; array_key_exists($i, $filearr); $i+=2)                                                    
                                                    <div class="imgcontainer">
                                                      @if(strstr((mime_content_type('images/'.$filearr[$i])), "image/"))
                                                      <img src="{{ asset('images/'.$filearr[$i] ) }}"  alt="Snow" style="width:100%;">
                                                      @else
                                                      <img src="https://i.ibb.co/4J0ZtqJ/download-removebg-preview.png"  alt="Snow" style="width:100%;">
                                                      @endif
                                                      <div class="bottom-right"><a class="btnlist btn-primary" style="font-size: 12px !important;" href="{{ url('/download?d='.'images/'.$filearr[$i] ) }}" role="button">download</a></div>
                                                    </div>
                                                    @endfor
                                                  </div>
                                                  <div class="column">
                                                    @for ($i=1; array_key_exists($i, $filearr); $i+=2)                                                    
                                                    <div class="imgcontainer">
                                                      @if(strstr((mime_content_type('images/'.$filearr[$i])), "image/"))
                                                      <img src="{{ asset('images/'.$filearr[$i] ) }}"  alt="Snow" style="width:100%;">
                                                      @else
                                                      <img src="https://i.ibb.co/4J0ZtqJ/download-removebg-preview.png"  alt="Snow" style="width:100%;">
                                                      @endif
                                                      <div class="bottom-right"><a class="btnlist btn-primary" style="font-size: 12px !important;" href="{{ url('/download?d='.'images/'.$filearr[$i] ) }}" role="button">download</a></div>
                                                    </div>
                                                    @endfor
                                                  </div>  
                                                </div>

                                                @endif
                                             </div>
                                             <div class="meta-data">
                                                <span class="comment-date">
                                                <label class="newmark" style="float: right; display: none; color: red;">未読</label>
                                                </span>
                                             </div>

                                          </div>                                         

                                       </div>
                                    </li>
                                 </ul>
                              </li>
                              @endforeach
                           </ul>
                           <!-- Comments-list ul end-->
                        </div>

                        <div id="replyform">
                           <form id="sendmsg" class="contact-form" action="{{ route('sendmsg') }}" method="post" enctype="multipart/form-data">
                           @csrf

                           <input type="hidden" name="taskid" value="{{ $taskhashid }}">
                           <input type="hidden" name="roomnum" value="{{ $roomnum }}">

                              <div class="error-container"></div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    <input class="form-control form-control-name"  name="title" id="title" type="text" placeholder="{{ __('message.subject') }}">
                                    <p style="display:none" class="title error sendmsg text-danger"></p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    <a class="btnlist btn-success" href='' style="line-height: 40px;" role="button" data-toggle="modal" data-target="#setzoom">ZOOMミーティング設定</a>
                                    </div>
                                 </div>
                                 @if(auth()->user()->role == 'admin')
                                 @endif
                                 
                              </div>
                              <div class="form-group">
                                 <textarea class="form-control form-control-message" id="bodytextarea" rows="6" placeholder="{{ __('message.pleaseinsertmessage') }}"></textarea>
                                    <p style="display:none" class="body error sendmsg text-danger"></p>
                                 <!-- <a class="btnlist btn-success" href='' style="line-height: 40px;" role="button" data-toggle="modal" data-target="#fileupl">ファイルを添付</a> -->
                                 <input type="file" name="attachment[]" id="attachment" style="margin-top: 10px;" multiple>
                                 <input type="hidden" name="body" id="body">
                              </div>
                              <div class="text-center"><br>
                                 <button class="btn sendmsg-btn" type="submit">{{ __('message.dosend') }}</button> 
                              </div>
                           </form><!-- Contact form end -->
                        </div>

                        <!-- Post comment end-->
                     </div>
                     <!-- Post content end-->
                  </div>

               </div><!-- col end -->

               <div id="confirmbox" class="col-lg-8" style="border: 1px solid #e5e5e5; display: none;">
                  <div class="blog-details">
                     <div class="entry-header" style="padding-top: 20px;">
                        <h2 class="entry-title text-center">
                           <a href="#">ヒヤリングシート</a>
                        </h2>
                     </div><!-- header end -->

                     <div class="post-content post-single">

                        <div>
                           <form id="contact-form" class="contact-form" method="POST" action="{{ route('hearing') }}">
                           @csrf          

                           <input type="hidden" name="taskid" value="{{ $taskhashid }}">
                              <div class="error-container"></div>

                              <div class="form-group">
                                 <label for="email"><b>ヒヤリングシート内容</b></label>
                                 <textarea class="form-control form-control-message" id="descriptiontextarea"  value="" rows="8">{!! str_replace("<br />","&#013;",$list->description ?? '')  !!}</textarea>
                                 <input type="hidden" name="description" id="descriptiontextareahidden" value="{!! old('description') ?? $list->description ?? '' !!}">
                              </div>

                              <div class="text-center"><br>
                                 <button class="btn askconfirm" type="submit" data-askconfirmtitle="ヒヤリング内容の更新" data-askconfirmtext="更新しますか？" data-yes="更新する">更新する</button> 
                              </div>

                           </form><!-- Contact form end -->
                        </div>

                        <!-- Post comment end-->
                     </div>
                     <!-- Post content end-->
                  </div>

               </div><!-- col end -->


                <!-- Modal -->
               <div class="modal fade" id="setzoom" tabindex="-1" role="dialog" aria-labelledby="setfeeModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="setfeeModalLabel">ZOOMミーティング設定</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>求人タイトル : {{ $list->positionname }}</p>
                        <p>求人番号 : {{ sprintf('%06d', $list->id) }}</p>
                    <form id="setzoom" method="POST" action="{{ route('sendmsg') }}">
                    @csrf          

                           <input type="hidden" name="taskid" value="{{ $taskhashid }}">
                           <input type="hidden" name="roomnum" value="{{ $roomnum }}">
                           <input type="hidden" name="zoomset" value="1">

                           <div class="form-group">
                              <label for="name"><b>ミーティング名</b></label>
                              <input class="form-control form-control-email"  name="name" id="name"
                                 type="text" value="">
                              <p style="display:none" class="name error setzoom text-danger"></p>
                           </div>


                           <div class="form-group">
                              <label for="timedate"><b>開始日時</b></label>
                              <input class="form-control"  name="start" id="start"
                                 type="datetime-local" >
                              <p style="display:none" class="start error setzoom text-danger"></p>
                           </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-submit" value="">設定する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                    </form>
                  </div>
                  </div>
               </div>

                <!-- Modal -->
               <div class="modal fade" id="fileupl" tabindex="-1" role="dialog" aria-labelledby="setfeeModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="setfeeModalLabel">ファイルの添付</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>依頼名 : {{ $list->positionname }}</p>
                        <p>依頼番号 : {{ sprintf('%06d', $list->id) }}</p>
                    <form id="setattach" method="POST" action="{{ route('sendmsg') }}" enctype="multipart/form-data">
                    @csrf          

                           <input type="hidden" name="taskid" value="{{ $taskhashid }}">
                           <input type="hidden" name="roomnum" value="{{ $roomnum }}">
                           <input type="hidden" name="fileupl" value="1">

                           <div class="form-group">
                              <label for="name"><b>件名</b></label>
                              <input class="form-control form-control-email"  name="name" id="setattachname"
                                 type="text" value="">
                              <p class="error setattach setattachname text-danger" style="display: none;"></p>
                           </div>


                           <div class="form-group">
                              <input type="file" name="attachment[]" id="attachment" class="form-control" multiple>
                              <p class="error setattach attachment text-danger" style="display: none;"></p>
                           </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-submit" value="">添付する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                    </form>
                  </div>
                  </div>
               </div>

                <!-- Modal -->
               <div class="modal fade" id="showdetailmodal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">依頼の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p><strong>依頼番号 : </strong><span id="semnamelabel">{{ '200101' }}</span></p>
                        <p><strong>依頼名 : </strong><span id="semnamelabel">{{ '21年冬休みキャンペーン' }}</span></p>
                        <p><strong>ステータス : </strong><span id="semstartlabel">{{ '打ち合わせ中' }}</span></p>
                        <p><strong>申込日時 : </strong><span id="semendlabel">{{ '2021/12/05　18：12' }}</span></p>
                        <p><strong>採用企業名： : </strong><span id="semtypelabel">{{ 'ahaha' }}</span></p>
                        <p><strong>依頼内容 : </strong><span id="semfeelabel">{{ '依頼内容依頼内容依頼内容依頼内容依頼内容依頼内容依頼内容' }}</span></p>
                     </div>
                 <!--     <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>


            </div><!-- row end-->
         </div><!-- .container end -->
      </section><!-- End faq section -->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-appear/0.1/jquery.appear.min.js" integrity="sha512-h3cK8UUr5b3GLA8k7uBvK2c2U/JjnaG7i7KF5OSUE6JPF5B+JCg/LI/VOlIORYK9d0UAUhXDoVVbEDmBFOOLeQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       <script>



       $('#sendmsg').submit(function() {
          $('.error.sendmsg').hide()
          if ($.trim($("#title").val()) === "" || $.trim($("#body").val()) === "") {
              
             if ($.trim($("#title").val()) === "") {
                  $('.error.title').text("{{ __('auth.msgtitle') }}")
                  $('.error.title').show()
             }

             if ($.trim($("#body").val()) === "") {
                  $('.error.body').text("{{ __('auth.msgcontent') }}")
                  $('.error.body').show()
             }

             return false;
          } 

       });


       $('#setzoom').submit(function() {
          $('.error.setzoom').hide()
          if ($.trim($("#name").val()) === "" || $.trim($("#start").val()) === "") {
              
             if ($.trim($("#name").val()) === "") {
                  $('.error.name').text('ミーティング名を入力してください')
                  $('.error.name').show()
             }

             if ($.trim($("#start").val()) === "") {
                  $('.error.start').text('開始日時を設定してください')
                  $('.error.start').show()
             }

             return false;
          } 

       });


       $('#setattach').submit(function() {
          $('.error.setattach').hide()
          if ($.trim($("#setattachname").val()) === "" || $.trim($("#attachment").val()) === "") {
              
             if ($.trim($("#setattachname").val()) === "") {
                  $('.error.setattachname').text("{{ __('auth.msgtitle') }}")
                  $('.error.setattachname').show()
             }

             if ($.trim($("#attachment").val()) === "") {
                  $('.error.attachment').text('ファイルを添付してください')
                  $('.error.attachment').show()
             }

             return false;
          } 

       });

       $( "#replybtn" ).click(function() {
         $( "#replyform" ).slideToggle( "slow" );
       });

       $( "#confirmpage" ).click(function() {

          if(!$('#messagebox').is(':visible')){
            
             $( "#confirmbox" ).toggle("slide", function() {            
                $( "#messagebox" ).toggle( "slide" );           
             });

          } else {

             $( "#messagebox" ).toggle("slide", function() {            
                $( "#confirmbox" ).toggle( "slide" );           
             });

          }
     
       });

         $('#bodytextarea').on('input', function() {
           text = $('#bodytextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#body').val(text);
         });

        $('div.msgread .newmark').show(); // show new msg flag

        $('div.msgread').appear(function() {
          // console.log("reading " + $(this).data('msgid'));
          msgread($(this).data('msgid'));
        });

        function msgread(msgid) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('msgread') }}",
                type:'POST',
                data: {_token:_token, 
                       msgid:msgid,
                       },

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        if (data.success) {
                          console.log("msg read for " + msgid);
                        }
                    }else{
                        console.log(data.error);
                        alert("システムエラー");

                    }
                },
                fail: function(data) {
                    alert("システムエラー");
                }
            });
        }

        //fix it later
       $('#descriptiontextarea').on('input', function() {
         text = $('#descriptiontextarea').val();
         text = text.replace(/\r?\n/g, '<br />')
         $('#descriptiontextareahidden').val(text);
       });


       </script>

    </x-auth-layout>