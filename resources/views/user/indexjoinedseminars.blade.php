<x-auth-layout>

     <link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle=__('手数料管理'); @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{__('手数料一覧')}}
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



            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{__('user.taskname')}}</b></label>
                              <input class="form-control form-control-email" placeholder="{{__('user.filltaskname')}}" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>{{__('user.start')}}</b></label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>{{__('user.end')}}</b></label>
                              <input class="form-control form-control-password" placeholder="終了日時" name="end" id="end"
                                 type="date" value="{{ $_GET['end'] ?? ''}}">
                           </div>
                        </div>
                     </div>  

                  @if ($message = Session::get('errorsearch'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                  </div>
                  @endif
                                                                 
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-search"></i>
                           {{__('user.dosearch')}}</button>
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
                          <th scope="col">{{__('user.taskdate')}}</th>
                          <th scope="col">{{__('求人タイトル')}}</th>
                          <th style="min-width: 100px" scope="col">{{__('user.amount')}}</th>
                          <th scope="col">{{__('user.paiddate')}}</th>
                          <th style="min-width: 106px" scope="col">{{__('求職者名')}}</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="{{__('user.taskdate')}}">{{ date('Y/m/d', strtotime($list->Taskcreateddate)) }}</td>
                          <td data-label="{{__('user.amount')}}">{{ $list->Taskname }}</td>
                          <td data-label="{{__('user.amount')}}">{{ number_format($list->moneyin) }} 円</td>
                          <td data-label="{{__('user.paiddate')}}"> @if(!empty($list->moneyinpaiddate)) {{ date('Y/m/d', strtotime($list->moneyinpaiddate)) }} @endif</td>
                          <td data-label="求職者名">{{ $list->Influencername }}</td>
                          <td data-label="アクション">
                          @if(empty($list->moneyinpaiddate))
                          <a class="btnlist btn-success moneyinpaiddate-btn" href="" data-assignid="{{ $list->id }}" role="button" data-toggle="modal" data-target="#setmoneyinpaiddate">報酬設定</a>
                          @endif
                          </td>
                        </tr>
                        @endforeach

                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  {{__('採用手数料データがありません。')}}
                  </div>
                  @endif
                </div>

                @include('components.pagination')


               <div class="modal fade" id="setmoneyinpaiddate" tabindex="-1" role="dialog" aria-labelledby="setmoneyinpaiddateLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="setmoneyinpaiddateLabel">支払日を設定</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
        <!--                 <p>担当者名 :  AAA</p>
                        <p>セミナー/試験名 : AAA</p> -->
                    <form id="setmoneyindate" method="POST" action="{{ route('setmoneyinpaiddate') }}">
                    @csrf          

                           <input type="hidden" name="setmoneyinpaiddateid" id="setmoneyinpaiddateid">
                           <div class="form-group">
                              <label for="moneyinpaiddate"><b>支払日</b></label>
                              <input class="form-control form-control-password" placeholder="支払日" name="moneyinpaiddate" id="moneyinpaiddate"
                                 type="date">
                              <p class="error moneyinpaiddate text-danger" style="display: none;"></p>
                           </div>

                    </form>

                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-setmoneyinpaiddate" value="">設定する</button>
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



        //FOR MOENEY OUT
        $(".moneyinpaiddate-btn").click(function(e){
            if ($(this).data('toggle') == 'modal') {
              // alert($(this).data('assignid'));
              $('#setmoneyinpaiddateid').val($(this).data('assignid')); 
              // $('#moneyout').val($(this).data('moneyout')); 
              // $('#moneyin').val($(this).data('moneyin')); 
              e.preventDefault();     
            }
        });  

        $(".btn-setmoneyinpaiddate").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('setmoneyinpaiddate') }}",
                type:'POST',
                data: {_token:_token, 
                       setmoneyinpaiddateid:$('#setmoneyinpaiddateid').val(),
                       moneyinpaiddate:$('#moneyinpaiddate').val(), 
                       },

                success: function(data) {
                    if($.isEmptyObject(data.error)){

                      $('.error').hide()
                      $( "#setmoneyindate" ).submit();   

                    }else{
                        console.log(data.error);
                        // alert("err2");
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {
                          // alert( key+id + 'cc ');
                            $('.error.'+key).text(value[0])
                            $('.error.'+key).show()
                        });
                    }
                },
                fail: function(data) {
                    alert("システムエラー");
                }
            });
       
        });

    });
</script>

</x-auth-layout>