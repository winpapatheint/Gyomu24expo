<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        // $('#detailModal').modal('show');
    });

</script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="主催会社管理"; @endphp
      @php 
        if($editmode) {
          if ($editother) {
            $subtitle="主催会社管理"; 
          } else {
            $subtitle="基本情報修正"; 
          }
        } else {
          $subtitle="システム設定";
        }
      @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('registertypes'); @endphp
                  <form id="contact-form" class="contact-form" method="POST" action="{{ $action }}">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $editdata->id }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                    @if ($editmode)
                      分類修正
                    @else
                    分類登録
                    @endif

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">


                     <div class="error-container"></div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="agerange_select"><b>分類種類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="types" id="types"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @php 
                                    if(!empty($editdata->size)){
                                        $select = $editdata->size;
                                    } else {
                                        $select = '';
                                    }
                                @endphp
                                <option value="0" selected>登録分類を選択してください</option>
                                <option value="m" @if($select == 'm' ) selected @endif>中分類</option>                   
                                <option value="s" @if($select == 's' ) selected @endif>小分類</option>                                    
                              </select>
                              <p style="display:none" class="types error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row mform sform" @if(!$editmode) style="display: none" @endif>
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="agerange_select"><b>大分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="b_type" id="b_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">大分類を選択してください</option>
                                <option value=".b1" @if(str_contains($editdata->code ?? '', 'b1')) selected @endif>セミナー</option>              
                                <option value=".b2" @if(str_contains($editdata->code ?? '', 'b2')) selected @endif>説明会</option>                                    
                                <option value=".b3" @if(str_contains($editdata->code ?? '', 'b3')) selected @endif>IBT試験</option>                                    
                              </select>
                              <p style="display:none" class="b_type error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row sform" @if($select != 's' ) style="display: none" @endif>
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="agerange_select"><b>中分類</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="m_type" id="m_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">大分類を選択してください</option>    
                              </select>
                              <p style="display:none" class="m_type error text-danger"></p>
                           </div>
                        </div>
                     </div> 

                     <div class="row mform sform" @if(!$editmode) style="display: none" @endif>
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>分類名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-name" placeholder="分類名を入力してください。" name="name" id="name"
                                 type="text" value="{{ old('name') ?? $editdata->name ?? '' }}" >
                                 <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     
                     <div class="text-center">
                        <button class="btn btn-submit" type="button" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-target="#detailModal"> -->
                      @if (!$editmode)  
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           分類登録する
                      @else
                          <i class="fa fa-edit" aria-hidden="true"></i>
                           情報を修正する
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
       
      function showform(fval) {
          $('.sform').hide()
          $('.mform').hide()
          $( "."+ fval+"form" ).slideDown( "slow", function() {
    // Animation complete.
          });
      }

      function gettypechild(fval) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('gettypechild') }}",
                type:'POST',
                data: {_token:_token, 
                     parentcode:fval, 
                      },

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        $('#m_type').empty();
                        $('#m_type').append(new Option('中分類を選択してください', '0', true, true));
            console.log(data.success);
                        var code = '{{ $editdata->code ?? '' }}';
                        $.each(data.success, function( index, value ) {
                          // alert( index + ": " + value['name'] + ": " + value['code'] + code);
                          select = false;  
                          if (code.includes(value['code'])) {
                              select = true;  
                          }
                          $('#m_type').append(new Option(value['name'], value['code'], true, select));
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


      if ($('#types').val() != '0') {
          showform($('#types').val());
      }

      $('#types').change(function(){
          showform($(this).val());
      })

      if ($('#b_type').val() != '0') {
          gettypechild($('#b_type').val());
      }

      $('#b_type').change(function(){
          // alert($(this).val());
          gettypechild($(this).val());

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
                url: "{{ $action }}",
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