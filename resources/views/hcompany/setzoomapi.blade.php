<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        // $('#detailModal').modal('show');
    });

</script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="ZOOM API 設定"; @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('setzoomapi'); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ $action }}">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if($editmode)
                      ZOOMキー修正
                    @else 
                      ZOOMキー登録
                    @endif

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                   
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="keyone"><b>ZOOMキー</b></label>
                              <input class="form-control form-control-pacssword" placeholder="氏名" name="keyone" id="keyone"
                                 type="text" value="{{ old('keyone') ?? $edituser['keyone'] ?? '' }}"  autofocus >
                                <p style="display:none" class="keyone error text-danger"></p>
                           </div>
                        </div>
                     </div>         
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="keytwo"><b>ZOOMキー</b></label>
                              <input class="form-control form-control-password" placeholder="氏名（フリガナ）" name="keytwo" id="keytwo"
                                 type="text" value="{{ old('keytwo') ?? $edituser['keytwo'] ?? '' }}"  autofocus>
                                <p style="display:none" class="keytwo error text-danger"></p>
                           </div>
                        </div>
                     </div>  

                     <div class="text-center">
                        <button class="btn btn-submit" type="button" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-target="#detailModal"> -->
                      @if (!$editmode)  
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           ZOOMキー登録する
                      @else
                          <i class="fa fa-edit" aria-hidden="true"></i>
                           ZOOMキー修正する
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
                        ZOOMキーを登録しますか？
                      　@else
                        ZOOMキーを修正しますか？
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


        $(".btn-submit").click(function(e){
            e.preventDefault();

			var _token = $("input[name='_token']").val();

			var keyone = $("input[name='keyone']").val();
			var keytwo = $("input[name='keytwo']").val();
			
			console.log({_token:_token, 
                	   keyone:keyone, 
                	   keytwo:keytwo, 
                	   });
                // alert(check);
            $.ajax({
                url: "{{ $action }}",
                type:'POST',
                data: {_token:_token, 
                     keyone:keyone, 
                     keytwo:keytwo, 
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
        

                            $('.error.'+key).text(value[0])
                            $('.error.'+key).show()
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