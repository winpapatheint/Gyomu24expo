<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="セミナー/試験管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     受験履歴
                  </h2>
               </div><!-- col end-->
            </div>



             <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>検索キーワード</b></label>
                              <input class="form-control form-control-email" placeholder="受験者・試験名・講師名・主催会社" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>試験開始日</b></label>
                              <input class="form-control form-control-password" placeholder="試験日付" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>試験終了日</b></label>
                              <input class="form-control form-control-password" placeholder="試験日付" name="end" id="end"
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
                          <th scope="col">試験日</th>
                          <th scope="col">提出日</th>
                          <th style="min-width: 105px" scope="col">受験者</th>
                          <th style="min-width: 56px" scope="col">性別</th>
                          <th style="min-width: 58px" scope="col">年齢</th>
                          <th scope="col">試験名</th>
                          <th style="min-width: 104px" scope="col">小分類</th>
                          <th style="min-width: 105px" pxscope="col">講師名</th>
                          <th style="min-width: 104px" scope="col">主催会社名</th>
                          <th style="min-width: 57px" scope="col">満点</th>
                          <th style="min-width: 57px" scope="col">得点</th>
                          <th style="min-width: 114px" scope="col">履歴</th>
                        </tr>
                      </thead>
                      <tbody>

                        @php

                         $agestring = array("10" => "10歳以下",                   
                                            "20" => "10歳～20歳",                   
                                            "30" => "20歳～30歳",                   
                                            "40" => "30歳～40歳",                   
                                            "50" => "40歳～50歳",                   
                                            "60" => "50歳以上",
                                            "" => ""
                                        );

                        @endphp

                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="試験日">{{ date('Y/m/d', strtotime($list->teststart)) }}<br>{{ date('H:i', strtotime($list->teststart)) }}</td>
                          <td data-label="提出日">{{ date('Y/m/d', strtotime($list->submittime ?? $list->end)) }}<br>{{ date('H:i', strtotime($list->submittime ?? $list->end)) }}</td>
                          <td data-label="受験者">{{ $list->answerername }}</td>
                          <td data-label="性別">{{ ($list->answerergender == '1') ? "男性" : "女性" }}</td>
                          <td data-label="年齢">{{ $agestring[$list->answereragerange] }}</td>
                          <td data-label="試験名">{{ $list->testname }}</td>
                          <td data-label="小分類">{{ $namebycode[$list->testsemtype_id] }}</td>
                          <td data-label="講師名">{{ $list->hostname }}</td>
                          <td data-label="主催会社名">{{ $list->hcompanyname }}</td>
                          <td data-label="満点">{{ $list->fullmark }}</td>
                          <td data-label="得点">{{ $list->getmark }}</td>
                          <td data-label="履歴" >
                              <a class="btnlist btn-success" target="_blank" href='{{ url("/examreview/".rand ( 10000 , 99999 ).$list->id ) }}'>確認する</a>
                          </td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  受験されたデータがありません。
                  </div>
                  @endif
                </div>

                @include('components.pagination')




            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>



</x-auth-layout>