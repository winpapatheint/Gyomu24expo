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


      @php $subtitle="授業スケジュール"; @endphp
      @include('components.subtitle')

      <!-- ts schedule start-->
      <section class="ts-schedule">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title">
                     <!-- <span>カレンダー</span> -->
                     授業スケジュール
                  </h2>
               </div>
            </div>


            @include('components.messagebox')

            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-12">
                  <div id="calendar"></div>
                  ※カレンダー上の授業スケジュールをクリックすると、ZOOMや試験が開きます。
               </div>
            </div>

            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title">
                     <!-- <span>今日＆今週</span> -->
                     授業スケジュールの詳細
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

                           @php 

                           $list=$lists[$t]; 
                           
                           if(!str_contains($list->semtype_id,'b3')){
                              $label = "ZOOMをスタート";
                              $href = $list->starturl;
                           } else {
                              $label = "試験を一覧する";
                              $href = url("/previewtest/".rand ( 10000 , 99999 ).$list->id );
                           }

                           @endphp
                           <div class="schedule-listing">
                              <div class="schedule-slot-time">
                                 <span> {{ date('m\月d\日', strtotime($list->start)) }}</span>
                                 <span> {{ date('H:i', strtotime($list->start)).'～'.date('H:i', strtotime($list->end)) }}</span>
                                 <span style="padding-top: 10px;"><a style="color: white; font-size: 80%" href="{{ $href }}" target="_blank">
                                    <i class="fa fa-play-circle"></i>
                                    {{ $label }}</a></span>
                              </div>
                              <div class="schedule-slot-info" style="padding-left: 50px;">
                                 <!-- <a href="#">
                                    <img class="schedule-slot-speakers" src="images/speakers/speaker1.jpg" alt="">
                                 </a> -->
                                 <div class="schedule-slot-info-content">
                                    <h3 class="schedule-slot-title">{{ $list->name }}
                                       <!-- <a href=''><strong>セミナーをスタート</strong></a> -->
                                    </h3>
                                    <p>{!! $list->description !!} </p>
                                 </div>
                                 <!--Info content end -->
                              </div><!-- Slot info end -->
                           </div>
                           <!--schedule-listing end -->
                           @endforeach
                           @else
                           <p style="text-align: center;">登録された授業がありません。</p>
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
                                 <!-- <span><a style="color: grey;" href="{{ $list->starturl }}">開始</a></span> -->
                              </div>
                              <div class="schedule-slot-info" style="padding-left: 50px;">
                                 <!-- <a href="#">
                                    <img class="schedule-slot-speakers" src="images/speakers/speaker1.jpg" alt="">
                                 </a> -->
                                 <div class="schedule-slot-info-content">
                                    <h3 class="schedule-slot-title">{{ $list->name }}
                                       <strong>{{ '' }}</strong>
                                    </h3>
                                    <p>{!! $list->description !!} </p>
                                 </div>
                                 <!--Info content end -->
                              </div><!-- Slot info end -->
                           </div>
                           <!--schedule-listing end -->
                           @endforeach
                           @else
                           <p style="text-align: center;">登録された授業がありません。</p>
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
         @php 
         
         $today = date("Y-m-d");

         if (($today == date('Y-m-d', strtotime($list->start)))) {

            if(!str_contains($list->semtype_id,'b3')){
               $href = $list->starturl;
            } else {
               $href = url("/previewtest/".rand ( 10000 , 99999 ).$list->id );
            }

         } else{
            $href = "";
         }

         @endphp

        eventlists.push({
                  title: '{{ $list->name }}',
                  fee: '{{ $list->fee }}',
                  start: '{{ date('Y-m-d\TH:i:00', strtotime($list->start)) }}',
                  end: '{{ date('Y-m-d\TH:i:00', strtotime($list->end)) }}',
                  url: '{{ $href }}',
                  description: 'Lecture',
                  // borderColor : '@if(!empty($list->joinurl)) red @elseif($list->fee == 0) green @endif'
                  borderColor : 'red'
                });
    @endforeach

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               headerToolbar: {start:'prev,next', center:'title', end: 'dayGridMonth' },
               initialView: 'dayGridMonth',
               timeZone: 'Asia/Tokyo',
               locale: 'ja',
               // displayEventTime : false,
               navLinks: true,
               dayMaxEvents: true,
               eventLimit: true,
               buttonText: 
                  {
                     today:    '今日',
                     month:    '月',
                     week:     '週',
                     day:      '日'
                  },
               editable: true,
              events: eventlists
              ,

              eventClick: function(info) {
                  // alert(info.event.url.includes('{{ url('/') }}'));
                   if (info.event.url) {
                     info.jsEvent.preventDefault();
                     window.open(info.event.url, "_blank");
                   }
              }

            });
            calendar.render();
         });
      </script>

</x-auth-layout>