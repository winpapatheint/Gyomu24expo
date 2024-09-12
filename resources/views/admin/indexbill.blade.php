<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="売上管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     日次売上管理表（単位：円）
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
                              <input class="form-control form-control-email" placeholder="取引先名" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start">販売開始日</label>
                              <input class="form-control form-control-password" placeholder="決済日付" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">販売終了日</label>
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

            <div class="row">
               <div class="text-left">
                  <button class="btn btn-print" tablename="daytable"><i class="fa fa-print"></i> 印刷する</button>
               </div>
            </div>
 
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table" id="daytable">
                     <thead>
                        <tr>
                          <th scope="col">販売日</th>
                          <th style="min-width: 100px" scope="col">取引先名</th>
                          <th style="min-width: 115px" scope="col">商品名</th>
                          <th style="min-width: 100px" scope="col">数量</th>
                          <th>単位</th>
                          <th style="min-width: 100px" scope="col">金額（円）</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr>
                          <td data-label="販売日" scope="row">{{ date('Y/m/d', strtotime($list['date'])) }}</td>
                          <td data-label="取引先名">{{ $list['hcompanyname'] }}</td>
                          <td data-label="商品名">{{ $list['label'] }}</td>
                          <td data-label="数量">{{ number_format($list['quantity']) }}</td>
                          <td data-label="単位">{{ $list['unit'] }}</td>
                          <td data-label="金額（円）">{{ number_format($list['totalrow']) }} 円</td>
                        </tr>
                        @endforeach                                                                    

                      </tbody>
                  </table>
                  @if($ttl < 1)
                  <div style="text-align: center;">
                  入金されたデータがありません。
                  </div>
                  @endif
                </div>



            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->

         <div class="container" style="padding: 100px 0;">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     月次売上管理表（単位：円）
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
                              @php $month = $_GET['monthsearch'] ?? date('Y-m'); @endphp
                              <input class="form-control form-control-email" name="monthsearch" id="monthsearch"
                                 type="month" value="{{ $_GET['monthsearch'] ?? date('Y-m') ?? '' }}">
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
       <!--         <div class="text-left" style="float: left;">
                  <button class="btn btn-print" tablename="monthtable"><i class="fa fa-print"></i> 印刷する</button>
               </div> -->
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col" colspan="2" style="background: white;color: white; border-top: unset; border-bottom: unset;"></th>
                          <th scope="col">年月</th>
                          <th style="min-width: 100px;background: #f0f3ff; color: #888888;" scope="col"> {{date('Y', strtotime($month))."年".date('m', strtotime($month))."月" }}</th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td data-label="販売日" scope="row" style="background: white;color: white; border-top: unset; border-bottom: unset; padding: unset;width :300px;" colspan="2"><button class="btn btn-print" tablename="monthtable"><i class="fa fa-print"></i> 印刷する</button></td>
                          <td data-label="販売日" scope="row" style="background: #304586;color: white;">売上実績</td>
                          <td data-label="取引先名">{{ number_format(array_sum($monthlyarr)) }}</td>
                        </tr>                                                                  

                      </tbody>
                  </table>
                  @if($ttl < 1)
                  <div style="text-align: center;">
                  入金されたデータがありません。
                  </div>
                  @endif
                </div>
            </div>
         
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table" id="monthtable">
                     <thead>
                        <tr style="text-align:center;">
                          <th style="width:10%" scope="col" colspan="2">日次</th>
                          <th scope="col">売上金額</th>
                          <th style="min-width: 115px" scope="col">売上累計</th>
                        </tr>
                      </thead>
                      <tbody>

                        @php 
                        $y = 0;
                          $jpdayname = array('0' => "日", 
                                             '1' => "月",
                                             '2' => "火",
                                             '3' => "水",
                                             '4' => "木",
                                             '5' => "金",
                                             '6' => "土",
                          );
                        @endphp
                        @for ($i = 1; $i <= date("t"); $i++)
                        <tr>
                          <td >{{ $i }}</td>
                          <td >{{ $jpdayname[date('w', strtotime($month."-".sprintf("%02d", $i)))] }}</td>
                          <td style="text-align:center;">@if(!empty($monthlyarr[$month."-".sprintf("%02d", $i)])) {{ number_format($monthlyarr[$month."-".sprintf("%02d", $i)]) }} @else 0 @endif</td>

                          @php

                             if(!empty($monthlyarr[$month."-".sprintf("%02d", $i)])){
                               $y = $y + $monthlyarr[$month."-".sprintf("%02d", $i)];
                             }

                          @endphp
                          
                          <td style="text-align:center;">{{ number_format($y) }}</td>
                        </tr>
                        @endfor
                        @foreach( $monthlyarr as $key => $data )
                        @endforeach                                                                    

                      </tbody>
                  </table>
                  @if($ttl < 1)
                  <div style="text-align: center;">
                  入金されたデータがありません。
                  </div>
                  @endif
                </div>
            </div>
         </div>



         <div class="container" style="padding: 100px 0;">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     年次売上管理表（単位：円）<br>（前年度対比）

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
                              <select class="form-control" name="yearsearch" id="yearsearch" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @for ($i = date('Y'); $i >=(date('Y')-3) ; $i--)
                                  <option value="{{$i}}" @if(!empty($_GET['yearsearch']) && ($_GET['yearsearch'] == $i)) selected @endif >{{__($i)}} 年</option>
                                @endfor
                              </select>
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

            <div class="row">
               <div class="text-left">
                  <button class="btn btn-print" tablename="yeartable"><i class="fa fa-print"></i> 印刷する</button>
               </div>
            </div>
            @include('components.messagebox')
         
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table" id="yeartable" style="text-align:center;">
                     <thead>
                        <tr>
                          <th>年度</th>
                          @for ($i = 1; $i <= 12; $i++)
                          <th scope="col">{{ $i }} 月</th>
                          @endfor 
                          <th style="min-width: 115px" scope="col">合計</th>
                        </tr>
                      </thead>
                      <tbody>

                        @php 

                          $yeararr = array();
                          if(!empty($_GET['yearsearch'])){
                             $yeararr[] = $lastyear = ($_GET['yearsearch']-1);
                             $yeararr[] = $thisyear = $_GET['yearsearch'];
                          } else {
                             $yeararr[] = $lastyear = date('Y', strtotime('-1 year'));
                             $yeararr[] = $thisyear = date('Y');
                          }
                        @endphp
                        @foreach( $yeararr as $y => $year )
                        <tr>
                          <td>{{ $year }}</td>
                          @for ($i = 1; $i <= 12; $i++)
                          <td scope="col">@if(!empty($yearlyarr[$year."-".$i])) {{ number_format($yearlyarr[$year."-".$i]) }} @else 0 @endif </td>
                          @endfor                          
                          <td>@if(!empty($yeartotalarr[$year])) {{ number_format(array_sum($yeartotalarr[$year])) }} @else 0 @endif</td>
                        </tr>
                        @endforeach

                        <tr>
                          <td>前年同月比(%)</td>
                          @for ($i = 1; $i <= 12; $i++)
                          <td scope="col"> @if( (!empty($yearlyarr[$yeararr['1']."-".$i])) && (!empty($yearlyarr[$yeararr['0']."-".$i])) ) {{ number_format(($yearlyarr[$yeararr['1']."-".$i])/($yearlyarr[$yeararr['0']."-".$i])*100, 2, '.', '')   }} @else 0 @endif </td>
                          @endfor                          
                          <td>@if((!empty($yeartotalarr[$yeararr['1']])) && (!empty($yeartotalarr[$yeararr['0']]))) {{ number_format((array_sum($yeartotalarr[$yeararr['1']]))/(array_sum($yeartotalarr[$yeararr['0']]))*100, 2, '.', '') }} @else 0 @endif</td>
                        </tr>


                      </tbody>
                  </table>
                  @if($ttl < 1)
                  <div style="text-align: center;">
                  入金されたデータがありません。
                  </div>
                  @endif
                </div>
            </div>
         </div>

    </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/table-to-json/1.0.0/jquery.tabletojson.min.js" integrity="sha512-kq3madMG50UJqYNMbXKO3loD85v8Mtv6kFqj7U9MMpLXHGNO87v0I26anynXAuERIM08MHNof1SDaasfw9hXjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
       
    $(document).ready(function() {

        $(".btn-print").click(function(e){
            // e.preventDefault();
            tablename = $(this).attr("tablename");
            var list = [];
            $('table#'+tablename+' > tbody  > tr').each(function(i, el) {
               var $tds = $(this).find('td');
               console.log($tds.length);
              //  var obj = {
              //      field_name: $tds.eq(0).text(),
              //      description: $tds.eq(1).text(),
              // }
               var obj = [];
               $.each(new Array($tds.length),
                      function(n){ obj.push($tds.eq(n).text());}
                      
               )

            list.push(obj);
            });

            console.log(JSON.stringify(list));

            // window.location.replace( "{{ url('/printpdf') }}"+ "/" + tablename + "?data=" + JSON.stringify(list) );
            window.open("{{ url('/printpdf') }}"+ "/" + tablename + "?data=" + JSON.stringify(list), "_blank")

            // console.log(list);
       
        }); 
       
    });


</script>

</x-auth-layout>