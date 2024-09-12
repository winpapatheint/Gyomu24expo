                     <div class="widget social-box" style="margin-bottom: 20px;">
                        <h4 class="widget-title">{{ __('user.taskoverview') }}</h4>
                        <ul>
                           <li style="display: flex;">
                           <div class="post-tags float-left"><span>{{ __('user.taskno') }}: </span>
                              <div class="comment-content">
                                 <p>{{ sprintf('%06d', $list->id) }}</p>
                              </div>
                           </div>                                             
                           </li>

                           <li style="display: flex;">
                           <div class="post-tags float-left"><span>{{ __('user.taskname') }}: </span>
                              <div class="comment-content">
                                 <p>{{ $list->positionname }}</p>
                              </div>
                           </div>                                             
                           </li>

                           <li style="display: flex;">
                           <div class="post-tags float-left"><span>{{ __('user.tasktime') }}: </span>
                              <div class="comment-content">
                                 <p>{{ date('Y/m/d H:i', strtotime($list->created_at)) }}</p>
                              </div>
                           </div>                                             
                           </li>

<!--                            <li style="display: flex;">
                           <div class="post-tags float-left"><span>{{ __('user.content') }}: </span>
                              <div class="comment-content">
                                 <p>{!! $list->description ?? '' !!}</p>
                              </div>
                           </div>                                             
                           </li>

                           <li style="display: flex;">
                           <div class="post-tags float-left"><span>{{ __('user.duration') }}: </span>
                              <div class="comment-content">
                                 <p>{{ $list->infoduration ?? '' }}</p>
                              </div>
                           </div>                                             
                           </li> -->

                           @if((auth()->user()->role  == 'admin') OR (auth()->user()->role  == 'user'))
                           @endif

                        </ul>
                     </div><!-- .widget end -->


                     @php
                        $lists[] = $list;
                     @endphp

                     @include('components.orderdetail')