<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style type="text/css">

a.disabled {
    pointer-events: none;
    color: #ccc;
}

.btndiv{
  display: contents;
}

.btn-light {
    color: #212529;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
}

.notinumber {
  font-size: .6rem;
  position: absolute;
  top: -6px;
  right: 0px;
  width: 15px;
  height: 15px;
  color: #fff;
  background-color: red;
  border-radius: 50%;
  align-items: center!important;
  justify-content: center!important;
  display: flex!important;
  font-weight: 700;
}

.table th {
    vertical-align: inherit !important;
    border-top: 1px solid #e9ecef;
    color: white;
    background: #304586;
}

table tr{
   height: 30px;
}

table tr{
   height: 40px;
}

.table td{
  padding: 0rem; 
  vertical-align: middle;
  padding-left: 0.45rem;
  padding-right: 0.45rem;
}

.item-row {
   margin-bottom: 0.5rem;
}

.item-header-wrapper {
   border-top: 1px solid #e9ecef;
   color: white;
   background: #304586;
   padding: 0.25rem;
}

.item-detail-wrapper {
   background: #f0f3ff;
   padding: 0.45rem; 
}

img.jobcover{
   max-width: 500px;
   max-height: 150px;
}
}

@media 
only screen and (max-width: 430px){

    .btndiv{
        display: block;
    }

    
}

