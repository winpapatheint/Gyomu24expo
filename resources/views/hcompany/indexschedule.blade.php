<x-auth-layout>
     <!-- Calender styles-->
     <link rel="stylesheet" href="{{ asset('css/fullcalendar/main.css') }}">
     <style>
         @media only screen and (max-width: 768px) {
            .fc .fc-daygrid-day-top {
               display: flex;
               flex-direction: row-reverse;
               line-height: 13px;
            }

            .fc .fc-daygrid-day-frame {
               position: relative;
               min-height: 100%;
               height: 60px;
            }

            .fc table {
               border-collapse: collapse;
               border-spacing: 0;
               font-size: 0.9em;
            }
         }   
     </style>        

      @php $subtitle="スケジュール"; @endphp
      @include('components.subtitle')

      <!-- ts schedule start-->
      <section class="ts-schedule">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title">
                     <!-- <span>カレンダー</span> -->
                     スケジュール
                  </h2>
               </div>
            </div>


            @include('components.messagebox')

            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-12">
                  <div id="calendar"></div>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title">
                     <!-- <span>今日＆今週</span> -->
                     スケジュールの詳細
                  </h2>
                  <div class="ts-schedule-nav">
                     <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="nav-item">
                           <a class="active" title="Click Me" href="#date1" role="tab" data-toggle="tab">
                              <h3>今日</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                           <a class="" href="#date2" title="Click Me" role="tab" data-toggle="tab">
                              <h3>今週</h3>
                           </a>
                        </li>
                     </ul>
                     <!-- Tab panes -->
                  </div>
               </div><!-- col end-->

            </div><!-- row end-->

            <div class="row">
               <div class="col-lg-12">
                  <div class="tab-content schedule-tabs schedule-tabs-item">
                        <div role="tabpanel" class="tab-pane active" id="date1">
                           
                           @if(count($today) > 0)                           
                           @foreach( $today as $key => $t )

                           @php $list=$lists[$t]; @endphp
                           <div class="schedule-listing">
                              <div class="schedule-slot-time">
                                 <span> {{ date('m\月d\日', strtotime($list->start)) }}</span>
                                 <span> {{ date('H:i', strtotime($list->start)).'～'.date('H:i', strtotime($list->end)) }}</span>
                                 <span><a style="color: white; font-size: 80%" href='{{ url("/seminardetail/".rand ( 10000 , 99999 ).$list->id ) }}'>詳細を見る</a></span>
                              </div>
                              <div class="schedule-slot-info">
                                 <!-- <a href="#"> -->
                                    <img class="schedule-slot-speakers" @if(empty($list->profileimg)) src="{{ asset('images/avatar/defaultavatar.jpg') }}" @else src="{{ asset('images/avatar/'.$list->profileimg) }}" @endif alt="">
                                 <!-- </a> -->
                                 <div class="schedule-slot-info-content">
                                    <h3 class="schedule-slot-title">{{ $list->name }}
                                       <strong>{{ $list->hostname }}</strong>
                                    </h3>
                                    <p>{!! $list->description !!} </p>
                                 </div>
                                 <!--Info content end -->
                              </div><!-- Slot info end -->
                           </div>
                           <!--schedule-listing end -->
                           @endforeach
                           @else
                           <p style="text-align: center;">登録されたデータがありません。</p>
                           @endif
                            
                           
                           <!-- Pagination-->
                       <!--     <div class="pages mt-60">
                              <nav aria-label="Page navigation ">
                                 <ul class="pagination mx-auto">
                                    <li class="page-item active"><a class="page-link" href="#">11</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                                 </ul>
                              </nav>
                           </div> -->
                        </div>
                        <div role="tabpanel" class="tab-pane" id="date2">
                           
                           @if(count($tweek) > 0)                           
                           @foreach( $tweek as $key => $t )

                           @php $list=$lists[$t]; @endphp
                           <div class="schedule-listing">
                              <div class="schedule-slot-time">
                                 <span> {{ date('m\月d\日', strtotime($list->start)) }}</span>
                                 <span> {{ date('H:i', strtotime($list->start)).'～'.date('H:i', strtotime($list->end)) }}</span>
                                 <span><a style="color: white; font-size: 80%" href='{{ url("/seminardetail/".rand ( 10000 , 99999 ).$list->id ) }}'>詳細を見る</a></span>
                              </div>
                              <div class="schedule-slot-info">
                                 <!-- <a href="#"> -->
                                    <img class="schedule-slot-speakers" @if(empty($list->profileimg)) src="{{ asset('images/avatar/defaultavatar.jpg') }}" @else src="{{ asset('images/avatar/'.$list->profileimg) }}" @endif alt="">
                                 <!-- </a> -->
                                 <div class="schedule-slot-info-content">
                                    <h3 class="schedule-slot-title">{{ $list->name }}
                                       <strong>{{ $list->hostname }}</strong>
                                    </h3>
                                    <p>{!! $list->description !!} </p>
                                 </div>
                                 <!--Info content end -->
                              </div><!-- Slot info end -->
                           </div>
                           <!--schedule-listing end -->
                           @endforeach
                           @else
                           <p style="text-align: center;">登録されたデータがありません。</p>
                           @endif
                            
                           
                           <!-- Pagination-->
                       <!--     <div class="pages mt-60">
                              <nav aria-label="Page navigation ">
                                 <ul class="pagination mx-auto">
                                    <li class="page-item active"><a class="page-link" href="#">11</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                                 </ul>
                              </nav>
                           </div> -->
                        </div>
   
                     </div>

               </div>
            </div>
         </div><!-- container end-->

