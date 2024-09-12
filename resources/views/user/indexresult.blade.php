<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="イベント履歴"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     イベント履歴
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
<!--             <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>セミナー名</b></label>
                              <input class="form-control form-control-email" placeholder="キーワードを入力してください" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>開始日時</b></label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="start" id="start"
                                 type="datetime-local"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>終了日時</b></label>
                              <input class="form-control form-control-password" placeholder="終了日時" name="end" id="end"
                                 type="datetime-local" value="{{ $_GET['end'] ?? ''}}">
                           </div>
                        </div>
                     </div>    
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="b_type"><b>大分類</b></label>
                              <select class="form-control" name="b_type" id="b_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">大分類を選択してください</option>
                                <option value=".b1">セミナー</option>                   
                                <option value=".b2">説明会</option>                                    
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="fee"><b>種類</b></label>
                              <select class="form-control" name="fee" id="fee"
                              style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                 <option value="">種類を選択してください</option>
                                 <option value="1">無料</option>                   
                                 <option value="2">有料</option>                                    
                              </select>
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="m_type"><b>中分類</b></label>
                              <select class="form-control" name="m_type" id="m_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">大分類を選択してください</option>                 
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="s_type"><b>小分類</b></label>
                              <select class="form-control" name="s_type" id="s_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">中分類を選択してください</option>                  
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
            </div> -->

            @include('components.messagebox')
            
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">開催日時</th>
                          <th scope="col">イベント名</th>
                          <th scope="col">イベント内容</th>
                          <th scope="col">登録者名</th>
                          <th scope="col">登録日</th>
<!--                           <th style="min-width: 104px" scope="col">小分類</th>
                          <th style="min-width: 100px" scope="col">満点</th>
                          <th style="min-width: 100px" scope="col">得点</th>
                          <th style="min-width: 152px" scope="col">履歴</th> -->
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <th scope="row">2</th>
                          <td data-label="申込日">2021/12/15<br>15:00</td>
                          <td data-label="イベント名">イベント名１１</td>
                          <td data-label="イベント名">イベント名１１</td>
                          <td data-label="イベント名">admin AAA</td>
                          <td data-label="イベント日">2021/12/18<br>15:00</td>

                        </tr>

                        <tr>
                          <th scope="row">1</th>
                          <td data-label="申込日">2021/12/15<br>15:00</td>
                          <td data-label="イベント名">イベント名１１</td>
                          <td data-label="イベント名">イベント名１１</td>
                          <td data-label="イベント名">admin AAA</td>
                          <td data-label="イベント日">2021/12/18<br>15:00</td>

                        </tr


                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="試験日">{{ date('Y/m/d', strtotime($list->teststart)) }}<br>{{ date('H:i', strtotime($list->teststart)) }}</td>
                          <td data-label="提出日">{{ date('Y/m/d', strtotime($list->submittime ?? $list->end)) }}<br>{{ date('H:i', strtotime($list->submittime ?? $list->end)) }}</td>
                          <td data-label="試験名">{{ $list->testname }}</td>
                          <td data-label="小分類">{{ $namebycode[$list->testsemtype_id] }}</td>
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
              <!--     <div style="text-align: center;">
                  イベントされたデータがありません。
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



</x-auth-layout>