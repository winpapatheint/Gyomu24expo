<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">

a.disabled {
    pointer-events: none;
    color: #ccc;
}

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


      @php 
        if(auth()->user()->role == 'admin'){
            $subtitle="セミナー/試験管理"; 
        } else {
            $subtitle="統計分析"; 
        }
      @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     マーケット分析
                  </h2>
               </div><!-- col end-->
            </div>
<!--             <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="register_new_seminar.html">
                        <i class="fa fa-plus" aria-hidden="true"></i> 試験の新規登録</a>
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
                              <input class="form-control form-control-email"
                                  @if(auth()->user()->role == 'admin')
                                  placeholder="試験名・主催者・主催会社" 
                                  @elseif (auth()->user()->role == 'hcompany') 
                                  placeholder="試験名・主催者" 
                                  @elseif (auth()->user()->role == 'host') 
                                  placeholder="試験名" 
                                  @endif
                              name="kword" id="kword" type="text" value="{{ $_GET['kword'] ?? '' }}">
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
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="b_type"><b>大分類</b></label>
                              <select class="form-control" name="b_type" id="b_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="0">大分類を選択してください</option>
                                <option value=".b1">セミナー</option>                   
                                <option value=".b2">説明会</option>                                    
                                <option value=".b3">IBT試験</option>                                    
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
                  <table class="table" style="text-align: center;">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">開始日</th>
                          <th scope="col">ゼミ/試験名</th>
                          <th style="min-width: 100px" scope="col">参加者数</th>
                          <th style="min-width: 56px" scope="col">男性</th>
                          <th style="min-width: 56px" scope="col">女性</th>
                          <th style="min-width: 56px" scope="col">10歳以下</th>
                          <th style="min-width: 56px" scope="col">10歳～20歳</th>
                          <th style="min-width: 56px" scope="col">20歳～30歳</th>
                          <th style="min-width: 56px" scope="col">30歳～40歳</th>
                          <th style="min-width: 56px" scope="col">40歳～50歳</th>
                          <th style="min-width: 56px" scope="col">50歳以上</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )
<!-- 
                        @php 
                            if($list->open) {
                                if (Carbon\Carbon::now() > $list->end) {
                                    $status = '終了';
                                } else {
                                    $status = '配布';
                                }
                            } else {
                                $status = '待機';
                            }
                        @endphp -->

                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="開始日" class="text-left">{{ date('Y/m/d', strtotime($list->start)) }}<br>{{ date('H:i', strtotime($list->start)) }}</td>
                          <td data-label="試験名">{{ $list->name }}</td>
                          <td data-label="予約者数">{{ number_format($list->joincount) ?? '0' }}</td>
                          <td data-label="男性" >{{ number_format($list->men) ?? '0' }}</td>
                          <td data-label="女性" >{{ number_format($list->women) ?? '0' }}</td>
                          <td data-label="10歳以下" >{{ $list->age10 }}</td>
                          <td data-label="10歳～20歳" >{{ $list->age20 }}</td>
                          <td data-label="20歳～30歳" >{{ $list->age30 }}</td>
                          <td data-label="30歳～40歳" >{{ $list->age40 }}</td>
                          <td data-label="40歳～50歳" >{{ $list->age50 }}</td>
                          <td data-label="50歳以上" >{{ $list->age60 }}</td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>

                 @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録されたセミナー/試験がありません。
                  </div>
                  @endif

                </div>

                @include('components.pagination')


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