<x-auth-layout>

<style type="text/css">
  
a.disabled {
    pointer-events: none;
    color: #ccc;
}

</style>


<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">


      @php $subtitle="試験管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     試験リスト
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('host/registertest') }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> 試験登録</a>
                  </p>
               </div>
            </div>

            <!-- Search filter -->
<!--             <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>問題名</b></label>
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
                                <option value="0">大分類を選択してください</option>
                                <option value=".b1">問題</option>                   
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
            <!-- 
            {{ Carbon\Carbon::now() }} -->

            <!-- Seminar list-->
            <form id="testoptionform" method="POST" action="{{ route('addquetotest') }}">
              @csrf
            <div class="row">


               <div class="table-responsive">
                  <table class="table" style="text-align: center;">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">登録日時</th>
                          <th scope="col">試験名</th>
                          <th scope="col">開始日時</th>
                          <th scope="col">終了日時</th>
                          <th style="min-width: 88px" scope="col">試験時間</th>
                          <th style="min-width: 72px" scope="col">問題数</th>
                          <th style="min-width: 57px" scope="col">満点</th>
                          <th style="min-width: 100px" scope="col">価額(税込)</th>
                          <th style="min-width: 57px" scope="col">状態</th>
                          <th style="width: 170px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
                        @php 
                            $quetotal = count(json_decode($list->testquestion ?? '[]')); 

                            if($list->open) {
                                if (Carbon\Carbon::now() > $list->end) {
                                    $status = '終了';
                                } else {
                                    $status = '配布';
                                }
                            } else {
                                $status = '待機';
                            }
                        @endphp
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}　</th>
                          <td data-label="登録日時" style="text-align: left;">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="試験名" >{{ $list->name }}</td>
                          <td data-label="開始日時" style="text-align: left;" >{{ date('Y/m/d', strtotime($list->start)) }}<br>{{ date('H:i', strtotime($list->start)) }}</td>
                          <td data-label="終了日時" style="text-align: left;" >{{ date('Y/m/d', strtotime($list->end)) }}<br>{{ date('H:i', strtotime($list->end)) }}</td>
                          <td data-label="試験時間" >{{ $list->testminute }}</td>
                          <td data-label="問題数" >{{ $quetotal }}</td>
                          <td data-label="満点" >{{ $list->totalmarks }}</td>
                          <td style="text-align: center;" data-label="価格(税込)"><span>&#165;</span>{{ number_format($list->fee) ?? '0' }}</td>
                          <td data-label="状態" >{{ $status }}</td>
                          <td data-label="アクション" >
                              <a target="blank" 
                              @if($quetotal > 0) 
                                href='{{ url("/previewtest/".rand ( 10000 , 99999 ).$list->id ) }}' class="btnlist btn-primary"
                              @else 
                                class="btnlist btn-primary zeroque" style="color:white;"
                              @endif
                                >ビュー</a>
                              <a class="btnlist btn-success @if(($list->open) AND (Carbon\Carbon::now() < $list->end)) disabled @endif" href='{{ url("/testedit/".rand ( 10000 , 99999 ).$list->id ) }}'>修正</a>
                              <a class="btnlist btn-danger @if( ($list->open) OR empty($quetotal) OR (Carbon\Carbon::now() > $list->end) ) disabled @else opentest @endif" href="#" data-id="{{ $list->id }}" role="button">配布</a>
                              <a class="btnlist @if($list->open) disabled @else deletetest @endif" style="background: grey" href="#" data-id="{{ $list->id }}" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <!-- <a class="btn btn-success" href="#" role="button" data-toggle="modal" data-target="#confirmbook">チケット設定</a> -->
                          </td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>

                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録された問題がありません。
                  </div>
                  @endif 
                </div>

                @include('components.pagination')


            </div>
            </form>




         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>

               <div class="modal fade" id="zeroquenoti" tabindex="-1" role="dialog" aria-labelledby="zeroquenotiLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="zeroquenotititle">プレビューエラー</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="seminarname" style="font-weight: bold">０件の問題数なので、プレビューできません。</p>
                     </div>
                     <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger">設定確認する</button> -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="opentest" tabindex="-1" role="dialog" aria-labelledby="opentestLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="opentestLabel">試験配布</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>一度配布した試験の修正はできません。</p>
                        <p>配布しますか？</p>
                    <form id="formfee" method="POST" action="{{ route('opentest') }}">
                    @csrf          
                           <div class="form-group">
                              <!-- <label for="fee"><b>チケット価格</b></label> -->
                              
                              <input type="hidden" name="testid" id="opentestid" value="">
                              <!-- <input type="hidden" name="name" value="qweeee"> -->
                              <!-- <p class="error fee text-danger" style="display: none;"></p> -->
                           </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">配布する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                    </form>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deletetest" tabindex="-1" role="dialog" aria-labelledby="deletetestLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deletetestLabel">試験を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか？</p>
                    <form id="formfee" method="POST" action="{{ route('deletetest') }}">
                    @csrf          
                           <div class="form-group">
                              <input type="hidden" name="testid" id="deletetestid" value="">
                           </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                    </form>
                  </div>
                  </div>
               </div>


<script type="text/javascript">
       

    $(document).ready(function() {

      $('.zeroque').click(function(){
        $('#zeroquenoti').modal('show');
      })

      $('.opentest').click(function(e){
        e.preventDefault();
        $('#opentestid').val($(this).attr("data-id"));
        $('#opentest').modal('show');
      })

      $('.deletetest').click(function(e){
        e.preventDefault();
        $('#deletetestid').val($(this).attr("data-id"));
        $('#deletetest').modal('show');
      })   
    });



</script>


</x-auth-layout>