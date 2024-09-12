<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">
  
.table td.unsettopborder, .table th.unsettopborder {
  border-top:unset;
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php 
        if(auth()->user()->role == 'admin'){
            $subtitle="セミナー/試験管理"; 
        } else {
            $subtitle="統計分析"; 
        }
      @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     試験成績分析
                  </h2>
               </div><!-- col end-->
            </div>



            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>キーワード</b></label>
                              <input class="form-control form-control-email" 
                                  @if(auth()->user()->role == 'admin')
                                  placeholder="試験名・講師名・主催会社・受験者名"
                                  @elseif (auth()->user()->role == 'hcompany') 
                                  placeholder="試験名・講師名・受験者名"
                                  @elseif (auth()->user()->role == 'host') 
                                  placeholder="試験名・受験者名"
                                  @endif
                                  name="kword" id="kword" type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start"><b>開始日</b></label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end"><b>終了日</b></label>
                              <input class="form-control form-control-password" placeholder="終了日時" name="end" id="end"
                                 type="date" value="{{ $_GET['end'] ?? ''}}">
                           </div>
                        </div>
                     </div>    
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="b_type"><b>大分類</b></label>
                              <select class="form-control" name="b_type" id="b_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <!-- <option value="0">大分類を選択してください</option> -->
                                <!-- <option value=".b1">セミナー</option>                    -->
                                <!-- <option value=".b2">説明会</option>                                     -->
                                <option value=".b3" selected="true">IBT試験</option>                                    
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="fee"><b>種類</b></label>
                              <select class="form-control" name="fee" id="fee"
                              style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                 <option value="">種類を選択してください</option>
                                 <option value="1">無料</option>                   
                                 <option value="2">有料</option>                                    
                              </select>
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="m_type"><b>中分類</b></label>
                              <select class="form-control" name="m_type" id="m_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">大分類を選択してください</option>                 
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="s_type"><b>小分類</b></label>
                              <select class="form-control" name="s_type" id="s_type"
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                <option value="">中分類を選択してください</option>                  
                              </select>
                           </div>
                        </div>
                     </div>       
                  @if ($message = Session::get('errorsearch'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                  </div>
                  @endif
                                   
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-search"></i>
                           検索する</button>
                     </div>
                  </form>
               </div>
            </div>

            @include('components.messagebox')
            
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
               問題番号の右側の数字は得点です
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">開始日</th>
                          <th scope="col">試験名</th>
                          <th scope="col">受験者名</th>
                          <th style="min-width: 57px" scope="col">満点</th>
                          <th style="min-width: 57px" scope="col">得点</th>
                        </tr>
                      </thead>
                      <tbody>

                        @php

                         $agestring = array("10" => "10歳以下",                   
                                            "20" => "10歳～20歳",                   
                                            "30" => "20歳～30歳",                   
                                            "40" => "30歳～40歳",                   
                                            "50" => "40歳～50歳",                   
                                            "60" => "50歳以上",
                                            "" => ""
                                        );

                        @endphp

                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="試験日">{{ date('Y/m/d', strtotime($list->teststart)) }}<br>{{ date('H:i', strtotime($list->teststart)) }}</td>
                          <td data-label="試験名">{{ $list->testname }}</td>
                          <td data-label="受験者名">{{ $list->answerername }}</td>
                          <td data-label="満点">{{ $list->fullmark }}</td>
                          <td data-label="得点">{{ $list->getmark }}</td>
                        </tr>

                        @if(!empty($list->checklog))
                        <tr>
                            <td colspan="6" class="unsettopborder">
                             <table class="table table-bordered">
                               @foreach( $list->checklog as $k => $value )
                               <tr>
                                 <td>{{ 'Q'.($loop->index+1) }}</td>
                                 <td>{{ $value }}</td>
                               </tr>
                              @endforeach
                             </table>
                            </td>

                        </tr>
                        @endif

                        @endforeach                                                                    
                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  受験されたデータがありません。
                  </div>
                  @endif
                </div>

                @include('components.pagination')




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
                          if (value['code'] == selectval) {
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

      let searchParams = new URLSearchParams(window.location.search)
      if (searchParams.has('fee')) {
          $('#fee').val(searchParams.get('fee'));        
      }


      let b_type = searchParams.get('b_type')
      if (searchParams.has('b_type')) {
          $('#b_type').val(b_type);        
      }

      if ($('#b_type').val() != '0') {
          let m_type = searchParams.get('m_type')
          // gettypechild($('#b_type').val(),'#m_type','中分類を選択してください',m_type);
          // alert("122");
          $.when($.ajax(gettypechild($('#b_type').val(),'#m_type','中分類を選択してください',m_type))).then(function () {

              // alert('2');
                if ($('#m_type').val() != '0') {
                    let s_type = searchParams.get('s_type')
                    gettypechild($('#m_type').val(),'#s_type','小分類を選択してください',s_type);
                }

          });


      }


      $('#b_type').change(function(){
          gettypechild($(this).val(),'#m_type','中分類を選択してください');
          $('#s_type').empty();
          $('#s_type').append(new Option('中分類を選択してください', '0', true, true));
      })


      $('#m_type').change(function(){
          // alert($(this).val());
          gettypechild($(this).val(),'#s_type','小分類を選択してください');

      })


       
    });



</script>


</x-auth-layout>