</style>



      @php $subtitle=__('welcome.managetask'); @endphp
      @include('components.subtitle')



      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                    {{ __('user.tasklist') }}
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a href="{{ url('/makeapplication' ) }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('user.registertask') }}</a>
                  </p>
               </div>
            </div>

            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url('/application' ) }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">{{ __('user.keywordsearch') }}</label>
                              <input class="form-control form-control-email" placeholder="{{ __('user.taskname') }}" name="kword" id="kword" type="text" value=""> 
                           </div>
                        </div>
                     </div>                       
     
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="status_select">求人ステータス</label>
                              <select class="form-control" name="status" id="status" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '0')) selected @endif value="0">選択してください</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '1')) selected @endif value="1">下書き 1</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '2')) selected @endif value="2">公開依頼中 2</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '3,4,10,12')) selected @endif value="3,4,10,12">公開中 3,4,10,12</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '13')) selected @endif value="13">募集停止中 13</option>
                              </select>
                              <p style="display:none" class="status error text-danger"></p>   
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">選考フロー</label>
                              <select class="form-control" name="inflstatus" id="inflstatus" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                  <option value="">選択してください</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '0')) selected @endif value="0">引き合い 0</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '4')) selected @endif value="4">書類選考 4</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '5')) selected @endif value="5">一次面接 5</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '6')) selected @endif value="6">二次面接 6</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '7')) selected @endif value="7">最終面接 7</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '8')) selected @endif value="8">内定 8</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '9')) selected @endif value="9">入社 9</option>
                              </select>
                              <p style="display:none" class="inflstatus error text-danger"></p>
                           </div>
                        </div>
                     </div>


                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-search"></i>
                           {{ __('user.dosearch') }}</button>
                     </div>
                  </form>



               </div>
            </div>

            @include('components.messagebox')
                        
            <!-- Seminar list-->
            <div class="row clearfix">

                  @foreach( $lists as $key => $list )

                        <div class="table-responsive" name="lokman" bis_skin_checked="1">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th colspan="10">{{ $list->positionname }}　　　<a class="btnlist disabled" role="button">{{ __(Config::get('global.taskstatus.' . $list->status)) }} {{-- $list->status --}}</a></th>
                                    <th style="width: 162px; text-align: right;">
                                       <div class="btndiv" bis_skin_checked="1">
                                          <!-- <span data-toggle="modal" data-target="#showdetailmodal3" style="cursor: pointer;">選考中（4人）</span> -->
                                          <!-- <span data-toggle="modal" data-target="#showdetailmodal3" style="cursor: pointer;">求人詳細はこちら <i class="fa fa-caret-right" aria-hidden="true"></i></span> -->
                                       </div>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr style="background: #f0f3ff;">
                                    <td scope="row" rowspan="100" colspan="5" style="vertical-align: unset; width:25%;">
                                       @if(!empty($list->image))
                                       <img id="preview-image-before-upload" alt="your image" src="{{ asset('images/avatar/'.$list->image   ) }}" class="jobcover">
                                  		@else
                                    	<img src="https://www.internships.com/wp-content/uploads/2019/09/computer_programmer_profile_image.jpg" class="jobcover">
                                       @endif


                                    	<br> <i class="fa fa-caret-right" aria-hidden="true"></i> 求人番号：{{ sprintf('%06d', $list->id) }}
                                       <br><i class="fa fa-caret-right" aria-hidden="true"></i> 求人日時：{{ date('Y/m/d', strtotime($list->created_at)) }}
                                       <br><i class="fa fa-caret-right" aria-hidden="true"></i> 求人終了日：{{ date('Y/m/d', strtotime($list->expireddate)) }}
                                       <br>
                                       @if($list->status == '1')
                                       <a class="btnlist btn-success"  href="{{ url('editapplication/'.$list->id ) }}" role="button">編集</a>
                                       @endif
                                       <!-- <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'A/'.$list->hashid }}" href="{{ url('/message/A/'.$list->hashid ) }}" role="button">チャット</a>
                                       <sup style="display: none;" id="{{ 'A/'.$list->hashid }}"><span id="{{ 'A/'.$list->hashid }}" class="notinumber"></span></sup>  -->
                                       <a class="btnlist btn-success" data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;" href="" role="button">求人詳細をみる</a>
                                       @if($list->status == '1')
                                       <a class="btnlist btn-secondary updatestatus-btn" href="" data-currentstatus="{{ $list->status }}" data-nextstatus="2" data-taskid="{{ $list->id }}" role="button" data-askconfirmtitle="求人を公開申請" data-askconfirmtext="求人を公開申請しますか？" data-yes="公開申請する">公開申請</a>
                                       @endif

                                    </td>
                                      <td colspan="3"> <i class="fa fa-caret-right" aria-hidden="true"></i> コンシェルジュ(担当者）： {{ $list->subadminname ?? '' }}</td>
                                      <td colspan="3" style="text-align:end;">
                                          <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'A/'.$list->hashid }}" href="{{ url('/message/A/'.$list->hashid ) }}" role="button">チャット</a>
                                          <sup style="display: none;" id="{{ 'A/'.$list->hashid }}"><span id="{{ 'A/'.$list->hashid }}" class="notinumber"></span></sup>  
                                      </td>
                                 </tr>

                                 <tr style="background: #f0f3ff;">
                                    <td colspan="6"> 
                                       選考フロー： ①書類選考　<i class="fa fa-caret-right" aria-hidden="true"></i>　②一次面接　<i class="fa fa-caret-right" aria-hidden="true"></i>　③二次面接　<i class="fa fa-caret-right" aria-hidden="true"></i>　④最終面接　<i class="fa fa-caret-right" aria-hidden="true"></i>　⑤内定　<i class="fa fa-caret-right" aria-hidden="true"></i>　⑥入社
                                    </td>
                                 </tr>

                                 @if(count($inflassign[$list->hashid]) > 0)
                                 <tr style="background: #f0f3ff;">
                                    <td>  <i class="fa fa-caret-down" aria-hidden="true"></i> 選考者 </td>
                                    <td> <i class="fa fa-caret-down" aria-hidden="true"></i> 履歴書</td>
                                    <td>  <i class="fa fa-caret-down" aria-hidden="true"></i> 採用フロー</td>
                                    <td> <i class="fa fa-caret-down" aria-hidden="true"></i> 状態</td>
                                    <td> <i class="fa fa-caret-down" aria-hidden="true"></i> 処理日</td>
                                    <td> </td>
                                 </tr>
                                 @endif

                                 @foreach( $inflassign[$list->hashid] as $key => $val ) 
                                 <tr style="background: #f0f3ff;">
                                    <td> <i class="fa fa-caret-right" aria-hidden="true"></i> {{ $val->Influencername }}</td>
                                    <td> <a href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $val->Influencerid }}" class="ts-image-popup btnlist btn-detail"><i class="fa fa-info-circle"></i></a></td>
                                    <td> {{ __(config('global.inflstatus')[$val->inflstatus]) }} {{-- $val->inflstatus --}}</td>
                                    <td> @if($val->inflstatus == '9') 募集終了  @else {{ __(config('global.applycond')[$val->applycond]) }} {{-- $val->applycond --}} @endif</td>
                                    <td> {{ date('Y/m/d', strtotime($val->created_at)) }} </td>
                                    <td style="min-width: 200px;">
                                       @if($val->applycond != "2")
                                          @if($val->inflstatus == "9")
                                             <!-- <a class="btnlist btn-primary" href="javascript:void(0);">募集終了</a> -->
                                          @else
                                             <a class="btnlist btn-primary assignrespon-btn" href="" data-respon="2" data-assignid="{{ $val->id }}" role="button" data-askconfirmtitle="通過確認" data-askconfirmtext="通過しますか？" data-yes="通過する">通過</a>
                                          @endif
                                       @endif
                                       @if($val->applycond != "5")
                                       @if(in_array($val->inflstatus, array("4", "5", "6", "7")))
                                       <a class="btnlist btn-danger assignrespon-btn" href="" data-respon="5" data-assignid="{{ $val->id }}" role="button" data-askconfirmtitle="不採用確認" data-askconfirmtext="不採用しますか？" data-yes="不採用する">不採用</a>
                                       @endif
                                       @endif
                                    </td>
                                 </tr>
                                 @endforeach 

                              </tbody>
                           </table>
                        </div>

                  @endforeach



                  @if(count($lists) < 1)
                  <div class="mx-auto">
                  {{ __('user.noresult') }}
                  </div>
                  @endif
                    
              </div>

              <form id="updatestatus" method="POST" action="{{ route('updatestatus') }}">
              @csrf
              <input type="hidden" name="currentstatus" id="currentstatus">
              <input type="hidden" name="nextstatus" id="nextstatus">
              <input type="hidden" name="taskid" id="taskid">
              </form>


               <form id="assignrespon" method="POST" action="{{ route('assignrespon') }}">
               @csrf
               <input type="hidden" name="assignid" id="assignid">
               <input type="hidden" name="respon" id="respon">
               </form>


                @include('components.pagination')

                @include('components.orderdetail')

                @include('components.influencerdetail')



              <!-- Add the checkout buttons, set up the order and approve the order -->
              <script>

              </script>

               <div class="modal fade" id="payboxModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">決済</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                     <div id="paypal-button-container" ></div>
                     </div>
                     <div class="modal-footer">
                        
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

               <div class="modal fade" id="paymentsuccessModal" tabindex="-1" role="dialog" aria-labelledby="alertLabel" aria-hidden="true">
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
                
            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>


