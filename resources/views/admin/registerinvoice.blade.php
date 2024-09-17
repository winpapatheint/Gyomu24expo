<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(window).on('load', function() {
        // $('#detailModal').modal('show');
    });

</script>


      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle="請求書管理"; @endphp
      @include('components.subtitle')

      
      <section class="ts-contact-form">




                  @php $action= route('registerinvoice'); @endphp
                  <form id="invoice-form" class="contact-form" method="POST" action="{{ $action }}">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $data['id'] ?? '' }}">
                  @endif

         <div class="container">

            <div class="row">
               <div class="col-lg-10 mx-auto text-center">
                  <h3>@if (!$editmode) 新規登録 @else 請求修正 @endif</h3>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-10 mx-auto">


                     <div class="error-container"></div>

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <span style="display:none" class="timeid error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="gender_select"><b>請求書番号</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('請求書番号') }}" name="timeid" id="timeid"
                                 type="text" value="{{ old('timeid') ?? $data['timeid'] ?? date('ymdHis') }}">
                                  
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <span style="display:none" class="date error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="end"><b>発行日</b></label> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('発行日') }}" name="date" id="date"
                                 @php if(!empty(old('date'))) { $date= old('date'); } elseif(!empty($data['date'])) { $date = date('Y-m-d', strtotime($data['date'] )); } else { $date = ''; } @endphp
                                 type="date" value="{{ $date }}"  autofocus>
                           </div>
                        </div>
                     </div>


                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <span style="display:none" class="name error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="name"><b>{{ __('件名') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('件名') }}" name="name" id="name"
                                 type="text" value="{{ old('name') ?? $data['name'] ?? '' }}">
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="remarks"><b>{{ __('備考') }}</b></label>
                              <textarea class="form-control form-control-message" id="remarkstextarea" rows="6">{!! str_replace("<br />","&#013;",old('remarks') ?? $data['remarks'] ?? '')  !!}</textarea>
                                <p style="display:none" class="remarks error text-danger"></p>
                                <input type="hidden" name="remarks" id="remarks" value="{!! old('remarks') ?? $data['remarks'] ?? '' !!}">
                           </div>
                        </div>
                     </div>

               </div>
            </div>


            <div class="row">
               <div class="col-lg-10 mx-auto">
                  <h3>お届け先</h3>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-10 mx-auto">


                     <div class="error-container"></div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <span style="display:none" class="hcompany error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="agerange_select"><b>{{ __('会社名') }}</b> <span class="badge badge-danger">必須</span></label>
                              <select class="form-control required" name="hcompany" id="hcompany"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="null" selected>登録会社名を選択してください</option>
                                @foreach( $hcompanies as $key => $hcompany )
                                <option value="{{ $hcompany->id }}" @if($hcompany->id == $data["hcompany"]) selected @endif>{{ $hcompany->name }}</option>                   
                                @endforeach                                   
                              </select>
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <span style="display:none" class="postalcode error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="postalcode"><b>{{ __('auth.postalcode') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('auth.postalcode') }}" name="postalcode" id="postalcode"
                                 type="text" value="{{ old('postalcode') ?? $data['postalcode'] ?? '' }}">
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <span style="display:none" class="address error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="address"><b>{{ __('auth.address') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('auth.address') }}" name="address" id="address"
                                 type="text" value="{{ old('address') ?? $data['address'] ?? '' }}">
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <span style="display:none" class="addressextra error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="addressextra"><b>{{ __('住所2') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('住所2') }}" name="addressextra" id="addressextra"
                                 type="text" value="{{ old('addressextra') ?? $data['addressextra'] ?? '' }}">
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <span style="display:none" class="phone error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="phonenumber"><b>{{ __('auth.phone') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ __('auth.phone') }}" name="phone" id="phone"
                                 type="text" value="{{ old('phone') ?? $data['phone'] ?? '' }}">
                           </div>
                        </div>
                     </div>
                     
               </div>
            </div>


            <div class="row">
               <div class="col-lg-10 mx-auto">
                  <h3>商品<span class="badge badge-primary" id="addnewproduct"> <i class="fa fa-plus-circle" aria-hidden="true"></i> 項目</span></h3> 
               </div><!-- col end-->
            </div>
            @php

            if(isset($data['totalrow'])){
              $countrow = count($data['totalrow']);
            } else {
              $countrow = 1;
            }

            @endphp
            <div class="row">


               <div class="col-lg-10 mx-auto" id="tableproduct">
                    @for ($i = 0; $i < $countrow; $i++)
                     <div class="row" id="row{{ $i+1 }}">

                        <div class="col-md-4">
                           <div class="form-group">
                              <a class="btnlist btn-secondary deleterow" data-id="{{ $i+1 }}" href="#" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                              <span style="display:none" class="label{{ $i+1 }} error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="gender_select"><b>項目</b> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password required" placeholder="{{ ($i+1).') 項目' }}" name="label[{{ $i+1 }}]" id="label{{ $i+1 }}"
                                 type="text" value="{{ old('label[$i+1]') ?? $data['label'][$i+1] ?? '' }}">
                                <p style="display:none" class="label[$i+1] error text-danger"></p>  
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <span style="display:none" class="quantity{{ $i+1 }} error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="end"><b>数量</b></label> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password totalrowcheck required" data-id="{{ $i+1 }}"  placeholder="{{ __('数量') }}" name="quantity[{{ $i+1 }}]" id="quantity{{ $i+1 }}"
                                 type="text" value="{{ old('quantity[$i+1]') ?? $data['quantity'][$i+1] ?? '' }}">
                                <p style="display:none" class="quantity[$i+1] error text-danger"></p>
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="end"><b>単位</b></label></label>
                              <input class="form-control form-control-password" placeholder="{{ __('単位') }}" name="unit[{{ $i+1 }}]" id="unit{{ $i+1 }}"
                                 type="text" value="{{ old('unit[$i+1]') ?? $data['unit'][$i+1] ?? '' }}">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <span style="display:none" class="priceperunit{{ $i+1 }} error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                              <label for="end"><b>単価</b></label> <span class="badge badge-danger">必須</span></label>
                              <input class="form-control form-control-password totalrowcheck required" data-id="{{ $i+1 }}" placeholder="{{ __('単価') }}" name="priceperunit[{{ $i+1 }}]" id="priceperunit{{ $i+1 }}"
                                 type="text" value="{{ old('priceperunit[$i+1]') ?? $data['priceperunit'][$i+1] ?? '' }}">
                                <p style="display:none" class="priceperunit[$i+1] error text-danger"></p>
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="end"><b>金額</b></label></label>
                              <input readonly class="form-control form-control-password" placeholder="{{ __('金額') }}" name="totalrow[{{ $i+1 }}]" id="totalrow{{ $i+1 }}"
                                 type="text" value="{{ old('totalrow[$i+1]') ?? $data['totalrow'][$i+1] ?? '' }}">
                           </div>
                        </div>


                     </div>
                     @endfor

               </div>
            </div>

            <div class="text-center">
                <button class="btn btn-submit" type="button" role="button" data-toggle="modal">
                
              @if (!$editmode)  
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                   情報を登録する
              @else
                    <i class="fa fa-edit" aria-hidden="true"></i>
                   情報を修正する
              @endif
                </button>

            </div>

         </div>

               <div id="detailModal" class="modal fade" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">
                      　@if (!$editmode)  
                        登録しますか？
                      　@else
                        修正しますか？
                      　@endif
                    　　</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">
                      　@if (!$editmode)  
                        登録する
                      　@else
                        修正する
                      　@endif
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>

                     </div>
                  </div>
                  </div>
               </div>
                  </form><!-- Contact form end -->

         <div class="speaker-shap">
            <img class="shap1" src="{{ asset('images/shap/home_schedule_memphis2.png') }}" alt="">
         </div>
        </section>

