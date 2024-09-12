<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        // $('#detailModal').modal('show');
    });

</script>


      @php $subtitle="セミナー管理"; @endphp
      @include('layouts.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     セミナー登録
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  @php $error = $errors->toArray(); @endphp

                  <form id="contact-form" class="contact-form" method="POST" action="{{ route('registerseminar') }}">
                  @csrf

                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="seminar_name"><b>セミナー名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-email" placeholder="セミナー名" name="seminar_name" id="seminar_name"
                                 type="text">
                                @if (!empty($error['seminar_name']))
                                    @foreach ($error['seminar_name'] as  $key => $value)
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
                              <input class="form-control form-control-password" placeholder="開始日時" name="startdt" id="startdt"
                                 type="datetime-local">
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
                              <input class="form-control form-control-password" placeholder="終了日時" name="enddt" id="enddt"
                                 type="datetime-local">
                                @if (!empty($error['enddt']))
                                    @foreach ($error['enddt'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>    
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="daibunrui_select"><b>大分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="b_type" id="b_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">大分類を選択してください</option>
                                <option value=".b1">セミナー</option>                   
                                <option value=".b2">説明会</option>                                    
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
                                 type="text">
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
                              <label for="s_type_select"><b>小分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="s_type" id="s_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">中分類を選択してください</option>
                                <option value="小分類1">小分類1</option>                   
                                <option value="小分類2">小分類2</option>                   
                                <option value="小分類3">小分類3</option>                   
                                <option value="小分類4">小分類4</option>                   
                                <option value="小分類5">小分類5</option>                   
                                <option value="小分類6">小分類6</option>                   
                              </select>
                                @if (!empty($error['s_type']))
                                    @foreach ($error['s_type'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="formurl"><b>Form URL</b> <span class="badge badge-secondary">任意</span></label>
                              <input class="form-control form-control-email" placeholder="Form URL" name="formurl" id="formurl"
                                 type="text">
                                @if (!empty($error['formurl']))
                                    @foreach ($error['formurl'] as  $key => $value)
                                        <p class="error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="description"><b>注釈</b> <span class="badge badge-secondary">任意</span></label>
                              <textarea class="form-control form-control-message" name="description" 
                                       id="description" placeholder="注釈" rows="6"></textarea>
                           </div>
                        </div>
                     </div>                                           
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-plus" aria-hidden="true"></i>
                           登録する</button>
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
       
      function gettypechild(fval, childselectid, firstopt ) {
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
                        $(childselectid).append(new Option(firstopt, '0', true, true));

                        $.each(data.success, function( index, value ) {
                          // alert( index + ": " + value['name'] );
                          $(childselectid).append(new Option(value['name'], value['code'], true, false));
                        });;

                    }else{
                        // alert("err");
                        console.log(data.error);

                    }
                },
                fail: function(data) {
                        alert("errqqqq");
                }
            });

      }

    $(document).ready(function() {


      if ($('#b_type').val() != '0') {
          gettypechild($('#b_type').val(),'#m_type','中分類を選択してください');
      }


      $('#b_type').change(function(){
          gettypechild($(this).val(),'#m_type','中分類を選択してください');

      })

      $('#m_type').change(function(){
          // alert($(this).val());
          gettypechild($(this).val(),'#s_type','小分類を選択してください');

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