<script type="text/javascript">


    $(document).ready(function() {

        $(".assignrespon-btn").click(function(e){
            e.preventDefault();
            $('#assignid').val($(this).data('assignid')); 
            $('#respon').val($(this).data('respon')); 
            askconfirmboxshow($(this),'assignrespon');     
        }); 


        $(".updatestatus-btn").click(function(e){
            e.preventDefault();
            $('#currentstatus').val($(this).data('currentstatus')); 
            $('#nextstatus').val($(this).data('nextstatus')); 
            $('#taskid').val($(this).data('taskid')); 
            askconfirmboxshow($(this),'updatestatus');     
        }); 

        $(".btn-pay").click(function(e){
            e.preventDefault();

            var total = parseInt($(this).data('total'));
            var hashid = parseInt($(this).data('hashid'));
            $('#paypal-button-container').html('');
            paypal.Buttons({
              createOrder: function(data, actions) {
                return actions.order.create({
                  purchase_units: [{
                    amount: {
                      value: total
                    }
                  }],
                  application_context: {
                    shipping_preference: 'NO_SHIPPING'
                  }
                });
              },
              onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                  // alert(details.status);
                  if (details.status == 'COMPLETED') {
                      console.log(details);
                      paymentdone(details.id , hashid);
                  } else {
                      $('#paymentfailModal').modal('show');
                  }
                  // alert('Transaction co/mpleted by ' + details.payer.name.given_name);
                });
              },
              style: {
                layout:  'vertical',
                color:   'blue',
                shape:   'rect',
                label:   'paypal'
              }
            }).render('#paypal-button-container'); // Display payment options on your web page




            $('#payboxModal').modal('show');
        }); 

    });

    function paymentdone(paypalid , hashid) {

      var _token = $("input[name='_token']").val();
      var submitdata = ({_token:_token,
                          paypalid:paypalid, 
                          hashid:hashid, 
                        });
      $.ajax({
          url: "{{ route('paymentdone') }}",
          type:'POST',
          data: submitdata,

          success: function(data) {
              if($.isEmptyObject(data.error)){
              console.log(data.success);
                  if (data.success) {
                    $('#paymentsuccessModal').modal('show');
                  }

              }else{
                  // alert("err");
                  console.log(data.error);

              }
          },
          fail: function(data) {
              alert("支払いが失敗しました。");
          }
      });

    }

    elements = $("a.getmsgnoti");
    
    var arr = new Array();

    elements.each(function()
    {
        arr.push($(this).data('msgroom'));
    });

    var _token = $("input[name='_token']").val();

    $.ajax({
        url: "{{ route('getmsgnoti') }}",
        type:'POST',
        data: {_token:_token, 
               arr:arr,
               },

        success: function(data) {
            if($.isEmptyObject(data.error)){

              // console.log(data.success);
              // alert(jQuery.type(data.success));
              $.each(data.success, function(key, value) {

                  var formattedkey = key.replace("/", "\\/"); // jquery need some formatted slash

                  $('span#'+formattedkey).text(value);
                  $('sup#'+formattedkey).fadeIn( "slow" );
                  // console.log(formattedkey + ' ' + value);
               
              })



            }else{
                console.log(data.error);
                alert("システムエラー");

            }
        },
        fail: function(data) {
            alert("システムエラー");
        }
    });



</script>


</x-auth-layout>