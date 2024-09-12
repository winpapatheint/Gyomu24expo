    <x-auth-layout>


    <style type="text/css">
       
    .replybox{
      background: #e0e5f1 !important;
      color:red;
      margin-right: 110px;
    }  

    .ourbox{
      background: #e7accd !important;
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

                  </div>
               </div><!-- col end-->

               <div id="messagebox" class="col-lg-8 post-content post-single" style="border: 1px solid #e5e5e5;">
                  <div class="blog-details">
                     <div class="entry-header" style="padding-top: 20px;">
                        <h2 class="entry-title text-center">
                           <a href="#"　class="disabled">{{ __('user.report') }}</a>
                        </h2>
                     </div><!-- header end -->

                     <div class="post-content post-single">
                           
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" id="alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        @php 
                            $error = $errors->toArray(); 
                            $cantedit = false; 
                            if($inflassign->inflstatus >= 9)
                              {$cantedit = true;} 
                        @endphp

                        @php $action= route('storereport') ; @endphp

                        <div id="replyform">
                           <form id="submitreport" class="contact-form" action="{{ $action }}" method="post">
                           @csrf

                           <input type="hidden" name="assignid" value="{{ $assignid }}">

                              <div class="error-container"></div>
                              <div class="row">
                                 <div class="col-md-8">
                                   @if($cantedit)
                                   <label for="email">{{ __('user.submitteddate') }}： {{ date('Y/m/d', strtotime($inflassign->reportsubmitted_at)) }}</label>
                                   @endif
                                    <div class="form-group">
                                    <label for="email"><b>{{ __('user.title') }}</b></label>
                                    <input @if($cantedit) disabled @endif  class="form-control form-control-name" name="title" id="title" type="text" value="{{ old('title') ?? $inflassign->reporttitle ?? '' }}">
                                     <p class="error title text-danger" style="display: none;"></p>
                                     @if (!empty($error['title']))
                                         @foreach ($error['title'] as  $key => $value)
                                             <p class="error text-danger">{{ $value }}</p>
                                         @endforeach
                                     @endif

                                    </div>
                                 </div>
                                 
                              </div>
                              <div class="form-group">
                                 <label for="email"><b>{{ __('user.reporto') }}</b>{{ old('body') }}</label>
                                 <textarea @if($cantedit) disabled @endif class="form-control form-control-message" id="bodytextarea" rows="14">{!! str_replace("<br />","&#013;",old('message') ?? $inflassign->reportbody ?? '')  !!}</textarea>
                                   <p class="error message text-danger" style="display: none;"></p>
                                   @if (!empty($error['message']))
                                       @foreach ($error['message'] as  $key => $value)
                                           <p class="error text-danger">{{ $value }}</p>
                                       @endforeach
                                   @endif                                 
                                 <input type="hidden" name="message" id="body" value="{!! old('message') ?? $inflassign->reportbody ?? '' !!}">
                                 <input type="hidden" name="submitconfirm" id="submitconfirm">
                              </div>
                              @if(!$cantedit)
                              <div class="text-center"><br>
                                 <button class="btn btn-submit" type="submit" data-askconfirmtitle="{{ __('user.savetitle') }}" data-askconfirmtext="{{ __('user.savetext') }}" data-yes="{{ __('user.dosave') }}">{{ __('user.dosave') }}</button>
                                 @if(auth()->user()->role == 'admin')
                                 <button class="btn btn-submit" type="submit" data-val="1" data-askconfirmtitle="提出し案件を終了" data-askconfirmtext="提出し終了しますか？" data-yes="提出する">提出し終了する</button> 
                                 @endif
                              </div>
                              @endif
                           </form><!-- Contact form end -->
                        </div>

                        <!-- Post comment end-->
                     </div>
                     <!-- Post content end-->
                  </div>

               </div><!-- col end -->


            </div><!-- row end-->
         </div><!-- .container end -->
      </section><!-- End faq section -->

   <script>


   $('#bodytextarea').on('input', function() {
     text = $('#bodytextarea').val();
     text = text.replace(/\r?\n/g, '<br />')
     // alert(text);
     $('#body').val(text);
   });


  $(".btn-submit").click(function(e){

      e.preventDefault();
      var _token = $("input[name='_token']").val();
      let formData = new FormData(submitreport);

      // console.log($(this).data('askconfirmtext'));
      let $this = $(this); // $(this) lost value after ajax, so need this line

      $.ajax({
          url: "{{ $action }}",
          type:'POST',

          data: formData,

           contentType: false,
           processData: false,

          success: function(data) {
              if($.isEmptyObject(data.error)){
                  // console.log("success");
                  // console.log($this);
                  // // alert(data.success);
                    $('.error').hide()
                  askconfirmboxshow($this,'submitreport');
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
                  alert("エラー：ajax error");
          }
      });
 
  });

   </script>

    </x-auth-layout>