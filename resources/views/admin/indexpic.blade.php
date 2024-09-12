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

      @php $subtitle="担当者管理"; @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     担当者一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('/editpic/0') }}">
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
                              <input class="form-control form-control-email" placeholder="担当者名・所属会社名" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div> 
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="end"><b>種類</b></label> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control" name="agerange" id="agerange" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.agerange') as $key => $value)
                                  <option value="{{$key}}" {{ old('agerange') == $key ? "selected" : "" }} @if(!empty($_GET['agerange']) && ($_GET['agerange'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="agerange error text-danger"></p>
                           </div>                        </div>
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
                          <th scope="col">担当者名</th>
                          <th scope="col">メールアドレス</th>
                          <th style="min-width: 130px" scope="col">電話番号</th>
                          <th scope="col">種類</th>
                          <th style="min-width: 218px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>



                        @foreach( $pics as $key => $pic )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($pics->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($pic->created_at)) }}<br>{{ date('H:i', strtotime($pic->created_at)) }}</td>
                          <td data-label="担当者名">{{ $pic->name }}</td>
                          <td data-label="メールアドレス">{{ $pic->email }}</td>
                          <td data-label="電話番号">{{ $pic->phone }}</td>
                          <td data-label="種類">{{ __(config('global.agerange')[$pic->agerange]) }}</td>
                          <td data-label="アクション">
                              <!-- <a class="btn btn-primary" href="seminar_detail_host.html" role="button">詳細</a> -->
                              <div class="btndiv">
                                  <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $pic->id }}">詳細</a>
                              </div>
                              @if(auth()->user()->id == '1')

                              <div class="btndiv">
                                  <a class="btnlist btn-success" href="{{ url('/editpic/'.$pic->id ) }}" role="button">修正</a>
                              </div>
                              <!-- <div class="btndiv">
                                  <a class="btnlist btn-danger" href="" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $pic->id }}">削除</a>
                              </div> -->
                              @endif
                          </td>
                        </tr>
                        @endforeach


                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($pics) < 1)
                  <div style="text-align: center;">
                  登録された担当者がありません。
                  </div>
                  @endif
                  
                </div>

                @include('components.pagination')


                @foreach( $pics as $key => $pic )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $pic->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">担当者の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">

                           <p> {{ __('氏名') }} : {{  $pic->name }}</p>   
                           <p> {{ __('氏名（ふりかた）') }} : {{  $pic->furiname }}</p>   
                           <p> {{ __('性別') }} : {{ __(config('global.gender')[$pic->gender]) }}</p>   
                           <p> {{ __('種類') }} : {{ __(config('global.agerange')[$pic->agerange]) }}</p>   
                           <p> {{ __('所属会社名') }} : {{  $pic->hcompanyname }}</p>   
                           <p> {{ __('勤務先郵便番号') }} : {{  $pic->postalcode }}</p>   
                           <p> {{ __('勤務先住所') }} : {{  $pic->address }}</p>   
                           <p> {{ __('部署名') }} : {{  $pic->departmentname }}</p>   
                           <p> {{ __('役職') }} : {{ __(config('global.occupation')[$pic->occupation]) }}</p>   
                           <p> {{ __('電話番号') }} : {{  $pic->phone }}</p>   
                           <p> {{ __('メールアドレス') }} : {{  $pic->email }}</p>   
                           <p> {{ __('auth.sns') }} : {{  $pic->sns }}</p>   
                           <p> {{ __('誕生日') }} : {{  date('Y/m/d', strtotime($pic->dob)) }}</p>   
                           <p> {{ __('auth.remarks') }} : <br>{!!  $pic->remarks !!}</p>    

                     </div>
                     <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $pic->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">担当者を削除</h4>
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
                        <input type="hidden" name="id" value="{{ $pic->id }}">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      </form>
                     </div>
                  </div>
                  </div>
               </div>
               @endforeach



            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>

</x-auth-layout>