<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      @php
      $dataopen=false; 
      if(!empty($data->id)){
          $editmode=true;
            if(($data->open == '1')){
              $dataopen=true; 
            }
      } else {
          $editmode=false;
      }
      @endphp

      @php $subtitle="授業管理"; @endphp
      @include('layouts.subtitle')
      

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                      @if($editmode)
                        @if(($dataopen))
                          授業新規作成
                        @else
                          授業修正
                        @endif
                      @else
                        授業登録
                      @endif
                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                  @php $error = $errors->toArray(); @endphp
                  @php $action= route('registerseminar'); @endphp

                  <form id="eventregister" class="contact-form" method="POST" action="{{ $action }}">
                  @csrf

                  @if($editmode)
                      <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                  @endif

                     <div class="error-container"></div>
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="seminar_name"><b>授業名</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-email" placeholder="授業名" name="seminar_name" id="seminar_name"
                                 type="text" value="{{ old('seminar_name') ?? $data->name ?? '' }}">
                                <p style="display:none" class="seminar_name error text-danger"></p>
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="startdt"><b>開始日時</b> <span class="badge badge-danger">必須</span></label>
                              @php if(isset($data->start)) $data->startdt = date('Y-m-d\TH:i', strtotime($data->start)); @endphp  
                              <input class="form-control form-control-password" placeholder="開始日時" name="startdt" id="startdt"
                                 type="datetime-local" value="{{ old('startdt') ?? $data->startdt ?? '' }}">
                                 <!-- value="2017-06-01T08:30" -->
                                <p style="display:none" class="startdt error text-danger"></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="enddt"><b>終了日時</b> <span class="badge badge-danger">必須</span></label>
                              @php if(isset($data->end)) $data->enddt = date('Y-m-d\TH:i', strtotime($data->end)); @endphp 
                              <input class="form-control form-control-password" placeholder="終了日時" name="enddt" id="enddt"
                                 type="datetime-local" value="{{ old('enddt') ?? $data->enddt ?? '' }}">
                                <p style="display:none" class="enddt error text-danger"></p>
                           </div>
                        </div>
                     </div>    

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="description"><b>授業内容</b> <span class="badge badge-danger">必須</span></label>

                                   <textarea class="form-control form-control-message" id="bodytextarea" rows="8">{!! str_replace("<br />","&#013;",old('description') ?? $data->description ?? '')  !!}</textarea>
                                   <p style="display:none" class="description error text-danger"></p>                                 
                                 <input type="hidden" name="description" id="description" value="{!! old('description') ?? $data->description ?? '' !!}">

                           </div>
                        </div>
                     </div>   


                     <div class="text-center">

                        @if((!$dataopen))
                           @if($editmode)
                              <button class="btn btn-submit" type="submit" data-askconfirmtitle="授業を修正" data-askconfirmtext="修正しますか?" data-yes="修正する"><i class="fa fa-plus" aria-hidden="true"> 修正する</i></button>
                           @else
                              <button class="btn btn-submit" type="submit" data-askconfirmtitle="授業を登録" data-askconfirmtext="登録しますか?" data-yes="登録する"><i class="fa fa-plus" aria-hidden="true"> 登録する</i></button>
                           @endif
                        @endif 
                        @if(($dataopen))
                        <button class="btn" name="makenew" value="1"><i class="fa fa-plus" aria-hidden="true"></i>授業を新規作成する</button>
                        @endif

                     </div>
                  </form><!-- Contact form end -->
               </div>
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
                          if (selectval.includes(value['code'])) {
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

    $(document).ready(function() {
     $('#bodytextarea').on('input', function() {
     text = $('#bodytextarea').val();
     text = text.replace(/\r?\n/g, '<br />')
     // alert(text);
     $('#description').val(text);
   });


        $(".btn-submit").click(function(e){

            e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(eventregister);
   
            $.ajax({
                url: "{{ $action }}",
                type:'POST',

                data: formData,

                 contentType: false,
                 processData: false,

                success: function(data) {
                    if($.isEmptyObject(data.error)){

                          $('.error').hide()
                          askconfirmboxshow($(".btn-submit"),'eventregister');
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