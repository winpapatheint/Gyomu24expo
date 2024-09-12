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

      @php $subtitle="商談管理"; @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     商談一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('editnego/0') }}">
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
                              <input class="form-control form-control-email" placeholder="商談番号・商品/サービス名" name="kword" id="kword"
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
                          <th scope="col">商談番号</th>
                          <th scope="col">商品/サービス名</th>
                          <th style="min-width: 130px;" scope="col">{{ __('auth.negovalue') }}（円）</th>
                          <th style="min-width: 218px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>


                        @foreach( $negos as $key => $nego )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($negos->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($nego->created_at)) }}<br>{{ date('H:i', strtotime($nego->created_at)) }}</td>
                          <td data-label="商談番号">{{ $nego->negoid }}</td>
                          <td data-label="商品/サービス名">{{ $nego->productname }}</td>
                          <td data-label="{{ __('auth.negovalue') }}（円）" style="text-align: right;">{{ number_format($nego->negovalue) }}</td>
                          <td data-label="アクション">
                              <!-- <a class="btn btn-primary" href="seminar_detail_host.html" role="button">詳細</a> -->
                              <div class="btndiv">
                                  <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $nego->id }}">詳細</a>
                              </div>
                              @if(auth()->user()->id == '1')

                              <div class="btndiv">
                                  <a class="btnlist btn-success" href="{{ url('/editnego/'.$nego->id ) }}" role="button">修正</a>
                              </div>
                              <!-- <div class="btndiv">
                                  <a class="btnlist btn-danger" href="" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $nego->id }}">削除</a>
                              </div> -->
                              @endif
                          </td>
                        </tr>
                        @endforeach
                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($negos) < 1)
                  <div style="text-align: center;">
                  登録された商談がありません。
                  </div>
                  @endif
                  
                </div>

                @include('components.pagination')


                @foreach( $negos as $key => $nego )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $nego->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">商談の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>{{ __('auth.negoid') }} : {{ $nego->negoid}}</p>
                        <p>{{ __('auth.negovalue') }} : {{ number_format($nego->negovalue)}}</p>
                        <p>{{ __('auth.discount') }} : {{ number_format($nego->discount)}}</p>
                        <p>{{ __('auth.agreementnumber') }} : {{ $nego->agreementnumber}}</p>
                        <p>{{ __('auth.purchasevalue') }} : {{ number_format($nego->purchasevalue)}}</p>
                        <p>{{ __('auth.productname') }} : {{ $nego->productname}}</p>
                        <p>{{ __('auth.createdate') }} : {{  date('Y/m/d', strtotime($nego->createdate)) }}</p>
                        <p>{{ __('auth.orderdate') }} : {{  date('Y/m/d', strtotime($nego->orderdate)) }}</p>
                        <p>{{ __('auth.action') }} : {{ $nego->action}}</p>
                        <p>{{ __('auth.invoicetype') }} : {{ __(config('global.invoicetype')[$nego->invoicetype]) }}</p>
                        <p>{{ __('作成者名') }} : {{ $nego->creater_name}}</p>
                        <p>{{ __('auth.remarks') }} : <br>{!! $nego->remarks !!}</p> 
                     </div>
                     <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $nego->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">商談を削除</h4>
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
                        <input type="hidden" name="id" value="{{ $nego->id }}">
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