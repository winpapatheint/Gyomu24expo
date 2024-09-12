<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">

.btndiv{
  display: contents;
}

.btn-light {
    color: #212529;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
}

@media 
only screen and (max-width: 430px){

    .btndiv{
        display: block;
    }

    
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="売上管理"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     セミナー/試験売上
                  </h2>
               </div><!-- col end-->
            </div>
<!--             <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="register_new_seminar.html">
                        <i class="fa fa-plus" aria-hidden="true"></i> セミナー/試験の新規登録</a>
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
                              <label for="email"><b>キーワード</b></label>
                              <input class="form-control form-control-email" placeholder="セミナー/試験名" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>開始日</b></label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>終了日</b></label>
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
                  <table class="table text-center">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <!-- <th scope="col">ホスト名</th> -->
                          <th scope="col">開始時間</th>
                          <th scope="col">終了時間</th>
                          <th scope="col">セミナー/試験名</th>
                          <th style="min-width: 56px" scope="col">参加予約者数</th>
                          <th style="min-width: 100px" scope="col">価額(税込)</th>
                          <th style="min-width: 56px" scope="col">売上額(税込）</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <!-- <td>{{ $list->hostname }}</td> -->
                          <td class="text-left" data-label="開始時間">{{ date('Y/m/d', strtotime($list->start)) }}<br>{{ date('H:i', strtotime($list->start)) }}</td>
                          <td class="text-left" data-label="終了時間">{{ date('Y/m/d', strtotime($list->end)) }}<br>{{ date('H:i', strtotime($list->end)) }}</td>
                          <td data-label="セミナー/試験名">{{ $list->name }}</td>
                          <td data-label="参加予約者数">{{ $list->joincount }}</td>
                          <td data-label="価額(税込)"><span>&#165;</span>{{ number_format($list->fee) ?? '0' }}</td>
                          <td data-label="売上額(税込）"><span>&#165;</span>{{ number_format($list->ttlper) ?? '0' }}</td>

                        </tr>
                        @endforeach    

                        @if(count($lists) > 0)
                        <tr class="trtotal">
                          <td scope="row"></td>
                          <td class="mobilehide"></td>
                          <td class="mobilehide"></td>
                          <td class="mobilehide"></td>
                          <td class="mobilehide">合計金額(税込)：</td>
                          <td style="text-align: center;" data-label="合計金額(税込)："><span>&#165;</span>{{ number_format($lists->sum('fee')) }}</td>                          
                          <td class="mobilehide"></td>
                        </tr>
                        @endif
                                                                                        
                      </tbody>
                  </table>

                 @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録されたセミナー/試験の売上がありません。
                  </div>
                  @endif

                </div>

                @include('components.pagination')

                @foreach( $lists as $key => $list )
                <!-- Modal -->
               <div class="modal fade" id="setfeeModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="setfeeModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="setfeeModalLabel">チケット設定</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>担当者名 :  {{ $list->hostname }}</p>
                        <p>セミナー/試験名 : {{ $list->name }}</p>
                    <form id="formfee{{ $list->id }}" method="POST" action="{{ route('registerfee') }}">
                    @csrf          
                           <div class="form-group">
                              <label for="fee"><b>チケット価格(税込)</b></label>
                              <input class="form-control form-control-email" placeholder="チケット価格" name="fee" id="fee{{ $list->id }}"
                                 type="text" value="{{ $list->fee }}">
                              <input type="hidden" name="id" value="{{ $list->id }}">
                              <input type="hidden" name="name" value="{{ $list->name }}">
                              <p class="error fee{{ $list->id }} text-danger" style="display: none;"></p>
                           </div>
                    </form>

                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-submit" value="{{ $list->id }}">設定する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="confirmsetfee{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmsetfeeLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="confirmsetfeeLabel">セミナーの削除{{ $list->id }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>選択したセミナーを削除してはよろしいですか。</p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger">設定確認する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>
                <!-- Modal -->
                @endforeach 


               <div class="modal fade" id="settoppage" tabindex="-1" role="dialog" aria-labelledby="settoppageLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="settoppageLabel">TOPページに表示セミナー設定</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>こちらのセミナーTOPページに表示するよろしでしょうか？</p>
                        <!-- <p>セミナー名 : </p> -->
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
                        <button type="submit" class="btn btn-danger">設定</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                    </form>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="sethideseminar" tabindex="-1" role="dialog" aria-labelledby="hideseminarLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="hideseminarLabel">セミナーの保留</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="sethideseminartext"></p>
                        <!-- <p>セミナー名 : </p> -->
                    <form id="formhideseminar" method="POST" action="{{ route('hideseminar') }}">
                    @csrf          
                           <div class="form-group">
                              <!-- <label for="fee"><b>チケット価格</b></label> -->
                              
                              <input type="hidden" name="id" id="idhideseminar" value="">
                              <!-- <input type="hidden" name="name" value="qweeee"> -->
                              <!-- <p class="error fee text-danger" style="display: none;"></p> -->
                           </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="sethideseminarbutton"></button>
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
                        alert("err:code99");
                }
            });

      }


      function confirmsetfee(feeval, id) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('registerfee') }}",
                type:'POST',
                data: {_token:_token, 
                           id:id, 
                           fee:feeval,
                      },

                success: function(data) {
                  console.log(data);

                    if($.isEmptyObject(data.error)){
                        // console.log(data.success);
                        // alert("success")
                        // $('#alert-success-text').text(data.success)
                        // $('.alert-success').show()

                        $('#formfee'+id).submit()
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

	$('.toppage').click(function(e) {
	    // $("#txtAge").toggle(this.checked);
	    // alert($(this).val());
	    e.preventDefault();
	    $('#idtoppage').val($(this).val()); 
	    $('#settoppage').modal('show');
	});

      $('.hideseminar').click(function(e) {
        // alert($(this).attr('data-open'));
          if ($(this).attr('data-open') == true) {
              $('#sethideseminartext').text('このセミナーを保留にしますか？');
              $("#sethideseminarbutton").html('保留');
          } else {
              $('#sethideseminartext').text('このセミナーを公開にしますか？');
              $("#sethideseminarbutton").html('公開');
          }

          e.preventDefault();
          $('#idhideseminar').val($(this).attr('data-id')); 
          $('#sethideseminar').modal('show');
      });

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


        $(".btn-submit").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var id = $(this).val();

            // alert(id);/
            var fee = $('#fee'+id).val();

            // var b_type = $('#b_type').val();
            // var m_type = $('#m_type').val();
            
            console.log({_token:_token, 
                           id:id, 
                           fee:fee,
                           forvalidate:1, 
                           });
                      // alert(check);
            $.ajax({
                url: "{{ route('registerfee') }}",
                type:'POST',
                data: {_token:_token, 
                       id:id, 
                       fee:fee,
                       forvalidate:1,
                     },

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        // alert("success");
                        // // alert(data.success);
                        // alert("err1");
                          $('.error').hide()
                          confirmsetfee(fee,id);
                        // $('#setfeeModal'+id).modal('hide');
                        // $('#confirmsetfee'+id).modal('show');

                    }else{
                        console.log(data.error);
                        // alert("err2");
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {
                          // alert( key + 'cc '+ value);
                            $('.error.'+key+id).text(value[0])
                            $('.error.'+key+id).show()
                        });
                    }
                },
                fail: function(data) {
                        alert("errqqqq");
                }
            });
       
        }); 
       
    });



</script>


</x-auth-layout>