
<!DOCTYPE html>
<html lang="en">

<style type="text/css">
   
.lang-select {
   min-width: 20px !important;
}

</style>


<head>
   <!-- Basic Page Needs ================================================== -->
   <meta charset="utf-8">

   <!-- Mobile Specific Metas ================================================== -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

   <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="32x32">

   <!-- Site Title -->
   <title>顧客管理システム</title>



   <!-- CSS
         ================================================== -->
   <!-- Bootstrap -->
   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

   <!-- FontAwesome -->
   <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
   <!-- Animation -->
   <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
   <!-- magnific -->
   <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
   <!-- carousel -->
   <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
   <!-- isotop -->
   <link rel="stylesheet" href="{{ asset('css/isotop.css') }}">
   <!-- ico fonts -->
   <link rel="stylesheet" href="{{ asset('css/xsIcon.css') }}">
   <!-- Template styles-->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <!-- Responsive styles-->
   <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

</head>

<!-- @php

print_r(session()->all());

@endphp -->



<body>
   <div class="body-inner">
      <!-- Header start -->
      <header id="header" class="header header-transparent">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <!-- logo-->
               <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="http://test.24expo.net/images/logos/logo-v3.png" alt="">
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                  aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavDropdown">
<!--                   <ul class="navbar-nav ml-auto">

                     <li class="nav-item">
                        <a href="{{ url('/news') }}">{{ __('headfoot.titleblog') }}</a>
                     </li>

                     <li class="nav-item">
                        <a href="{{ url('/contact') }}">{{ __('headfoot.ttlecontact') }}</a>
                     </li>
                     <li class="header-ticket nav-item">
                          <form method="POST">
                          <a class="ticket-btn btn" style='padding: 0px 10px;' href="{{ route('login') }}"> {{ __('headfoot.login') }}</a>
                          </form>
                     </li>

                     <li class="header-ticket nav-item">
                          <form method="POST">
                          <a class="ticket-btn btn" style='padding: 0px 10px;' href="{{ url('/selectregister') }}"> {{ __('headfoot.register') }}</a>
                          </form>
                     </li>

                     <li class="header-ticket nav-item">
                          <form method="POST">
                          <a class="ticket-btn btn" style='padding: 0px 10px; color: white;' href="{{ url('/foremployee') }}"> {{ __('求職希望の方はこちら') }}</a>
                          </form>
                     </li>

          
                  </ul> -->
               </div>
            </nav>
         </div><!-- container end-->
      </header>
      <!--/ Header end -->
            {{ $slot }}
      <!-- ts footer area start-->
      <div class="footer-area">
         <!-- footer start-->
         <footer class="ts-footer" style="padding-top: 50px;">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 mx-auto">
                     <div class="ts-footer-social text-center mb-30">
                        <ul>
                           <li>
                              <a href="#"><i class="fa fa-facebook"></i></a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-google-plus"></i></a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                           </li>
                        </ul>
                     </div>
                     <!-- footer social end-->
                     <div class="footer-menu text-center mb-25">
                        <ul>
                           <li>アジア人材開発株式会社</li>
                           <!-- <li><a href="{{ url('/gallery') }}">写真集</a></li> -->
<!--                            <li><a href="{{ url('/news') }}">{{ __('headfoot.titleblog') }}</a></li>
                           <li><a href="{{ url('/faq') }}">{{ __('headfoot.ttlefaq') }}</a></li>
                           <li><a href="{{ url('/privacy') }}">{{ __('headfoot.ttlepolicy') }}</a></li>
                           <li><a href="{{ url('/contact') }}">{{ __('headfoot.ttlecontact') }}</a></li> -->
                        </ul>
                     </div><!-- footer menu end-->
                     <div class="copyright-text text-center">
                        <p>Copyright © 2022 {{ env('APP.ENV') }} All Rights Reserved.</p>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer end-->
         <div class="BackTo">
            <a href="#" class="fa fa-angle-up" aria-hidden="true"></a>
         </div>

      </div>
      <!-- ts footer area end-->




      <!-- Javascript Files
            ================================================== -->
      <!-- initialize jQuery Library -->
      <script src="{{ asset('js/jquery.js') }}"></script>

      <script src="{{ asset('js/popper.min.js') }}"></script>
      <!-- Bootstrap jQuery -->
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <!-- Counter -->
      <script src="{{ asset('js/jquery.appear.min.js') }}"></script>
      <!-- Countdown -->
      <script src="{{ asset('js/jquery.jCounter.js') }}"></script>
      <!-- magnific-popup -->
      <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
      <!-- carousel -->
      <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <!-- Waypoints -->
      <script src="{{ asset('js/wow.min.js') }}"></script>
    
      <!-- isotop -->
      <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>

      <!-- Template custom -->
      <script src="{{ asset('js/main.js') }}"></script>

   </div>
   <!-- Body inner end -->
</body>

</html>