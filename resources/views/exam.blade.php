
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

   <style type="text/css">
      
   .time {
        color: white; 
        margin-top: .5rem;
        margin-bottom: .5rem;
   }

   .header .navbar {
        padding: unset; 
   }

   .header.header-transparent {
      background: #1a1831;
   }

   ts-footer {
      background: #1a1831;
      padding: 0px; 
   }

   .header.sticky.fade_down_effect {
       overflow-y: scroll;
       max-height: 75%;
   }

   .info {
        padding-right: 20px;
        color: white !important;
        font-size: 14px;
        font-weight: 700;
   }

    @media (max-width: 991px){
        .desktopview{
          display: none;
        }

        .header .navbar-collapse {
            max-width: 75%;
            margin-left: auto;
        }
    }

    @media (min-width: 991px){
        .mobileview{
          display: none;
        }
    }

    .noselect {
      -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
         -khtml-user-select: none; /* Konqueror HTML */
           -moz-user-select: none; /* Old versions of Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
                user-select: none; /* Non-prefixed version, currently
                                      supported by Chrome, Edge, Opera and Firefox */
    }

    .header.sticky.fade_down_effect {
        -webkit-animation-name: unset;
        animation-name: unset;
        -webkit-animation-duration: unset;
        animation-duration: unset;
        -webkit-animation-fill-mode: unset;
        animation-fill-mode: unset;
        -webkit-animation-delay:  unset;
        animation-delay:  unset;
    }
  
   </style>


</head>

<!-- @php

print_r(session()->all());

@endphp -->

<body>
   <div class="body-inner noselect">
      <!-- Header start -->
      <header id="header" class="header-transparent" style="background: #1a1831;position: fixed;width: 100%;left: 0;top: 0;z-index: 2;height: auto;">
         <div class="container">
            <div class="info desktopview" style="text-align: center; font-size: 18px;">{{ $test->name ?? "" }}</div>
            <nav class="navbar navbar-expand-lg navbar-light">
               <a class="mobileview navbar-brand" href="{{ url('/') }}">
                <span class="info" style="color: #fff; font-size: 14px; font-weight: 700;"><text>{{ $test->name ?? "" }}<br></text><text class="timer"></text></span>
               </a>

               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                  aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav ml-auto">
                     <li class="mobileview dropdown nav-item show">
                        <a class="" data-toggle="dropdown" aria-expended='true'>解答表示欄</a>
                        <ul class="dropdown-menu show" role="menu">
                          @foreach( $lists as $key => $list )
                           <li style="display: inline-flex; padding-bottom: 5px">
                                <div style="background: #d20055; display: flex; width: 25%;margin-right: 5px;" class="quescroll" data-que="{{ (($loop->index)+1) }}">
                                    <div class="col d-flex justify-content-center" style="margin: auto; color: white;">
                                         {{ 'Q'.(($loop->index)+1) }}
                                    </div>
                                </div>
                                <input style="max-width: 30%;" type="text" class="form-control answerconfirm{{ ($list->id) }}" name="ans[{{ (($loop->index)+1) }}]" readonly>
                           </li>
                          @endforeach
                        </ul>
                     </li>
                     <li class="desktopview nav-item">
                        <a><span class="info timer"></span></a>
                     </li>
                     @if(isset($log->getmark))
                     <li class="desktopview nav-item">
                        <a class="info">得点:{{ $log->getmark ?? "0" }}</a>
                     </li>
                     @endif
                     <li class="desktopview nav-item">
                        <a class="info">試験時間:{{ $test->testminute ?? "00" }}分</a>
                     </li>
                     <li class="desktopview nav-item">
                        <a class="info">満点:{{ $lists->sum('mark') ?? '00' }}点</a>
                     </li>
                     <li class="desktopview nav-item active">
                        <a class="info">問題総数:{{ count($lists) ?? '00' }}問</a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div><!-- container end-->
      </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- 
      <div id="page-banner-area" class="page-banner-area" style="background-image: url('{{ asset('images/hero_area/banner_bg01.jpg')}}');">

      </div> -->
      <!-- Page Banner end -->

      <style type="text/css">
         
      .faq-item .faq-list h4 a:before {
           content: unset; 
      }

      .section-title, .column-title {
           padding-bottom: unset; 
      }

      .section-title:after, .column-title:after {
          background-image: unset;
      }

		.page-banner-area {
		    min-height: 200px;
		}

		.section-title, .column-title {
		    color: unset; 
		    font-size: 26px;
		}

		.column-title {
		    margin-bottom: 10px;
		}

  .chooseans  {
  background:url('/icon_true.png') no-repeat center;
  background-size: contain;
  }

      .btn:hover {

           /*-webkit-box-shadow: unset; 
           box-shadow: unset;*/ 
           cursor: unset;
      }

      </style>

