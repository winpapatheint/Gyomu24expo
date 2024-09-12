<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="決済履歴"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     決済履歴
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
                          <th scope="col">決済日時</th>
                          <th scope="col">決済者名</th>
                          <th scope="col">セミナー名/試験名</th>
                          <th style="min-width: 100px" scope="col">価額(税込)</th>
                          <th style="min-width: 104px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="決済日時">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="決済者名">{{ $list->payername }}</td>
                          <td data-label="セミナー名">{{ $list->seminarname }}</td>
                          <td data-label="価額(税込)"><span>&#165;</span>{{ number_format($list->sem_fee) ?? '0' }}</td>
                          <td data-label="アクション">
                              <a class="btnlist btn-primary" href="{{ url('/seminardetail/'.rand ( 10000 , 99999 ).$list->seminar_id ) }}" role="button">詳細</a>
                              <!-- <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal">詳細</a> -->
                              <!-- <a class="btnlist btn-success" href="#" role="button" data-toggle="modal" data-target="#setfeeModal{{$list->id}}">チケット設定</a> -->
                              <!-- <a class="btnlist btn-danger" href="#" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $list->id }}">削除</a> -->
                          </td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  決済されたデータがありません。
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