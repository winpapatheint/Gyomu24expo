<x-auth-layout>

    <link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="カート"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">



    <script src="https://www.paypal.com/sdk/js?client-id=Afa37Sd8KhndPxu857AGrWKc44766o1oiHViAxUlSl9ZFiryUEY7mwcsslzuv-OARUnMSJBSS15ZVoGg&currency=JPY"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>






        <form id="makepayform" id="makepayform" class="contact-form" method="POST" action="{{ route('makepay') }}" enctype="multipart/form-data">
        @csrf
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     カート
                  </h2>
               </div><!-- col end-->
            </div>
<!--             <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="register_new_seminar.html">
                        <i class="fa fa-plus" aria-hidden="true"></i> セミナーの新規登録</a>
                  </p>
               </div>
            </div> -->


            @include('components.messagebox')
            
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <!-- <th scope="col">ホスト名</th> -->
                          <th style="text-align: left" scope="col">セミナー/試験名</th>
                          <th style="min-width: 115px" scope="col">主催者名</th>
                          <th scope="col">開始日時</th>
                          <th style="min-width: 147px" scope="col">終了日時</th>
                          <th style="min-width: 100px" scope="col">価額(税込)</th>
                          <th style="min-width: 106px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="セミナー名"  style="text-align: left">{{ $list->name }}</td>
                          <td data-label="主催者名" >{{ $list->hostname }}</td>
                          <td data-label="開始日時" >{{ date('Y/m/d', strtotime($list->start)) }}<br>{{ date('H:i', strtotime($list->start)) }}</td>
                          <td data-label="終了日時" >{{ date('Y/m/d', strtotime($list->end)) }}<br>{{ date('H:i', strtotime($list->end)) }}</td>
                          <td style="text-align: center;" data-label="価額(税込)" ><span>&#165;</span>{{ number_format($list->fee) ?? '0' }}</td>
                          <td data-label="アクション" >
                              <a class="btnlist btn-danger btn-removefromcart" semid="{{ $list->id }}" semfee="{{ $list->fee }}" href="/" role="button" data-toggle="modal" data-target="#removefromcartModal">削除</a>
                          </td>
                        </tr>
                        @endforeach                                                                    

                        @if(count($lists) > 0)
                        <tr class="trtotal">
                          <td scope="row"></td>
                          <td class="mobilehide"></td>
                          <td class="mobilehide"></td>
                          <td class="mobilehide"></td>
                          <td class="mobilehide">合計金額(税込)：</td>
                          <td style="text-align: center;" data-label="合計金額(税込)："><span>&#165;</span>{{ number_format($lists->sum('fee')) }}</td>                          
                          <td class="mobilehide"></td>
                        </tr>
                        @endif
                      </tbody>
                  </table>
                @if(count($lists) < 1)
                <div style="text-align: center;">
                登録されたデータがありません。
                </div>
                @endif
                </div>

<!--  -->




            </div>
            @if(count($lists) > 0)
            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-8 mx-auto">
                     <div class="text-center">
                        <!-- <button class="btn btn-submit" type="submit"><i class="fa fa-credit-card-alt"></i> 決済する</button> -->
                        <div id="paypal-button-container"></div>

                     </div>
               </div>
            </div>
            @endif



    <!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
      paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{ $lists->sum("fee") }}'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            // alert(details.status);
            if (details.status == 'COMPLETED') {
                console.log(details);
                emptycart(details.id);
            } else {
                $('#paymentfailModal').modal('show');
            }
            // alert('Transaction co/mpleted by ' + details.payer.name.given_name);
          });
        },
        style: {
            layout: 'horizontal'
        }
      }).render('#paypal-button-container'); // Display payment options on your web page
    </script>

         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->

               <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmLabel">セミナーの決済</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>合計金額(税込)：<span>&#165;</span>{{ number_format($lists->sum('fee')) }}</p>
                        <p>選択したセミナーを決済してもよろしいですか?</p>
                     </div>
                     <div class="modal-footer">
                        
                        <button type="submit" class="btn btn-danger">決済</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="alertLabel">支払い通知</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>支払いが正常に完了されました。</p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>

            <input type="hidden" name="listsarr" value="{{ $listsarr }}">
            <input type="hidden" name="totalfee" value="{{ $lists->sum('fee') }}">
      </form>


               <div class="modal fade" id="removefromcartModal" tabindex="-1" role="dialog" aria-labelledby="removefromcartLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="removefromcartLabel">カートから削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>金額(税込)：<span>&#165;</span><span id="seminarfee"></span></p>
                        <p>選択したセミナーを削除してもよろしいですか?</p>
                     </div>
                     <div class="modal-footer">
                        <form method="POST" action="{{ route('removefromcart') }}">
                        @csrf
                        
                        <!-- <input type="hidden" id="seminarfee" name="fee"> -->
                        <input type="hidden" id="seminarid" name="id">
                        <button type="submit" class="btn btn-danger">削除</button>
                          
                        </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>


               <div class="modal fade" id="paymentfailModal" tabindex="-1" role="dialog" aria-labelledby="paymentfailLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="paymentfailLabel">支払い通知</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>支払いが失敗しました。</p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>

    </section>


<script type="text/javascript">
  
    $(document).ready(function() {   

        $(".btn-submit").click(function(e){
            e.preventDefault();

            $('#deleteConfirmModal').modal('show');


       
        }); 

        $(".btn-removefromcart").click(function(e){
            var seminarid = $(this).attr("semid");
            var seminarfee = $(this).attr("semfee");

            $('#seminarfee').text(seminarfee); 
            $('#seminarid').val(seminarid); 
            // alert( seminarid + ' ' +seminarfee);
       
        }); 


        $(document).on('hide.bs.modal','#alertModal', function () {
              window.location = 'user';
        });

       
    });


function emptycart(paypalid) {

            var _token = $("input[name='_token']").val();


            var submitdata = ({_token:_token,
                                paypalid:paypalid, 
                     });
                // alert(check);
            $.ajax({
                url: "{{ route('emptycart') }}",
                type:'POST',
                data: submitdata,

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                    console.log(data.success);
                        if (data.success) {
                          $('#alertModal').modal('show');
                        }
                        // alert("success");
                        // // alert(data.success);

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



</script>


</x-auth-layout>