<!--                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">
                        参加しますか？
                    　　</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="confirmquestion">選択したセミナーを削除してはよろしいですか。</p>
                     </div>
                     <div class="modal-footer">
                        <a id="confirmurl" href="http://www.google.com/">
                        <button type="button" href="lalala" class="btn btn-primary" id="confirmbutton">
                        </button>
                        <a/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>

                     </div>
                  </div>
                  </div>
               </div> -->

      </section>
      <!-- ts schedule end-->   

      <script src="{{ asset('js/fullcalendar/main.js') }}"></script>
      <script src="{{ asset('js/fullcalendar/locales-all.js') }}"></script>

      <script>
         document.addEventListener('DOMContentLoaded', function() {

    var eventlists = [];
    @foreach($lists as $list )
        eventlists.push({
                  title: '{{ $list->name }}',
                  fee: '{{ $list->fee }}',
                  start: '{{ date('Y-m-d\TH:i:00', strtotime($list->start)) }}',
                  end: '{{ date('Y-m-d\TH:i:00', strtotime($list->end)) }}',
                  url: '{{ url("/seminardetail/".rand ( 10000 , 99999 ).$list->id ) }}',
                  description: 'Lecture',
                  borderColor : 'red'
                });
    @endforeach

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               headerToolbar: {start:'prev,next', center:'title', end: 'dayGridMonth' },
               initialView: 'dayGridMonth',
               timeZone: 'Asia/Tokyo',
               locale: 'ja',
               navLinks: true,
               dayMaxEvents: true,
               buttonText: 
                  {
                     today:    '今日',
                     month:    '月',
                     week:     '週',
                     day:      '日'
                  },
               editable: true,
               eventLimit: true,
              events: eventlists
              ,

              eventClick: function(info) {
                  // alert(info.event.url.includes('{{ url('/') }}'));
                  // if (info.event.url.includes('{{ url('/') }}')) {
                     

                  //    info.jsEvent.preventDefault();

                  //    $('#confirmquestion').text('');
                  //    var url = new URL(info.event.url);
                  //    var fee = url.searchParams.get("fee");
                  //     // alert('Event: ' + info.event.url);

                  //    $('#detailModal').modal('show');
                  //    if (fee == 0) {
                  //       $('#confirmquestion').text('無料のセミナー');
                  //       $('#confirmbutton').text('参加登録');
                  //    } else {
                  //       $('#confirmquestion').text('有料のセミナー：'+fee+'¥ カートに追加してはよろしいですか。');
                  //       $('#confirmbutton').text('カートに追加');
                  //    }
                  //       $('#confirmurl').attr("href", info.event.url);
                  //     // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                  //     // alert('View: ' + info.view.type);

                  //     // change the border color just for fun
                  //     // info.el.style.borderColor = 'red';
                  // }
              }

            });
            calendar.render();
         });
      </script>

</x-auth-layout>