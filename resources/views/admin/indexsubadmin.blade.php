<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">

.btndiv{
  display: contents;
}
  
@media 
only screen and (max-width: 430px){

    .btndiv{
        display: block;
    }

    
}

</style>

      @php $subtitle="管理者管理"; @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     管理者一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a href="{{ url('/admin/registersubadmin' ) }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> 新規登録</a>
                  </p>
               </div>
            </div>          

            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">検索キーワード</label>
                              <input class="form-control form-control-email" placeholder="管理者名・メールアドレス" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                                       
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-search"></i>
                           検索する</button>
                     </div>
                  </form>
               </div>
            </div>

            @include('components.messagebox')

            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                          <th scope="col">登録日</th>
                          <th scope="col">管理者名</th>
                          <th scope="col">メールアドレス</th>
                          <th style="min-width: 130px" scope="col">電話番号</th>
                          <th style="min-width: 218px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $subadmins as $key => $subadmin )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($subadmins->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($subadmin->created_at)) }}<br>{{ date('H:i', strtotime($subadmin->created_at)) }}</td>
                          <td data-label="管理者名"><a href="{{ url('/takeremote/'.rand ( 10000 , 99999 ).$subadmin->id ) }}">{{ $subadmin->name }}</a></td>
                          <td data-label="メールアドレス">{{ $subadmin->email }}</td>
                          <td data-label="電話番号">{{ $subadmin->phone }}</td>
                          <!-- <td>{{ $subadmin->gender }}</td> -->
                          <!-- <td>{{ $subadmin->agerange }}</td> -->
                          <td data-label="アクション">
                              <!-- <a class="btn btn-primary" href="seminar_detail_host.html" role="button">詳細</a> -->
                              <div class="btndiv">
                                  <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $subadmin->id }}">詳細</a>
                              </div>
                              <!-- <div class="btndiv">
                                  <a class="btnlist btn-success" href="{{ url('/edit/admin/'.rand ( 10000 , 99999 ).$subadmin->id ) }}" role="button">修正</a>
                              </div> -->
                              @if(auth()->user()->id == '1')
                              <div class="btndiv">
                                  <a class="btnlist btn-danger" href="" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $subadmin->id }}">削除</a>
                              </div>
                              <!-- <div class="btndiv">
                                  <a class="btnlist btn-secondary setzoomapi-btn" href="" role="button" data-toggle="modal" data-target="#setzoomapi" data-subadminid="{{ $subadmin->id }}" data-zoomapi="{{ $subadmin->zoomapi }}">zoom api</a>
                              </div> -->
                              @endif
                          </td>
                        </tr>
                        @endforeach
                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($subadmins) < 1)
                  <div style="text-align: center;">
                  登録された管理者がありません。
                  </div>
                  @endif
                  
                </div>

                @include('components.pagination')

                <!-- Modal -->
               <div class="modal fade" id="setzoomapi" tabindex="-1" role="dialog" aria-labelledby="setzoomapiLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="setzoomapiLabel">ZOOMAPI設定</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                    @php
                      $action = route('updatezoomapi');
                    @endphp
                    <form id="zoomapiform" method="POST" action="{{ $action }}">
                    @csrf          

                           <input type="hidden" name="subadminid" id="subadminid">

                           <div class="form-group">
                              <label for="name"><b>ZOOMキー</b></label>
                              <input class="form-control form-control-email"  name="keyone" id="keyone"
                                 type="text" value="">
                              <p class="error keyone text-danger" style="display: none;"></p>
                           </div>


                           <div class="form-group">
                              <label for="timedate"><b>ZOOM秘密キー</b></label>
                              <input class="form-control form-control-email"  name="keytwo" id="keytwo"
                                 type="text" value="">
                              <p class="error keytwo text-danger" style="display: none;"></p>
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


                @foreach( $subadmins as $key => $subadmin )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $subadmin->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">管理者の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        
                        <p><strong>氏名 : </strong><span>{{ $subadmin->name }}</span></p>
                        @if(!empty($subadmin->profileimg))
                        <p><strong>プロフィール写真 : </strong>
                        <img src="{{ asset('images/avatar/'.$subadmin->profileimg ) }}" style="width: 100%;">
                        </p>
                        @endif
                        <p><strong>メールアドレス : </strong><span>{{ $subadmin->email }}</span></p>
                        <p><strong>電話番号 : </strong><span>{{ $subadmin->phone }}</span></p>
                        
                        <p><strong>性別 : </strong><span>{{ __(config('global.gender')[$subadmin->gender]) }}</span></p>
                        <p><strong>年齢代 : </strong><span>{{ __(config('global.age')[$subadmin->agerange]) }}</span></p>
                        <!-- <p>管理者詳細</p> -->
                     </div>
                     <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $subadmin->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">管理者を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか？</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteuser') }}" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $subadmin->id }}">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      </form>
                     </div>
                  </div>
                  </div>
               </div>
               @endforeach



            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>

<script type="text/javascript">
       
    $(document).ready(function() {

        $(".setzoomapi-btn").click(function(e){
            if ($(this).data('toggle') == 'modal') {


            	console.log($(this).data('zoomapi'));
               // const obj = JSON.parse($(this).data('zoomapi'));

              $('#keyone').val($(this).data('zoomapi').keyone); 
              $('#keytwo').val($(this).data('zoomapi').keytwo); 
              $('#subadminid').val($(this).data('subadminid')); 
              // e.preventDefault();     
            }
        });


        $(".btn-submit").click(function(e){

            e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(zoomapiform);
   
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
                          $('#zoomapiform').submit();
                        // $('#detailModal').modal('show');
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
       
    });


</script>

</x-auth-layout>