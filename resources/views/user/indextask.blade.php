<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->
    <script src="https://www.paypal.com/sdk/js?client-id=Afa37Sd8KhndPxu857AGrWKc44766o1oiHViAxUlSl9ZFiryUEY7mwcsslzuv-OARUnMSJBSS15ZVoGg&currency=JPY"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
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
                          @php
                            if( $list->status == '3' AND !empty($list->paypal)){
                                $list->status == '4';
                            }
                          @endphp
                    @if ($agent->isDesktop())
                    <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="7">{{ $list->name }}　　　<a class="btnlist disabled" role="button">{{ __(Config::get('global.taskstatususer.' . $list->status)) }}</a></th>
                           <th style="width: 162px; text-align: right;">
                              <div class="btndiv">
                              <span data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;">{{ __('user.detailhere') }} <i class="fa fa-caret-right" aria-hidden="true"></i></span>
                              </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="background: #f0f3ff;">
                          <td scope="row" rowspan="100" colspan="4" style="vertical-align: unset; width: 40%;"><i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskdate') }}:{{ date('Y/m/d', strtotime($list->created_at)) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskno') }}：{{ sprintf('%06d', $list->id) }}<br> <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.budget') }}：{{ __(Config::get('global.budget.' . $list->budget)) }}
                          @if(!empty($list->moneyin))
                          <br><i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.moneyin') }}：{{ number_format($list->moneyin) }} 円
                          @endif
                          </td>
                          <td colspan="3"> <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('welcome.admin') }}： {{ $list->subadminname ?? '' }}</td>   
                          <td >
                          <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'A/'.$list->hashid }}" href="{{ url('/message/A/'.$list->hashid ) }}" role="button">{{ __('user.message') }}</a>
                          <sup style="display: none;" id="{{ 'A/'.$list->hashid }}"><span id="{{ 'A/'.$list->hashid }}" class="notinumber"></span></sup>
                          @if(!empty($list->moneyin))
                          <a class="btnlist btn-success btn-pay" href="{{ url('/pleasepay/'.$list->moneyin ) }}" role="button" data-total="{{ $list->moneyin }}" data-taskid="{{ $list->hashid }}" >{{ __('user.dopay') }}</a>
                          @endif
                          </td>    
                        </tr>  

                        <tr style="background: #f0f3ff;">
                          <td> @if(count($inflassign[$list->hashid]) > 0) <i class="fa fa-caret-down" aria-hidden="true"></i> {{ __('user.influncer') }} @endif</td>  
                          <td> </td>
                          <td> @if(count($inflassign[$list->hashid]) > 0) <i class="fa fa-caret-down" aria-hidden="true"></i> {{ __('user.inflstatus') }} @endif</td>   
                          <td></td>    
                        </tr> 
                        @foreach( $inflassign[$list->hashid] as $key => $val )             
                        <tr style="background: #f0f3ff;"> 
                          <td> <i class="fa fa-caret-right" aria-hidden="true"></i> {{ $val->Influencername }}</td>
                          <td> <a href="#popup_{{ $val->Influencerid }}" class="ts-image-popup btnlist btn-detail">{{ __('user.infldetail') }}</a></td>
                          <td> {{ __(config('global.inflstatus')[$val->inflstatus]) }}</td>
                          <td style="min-width: 200px;">
                          @if(( $val->inflstatus == '9') AND (!empty($val->reportsubmitted_at )))
                          <a class="btnlist btn-success" href="{{ url('/report/'.$val->id.'/'.$list->hashid ) }}" role="button">{{ __('user.report') }}</a>
                          @endif
                          </td>    
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                    </table>
                    
                    </div>

                  @else
                    @if ($agent->isMobile() || $agent->isTablet())
                    <div class="item-row col-sm-12 col-md-12">
                        <div class="item-header-wrapper">
                           <div class="item-title-1 d-flex align-content-center flex-wrap">
                              <span class="mr-3">{{ $list->name }} </span>
                              <a class="btnlist disabled" role="button">{{ __(Config::get('global.taskstatususer.' . $list->status)) }}</a>
                              <span class="ml-auto" data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;">{{ __('user.detailhere') }} <i class="fa fa-caret-right" aria-hidden="true"></i></span>
                           </div>
                        </div>
                        <div class="item-detail-wrapper">
                           <div class="detail-row">
                              <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskdate') }}:{{ date('Y/m/d', strtotime($list->created_at)) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskno') }}：{{ sprintf('%06d', $list->id) }}<br/>
                              <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.budget') }}：{{ __(Config::get('global.budget.' . $list->budget)) }}<br/>
                              @if(!empty($list->moneyin))
                               <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.moneyin') }}：{{ number_format($list->moneyin) }} 円
                              @endif
                           </div>
                           <div class="detail-row">
                              <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('welcome.admin') }}： {{ $list->subadminname ?? '' }} <br/>
                              <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'A/'.$list->hashid }}" href="{{ url('/message/A/'.$list->hashid ) }}" role="button">{{ __('user.message') }}</a>
                              <sup style="display: none;" id="{{ 'A/'.$list->hashid }}"><span id="{{ 'A/'.$list->hashid }}" class="notinumber"></span></sup>
                              @if(!empty($list->moneyin))
                              <a class="btnlist btn-success btn-pay" href="{{ url('/pleasepay/'.$list->moneyin ) }}" role="button" data-total="{{ $list->moneyin }}" data-taskid="{{ $list->hashid }}" >{{ __('user.dopay') }}</a>
                              @endif
                           </div>
                           <div class="detail-row">
                             <span>@if(count($inflassign[$list->hashid]) > 0) <i class="fa fa-caret-down" aria-hidden="true"></i> {{ __('user.influncer') }} @endif</span>
                             <span class="pl-4">@if(count($inflassign[$list->hashid]) > 0) <i class="fa fa-caret-down" aria-hidden="true"></i> {{ __('user.inflstatus') }} @endif</span>
                           </div>
                           <div class="detail-row">
                              @foreach( $inflassign[$list->hashid] as $key => $val )
                                <span class="mr-4"><a href="#popup_{{ $val->Influencerid }}" class="ts-image-popup"><i class="fa fa-caret-right" aria-hidden="true"></i> {{ $val->Influencername }}</a></span>
                                <span class="pl-5">{{ __(config('global.inflstatus')[$val->inflstatus]) }}</span>
                                <span class="pl-3">
                                 @if(( $val->inflstatus == '9') AND (!empty($val->reportsubmitted_at )))
                                   <a class="btnlist btn-success" href="{{ url('/report/'.$val->id.'/'.$list->hashid ) }}" role="button">{{ __('user.report') }}</a>
                                 @endif
                                </span>
                                <br/>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     @endif                 
                  @endif
                  @endforeach

                  @if(count($lists) < 1)
                  <div class="mx-auto">
                  {{ __('user.noresult') }}
                  </div>
                  @endif
                    
              </div>

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