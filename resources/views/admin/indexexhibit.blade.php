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

      @php $subtitle="商品管理"; @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     商品一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('/editexhibit/0') }}">
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
                              <input class="form-control form-control-email" placeholder="商品名・商品番号" name="kword" id="kword"
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
               <div class="table-responsive" style="overflow-x: auto;">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                          <th scope="col">登録日</th>
                          <th scope="col">商品名</th>
                          <th scope="col">商品番号</th>
                          <th style="min-width: 130px" scope="col">カテゴリー</th>
                          <th style="min-width: 218px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>



                        @foreach( $exhibits as $key => $exhibit )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($exhibits->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ $exhibit->taskdate }}</td>
                          <td data-label="商品名">{{ $exhibit->name }}</td>
                          <td data-label="商品番号">{{ $exhibit->taskno }}</td>
                          <td data-label="カテゴリー">{{ __(config('global.category')[$exhibit->category]) }}</td>
                          <td data-label="アクション">
                              <!-- <a class="btn btn-primary" href="seminar_detail_host.html" role="button">詳細</a> -->
                              <div class="btndiv">
                                  <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $exhibit->id }}">詳細</a>
                              </div>
                              @if(auth()->user()->id == '1')

                              <div class="btndiv">
                                  <a class="btnlist btn-success" href="{{ url('/editexhibit/'.$exhibit->id ) }}" role="button">修正</a>
                              </div>
                              <div class="btndiv">
                                  <a class="btnlist btn-danger" href="" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $exhibit->id }}">削除</a>
                              </div>
                              <div class="btndiv">
                                  <a class="btnlist btn-warning btn-email" href="" role="button" data-toggle="modal" data-target="#sendemail{{ $exhibit->id }}">メール送信</a>
                              </div>
                              
                              @endif
                          </td>
                        </tr>
                        @endforeach


                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($exhibits) < 1)
                  <div style="text-align: center;">
                  登録された出展がありません。
                  </div>
                  @endif
                  
                </div>

                @include('components.pagination')


                @foreach( $exhibits as $key => $exhibit )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $exhibit->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">商品の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">

                           @if(!empty($exhibit->imageone))
                           <img id="preview-imageone" alt="your imageone" src="{{ asset('images/'.($exhibit->imageone)   ) }}" style="max-width: 100%;"/>
                           @endif

                           @if(!empty($exhibit->imagetwo))
                           <img id="preview-imagetwo" alt="your imagetwo" src="{{ asset('images/'.($exhibit->imagetwo)   ) }}" style="max-width: 100%;"/>
                           @endif

                           @if(!empty($exhibit->imagethr))
                           <img id="preview-imagethr" alt="your imagethr" src="{{ asset('images/'.($exhibit->imagethr)   ) }}" style="max-width: 100%;"/>
                           @endif

                           @if(!empty($exhibit->imagefou))
                           <img id="preview-imagefou" alt="your imagefou" src="{{ asset('images/'.($exhibit->imagefou)   ) }}" style="max-width: 100%;"/>
                           @endif

                           <p> {{ __('商品名') }} : {{  $exhibit->name }}</p>
                           <p> {{ __('商品番号') }} : {{  $exhibit->taskno }}</p>
                           <p> {{ __('商品日') }} : {{  $exhibit->taskdate }}</p>
                           <p> {{ __('都録者') }} : {{  $exhibit->taskauthor }}</p>
                           <p> {{ __('カテゴリー') }} : {{ __(config('global.category')[$exhibit->category]) }}</p>
                           <p> {{ __('auth.remarks') }} : <br>{!!  $exhibit->taskcontent !!}</p>    

                     </div>
                     <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $exhibit->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">商品を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか？</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteexhibit') }}" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $exhibit->id }}">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      </form>
                     </div>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="sendemail{{ $exhibit->id }}" tabindex="-1" role="dialog" aria-labelledby="sendemailLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="sendemailLabel">商品情報を送信</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form method="POST" action="{{ route('sendemailexhibit') }}" >
                        @csrf
                     <div class="modal-body">

                           <div class="form-group">
                              <label for="end"><b>担当者種別</b></label>
                              <select class="form-control" name="agerange" id="agerange" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.agerange') as $key => $value)
                                  <option value="{{$key}}">{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="agerange error text-danger"></p>
                           </div>

                        <p>一斉に送信しますか？</p>
                     </div>
                     <div class="modal-footer">
                      
                        <input type="hidden" name="id" value="{{ $exhibit->id }}">
                        <button type="submit" class="btn btn-danger btn-sendemail">送信する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      
                     </div>
                     </form>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
       


    $(document).ready(function() {

        $(".btn-email").click(function(e){
            $('.error.agerange').hide();
        });

        $(".btn-sendemail").click(function(e){
            str1 = $("#agerange").val();
            if(!str1) {
                $('.error.agerange').text("weeeeee");
                $('.error.agerange').show();
                e.preventDefault();
            }
       
        });


    });


</script>
</x-auth-layout>