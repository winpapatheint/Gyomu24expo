<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        // $('#detailModal').modal('show');
    });

</script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="会社情報"; @endphp

      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('registertopsetting'); @endphp

                  <form id="registerhcompanyform" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf



         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    情報設定

                  </h2>
               </div><!-- col end-->
            </div>


            <div class="row">
               <div class="col-lg-8 mx-auto">

                     <div class="error-container"></div>
                      
                      @include('components.messagebox')

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="companyname"><b>会社名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="会社名" name="companyname" id="companyname"
                                 type="text" value="{{ old('companyname') ?? $lists['companyname'] ?? '' }}"  autofocus >
                                <p style="display:none" class="companyname error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="postalcode"><b>郵便番号</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="郵便番号" name="postalcode" id="postalcode"
                                 type="text" value="{{ old('postalcode') ?? $lists['postalcode'] ?? '' }}"  autofocus >
                                <p style="display:none" class="postalcode error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>住所1</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="住所1" name="address" id="address"
                                 type="text" value="{{ old('address') ?? $lists['address'] ?? '' }}"  autofocus >
                                <p style="display:none" class="address error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="addressextra"><b>住所2</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="住所2" name="addressextra" id="addressextra"
                                 type="text" value="{{ old('addressextra') ?? $lists['addressextra'] ?? '' }}"  autofocus >
                                <p style="display:none" class="addressextra error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="ceoname"><b>代表者名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="代表者名" name="ceoname" id="ceoname"
                                 type="text" value="{{ old('ceoname') ?? $lists['ceoname'] ?? '' }}"  autofocus >
                                <p style="display:none" class="ceoname error text-danger"></p>
                           </div>
                        </div>
                     </div>  

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="phone"><b>電話</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="電話" name="phone" id="phone"
                                 type="text" value="{{ old('phone') ?? $lists['phone'] ?? '' }}"  autofocus >
                                <p style="display:none" class="phone error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picname"><b>担当者名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password" placeholder="担当者名" name="picname" id="picname"
                                 type="text" value="{{ old('picname') ?? $lists['picname'] ?? '' }}"  autofocus >
                                <p style="display:none" class="picname error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="remarks"><b>備考欄</b></label>
                              <input class="form-control form-control-password" placeholder="備考欄" name="remarks" id="remarks"
                                 type="text" value="{{ old('remarks') ?? $lists['remarks'] ?? '' }}"  autofocus >
                                <p style="display:none" class="remarks error text-danger"></p>
                           </div>
                        </div>
                     </div> 


                     <div class="text-center">
                        <button class="btn btn-submit" type="button" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-target="#detailModal"> -->
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           設定する

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
                      　設定する
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
                      　設定する
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

        $(".btn-submit").click(function(e){
            e.preventDefault();

      let formData = new FormData(registerhcompanyform);

			console.log(formData);

            $.ajax({
                url: "{{ $action }}",
                type:'POST',
                data: formData,

                 contentType: false,
                 processData: false,

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