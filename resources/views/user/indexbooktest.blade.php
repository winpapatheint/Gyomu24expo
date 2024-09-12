<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle="イベント予約"; @endphp
      @include('components.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     イベント検索
                  </h2>
               </div><!-- col end-->
            </div>
<!--             <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="register_new_seminar.html">
                        <i class="fa fa-plus" aria-hidden="true"></i> イベントの新規登録</a>
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
                              <input class="form-control form-control-email" placeholder="イベント名・主催者・主催会社" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>開始日</b></label>
                              <input class="form-control form-control-password" placeholder="開始日" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>終了日</b></label>
                              <input class="form-control form-control-password" placeholder="終了日" name="end" id="end"
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
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">開始日時</th>
                          <th scope="col">終了日時</th>
                          <th style="text-align: left;" scope="col">イベント名</th>
                          <th style="min-width: 115px" scope="col">主催者名</th>
                          <th style="min-width: 56px" scope="col">予約許可番号</th>
                          <th style="text-align: center; min-width: 100px" scope="col">価額(税込)</th>
                          <th style="min-width: 56px" scope="col">状態</th>
                          <th style="min-width: 152px" scope="col">アクション</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $lists as $key => $list )

                        @php
                        $status = "待機";
                        if(!empty($list->joinlist)){
                            if(str_contains($list->joinlist, sprintf("%05d", Auth::user()->id))){
                                $status = "予約済";
                            }
                        }
                        @endphp

                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <!-- <td>{{ $list->hostname }}</td> -->
                          <td data-label="開始日時">{{ date('Y/m/d', strtotime($list->start)) }}<br>{{ date('H:i', strtotime($list->start)) }}</td>
                          <td data-label="終了日時">{{ date('Y/m/d', strtotime($list->end)) }}<br>{{ date('H:i', strtotime($list->end)) }}</td>
                          <td data-label="イベント名" style="text-align: left">
                            <p>{{ $list->name }}</p>
                            <!-- <a href='{{ url("/seminardetail/".rand ( 10000 , 99999 ).$list->id ) }}'>
                              <strong>
                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                イベント詳細
                              </strong>
                            </a> -->
                          </td>
                          <td data-label="主催者名">{{ $list->hostname }}</td>
                          <td style="text-align: center;" data-label="予約許可番号">@if(empty($list->passkey))無し@elseあり@endif</td>
                          <td style="text-align: center;" data-label="価額(税込)"><span>&#165;</span>{{ number_format($list->fee) ?? '0' }}</td>
                          <td data-label="状態">{{ $status }}</td>
                          <td data-label="アクション">
                              <a class="btnlist btn-success btn-submit" 
                                  href='{{ url("/applyseminar/".rand ( 10000 , 99999 ).$list->id."?fee=".$list->fee ) }}' 
                                  passkeyneed='{{ (!empty($list->passkey)) ? '1' : '0' }}'
                                  data-id='{{ $list->id }}'
                              >予約</a>
                              <a class="btnlist btn-primary btn-godetail" href='{{ url("/seminardetail/".rand ( 10000 , 99999 ).$list->id ) }}' role="button" data-toggle="modal" data-target="#detailModal"
                                data-semname="{{ $list->name }}"
                                data-hostname="{{ $list->hostname }}"
                                data-companyname="{{ $list->companyname }}"
                                data-profileimg="@if(empty($list->profileimg)){{ asset('images/avatar/defaultavatar.jpg') }} @else{{asset('images/avatar/'.$list->profileimg) }} @endif"
                                data-profile="{{ $list->profile }}"
                                data-start="{{ date('Y/m/d H:i', strtotime($list->start)) }}"
                                data-end="{{ date('Y/m/d H:i', strtotime($list->end)) }}"
                                data-fee="{{ $list->fee }}"
                                data-description="{{ $list->description }}"
                                data-type="{{ $namebycode[$list->semtype_id] }}"
                                >詳細</a>
                              <!-- <a class="btn btn-success" href="#" role="button" data-toggle="modal" data-target="#confirmbook">チケット設定</a> -->
                              <!-- <a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#deleteConfirmModal{{ $list->id }}">削除</a> -->
                          </td>
                        </tr>
                        @endforeach                                                                    
                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  予約可能なイベントがありません。
                  </div>
                  @endif
                </div>

               <div class="modal fade" id="confirmbook" tabindex="-1" role="dialog" aria-labelledby="setfeeModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="setfeeModalLabel">予約しますか？</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                      <form method="POST" action="{{ route('applyseminar') }}">
                     <div class="modal-body">
                        <p id="confirmquestion"></p>
                        @csrf          
                               <div class="form-group">
                                  <!-- <label for="passkey"><b>予約許可番号</b></label> -->
                                  <input class="form-control" placeholder="予約許可番号を半角数字で入力してください" name="passkey" id="passkey"
                                     type="text">
                                  <input type="hidden" name="id" id="applyseminarid" value="">
                               </div>

                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="confirmbutton"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                      </form>
                  </div>
                  </div>
               </div>


                <!-- Modal -->
               <div class="modal fade" id="godetail" tabindex="-1" role="dialog" aria-labelledby="godetailLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="godetailLabel">
                        イベント情報
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <img id="profileimg" style="max-width: 50px; max-height: 50px; float: left;　border-radius: 50%;" class="schedule-slot-speakers" alt="">
                        <ul style="list-style-position: inside; list-style-type:none; padding-left: 80px;">
                          <li><strong><span id="hostnamelabel"></span></strong></li>
                          <li><span id="hostprofilelabel"></span></li>
                        </ul>
                     </div>
                     <div class="modal-body" style="border-top: 1px solid #e9ecef;">
                        <p><strong>イベント名 : </strong><span id="semnamelabel"></span></p>
                        <p><strong>開始日時 : </strong><span id="semstartlabel"></span></p>
                        <p><strong>終了日時 : </strong><span id="semendlabel"></span></p>
                        <p><strong>価額(税込) : </strong><span>&#165;</span><span id="semfeelabel"></span></p>
                        <p><strong>イベント分類 : </strong><span id="semtypelabel"></span></p>
                        <p><strong>主催会社名 : </strong><span id="companynamelabel"></span></p>
                        <p><strong>イベント内容： </strong><span id="semdescriptionlabel"></span></p>
                     </div>
                  </div>
                  </div>
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


        $(".btn-submit").click(function(e){
            var href = $(this).attr("href");

            var passkeyneed = $(this).attr("passkeyneed");
            
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            
            $('#passkey').css( "display", "none" );
            if(passkeyneed == '1'){
                $('#passkey').show();
            } 
            
            $('#applyseminarid').val($(this).attr("data-id"));

               if (href.includes('{{ url('/') }}')) {

                  $('#confirmquestion').text('');
                  var url = new URL(href);
                  var fee = url.searchParams.get("fee");
                   // alert('Event: ' + href);

                  $('#confirmbook').modal('show');
                  if (fee == 0) {
                     $('#confirmquestion').text('無料イベント');
                     $('#confirmbutton').text('予約する');
                  } else {
                     // $('#confirmquestion').text('有料のイベント：'+fee+'¥ カートに追加してはよろしいですか。');
                     $('#confirmquestion').text('有料イベント');
                     $('#confirmbutton').text('カートに追加');
                  }
                   // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                   // alert('View: ' + info.view.type);

                   // change the border color just for fun
                   // info.el.style.borderColor = 'red';
               }
       
        }); 


          $('#passkey').change(function(){
          var text  = $(this).val();
          var hen = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){
                    return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
                    });
          $(this).val(hen);
          });

       
        $(".btn-godetail").click(function(e){
            var href = $(this).attr("href");
            e.preventDefault();

            var hostname = $(this).attr("data-hostname");
            var profile = $(this).attr("data-profile");
            var profileimg = $(this).attr("data-profileimg");
            

            $('#hostnamelabel').text(hostname);
            $('#hostprofilelabel').text(profile);
            $('#profileimg').attr("src", profileimg);
            // alert(hostname);
            var semname = $(this).attr("data-semname");
            var start = $(this).attr("data-start");
            var end = $(this).attr("data-end");
            var fee = $(this).attr("data-fee");
            var type = $(this).attr("data-type");
            var companyname = $(this).attr("data-companyname");
            var description = $(this).attr("data-description");

            $('#semnamelabel').text(semname);
            $('#semstartlabel').text(start);
            $('#semendlabel').text(end);
            $('#semfeelabel').text(fee);
            $('#semtypelabel').text(type);
            $('#companynamelabel').text(companyname);
            $('#semdescriptionlabel').html(description);

            $('#godetail').modal('show');
       
        }); 

    });



</script>


</x-auth-layout>