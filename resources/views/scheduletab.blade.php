    <x-guest-layout>

      @php $subtitle=__('scheduletab.eventinfo'); @endphp
      @include('components.subtitle')
 <!-- ts schedule start-->
      <section class="ts-schedule">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title">
                     <!-- <span>Schedule Details</span> -->
                     {{ __('scheduletab.zoomevent') }} 
                  </h2>
                  <div class="ts-schedule-nav">
                     <ul class="nav nav-tabs justify-content-center" role="tablist">
                        
                        @php
                        $monthindex = array('0' => __('scheduletab.thismonth'),
                                            '1' => __('scheduletab.nextmonth'), 
                                            '2' => __('scheduletab.nextnextmonth') 
                                            );
                        @endphp

                        @foreach( $seminar as $key => $list )

                          @php

                          $ttlpage = $ttlpagearr[$key];

                          if(empty($_GET['tab']) AND $key == array_key_first($seminar)){
                              $active = 'active';
                          } else if (!empty($_GET['tab']) AND $key == $_GET['tab']) {
                              $active = 'active';
                          } else {
                              $active = '';
                          }

                          @endphp


                        <li class="nav-item">
                           <a title="Click Me" href="#date{{$key}}" role="tab" data-toggle="tab" class="{{ $active }}">
                              <h3>{{+$key}} 月</h3>
                              <span>{{ $monthindex[$loop->index] }}</span>
                            </a>
                        </li>
                        @endforeach


                        <!-- <li class="nav-item">
                           <a href="#date2" title="Click Me" role="tab" data-toggle="tab" class="">        
                              <h3>6th June</h3>
                              <span>Saturday</span>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#date3" title="Click Me" role="tab" data-toggle="tab" class="">
                              <h3>7th June</h3>
                              <span>Sunday</span>
                           </a>
                        </li> -->
                     </ul>
                     <!-- Tab panes -->
                  </div>
               </div><!-- col end-->

            </div><!-- row end-->
            <div class="row">
               <div class="col-lg-12">
                  <div class="tab-content schedule-tabs schedule-tabs-item">


                     @foreach( $seminar as $key => $lists )

                          @php

                          $ttlpage = $ttlpagearr[$key];
                          $tabpage = $selectpage[$key];

                          if(empty($_GET['tab']) AND $key == array_key_first($seminar)){
                              $active = 'active';
                          } else if (!empty($_GET['tab']) AND $key == $_GET['tab']) {
                              $active = 'active';
                          } else {
                              $active = '';
                          }

                          @endphp

                         <div role="tabpanel" class="tab-pane {{ $active }}" id="date{{$key}}">
                            @if(count($lists) > 0 )                            
                                @foreach( $lists as $k => $list )
                            <div class="schedule-listing">
                                 <div class="schedule-slot-time">
                                    <span> {{ date('Y-m-d', strtotime($list->start)) }}</span>
                                    <span> {{ date('H:i', strtotime($list->start)) }} - {{ date('H:i', strtotime($list->end)) }}</span>

                  @if( date("Y-m-d") == date('Y-m-d', strtotime($list->start)) ) 
                      @php
                        if( (new DateTime() > new DateTime(date('Y-m-d H:i',strtotime('-5 minutes',strtotime($list->start))) )) AND 
                             (new DateTime() < new DateTime(date('Y-m-d', strtotime($list->end)) )) ){
                             $void = false;
                        }else{
                             $void = true;
                        }
                      @endphp
                        
                      <a style="color: white; font-size: 80%" 
                        @if(!$void)
                        href="{{ $list->joinurl }}" target="_blank"
                        @endif
                      ><i class="fa fa-play-circle"></i>{{ __('scheduletab.clicktojoin') }} </a>
                                    <span style="font-size: 12px;">{{ __('scheduletab.join5minutebefore') }} </span>

                    @endif
                                 </div>
                                 <div class="schedule-slot-info">
                                    <a href="#">
                                        <img class="schedule-slot-speakers" src="{{ asset('images/avatar/'.($list->profileimg ?? 'defaultavatar.jpg') ) }}" alt="">
                                    </a>
                                    <div class="schedule-slot-info-content">
                                       <h3 class="schedule-slot-title">{{ $list->name }}
                                          <strong>@ {{ $list->hostname }}</strong>
                                       </h3>
                                       <p>{!! $list->description !!}</p>
                                    </div>
                                    <!--Info content end -->
                                 </div><!-- Slot info end -->
                            </div>
                                 @endforeach
                            @else
                            <div style="text-align: center;">
                                  <p>登録されたイベントがありません</p>
                            </div>
                            @endif

                            <div class="pagi-area">
                                @if ($ttlpage > 0)
                                <!-- Pagination -->
                                <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">
                                  <div class="pages mt-60">
                                     <nav aria-label="Page navigation ">
                                        <ul class="pagination mx-auto">

                                            @php if(empty($tabpage))$tabpage=1; $set=ceil($tabpage/5);@endphp
                                            @php $ppage=($tabpage-1); $npage=($tabpage+1);@endphp

                                            <li @if($tabpage < 2) style="display: none" @endif class="page-item"><a class="page-link" href="{{ request()->fullUrlWithQuery(['tab' => $key , 'page' => $ppage]) }}"><i class="fa fa-long-arrow-left"></i></a></li>
                                            

                                            @php $m = 5; if($ttlpage<5)$m=$ttlpage; @endphp
                                            
                                            @php $k=5*($set-1); @endphp
                                            @for ($i = ($k)+1; $i <= (($k)+5); $i++)
                                                @if($i<=$ttlpage)
                                                    @if($i < (($k)+5))
                                                    <li class="page-item @if($tabpage == $i) active @endif"><a class="page-link" href="{{ request()->fullUrlWithQuery(['tab' => $key , 'page' => $i]) }}">{{$i}}</a></li>
                                                    @endif
                                                @endif
                                            @endfor
                                            
                                            <li @if($tabpage == $ttlpage) style="display: none" @endif class="page-item"><a class="page-link" href="{{ request()->fullUrlWithQuery(['tab' => $key , 'page' => $npage]) }}"><i class="fa fa-long-arrow-right"></i></a></li>

                                        </ul>
                                     </nav>
                                  </div>
                                </div>
                                @endif
                            </div>
                            <!--schedule-listing end -->
                         </div>
                      @endforeach
                  </div>

               </div>
            </div>
         </div><!-- container end-->
      </section>
      <!-- ts schedule end-->

    </x-guest-layout>