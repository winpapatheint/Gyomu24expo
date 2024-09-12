<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">
.btnlist {
 font-size: 12px !important;
}

a.disabled {
    pointer-events: none;
    color: white;
}

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="入出金管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     入出金一覧
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
                              <label for="email">検索キーワード</label>
                              <input class="form-control form-control-email" placeholder="依頼名" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start">依頼開始日</label>
                              <input class="form-control form-control-password" placeholder="決済日付" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">依頼終了日</label>
                              <input class="form-control form-control-password" placeholder="決済日付" name="end" id="end"
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
                          <th style="min-width: 100px" scope="col">依頼日</th>
                          <th scope="col">依頼番号</th>
                          <th style="min-width: 115px" scope="col">依頼名</th>
                          <th style="min-width: 100px" scope="col">入金額（税込）</th>
                          <th style="min-width: 100px" scope="col">出金額（税込）</th>
                          <th style="min-width: 100px" scope="col">インフルエンサー名</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr>
                          <td scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                          <td data-label="依頼日">{{ date('Y/m/d', strtotime($list->created_at)) }}</td>
                          <td data-label="依頼ID">{{ sprintf('%06d', $list->id) }}</td>
                          <td data-label="依頼名">{{ $list->name }}</td>
                          <td data-label="入金額(税込)">{{ number_format($list->moneyin) }} 円</td>
                          <td data-label="出金額(税込)">
                          @foreach( $inflassign[$list->hashid] as $key => $val ) 
                          @if(!empty($val->moneyout)) {{ number_format($val->moneyout) }} 円 
                            @if(empty($val->paydone))
                            <a class="btnlist btn-primary btn-paydone" href="{{ url('paydone/'.$val->id) }}" role="button" data-assignid="{{ $val->id }}" data-askconfirmtitle="支払を確認" data-askconfirmtext="支払いを確認済みにしますか？" data-yes="確認済にする">支払チェック</a>
                            @else
                            <a class="btnlist btn-success disabled" href="{{ url('paydone/'.$val->id) }}">支払済</a>
                            @endif
                          @endif
                            <br>
                          @endforeach
                          </td>
                          <td data-label="インフルエンサー名">
                          @foreach( $inflassign[$list->hashid] as $key => $val ) 
                          {{ $val->Influencername }}<br>
                          @endforeach                            
                          </td>
                        </tr>
                        @endforeach                                                                 
                      </tbody>

                      <form id="assignpaydone" method="POST" action="{{ route('assignpaydone') }}">
                      @csrf
                      <input type="hidden" name="assignid" id="assignid">
                      </form>

                  </table>
                  @if(count($lists) < 1)
                  <!-- <div style="text-align: center;">
                  入金されたデータがありません。
                  </div> -->
                  @endif
                </div>
                @include('components.pagination')




            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>



    <script type="text/javascript">
        $(".btn-paydone").click(function(e){
            e.preventDefault();
            $('#assignid').val($(this).data('assignid')); 
            askconfirmboxshow($(this),'assignpaydone');     
        }); 
    </script>


</x-auth-layout>