<script>
// Set the date we're counting down to
  @if(!isset($log->getmark) AND !isset($log->fullmark))

    @php
    if (!empty($log->end)) {
        $finishtime = $log->end;
    } else {
        if (!empty($test->testminute)) {
            $finishtime = '+'.$test->testminute.' minutes'; 
        } else {
            $finishtime = '+60 minutes'; 
        }
    }
    
    $finishtime = date(' F j, Y H:i:s', strtotime($finishtime)); 
    @endphp

    // alert('{{$finishtime}}');

    var countDownDate = new Date("{{ $finishtime }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="demo"

    $('.timer').text("残り時間: " + minutes + "分" + seconds + "秒");
    $('.timer').show("slow");
    // document.getElementById("demo").innerHTML = "残り時間: " + minutes + "分" + seconds + "秒";
      
    // If the count down is over, write some text 
    if (distance < 0) {
        $('#submitcheck').val('1');
        // updatelog();
          $( "#submittest" ).submit();
         // window.close('','_parent','');
         // Window.close();
      }
    }, 1000);

  @endif
</script>
  
      <section class="ts-faq-sec" style="padding: 120px 0">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  @php
                    $alphabet = range('A', 'Z');
                  @endphp


                  @foreach( $lists as $key => $list )
                  
                  @if(!empty($list->instruction))
                  <h4 class="panel-title" style="font-weight: unset;">
                      {!! $list->instruction !!}
                   </h4>
                  @endif
                  
                  @if(!empty($list->content))
                  <h4 class="panel-title" style="font-weight: unset;">
                      {!! $list->content !!}
                   </h4>
                  @endif

                  @if(!empty($list->contentimg))
                  <!-- <div bis_skin_checked="1" style="text-align: left;"> -->
                     <img src="{{ url('/images/'.$list->contentimg) }}" style="width: 100%">
                  <!-- </div> -->
                  @endif

                  @if(!empty($list->contentmp3))
                  <div bis_skin_checked="1" style="text-align: left;">
                      <audio controls controlsList="nodownload">
                        <source src="{{ url('/audio/'.$list->contentmp3) }}" type="audio/mpeg">
                      Your browser does not support the audio element.
                      </audio>
                  </div>
                  @endif

                  <!-- (($loop->index)+1).') '. $( "#target" ).scroll();-->
                  <div class="faq-content mb-70 form-group" id="{{ 'que'.(($loop->index)+1) }}">
                  	
                  <button type="button" class="btn btn-default" style="height: unset; line-height: unset;">{{ 'Q'.(($loop->index)+1) }}</button>
                  <button type="button" class="btn btn-default" style="height: unset; line-height: unset; background: #7ebcbb;">{{ $list->mark.' 点' }}</button>

                    @if( (!isset($log->fullmark) AND !isset($log->getmark)) == false OR (!isset($log->id)) )
                    <button type="button" class="btn btn-default" style="height: unset; line-height: unset; background: #285ccc;">{{ '正解 '.$alphabet[($list->correctans-1)] }}</button>
                    @endif

                   <h4 class="panel-title" style="font-weight: unset;">
                      {!! $list->question !!}
                   </h4>
                  
                  @if(!empty($list->questionimg))
                     <img src="{{ url('/images/'.$list->questionimg) }}" style="width: 100%">
                  @endif

                  @if(!empty($list->questionmp3))
        					<audio controls controlsList="nodownload">
        					  <source src="{{ url('/audio/'.$list->questionmp3) }}" type="audio/mpeg">
        					Your browser does not support the audio element.
        					</audio>
                  @endif

                     <div class="panel-group faq-item" id="accordion" role="tablist" aria-multiselectable="true">

                      @if($list->ansformat == '1')

                            <div class="form-group">
                              <input class="form-control form-control-email" name="anskeyin" id="anskeyin"
                                 type="text" style="display: inline-block;">
                            </div>

                      @else

                          @for ($i = 1; $i <= $list->ansformat; $i++)
                              <div class="panel faq-list panel-default">
                                 <div class="panel-heading answerbox answerbox{{ $list->id }}" data-que="{{ $list->id }}" data-value="{{$i}}" role="tab">
                                    <h4 class="panel-title" style="font-weight: unset;">
                                       <a role="button" data-toggle="collapse" data-parent="#accordion">
                                          <span style="padding-left:5px;width: 30px;display: inline-block;" class="answerbox answerbox{{ $list->id }}" data-que="{{ $list->id }}" data-value="{{$i}}">{{$alphabet[$i-1]}}</span> {{ $list->{'ans'.$i} }}
                                       </a>
                                    </h4>
                                 </div>
                              </div>
                          @endfor

                      @endif


                     </div><!-- panel-group -->

                  </div>
                  @endforeach


               </div><!-- col end -->
               @if(isset($log->answer))
               <input type="hidden" name="answerlist" id="answerlist" value="{{$log->answer ?? ''}}">
               @endif

               <div class="col-lg-4 desktopview" id="answerform">
                  <div class="sidebar-widgets header" style="top: 100px; left: unset; background: unset; width: unset;">
                     <div class="widget asq-form">
                        <form id="submittest" class="form-horizontal" action="{{ route('updatelog') }}" method="POST">
                        
                        <input type="hidden" name="submitcheck" id="submitcheck">
                        <input type="hidden" name="submitbutton" id="submitbutton">
                        
                        @if(!empty($log->id))  
                        <input type="hidden" name="logid" value="{{ $log->id }}">
                        @endif

                        @if(!empty($test->id))  
                        <input type="hidden" name="testid" value="{{ $test->id }}">
                        @endif
                        @csrf
                          @foreach( $lists as $key => $list )
                          <div class="form-group quescroll" style="display: flex;" data-que="{{ (($loop->index)+1) }}">
                            <!-- <button type="button" class="btn btn-default" style="height: unset; line-height: unset;"></button> -->
                              <div style="background: #d20055; display: flex; width: 25%">
                                  <div class="col d-flex justify-content-center" style="margin: auto; color: white;">
                                       {{ 'Q'.(($loop->index)+1) }}
                                  </div>
                              </div>
                              <input style="margin-left: 5px;width: 50%;" type="text" class="form-control answerconfirm{{ ($list->id) }}" readonly>
                              <input type="hidden" name="ans[{{ $list->id }}]" class="answervalue{{ $list->id }}">
                            <!-- <div class="col-sm-10">          
                            </div> -->
                          </div>
                          @endforeach

                        </form>
                     </div>

                  </div>
               </div>

               <!-- col end-->

            </div><!-- row end-->
         </div><!-- .container end -->

               <div class="modal fade" id="submitconfirmmodal" tabindex="-1" role="dialog" aria-labelledby="submitconfirmmodal" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">試験を提出</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p style="font-weight: bold">試験を提出すると試験が終了となります。</p>
                        <p style="font-weight: bold">試験を提出しますか？</p>
                     </div>
                     <div class="modal-footer">
                        <button id="submitbtn" type="button" class="btn btn-danger">提出する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>


      </section><!-- End faq section -->



  <script type="text/javascript">


  function toAlpha(num) {
     if(num < 1 || num > 26 || typeof num !== 'number'){
        return -1;
     }
     const leveller = 64;
     //since actually A is represented by 65 and we want to represent it with one
     return String.fromCharCode(num + leveller);
  };

  function updatelog() {
      // var _token = $("input[name='_token']").val();

      let formData = new FormData(submittest);

      $.ajax({
          url: "{{ route('updatelog') }}",
          type:'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(data) {
                  console.log(data);
              // if($.isEmptyObject(data.error)){
              //     alert("success");

              // }else{
              //     // alert("err");
              //     console.log(data.error);

              // }
          },
          fail: function(data) {
                  alert("errqqqq");
          }
      });
  }


  $(function() {

          $('.container').bind("cut copy paste",function(e) {
              e.preventDefault();
          });

          $('.quescroll').click(function() {
              // alert($(this).attr("data-que"));
              $target = $('#que'+$(this).attr("data-que"));

              $('html, body').stop().animate({
                  'scrollTop': $target.offset().top-140
              }, 900, 'swing', function () {
                  window.location.hash = target;
              }); 
          });

          if ($('#answerlist').val()) {
              var answerarr = jQuery.parseJSON( $('#answerlist').val() );
              // console.log(answerarr);
              
              if (answerarr) {
                  $.each(answerarr, function( index, value ) {
                    // alert( index + ": " + value );
                    if(value){
                        $('.answerconfirm'+index).val(toAlpha(parseInt(value)));
                        $('span[data-que="'+index+'"][data-value="'+value+'"]').addClass("chooseans");
                    }
                  });
              }
          }

          @if(!isset($log->getmark) AND !isset($log->fullmark))

          $('#submitconfirm').click(function() {
              $('#submitconfirmmodal').modal('show');
          });

          $('#submitbtn').click(function() {

          	   $('#submitcheck').val('1');
               $('#submitbutton').val('1');
          	// updatelog();
               $( "#submittest" ).submit();
               // window.close('','_parent','');
               // Window.close();
          	
          });

          $('.answerbox').click(function() {
              $('span.answerbox'+$(this).attr("data-que")).removeClass("chooseans");
              $('span[data-que="'+$(this).attr("data-que")+'"][data-value="'+$(this).attr("data-value")+'"]').addClass("chooseans");

              var ansalphabet = toAlpha(parseInt($(this).attr("data-value")));
              $('.answerconfirm'+$(this).attr("data-que")).val(ansalphabet);
              $('.answervalue'+$(this).attr("data-que")).val($(this).attr("data-value"));
              

              @if(!empty($test->id) AND !empty($log->id)) 
              updatelog();
              @endif
          
          });

          @endif
  });
      // $(document).ready(function() {


      //     $('.answerbox').click(function() {
      //         // var row = $(this).closest('tr');
      //         alert('eee');
      //     });

      // });

  </script>

      <div class="footer-area">
         <!-- footer start-->
         <footer class="ts-footer" style="padding: 0;  position: fixed;left: 0; bottom: 0;width: 100%;">
            <div class="container">
               <div class="row">
                  <div class="mx-auto">
                    <div class="text-center" style="padding: 10px 10px 10px 10px;height: 73px;line-height: 50px;" bis_skin_checked="1">
                         @if(!isset($log->fullmark) AND !isset($log->getmark))
                        <button id="submitconfirm" class="btn" type="submit" @if(!isset($log->id)) disabled @endif>試験提出</button>
                         @else
                         <text>
                         コンテンツ（記事・画像・音声）の無断での一部引用・全文引用・流用・複写・転載について固く禁じます
                         @endif
                         </text>
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