<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

      @php $subtitle="イベント詳細"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     イベント詳細
                  </h2>
               </div><!-- col end-->
            </div>

            <!-- Seminar info -->
            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-10 mx-auto">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="email"><b>イベント名：</b>　{{ $data->name }}</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="chuubunrui_select"><b>登録者：</b>　{{ $data->adminname }}
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="startdt"><b>開始日時：</b>　{{ date('Y/m/d H:i', strtotime($data->start)) }}</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="enddt"><b>終了日時：</b>　{{ date('Y/m/d H:i', strtotime($data->end)) }}</label>
                           </div>
                        </div>
                     </div>    

                     <div class="row ">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label><b>イベント内容：</b></label><br>
                              {!! $data->description !!}
                           </div>
                        </div>
                     </div>

               </div>
            </div>

    </section>


</x-auth-layout>