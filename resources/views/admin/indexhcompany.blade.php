<x-auth-layout>


<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">
<style>
    .small-alert {
        max-width: 350px; /* Maximum width */
        margin: 20px auto; /* Center the alert */
        padding: 15px; /* Padding inside the alert */
        border-radius: 5px; /* Rounded corners */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .small-alert strong {
        display: block; /* Make the strong text block-level */
        font-size: 1.2em; /* Increase font size */
        margin-bottom: 5px; /* Space below the strong text */
    }

    .small-alert .close {
        font-size: 1.5em; /* Increase close button size */
        color: #fff; /* White close button */
    }

    /* Optional: Customize the background and border colors */
    .small-alert {
        background-color: #d4edda; /* Light green background */
        border-color: #c3e6cb; /* Darker green border */
    }
</style>


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

      @php $subtitle="顧客管理"; @endphp
      @include('components.subtitle')
      @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show small-alert" role="alert">
        <strong>成功しました!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif



      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     顧客一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('admin/registerhcompany') }}">
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
                              <input class="form-control form-control-email" placeholder="顧客名・メールアドレス" name="kword" id="kword"
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
                          <th scope="col">顧客名</th>
                          <th scope="col">メールアドレス</th>
                          <th style="min-width: 130px" scope="col">電話番号</th>
                          <th style="min-width: 218px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $hcompanies as $key => $hcompany )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($hcompanies->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($hcompany->created_at)) }}<br>{{ date('H:i', strtotime($hcompany->created_at)) }}</td>
                          <td data-label="顧客名">{{ $hcompany->name }}</td>
                          <td data-label="メールアドレス">{{ $hcompany->email }}</td>
                          <td data-label="電話番号">{{ $hcompany->phone }}</td>
                          <td data-label="アクション">
                              <!-- <a class="btn btn-primary" href="seminar_detail_host.html" role="button">詳細</a> -->
                              <div class="btndiv">
                                  <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $hcompany->id }}">詳細</a>
                              </div>
                              @if(auth()->user()->id == '1')

                              <div class="btndiv">
                                  <a class="btnlist btn-success" href="{{ url('/edit/hcompany/'.rand ( 10000 , 99999 ).$hcompany->id ) }}" role="button">修正</a>
                              </div>
                              <!-- <div class="btndiv">
                                  <a class="btnlist btn-danger" href="" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $hcompany->id }}">削除</a>
                              </div> -->
                              @endif
                          </td>
                        </tr>
                        @endforeach
                                                                                                                                                          
                      </tbody>
                  </table>

                  @if(count($hcompanies) < 1)
                  <div style="text-align: center;">
                  登録された顧客がありません。
                  </div>
                  @endif
                  
                </div>

                @include('components.pagination')


                @foreach( $hcompanies as $key => $hcompany )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $hcompany->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">顧客の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">

                        <p>{{ __('会社名') }} : {{ $hcompany->name }} </p>
                        <p>{{ __('auth.postalcode') }} : {{ $hcompany->postalcode }} </p>
                        <p>{{ __('auth.address') }} : {{ $hcompany->address }} </p>
                        <p>{{ __('auth.addressextra') }} : {{ $hcompany->addressextra }} </p>
                        <p>{{ __('auth.phone') }} : {{ $hcompany->phone }} </p>
                        <p>{{ __('auth.mailaddress') }} : {{ $hcompany->email }} </p>
                        <p>{{ __('auth.picname') }} : {{ $hcompany->picname }} </p>
                        <p>{{ __('auth.picnamefurigana') }} : {{ $hcompany->picnamefurigana }} </p>
                        <p>{{ __('auth.capital') }} : {{ $hcompany->capital }} </p>
                        <p>{{ __('auth.establishdate') }} : {{ $hcompany->establishdate }} </p>
                        <p>{{ __('auth.listed') }} : {{ __(config('global.listed')[$hcompany->listed]) }} </p>
                        <p>{{ __('auth.closemonth') }} : {{ __(config('global.closemonth')[$hcompany->closemonth]) }} </p>
                        <p>{{ __('auth.compindustry') }} : {{ __(config('global.compindustry')[$hcompany->compindustry]) }} </p>
                        <p>{{ __('事業内容') }} : <br>{!! $hcompany->companycontent !!} </p>
                        <p>{{ __('auth.url') }} : {{ $hcompany->url }} </p>
                        <p>{{ __('auth.sns') }} : {{ $hcompany->sns }} </p>
                        <p>{{ __('商品詳細') }} : <br>{!! $hcompany->remarks !!} </p>

                     </div>
                     <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $hcompany->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">顧客を削除</h4>
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
                        <input type="hidden" name="id" value="{{ $hcompany->id }}">
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
    <script>
    $(document).ready(function() {
        @if(session('success'))
            // Show success alert
            $('.alert').fadeIn().delay(3000).fadeOut(); // Change duration as needed

            // Optionally show the modal
            $('#myModal').modal('show');
        @endif
    });
</script>

</x-auth-layout>