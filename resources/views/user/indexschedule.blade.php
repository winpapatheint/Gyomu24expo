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
                     出展スケジュール
                  </h2>
               </div>
            </div>


            @include('components.messagebox')

            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-12">
                  <div id="calendar"></div>
                  <!-- ※カレンダー上のスケジュールをクリックすると、ZOOMが開きます。 -->
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
                  fee: '{{ $list->taskno }}',
                  start: '{{ date('Y-m-d\TH:i:00', strtotime($list->taskdate)) }}',
                  end: '{{ date('Y-m-d\TH:i:00', strtotime($list->taskdate)) }}',
                  allDay : true,
                  // url: '@if(empty($list->joinurl)) {{ url("/applyseminar/".rand ( 10000 , 99999 ).$list->id ) }} @else {{ $list->joinurl }} @endif',
                  description: 'Lecture',
                  groupId: '{{ $list->taskno }}',
                  borderColor : 'red'
                });
    @endforeach

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               headerToolbar: {start:'prev,next', center:'title', end: 'dayGridMonth' },
               initialView: 'dayGridMonth',
               timeZone: 'Asia/Tokyo',
               locale: 'ja',
               timeFormat: 'h:mm',
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
                  console.log(info.event);
                  // alert(info.event.groupId.includes('b3'));
                   if (info.event.url) {
                     info.jsEvent.preventDefault();
                     if (info.event.groupId.includes('b3')) {
                        // window.open(info.event.url);
                        // window.location.replace(info.event.url);
                        // alert(info.event.url);
                        window.open(info.event.url);
                     } else {
                        // alert(info.event.start);
                        // alertmeee(info.event.url,info.event.start);
                        window.open(info.event.url, "_blank");
                     }
                   }
              }

            });
            calendar.render();
         });
      </script>

  <script type="text/javascript">


  $(function() {

          $('a.opennewtab').click(function(e) {
               // window.open('','_self').close();
               e.preventDefault();
               // alert($(this).attr("href"));
               // alertmeee($(this).attr("href"));
               window.open($(this).attr("href"));
          });


  });


  function alertmeee($link  , $time) {
      var now = new Date();
      var tenbefstart = new Date($time);
      // alert($link);
      console.log(now);
      console.log(tenbefstart);
  }


  </script>


</x-auth-layout>