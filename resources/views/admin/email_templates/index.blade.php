<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->



<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


      @php $subtitle="メール管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     メール一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTemplateModal">
                        <i class="fa fa-plus" aria-hidden="true"></i> 新規登録
                    </button>
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
                          <th scope="col">登録日</th>
                          <th scope="col">題名</th>
                          <th style="min-width: 115px" scope="col">登録者</th>
                          <th style="min-width: 152px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $templates as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($templates->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="タイトル">{{ $list->title }}</td>
                          <td data-label="登録者">{{ $list->author }}</td>
                          <td data-label="アクション">
                              <a class="btnlist btn-primary" href='{{ url("/blog/".$list->id ) }}'>詳細</a>
                              <a class="btnlist btn-success" href='{{ url("/editblog/".$list->id ) }}'>修正</a>
                              <a class="btnlist btn-danger" href="" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $list->id }}">削除</a>
                          </td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>

                  @if(count($templates) < 1)
                  <div style="text-align: center;">
                  登録されたデータがありません。
                  </div>
                  @endif

                </div>

                @include('components.pagination')


                @foreach( $templates as $key => $list )
               <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">新着情報を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか。</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteblog') }}" >
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

    <div class="modal fade" id="createTemplateModal" tabindex="-1" aria-labelledby="createTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTemplateModalLabel">Create Email Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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



      let searchParams = new URLSearchParams(window.location.search)
      if (searchParams.has('fee')) {
          $('#fee').val(searchParams.get('fee'));        
      }


      let b_type = searchParams.get('b_type')
      if (searchParams.has('b_type')) {
          $('#b_type').val(b_type);        
      }

      if ($('#b_type').val() != '0') {
          let m_type = searchParams.get('m_type')
          // gettypechild($('#b_type').val(),'#m_type','中分類を選択してください',m_type);
          // alert("122");
          $.when($.ajax(gettypechild($('#b_type').val(),'#m_type','中分類を選択してください',m_type))).then(function () {

              // alert('2');
                if ($('#m_type').val() != '0') {
                    let s_type = searchParams.get('s_type')
                    gettypechild($('#m_type').val(),'#s_type','小分類を選択してください',s_type);
                }

          });


      }


      $('#b_type').change(function(){
          gettypechild($(this).val(),'#m_type','中分類を選択してください');
          $('#s_type').empty();
          $('#s_type').append(new Option('中分類を選択してください', '0', true, true));
      })


      $('#m_type').change(function(){
          // alert($(this).val());
          gettypechild($(this).val(),'#s_type','小分類を選択してください');

      })


        // $(".btn-submit").click(function(e){
        //     var href = $(this).attr("href");;
        //     // alert(href);
        //     e.preventDefault();

        //     var _token = $("input[name='_token']").val();


        //        if (href.includes('{{ url('/') }}')) {

        //           $('#confirmquestion').text('');
        //           var url = new URL(href);
        //           var fee = url.searchParams.get("fee");
        //            // alert('Event: ' + href);

        //           $('#confirmbook').modal('show');
        //           if (fee == 0) {
        //              $('#confirmquestion').text('無料のセミナー');
        //              $('#confirmbutton').text('参加登録');
        //           } else {
        //              $('#confirmquestion').text('有料のセミナー：'+fee+'¥ カートに追加してはよろしいですか。');
        //              $('#confirmbutton').text('カートに追加');
        //           }
        //              $('#confirmurl').attr("href", href);
        //            // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        //            // alert('View: ' + info.view.type);

        //            // change the border color just for fun
        //            // info.el.style.borderColor = 'red';
        //        }
       
        // }); 
       
    });



</script>


</x-auth-layout>