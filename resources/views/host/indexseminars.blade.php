<x-auth-layout>

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
  right: -5px;
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
    font-weight: 400;
}

table tr{
   height: 40px;
}

.table td, .table th {
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

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle=__('求人管理'); @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{ __('求人一覧') }}
                  </h2>
               </div><!-- col end-->
            </div>

            @include('components.messagebox')
            
            <!-- Seminar list-->
            <div class="row clearfix">
               <div class="table-responsive">

                  @foreach( $lists as $key => $list )

                    @php

                      if( ($list->status == '10') AND ($list->inflstatus == '9') ){
                        $list->status = '13';
                      }elseif( ($list->status == '10') AND ($list->inflstatus == '5') ){
                        $list->status = '12';
                      }

                    @endphp

                  @if ($agent->isDesktop())
                  <table class="table">
                      <thead>
                        <tr>
                          <!-- {{ $list->status }} {{ $list->inflstatus }} -->
                          <!-- <th colspan="2">{{ $list->positionname }}　　　<a class="btnlist disabled" role="button">{{ __(Config::get('global.taskstatus.' . $list->status)) }}</a></th> -->
                          <th colspan="2">{{ $list->positionname }}　　　<a class="btnlist disabled" role="button">{{ __(config('global.applycond')[$list->applycond]) }} {{-- $list->applycond --}}</a></th>
                           <th style="width: 162px; text-align: right;">
                              <div class="btndiv">
                              <!-- <span data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;">{{ __('書類選考') }}xxxx</span> -->
                              </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="background: #f0f3ff;"> 
                          <td colspan="2"> <i class="fa fa-caret-right" aria-hidden="true"></i> 求人番号： {{ sprintf('%06d', $list->id) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> 求人日： {{ date('Y/m/d', strtotime($list->created_at)) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> 求人終了日： {{ date('Y/m/d', strtotime($list->expireddate)) }}</td>s
                          <td colspan="2" style="text-align:end;">
                            <a class="btnlist btn-success" data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;" href="" role="button">求人詳細</a>
                            @if((in_array($list->inflstatus, array("5", "6", "7", "8"))) OR empty($list->inflstatus))
                            @if($list->applycond != "4")
                            <a class="btnlist btn-danger assignrespon-btn" href="" data-respon="4" data-assignid="{{ $list->id }}" role="button" data-askconfirmtitle="辞退確認" data-askconfirmtext="辞退しますか？" data-yes="辞退する">辞退</a>
                            @endif
                            @endif
                            <!-- <a class="btnlist btn-success getmsgnoti" data-msgroom="A/k5" href="http://g-jinzaibank-test.asia-hd.com/message/A/k5" role="button">求人詳細</a> -->
                          </td>    
                        </tr> 

                        <tr style="background: #f0f3ff;"> 
                          <td colspan="4" style="text-align:center;"> 選考フロー： <span @if($list->inflstatus == "") class="text-danger font-weight-bold" @endif>①引き合い</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "4") class="text-danger font-weight-bold" @endif>②書類選考</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "5") class="text-danger font-weight-bold" @endif>③一次面接</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "6") class="text-danger font-weight-bold" @endif>④二次面接</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "7") class="text-danger font-weight-bold" @endif>⑤最終面接</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "8") class="text-danger font-weight-bold" @endif>⑥内定</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "9") class="text-danger font-weight-bold" @endif>⑦入社</span>　</td>   
                        </tr> 


                        <tr style="background: #f0f3ff;">
                          <td colspan="2"> <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.hcompany') }}： {{ $list->Hcompanyname }}</td>  
                          <td style="min-width: 240px; text-align:end;">
                          <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'C'.$list->id.'/'.$list->hashid  }}" href="{{ url('/message/C'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.message') }}</a>
                          <sup style="display: none;" id="{{ 'C'.$list->id.'/'.$list->hashid }}"><span id="{{ 'C'.$list->id.'/'.$list->hashid }}" class="notinumber"></span></sup>
                          @if($list->inflstatus >= 8)
                          <!-- <a class="btnlist btn-success" href="{{ url('/report/'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.makereport') }}</a> -->
                          @endif
                          </td>    
                        </tr>                   
                                                                   
                      </tbody>
                  </table>
                  @else
                    <div class="item-row col-sm-12 col-md-12">
                      <div class="item-header-wrapper">
                        <div class="item-title-1 d-flex align-content-center flex-wrap">
                            <span class="mr-3">{{ $list->positionname }} </span>
                            <a class="btnlist disabled" role="button">{{ __(Config::get('global.taskstatus.' . $list->status)) }}</a>
                            <span class="ml-auto" data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;">{{ __('user.detailhere') }} <i class="fa fa-caret-right" aria-hidden="true"></i></span>
                        </div>
                      </div>
                      <div class="item-detail-wrapper">
                          @if ($agent->isTablet())
                          <div class="detail-row d-flex">
                            <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskdate') }}:{{ date('Y/m/d', strtotime($list->taskcreated_at)) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskno') }}：{{ sprintf('%06d', $list->taskidno) }}
                            <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.hcompany') }}： {{ $list->Hcompanyname }}
                            <div class="ml-auto">
                            <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'C'.$list->id.'/'.$list->hashid  }}" href="{{ url('/message/C'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.message') }}</a>
                            <sup style="display: none;" id="{{ 'C'.$list->id.'/'.$list->hashid }}"><span id="{{ 'C'.$list->id.'/'.$list->hashid }}" class="notinumber"></span></sup>
                            @if($list->inflstatus >= 8)
                            <!-- <a class="btnlist btn-success" href="{{ url('/report/'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.makereport') }}</a> -->
                            @endif
                            </div>
                          </div>
                          @else
                          <div class="detail-row">
                            <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskdate') }}:{{ date('Y/m/d', strtotime($list->taskcreated_at)) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.taskno') }}：{{ sprintf('%06d', $list->taskidno) }}
                          </div>
                          <div class="detail-row">
                            <i class="fa fa-caret-right" aria-hidden="true"></i> {{ __('user.hcompany') }}： {{ $list->Hcompanyname }}<br/>
                            <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'C'.$list->id.'/'.$list->hashid  }}" href="{{ url('/message/C'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.message') }}</a>
                            <sup style="display: none;" id="{{ 'C'.$list->id.'/'.$list->hashid }}"><span id="{{ 'C'.$list->id.'/'.$list->hashid }}" class="notinumber"></span></sup>
                            @if($list->inflstatus >= 8)
                            <!-- <a class="btnlist btn-success" href="{{ url('/report/'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.makereport') }}</a> -->
                            @endif
                          </div>
                          @endif
                      </div>
                    </div>
                  @endif
                  @endforeach

                 @if(count($lists) < 1)
                  <div style="text-align: center;">
                  {{ __('user.noorder') }}
                  </div>
                  @endif

                </div>

               <form id="assignrespon" method="POST" action="{{ route('assignrespon') }}">
               @csrf
               <input type="hidden" name="assignid" id="assignid">
               <input type="hidden" name="respon" id="respon">
               </form>

                @include('components.pagination')

                @include('components.orderdetail')

            </div>

         </div>
      </section>


<script type="text/javascript">
       
    $(document).ready(function() {

        $(".assignrespon-btn").click(function(e){
            e.preventDefault();
            $('#assignid').val($(this).data('assignid')); 
            $('#respon').val($(this).data('respon')); 
            askconfirmboxshow($(this),'assignrespon');     
        });

    });

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