<script type="text/javascript">
       
      function showform(fval) {
          $('.sform').hide()
          $('.mform').hide()
          $( "."+ fval+"form" ).slideDown( "slow", function() {
    // Animation complete.
          });
      }

      function gethcompany(fval) {
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('gethcompany') }}",
                type:'POST',
                data: {_token:_token, 
                     id:fval, 
                      },

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        // console.log(data.success[0]);
                        $('#postalcode').val(data.success[0]['postalcode']);
                        $('#address').val(data.success[0]['address']);
                        $('#addressextra').val(data.success[0]['addressextra']);
                        $('#phone').val(data.success[0]['phone']);

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

         $('#remarkstextarea').on('input', function() {
           text = $('#remarkstextarea').val();
           text = text.replace(/\r?\n/g, '<br />')
           // alert(text);
           $('#remarks').val(text);
         });

        if ($('#hcompany').val() != '0') {
            gethcompany($('#hcompany').val());
        }

        $('#hcompany').change(function(){
           // alert($(this).val());
           gethcompany($(this).val());

        })
        
        $("#addnewproduct").click(function(e){
            
            x = $('a.deleterow').last().data("id");
            x = x+1;
            // alert(x);

            $( "#tableproduct" ).append(' <div class="row" id="row'+x+'"> <div class="col-md-4"> <div class="form-group"> <a class="btnlist btn-secondary deleterow" data-id="'+x+'" href="#" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a> <span style="display:none" class="label'+x+' error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span> <label for="gender_select"><b>項目</b> <span class="badge badge-danger">必須</span></label> <input class="form-control form-control-password required" placeholder="'+x+') 項目" name="label['+x+']" id="label'+x+'" type="text"> </div></div><div class="col-md-2"> <div class="form-group"> <span style="display:none" class="quantity'+x+' error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span> <label for="end"><b>数量</b></label> <span class="badge badge-danger">必須</span></label> <input class="form-control form-control-password totalrowcheck required" data-id="'+x+'" placeholder="数量" name="quantity['+x+']" id="quantity'+x+'" type="text"> </div></div><div class="col-md-2"> <div class="form-group"> <label for="end"><b>単位</b></label></label> <input class="form-control form-control-password" placeholder="単位" name="unit['+x+']" id="unit'+x+'" type="text"> </div></div><div class="col-md-2"> <div class="form-group"> <span style="display:none" class="priceperunit'+x+' error text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span> <label for="end"><b>単価</b></label> <span class="badge badge-danger">必須</span></label> <input class="form-control form-control-password totalrowcheck required" data-id="'+x+'" placeholder="単価" name="priceperunit['+x+']" id="priceperunit'+x+'" type="text"> </div></div><div class="col-md-2"> <div class="form-group"> <label for="end"><b>金額</b></label></label> <input readonly class="form-control form-control-password" placeholder="金額" name="totalrow['+x+']" id="totalrow'+x+'" type="text"> </div></div></div>');



        });

         $('#tableproduct').on('click', '.deleterow', function() {
           // alert($(this).data("id"));
           var count = $("a.deleterow").length;
           if (count > 1) {
              $( "#row"+$(this).data("id") ).remove();
           } else {
              alert('1件目の項目の削除はできません。');
           }

         });

         // $(".totalrowcheck").on("input", function(evt) {
         $('#tableproduct').on('input', '.totalrowcheck', function(evt) {
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
            {
              evt.preventDefault();
            } 

            var id = $(this).data("id");
            // alert($( "#quantity"+id ).val());
            // alert($( "#priceperunit"+id ).val());
            var totalrow = ($( "#quantity"+id ).val()) * ($( "#priceperunit"+id ).val());
            $("#totalrow"+id).val(totalrow);
            // alert(totalrow);
          });

           $(".btn-submit").click(function(e){
               e.preventDefault();

               let cansubmit = true;
               $('.error').hide()
               $('.required').each(function() {
                    if (($(this).val() == '') ||($(this).val() == 'null')) {
                       $('.error.'+$(this).attr("id")).show();
                       cansubmit = false;
                     //   alert($(this).attr("id"));
                    }
                    // else {
                    //     alert('Everything has a value.');

                    // }
               });
               // alert(cansubmit);
               if (cansubmit) {
                  $('#detailModal').modal('show');
                  // $( "#invoice-form" ).submit();
               }
          
           }); 
       
    });


</script>

</x-auth-layout>