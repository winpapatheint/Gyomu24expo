
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Basic Page Needs ================================================== -->
   <meta charset="utf-8">

   <!-- Mobile Specific Metas ================================================== -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

   <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="32x32">

   <!-- Site Title -->
   <title>Seminar Navi</title>



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

   <style type="text/css">
      
   .time {
        color: black; 
        margin-top: .5rem;
        margin-bottom: .5rem;
   }

   .header .navbar {
        padding: unset; 
   }

   .header.header-transparent {
      background: lightgrey;
   }

   ts-footer {
      background: #1a1831;
      padding: 0px; 
   }

   .header.sticky.fade_down_effect {
       overflow-y: scroll;
       max-height: 75%;
   }
   </style>


</head>

<!-- @php

print_r(session()->all());

@endphp -->

<body>
   <div class="body-inner">
      <!-- Header start -->
      <header id="header" class="header header-transparent">
         <div class="container" style="color: black;">
            <nav class="navbar navbar-light">
               <div class="" style="margin: auto;">
                  <h4 class="time" id="testname"></h4>
               </div>
            </nav>
            <nav class="navbar navbar-light">
               <!-- logo-->
<!--                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset('images/logos/logo-v3.png') }}" alt="">
               </a> -->
               <div class="">
                  <h4 class="time">問題総数:40問</h4>
               </div>
               <div class="">
                  <h4 class="time">試験時間:60分</h4>
               </div>
               <div class="">
                  <h4 class="time">満点:60点</h4>
               </div>
               <div class="">
                  <h4 id="demo" class="time"></h4>
               </div>
            </nav>
         </div><!-- container end-->
      </header>
      <!--/ Header end -->
            {{ $slot }}
      <!-- ts footer area start-->
      <div class="footer-area">
         <!-- footer start-->
         <footer class="ts-footer" style="padding: 0 0 50px;">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 mx-auto">
                     <!-- <div class="ts-footer-social text-center mb-30">
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
                     </div> -->
                     <!-- footer social end-->
                     <!-- <div class="footer-menu text-center mb-25">
                        <ul>
                           <li><a href="{{ url('/aboutus') }}">About Us</a></li>
                           <li><a href="{{ url('/gallery') }}">写真集</a></li>
                           <li><a href="{{ url('/faq') }}">よくあるご質問</a></li>
                           <li><a href="{{ url('/blog') }}">新着情報</a></li>
                           <li><a href="{{ url('/privacy') }}">プライバシーポリシー</a></li>
                           <li><a href="{{ url('/contact') }}">お問い合わせ</a></li>
                        </ul>
                     </div> -->
                     <!-- footer menu end-->
                     <div class="copyright-text text-center">
                        <p>Copyright © 2021 Asia Human Development, Inc. All Rights Reserved.</p>
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