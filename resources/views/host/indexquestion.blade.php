<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">


      @php $subtitle="問題管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     問題リスト
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('host/registerquestion') }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> 問題登録</a>
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
            
            <!-- Seminar list-->
            <form id="testoptionform" method="POST" action="{{ route('addquetotest') }}">
              @csrf
            <div class="row">


               <div class="table-responsive">
                  <table class="table" style="text-align: center;">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col"></th>
                          <th scope="col">登録日時</th>
                          <th scope="col">問題番号</th>
                          <th scope="col">問題タイプ</th>
                          <th style="max-width: 200px" scope="col">問題名</th>
                          <th style="min-width: 56px" scope="col">配点</th>
                          <th scope="col">正解</th>
                          <th style="min-width: 152px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}　</th>
                          <td data-label="">
                              <input name="addquestion[]" type="checkbox" class="toppage" style="width: 16px;height: 16px;" value="{{$list->id}}"> 
                              <!-- <i class="fa fa-minus" aria-hidden="true"></i> -->
                          </td>
                          <td class="text-left" data-label="登録日時">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="問題番号">{{ $list->qid }}</td>
                          <td data-label="問題タイプ">{{ $typearr[$list->qtype].'+'.$ansarr[$list->ansformat] }}</td>
                          <td style="max-width: 200px" class="overflow" data-label="問題名" >{{ $list->name }}</td>
                          <td data-label="配点" >{{ $list->mark }}</td>
                          <td data-label="正解" >{{ $list->correctans }}</td>
                          <td data-label="アクション" >
                              <a class="btnlist btn-primary" target="blank" href='{{ url("/previewquestion/".rand ( 10000 , 99999 ).$list->id ) }}'>ビュー</a>
                              <a class="btnlist btn-success" href='{{ url("/questionedit/".rand ( 10000 , 99999 ).$list->id ) }}'>修正</a>
                              <a class="btnlist btn-danger quedelete" style="color: white;" data-href='{{ url("/questiondel/".rand ( 10000 , 99999 ).$list->id ) }}' role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <!-- <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal">詳細</a> -->
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

                @if(count($tests) > 0)
                <div class="col-md-9">
                   <div class="form-group">
                        
                      <select class="form-control" name="testid" id="testid" style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                        <!-- <option value="0" >試験名を選択してください。</option> -->
                        @foreach( $tests as $key => $list )
                        <option value="{{ $list->id }}" >{{ $list->name }}</option>
                        @endforeach                                    
                      </select>
                   ※問題のチェックボックスを選択し試験に登録してください。

                   </div>
                </div>

                <div class="col-md-3">
                   <div class="form-group">
                      <button class="btn" type="submit">問題を試験に登録</button>
                   </div>
                </div>
                @endif

                @include('components.pagination')


            </div>
            </form>




         </div>

               <div class="modal fade" id="confirmdelete" tabindex="-1" role="dialog" aria-labelledby="confirmdeleteLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="confirmdeleteLabel">
                        問題を削除
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="confirmquestion">削除しますか。</p>
                     </div>
                     <div class="modal-footer">
                        <a type="button" id="confirmdeleteurl" href="/" class="btn btn-primary">削除する
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>


    </section>


<script type="text/javascript">
       

    $(document).ready(function() {



        $(".quedelete").click(function(e){
            var href = $(this).attr("data-href");;
            // alert(href);
            e.preventDefault();
            $( "#confirmdeleteurl" ).attr("href", href);
            $( "#confirmdelete" ).modal('show');

       
        }); 

      // $('#testid').change(function(){
      //     alert($(this).val());
      // })

       
    });



</script>


</x-auth-layout>