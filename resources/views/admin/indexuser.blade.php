<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">

.btndiv{
  display: contents;
}
  
@media 
only screen and (max-width: 430px){

    .btndiv{
        display: block;
    }

    
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        // $('#detailModal').modal('show');
    });

</script>

      @php $subtitle="採用企業管理"; @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     採用企業一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <!-- <div class="row">
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
                              <input class="form-control form-control-email" placeholder="採用企業名・メールアドレス" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>   
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start">登録開始日</label>
                              <input class="form-control form-control-password" placeholder="登録開始日" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">登録終了日</label>
                              <input class="form-control form-control-password" placeholder="登録終了日" name="end" id="end"
                                 type="date" value="{{ $_GET['end'] ?? ''}}">
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
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">登録日</th>
                          <th scope="col">会社名</th>
                          <th scope="col">メールアドレス</th>
                          <th style="min-width: 130px" scope="col">電話番号</th>
                          <th style="min-width: 90px" scope="col">事業形態</th>
                          <th style="min-width: 109px;text-align: center;" scope="col">業種</th>
                          <th style="min-width: 218px"scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $users as $key => $user )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($users->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($user->created_at)) }}<br>{{ date('H:i', strtotime($user->created_at)) }}</td>
                          <td data-label="氏名"><a href="{{ url('/takeremote/'.rand ( 10000 , 99999 ).$user->id ) }}">{{ $user->compname }}</a></td>
                          <td data-label="メールアドレス">{{ $user->email }}</td>
                          <td data-label="電話番号">{{ $user->phone }}</td>
                          <td data-label="事業形態" style="text-align: center;">{{ __(config('global.entity')[$user->entity]) }}</td>
                          <td data-label="業種" style="text-align: center;">{{ __(config('global.compindustry')[$user->compindustry]) }}</td>
                          <td data-label="アクション">
                              <div class="btndiv">
                              <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#userdetailModal{{ $user->id }}">詳細</a>
                              </div>
                              @if(auth()->user()->id == '1')

                              <div class="btndiv">
                              <a class="btnlist btn-success" href="{{ url('/edit/user/'.rand ( 10000 , 99999 ).$user->id ) }}" role="button">修正</a>
                              </div>
                              <div class="btndiv">
                              <a class="btnlist btn-danger btn-delete" href='{{ url("/delete/".rand ( 10000 , 99999 ).$user->id ) }}' data-userid='{{ $user->id }}' role="button">削除</a>
                              </div>
                              @endif
                          </td>
                        </tr>
                        @endforeach
                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($users) < 1)
                  <div style="text-align: center;">
                  登録された採用企業がありません。
                  </div>
                  @endif

                </div>


                @include('components.pagination')

                @foreach( $users as $key => $user )

                <!-- Modal -->
               <div class="modal fade" id="userdetailModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">採用企業の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">

                        @if(!empty($user->profileimg))
                        <p><strong>プロフィール写真 : </strong>
                        <img src="{{ asset('images/avatar/'.$user->profileimg ) }}" style="width: 100%;">
                        </p>
                        @endif
                        
                        <p><strong>メールアドレス : </strong><span>{{ $user->email }}</span></p>
                        <p><strong>氏名 : </strong><span>{{ $user->name }}</span></p>
                        <p><strong>会社名 : </strong><span>{{ $user->compname }}</span></p>
                        <p><strong>事業形態 : </strong><span>{{ __(config('global.entity')[$user->entity]) }}</span></p>
                        <p><strong>利用目的 : </strong><span>{{ __(config('global.purpose')[$user->purpose] ?? '') }}</span></p>
                        <p><strong>業種 : </strong><span>{{ __(config('global.compindustry')[$user->compindustry]) }}</span></p>
                        <p><strong>役職 : </strong><span>{{ __(config('global.position')[$user->position]) }}</span></p>
                        <p><strong>電話番号 : </strong><span>{{ $user->phone }}</span></p>
                        <p><strong>住所 : </strong><span>{{ $user->address }}</span></p>
                        <p><strong>従業員数 : </strong><span>
                           @if(!empty($user->membernumber) && ($user->membernumber == '1')) {{__('10名以下')}} @endif
                           @if(!empty($user->membernumber) && ($user->membernumber == '2')) {{__('11名 ～ 20名')}} @endif
                           @if(!empty($user->membernumber) && ($user->membernumber == '3')) {{__('21名 ～ 30名')}} @endif
                           @if(!empty($user->membernumber) && ($user->membernumber == '4')) {{__('30名 ～ 40名')}} @endif
                           @if(!empty($user->membernumber) && ($user->membernumber == '5')) {{__('41名 ～ 50名')}} @endif
                           @if(!empty($user->membernumber) && ($user->membernumber == '6')) {{__('50名以上')}} @endif
                        </span></p>
                        <p><strong>設立年月 : </strong><span>{{ date('Y/m', strtotime($user->dob)) }}</span></p>
                        <p><strong>事業内容 : </strong><span>{!! $user->companyinfo !!}</span></p>
                        <p><strong>URL : </strong><span>{{ $user->url }}</span></p>
                     </div>
<!--                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
 -->                  </div>
                  </div>
               </div>

                @endforeach


                <!-- Modal -->
               <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">採用企業を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか？</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteuser') }}" >
                        @csrf
                        <input type="hidden" id="deleteid" name="id">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      </form>
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

            $(".btn-delete").click(function(e){
                // var href = $(this).attr("href");
                e.preventDefault();
                // alert('userid');

                var userid = $(this).attr("data-userid");    
                $('#deleteid').val(userid);
                $('#deleteConfirmModal').modal('show');
           
            }); 

    });



</script>

</x-auth-layout>