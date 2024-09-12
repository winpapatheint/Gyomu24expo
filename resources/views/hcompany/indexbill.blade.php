<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">
<style type="text/css">
   .payamount-influencers {
      display:none;
   }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->

      @php $subtitle=__('auth.managebill'); @endphp
      @include('hcompany.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{ __('auth.billlist') }}
                  </h2>
               </div><!-- col end-->
            </div>
<!--             <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="register_new_seminar.html">
                        <i class="fa fa-plus" aria-hidden="true"></i> セミナーの新規登録</a>
                  </p>
               </div>
            </div> -->

            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">

               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">{{ __('user.keywordsearch') }}</label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.taskname') }}" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>                    
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start">{{ __('auth.taskstart') }}</label>
                              <input class="form-control form-control-password" placeholder="決済日付" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">{{ __('auth.taskend') }}</label>
                              <input class="form-control form-control-password" placeholder="決済日付" name="end" id="end"
                                 type="date" value="{{ $_GET['end'] ?? ''}}">
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
                           {{ __('user.dosearch') }}</button>
                     </div>
                  </form>
               </div>
            </div>

            @include('components.messagebox')
            
            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th style="min-width: 100px" scope="col">{{ __('user.taskdate') }}</th>
                          <th scope="col">{{ __('user.taskno') }}</th>
                          <th style="min-width: 115px" scope="col">{{ __('user.taskname') }}</th>
                          <th style="min-width: 100px" scope="col" class="pay-amount">{{ __('auth.moneyout') }}</th>
                          <th style="min-width: 100px" scope="col" class="influencer-name">{{ __('auth.inflname') }}</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr class="col-12 col-sm-12 col-md-12 d-flex-sm d-flex-md flex-wrap h-100">
                          <td scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                          <td data-label="{{ __('user.taskdate') }}">{{ date('Y/m/d', strtotime($list->created_at)) }}</td>
                          <td data-label="{{ __('user.taskno') }}">{{ sprintf('%06d', $list->id) }}</td>
                          <td data-label="{{ __('user.taskname') }}">{{ $list->Taskname }}</td>
                          <td data-label="{{ __('auth.moneyout') }}" class="pay-amount">{{ number_format($list->moneyout) }} 円</td>
                          <td data-label="{{ __('auth.inflname') }}" class="influencer-name">{{ $list->Influencername }}</td>
                        </tr>
                        @endforeach                                                                    

                      </tbody>
                  </table>
                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  入金されたデータがありません。
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
       

       $(document).ready(function() {
   
           $(window).on('load resize', function() {
               var currWidth = $(window).width();
               if (currWidth < 1200) {
                  $(".pay-amount").hide();
                  $(".influencer-name").hide();
                  $(".payamount-influencers").show();
               } 
               else {
                  $(".pay-amount").show();
                  $(".influencer-name").show();
                  $(".payamount-influencers").hide();
               }
           }); 
          
       });
   </script>

</x-auth-layout>