<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="写真集管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     写真集一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="{{ url('/registergallery') }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> 新規登録</a>
                  </p>
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
                          <th scope="col">画像</th>
                          <th scope="col">作成日</th>
                          <th scope="col">タイトル</th>
                          <th style="min-width: 152px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="画像"><img src="{{ asset('images/'.($list->value)   ) }}" alt="thumb" style="width: 200px;"></td>
                          <td data-label="作成日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="タイトル">{{ $list->title }}</td>
                          <td data-label="アクション">
                              <a class="btnlist btn-success" href='{{ url("/editgallery/".$list->id ) }}'>修正</a>
                              <a class="btnlist btn-danger" href="#" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $list->id }}">削除</a>
                          </td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録されたデータがありません。
                  </div>
                  @endif
                </div>

                @include('components.pagination')



                @foreach( $lists as $key => $list )


               <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">イメージの削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>イメージ「{{ $list->title }}」を削除してはよろしいですか。</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deletematters') }}" >
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

    </section>


<script type="text/javascript">
       
      function gettypechild(fval, childselectid, firstopt , selectval = '0' ) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('gettypechild') }}",
                type:'POST',
                data: {_token:_token, 
                     parentcode:fval, 
                      },

                success: function(data) {
                  console.log(data);

                    if($.isEmptyObject(data.error)){
                        $(childselectid).empty();
                        $(childselectid).append(new Option(firstopt, '0', true, false));

                        $.each(data.success, function( index, value ) {
                          // alert( index + ": " + value['name'] );
                          select = false;
                          if (value['code'] == selectval) {
                            select = true;
                          }
                          // alert(selectval+" >>> "+value['code']+">>>"+select);
                          $(childselectid).append(new Option(value['name'], value['code'], true, select));
                        });;

                    }else{
                        // alert("err");
                        console.log(data.error);

                    }
                },
                fail: function(data) {
                        alert("errqqqq");
                }
            });

      }


    $(document).ready(function() {

       
    });



</script>


</x-auth-layout>