<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="授業管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     授業一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('/host/registerseminar') }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> 新規登録</a>
                  </p>
               </div>
            </div>  
            
            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">検索キーワード</label>
                              <input class="form-control form-control-email" placeholder="授業名・登録者名" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>    

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>授業開始日</b></label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>授業終了日</b></label>
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
                          <th scope="col">開催日時</th>
                          <th scope="col">授業名</th>
                          <th scope="col">登録者名</th>
                          <th scope="col">登録日</th>
                          <th scope="col">アクション</th>
                          <!-- <th scope="col" style="vertical-align: middle;text-align: center;">TOP</th> -->
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="申込日">{{ date('Y/m/d', strtotime($list->start)) }}<br>{{ date('H:i', strtotime($list->start)) }}</td>
                          <td data-label="授業名">{{ $list->name }}</td>
                          <td data-label="登録者名">{{ $list->adminname }}</td>
                          <td data-label="申込日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="履歴" >
                              <a class="btnlist btn-primary" href='{{ url("/seminardetail/".rand ( 10000 , 99999 ).$list->id ) }}'>詳細</a>

                      @php
                        if( (new DateTime() > new DateTime(date('Y-m-d H:i',strtotime('-5 minutes',strtotime($list->start))) ))  ){
                             $void = false;
                        }else{
                             $void = true;
                        }
                      @endphp

                              <a class="btnlist btn-success" @if($void) href='{{ url("/seminaredit/".rand ( 10000 , 99999 ).$list->id ) }}' @endif>修正</a>
                              <a class="btnlist btn-danger" href=''  data-toggle="modal" data-target="#deleteConfirmModal{{ $list->id }}">削除</a>
                          </td>
                          <!-- <td data-label="TOP" style="vertical-align: middle;text-align: center;">
                              <input type="checkbox" class="toppage" style="width: 16px;height: 16px;" value="{{$list->id}}"
                              @if($toppageseminar == $list->id) checked @endif
                              > 
                          </td> -->
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録された授業がありません。
                  </div>
                  @endif
                </div>

                @include('components.pagination')

                @foreach( $lists as $key => $list )
               <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">授業を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか?</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteevent') }}" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $list->id }}">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      </form>
                     </div>
                  </div>
                  </div>
               </div>
               @endforeach

               <div class="modal fade" id="settoppage" tabindex="-1" role="dialog" aria-labelledby="settoppageLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="settoppageLabel">PR位置に表示</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>TOPページのPR位置に表示しますか？</p>
                        <!-- <p>授業名 : </p> -->
                    <form id="formfee" method="POST" action="{{ route('registershowseminar') }}">
                    @csrf          
                           <div class="form-group">
                              <!-- <label for="fee"><b>チケット価格</b></label> -->
                              
                              <input type="hidden" name="id" id="idtoppage" value="">
                              <!-- <input type="hidden" name="name" value="qweeee"> -->
                              <!-- <p class="error fee text-danger" style="display: none;"></p> -->
                           </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">表示する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                    </form>
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

        $('.toppage').click(function(e) {
            // $("#txtAge").toggle(this.checked);
            // alert($(this).val());
            e.preventDefault();
            $('#idtoppage').val($(this).val()); 
            $('#settoppage').modal('show');
        });
  
    });



</script>

</x-auth-layout>