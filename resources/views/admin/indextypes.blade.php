<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

      @php $subtitle="その他"; @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     分類管理
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('/admin/registertypes') }}">
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
                              <label for="email"><b>キーワード</b></label>
                              <input class="form-control form-control-email" placeholder="キーワードを入力してください" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
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
                          <th scope="col">大分類</th>
                          <th scope="col">中分類</th>
                          <th scope="col">小分類</th>
                          <th scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="大分類">
                            @if($list->size == 'b')
                            {{ $namebycode[$list->code] }}
                            @endif

                            @if($list->size == 'm')
                            @php
                             $mcode = substr($list->code, 0, strrpos($list->code,"."));
                            @endphp
                            {{ $namebycode[$mcode] }}
                            @endif

                            @if($list->size == 's')
                            @php
                             $mcode = substr($list->code, 0, strrpos($list->code,"."));
                             $scode = substr($mcode, 0, strrpos($mcode,"."));
                            @endphp
                            {{ $namebycode[$scode] }}
                            @endif
                          </td>

                          <td data-label="中分類">
                            @if($list->size == 'm')
                            {{ $namebycode[$list->code] }}
                            @endif

                            @if($list->size == 's')
                            @php
                             $mcode = substr($list->code, 0, strrpos($list->code,"."));
                            @endphp
                            {{ $namebycode[$mcode] }}
                            @endif
 
                          </td>
                          <td data-label="小分類">
                            @if($list->size == 's')
                            {{ $namebycode[$list->code] }}
                            @endif
                          </td>

                          <td data-label="アクション">
                              <a class="btnlist btn-success" href="{{ url('/edittype/'.$list->id ) }}" role="button">修正</a>
                          </td>
                        </tr>
                        @endforeach
                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録された分類がありません。
                  </div>
                  @endif

                </div>

                @include('components.pagination')


                @foreach( $lists as $key => $list )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">主催会社詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>主催会社氏名 : {{ $list->name }}</p>
 
                        <!-- <p>主催会社詳細</p> -->
                     </div>
                     <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger">削除する</button> -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">セミナーの削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>選択したセミナーを削除してはよろしいですか。</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteuser') }}" >
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



            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>

</x-auth-layout>