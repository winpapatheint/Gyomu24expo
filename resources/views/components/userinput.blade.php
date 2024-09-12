         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                      @if (!$editmode)
                        {{ __('auth.userfreeregister') }}
                      @else
                        基本情報修正
                      @endif

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                    @if ($editmode)
                    <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                    @endif


                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{ __('auth.mailaddress') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                 type="email" value="{{ old('email') ?? $edituser['email'] ?? '' }}" >
                                <p style="display:none" class="email error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="pwd"><b>{{ __('auth.password') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password"
                                 type="password"  autocomplete="new-password" value="{{ $edituser['password'] ?? '' }}">
                                <p style="display:none" class="password error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="pwdagain"><b>{{ __('auth.confirmpassword') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                 type="password" value="{{ $edituser['password'] ?? '' }}">
                                <p style="display:none" class="password_confirmation  error text-danger"></p>
                           </div>
                        </div>
                     </div>                     
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname"><b>{{ __('auth.namekanji') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.name') }}" name="name" id="name"
                                 type="text"value="{{ old('name') ?? $edituser['name'] ?? '' }}"  autofocus >
                                <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div>         
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname_furi"><b>{{ __('auth.compname') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.compname') }}" name="compname" id="compname"
                                 type="text" value="{{ old('compname') ?? $edituser['compname'] ?? '' }}"  autofocus>
                                <p style="display:none" class="compname error text-danger"></p>
                            </div>
                        </div>
                     </div>   

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="entity_select"><b>{{ __('auth.compentity') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="entity" id="entity_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.entity') as $key => $value)
                                  <option value="{{$key}}" {{ old('entity') == $key ? "selected" : "" }} @if($edituser['entity'] ?? '' == $value) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="entity error text-danger"></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="purpose_select"><b>{{ __('auth.purpose') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="purpose" id="purpose_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.purpose') as $key => $value)
                                  <option value="{{$key}}" {{ old('purpose') == $key ? "selected" : "" }} @if($edituser['purpose'] ?? '' == $value) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="purpose error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="compindustry_select"><b>{{ __('auth.industry') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="compindustry" id="compindustry_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.compindustry') as $key => $value)
                                  <option value="{{$key}}" {{ old('compindustry') == $key ? "selected" : "" }} @if($edituser['compindustry'] ?? '' == $value) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="compindustry error text-danger"></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="position_select"><b>{{ __('auth.position') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="position" id="position_select"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.position') as $key => $value)
                                  <option value="{{$key}}" {{ old('position') == $key ? "selected" : "" }} @if($edituser['position'] ?? '' == $value) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                                <p style="display:none" class="position error text-danger"></p>
                           </div>
                        </div>
                     </div>  

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="phonenumber"><b>{{ __('auth.phone') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.phone') }}" name="phone" id="phone"
                                 type="text" value="{{ old('phone') ?? $edituser['phone'] ?? '' }}">
                                <p style="display:none" class="phone error text-danger"></p>
                           </div>
                        </div>
                     </div>                        
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>{{ __('auth.address') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.address') }}" name="address" id="address"
                                 type="text">
                                <p style="display:none" class="address error text-danger"></p>
                           </div>
                        </div>
                     </div>    
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>URL</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <input class="form-control form-control-password" placeholder="URL" name="url" id="url"
                                 type="text">
                                <p style="display:none" class="url error text-danger"></p>
                           </div>
                        </div>
                     </div>  
                    
                    @if (!$editmode)  
                     <div class="col-md-5 mx-auto" style="text-align: center;">
                        <div class="form-group" style="font-size: 16px;">
                           <label class="form-check-label" style="padding-left: unset;">
                              <input type="checkbox" class="form-check-input" style="width: 16px;height: 16px;" name="check" id="check_id" value="1"> 
                              <a style="color: inherit;" href="{{ url('/privacy') }}">{{ __('auth.policy') }}</a></label><p style="display:none" class="check error text-danger"></p></div>
                     </div> 
                    @endif

                     <div class="text-center">
                        <button class="btn btn-submit" type="button">
                      @if (!$editmode)  
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           {{ __('auth.doregister') }}
                      @else
                          <i class="fa fa-edit" aria-hidden="true"></i>
                           情報を修正する
                      @endif
                        </button>
                     </div>
               </div>
            </div>
         </div>

         <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="deleteConfirmModalLabel">
                  修正しますか？
              　　</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
          <!--      <div class="modal-body">
                  <p>選択したセミナーを削除してはよろしいですか。</p>
               </div> -->
               <div class="modal-footer">

                  <button type="submit" class="btn btn-primary">
                  修正する
                  </button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>

               </div>
            </div>
            </div>
         </div>