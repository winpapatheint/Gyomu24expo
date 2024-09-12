      <style type="text/css">
         .ts-speaker-popup .ts-speaker-popup-content p {
          margin-bottom: 5px;
         }
      </style>

                @foreach( $influencers as $key => $list )
                 <!-- popup start-->
               <div class="modal fade" id="detailModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">求職者の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p><strong>求職者名 : </strong><span>{{ $list->name }}</span></p>
                        @if(!empty($list->profileimg))
                        <p><strong>プロフィール写真 : </strong>
                        <img src="{{ asset('images/avatar/'.$list->profileimg ) }}" style="width: 100%;">
                        </p>
                        @endif
                        @auth
                        @if( Auth::user()->role != 'user' )
                        <p><strong>{{ __('auth.phone') }} : </strong><span>{{ $list->phone }}</span></p>
                        <p><strong>{{ __('auth.mailaddress') }} : </strong><span>{{ $list->email }}</span></p>
                        @endif
                        @endauth
                        <p><strong>{{ __('auth.infcgender0') }} : </strong><span>{{ __(config('global.gender')[$list->gender]) }}</span></p>
                        <p><strong>{{ __('誕生日') }} : </strong><span>{{date('Y/m/d', strtotime($list->dob))}}</span></p>
                        <p><strong>{{ __('希望職種') }} : </strong><span>{{ $list->field }}</span></p>
                        <p><strong>{{ __('居住国名') }} : </strong><span>{{ __(config('global.country')[$list->country]) }}</span></p>
                        <p><strong>{{ __('auth.address') }} : </strong><span>{{ $list->address }}</span></p>

                     @if(!empty($list->resume))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="resume"><b>{{ __('履歴書') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                                 <iframe src="{{ asset('documents/'.$list->resume) }}" width="100%" height="500px"></iframe>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(!empty($list->docone))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="docone"><b>{{ __('職務経歴書') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                                 <iframe src="{{ asset('documents/'.$list->docone) }}" width="100%" height="500px"></iframe>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(!empty($list->doctwo))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="doctwo"><b>{{ __('その他の書類') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                                 <iframe src="{{ asset('documents/'.$list->doctwo) }}" width="100%" height="500px"></iframe>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(!empty($list->companyinfo))
                        <p><strong>{{ __('推薦文') }} : </strong><br><span>{!! $list->companyinfo  !!}</span></p>
                     @endif

                     </div>

                 <!--     <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

                @endforeach