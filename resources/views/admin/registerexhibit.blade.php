<x-auth-layout>

      @php $subtitle=__('メール管理'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                   @if (!empty($edituser['id']))
                       <h2 class="section-title text-center">
                           {{ __('商品修正') }} <!-- This is for editing -->
                       </h2>
                   @else
                       <h2 class="section-title text-center">
                           {{ __('商品登録') }} <!-- This is for registration -->
                       </h2>
                   @endif
               </div><!-- col end-->
           </div>
            <div class="row">


               <div class="col-lg-8 mx-auto">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @php $error = $errors->toArray(); @endphp
            @php $action = route('saveexhibit'); @endphp

                  <form id="makeapplication" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                    @if (!empty($edituser['id']))
                    <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                    @endif

                     <div class="error-container"></div>
                     <label for="name"><b>{{ __('商品名') }}</b> <span class="badge badge-danger">必須</span></label>
                     <div class="form-group">
                        <input class="form-control form-control-name" placeholder="{{ __('user.taskname') }}" name="name" id="name"
                           type="text" value="{{ old('name') ?? $edituser['name'] ?? '' }}"  style="line-height: 2.0;">
                            <p class="error name text-danger"></p>
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                        <label for="taskno"><b>商品番号</b> <span class="badge badge-danger">必須</span></label>
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('商品番号') }}" name="taskno" id="taskno"
                                 type="text" value="{{ old('taskno') ?? $edituser['taskno'] ?? '' }}" style="line-height: 2.0;">
                              <p class="error taskno text-danger"></p>                          
                           </div>
                        </div>
                        <div class="col-md-6">
                        <label for="taskdate"><b>商品日</b> <span class="badge badge-danger">必須</span></label>
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('商品日') }}" name="taskdate" id="taskdate"
                                 type="date" value="{{ old('taskdate') ?? $edituser['taskdate'] ?? '' }}" style="line-height: 2.0;">
                              <p class="error taskdate text-danger"></p>                               
                           </div>
                        </div>
                     </div>

                     <label for="email"><b>{{ __('登録者') }}</b></label>
                     <div class="form-group">
                        <input class="form-control form-control-name" placeholder="{{ __('登録者') }}" name="taskauthor" id="taskauthor"
                           type="text" value="{{ old('taskauthor') ?? $edituser['taskauthor'] ?? '' }}" style="line-height: 2.0;">
                        <p class="error taskauthor text-danger"></p>                               
                     </div>


                     <label for="picture"><b>商品画像</b></label>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="file" name="imageone" id="imageone" class="form-control" >
                              <img id="preview-imageone" alt="your imageone" 
                              @if(!empty($edituser['imageone']))
                              src="{{ asset('images/'.($edituser['imageone'] ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:none" class="imageone error text-danger"></p>
                                @if (!empty($error['imageone']))
                                    @foreach ($error['imageone'] as  $key => $value)
                                        <p class="imageone error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="file" name="imagetwo" id="imagetwo" class="form-control" >
                              <img id="preview-imagetwo" alt="your imagetwo" 
                              @if(!empty($edituser['imagetwo']))
                              src="{{ asset('images/'.($edituser['imagetwo'] ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:ntwo" class="imagetwo error text-danger"></p>
                                @if (!empty($error['imagetwo']))
                                    @foreach ($error['imagetwo'] as  $key => $value)
                                        <p class="imagetwo error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="file" name="imagethr" id="imagethr" class="form-control" >
                              <img id="preview-imagethr" alt="your imagethr" 
                              @if(!empty($edituser['imagethr']))
                              src="{{ asset('images/'.($edituser['imagethr'] ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:nthr" class="imagethr error text-danger"></p>
                                @if (!empty($error['imagethr']))
                                    @foreach ($error['imagethr'] as  $key => $value)
                                        <p class="imagethr error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="file" name="imagefou" id="imagefou" class="form-control" >
                              <img id="preview-imagefou" alt="your imagefou" 
                              @if(!empty($edituser['imagefou']))
                              src="{{ asset('images/'.($edituser['imagefou'] ?? 'blog/blog-details.jpg')   ) }}"
                              style="max-width: 100%;" 
                              @else
                              style="display: none; max-width: 100%;" 
                              @endif
                              />
                                <p style="display:nfou" class="imagefou error text-danger"></p>
                                @if (!empty($error['imagefou']))
                                    @foreach ($error['imagefou'] as  $key => $value)
                                        <p class="imagefou error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                           </div>
                        </div>

                     </div>

                     <label for="email"><b>{{ __('auth.category') }}</b> <span class="badge badge-danger">必須</span></label>
                     <div class="form-group">
                        <select class="form-control" name="category" id="category" 
                              style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                          @foreach (config('global.category') as $key => $value)
                            <option value="{{$key}}" {{ old('category') == $key ? "selected" : "" }} @if(!empty($edituser['category']) && ($edituser['category'] == $key)) selected @endif >{{__($value)}}</option>
                          @endforeach
                        </select>
                         <p class="error category text-danger"></p>                             
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="taskcontent"><b>{{ __('商品詳細') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <textarea class="form-control form-control-message" id="taskcontenttextarea" rows="6">{!! str_replace("<br />","&#013;",old('taskcontent') ?? $edituser['taskcontent'] ?? '')  !!}</textarea>
                                <p style="display:none" class="taskcontent error text-danger"></p>
                                <input type="hidden" name="taskcontent" id="taskcontent" value="{!! old('taskcontent') ?? $edituser['taskcontent'] ?? '' !!}">
                           </div>
                        </div>
                     </div>


                     <div class="text-center"><br>

                        @if (!empty($edituser['id']))
                        <button class="btn btn-submit" type="submit" data-askconfirmtitle="{{ __('商品を更新') }}" data-askconfirmtext="{{ __('更新しますか？') }}" data-yes="{{ __('更新する') }}"> {{ __('更新する') }}</button>
                        @else
                        <button class="btn btn-submit" type="submit" data-askconfirmtitle="{{ __('user.applytitle') }}" data-askconfirmtext="{{ __('user.applytext') }}" data-yes="{{ __('user.dorequest') }}"> {{ __('user.dorequest') }}</button>
                        @endif
                     </div>
                  </form><!-- Contact form end -->
               </div>
            </div>
         </div>
         <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div>
      </section>

<script type="text/javascript">
       


    $(document).ready(function() {

        $('#imageone').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-imageone').attr('src', e.target.result); 
              $('#preview-imageone').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });

        $('#imagetwo').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-imagetwo').attr('src', e.target.result); 
              $('#preview-imagetwo').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });

        $('#imagethr').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-imagethr').attr('src', e.target.result); 
              $('#preview-imagethr').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });

        $('#imagefou').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview-imagefou').attr('src', e.target.result); 
              $('#preview-imagefou').show();
            }
            reader.readAsDataURL(this.files[0]); 
        });

         $('#taskcontenttextarea').on('input', function() {
           text = $('#taskcontenttextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#taskcontent').val(text);
         });


        $(".btn-submit").click(function(e){

            e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(makeapplication);
   
            $.ajax({
                url: "{{ $action }}",
                type:'POST',

                data: formData,

                 contentType: false,
                 processData: false,

                success: function(data) {
                    if($.isEmptyObject(data.error)){

                          $('.error').hide()
                          askconfirmboxshow($(".btn-submit"),'makeapplication');
                    }else{
                        // alert("err");
                        console.log(data.error);
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {


                          $('.error.'+key).text(value[0])
                          $('.error.'+key).show()
                          
                        });
                    }
                },
                fail: function(data) {
                        alert("エラー：ajax error");
                }
            });
       
        });


    });


</script>
</x-auth-layout>