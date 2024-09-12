
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
   <title>{{ $test->name ?? "" }}</title>



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

</head>

<!-- @php

print_r(session()->all());

@endphp -->

<body>
   <div class="body-inner noselect">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <section class="ts-faq-sec" style="padding: 120px 0">
               <div class="modal fade" id="submitconfirmmodal" tabindex="-1" role="dialog" aria-labelledby="submitconfirmmodal" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">お知らせ</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p style="font-weight: bold">{{ $msg ?? '' }}</p>
                     </div>
                     <div class="modal-footer">
                        <!-- <button id="submitbtn" type="button" class="btn btn-danger">試験を提出する</button> -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>


      </section><!-- End faq section -->



  <script type="text/javascript">


  $(function() {

          $('.container').bind("cut copy paste",function(e) {
              e.preventDefault();
          });

          $('#submitconfirmmodal').modal('show');

          $('#submitconfirmmodal').on('hidden.bs.modal', function () {
               window.close('','_parent','');
               Window.close();
          });


  });
      // $(document).ready(function() {


      //     $('.answerbox').click(function() {
      //         // var row = $(this).closest('tr');
      //         alert('eee');
      //     });

      // });

  </script>

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