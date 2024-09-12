<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Basic Page Needs ================================================== -->
   <meta charset="utf-8">

   <!-- Mobile Specific Metas ================================================== -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
   <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="32x32"> 

   <!-- Site Title -->
   <title>顧客管理システム</title>



<style type="text/css">
  
.badgenoti {
    top: 10px;
    right: 10px;
    /* margin: -2px 0px 3px; */
    padding: 2px 6px;
    border-radius: 50%;
    background: red;
    color: white;
}

.overflow {
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.table th {
    padding: 0rem; 
    vertical-align: inherit !important;
    border-top: 1px solid #e9ecef;
    font-weight: 400;
}

table tr{
   height: 40px;
}

table tbody{
  background: #f0f3ff;
}

table thead {
  background: #304586;
  color: white;
}

.table td {
  vertical-align: middle;
  padding-left: 0.45rem;
  padding-right: 0.45rem;
}

</style>




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

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('29b8fc8a5fed140016cb', {
      cluster: 'ap3'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>

  

   <style>

      .btnlist {
          font-size: 14px;
          font-weight: 200;
          color: #fff;
          text-transform: uppercase;
          background: #ff007a;
          height:30px;
          padding: 5px 10px;
          border-radius: 3px;
          -webkit-border-radius: 3px;
          -ms-border-radius: 3px;
          -o-transition: all 0.4s ease;
          transition: all 0.4s ease;
          -webkit-transition: all 0.4s ease;
          -moz-transition: all 0.4s ease;
          -ms-transition: all 0.4s ease;
          outline: none;
          text-decoration: none;
          cursor: pointer;
      }

      .btn-danger,
      .btn-danger:hover {
         background-color: #c82333;
      }

      .btn-success,
      .btn-success:hover {
         background-color: #218838;
         color: white;
      }

     .btn-primary,
     .btn-primary:hover {
         background-color: #0069d9;
         color: white;
     }

     .btn-secondary,
     .btn-secondary:hover {
         background-color: #727b84;
         color: white;
      }

      .btn-detail,
      .btn-detail:hover {
         background-color: #9eb8d3;
         color: white;
      }

      .btn-warning,
      .btn-warning:hover {
         background-color: #d39e00;
      }

     .page-item.active .page-link {
         background: #ff0763;
         border: 1px solid transparent;
     }
   </style>

</head>
<!-- 
@php

print_r(session()->all());

@endphp -->

<body>
   <div class="body-inner">
      <!-- Header start -->
      <header id="header" class="header header-transparent">
          @auth
         <p class="welcometag" style="background:#ff007a; color:white; ">{{ __('auth.welcome', ['name' => auth()->user()->name]) }}</p>
         @endauth
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <!-- logo-->
               <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="http://test.24expo.net/images/logos/logo-v3.png" alt="">
               </a>

               @auth

               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                  aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"><i class="icon icon-menu"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav ml-auto">

                     @if(auth()->user()->role == 'admin')

                     <li class="nav-item"><a href="{{ url('/admin/exhibit') }}">出展管理</a></li>
                     <li class="nav-item"><a href="{{ url('/admin/agent') }}">顧客管理</a></li>
                     <li class="nav-item"><a href="{{ url('/admin/pic') }}">担当者管理</a></li>
                     <li class="nav-item"><a href="{{ url('/admin/nego') }}">商談管理</a></li>
                     <li class="nav-item"><a href="{{ url('/admin/agreement') }}">契約管理</a></li>


                     <li class="dropdown nav-item active">
                        <a href="#" class="" data-toggle="dropdown">帳簿管理 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/admin/quotation') }}">見積書管理</a></li>

                              <li><a href="{{ url('/admin/order') }}">注文書管理</a></li>
                              <li><a href="{{ url('/admin/invoice') }}">請求書管理</a></li>
                              <li><a href="{{ url('/admin/bill?start='.date('Y-m-01').'&end='.date('Y-m-t') ) }}">売上管理</a></li>

                        </ul>
                     </li>

                     <li class="dropdown nav-item active">
                        <a href="#" class="" data-toggle="dropdown">その他 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                              @if(auth()->user()->id == '1')
                              <li><a href="{{ url('/admin/subadmin') }}">管理者管理</a></li>
                              @endif
                              @if(auth()->user()->id == '1')
                              <li><a href="{{ url('/admin/topsetting') }}">会社情報</a></li>
                              @endif
                        </ul>
                     </li>


                     <li class="nav-item"><a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li>

                     @elseif (auth()->user()->role == 'hcompany')
<!--                      <li class="dropdown nav-item active">
                        <a href="#" class="" data-toggle="dropdown">人材管理 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/agent') }}">人材一覧</a></li>
                              <li><a href="{{ url('/hcompany/registerhost') }}">人材登録</a></li>
                        </ul>
                     </li> -->

                     <li class="nav-item"><a href="{{ url('/agent') }}">{{ __('auth.infllist') }}</a></li>
                     <li class="nav-item"><a href="{{ url('/agent/job') }}">{{ __('求人管理') }}</a></li>

                     <li class="nav-item"><a href="{{ url('/hcompany/bill') }}">{{ __('auth.managebill') }}</a></li>

                     <li class="nav-item"><a href="{{ url('/edit/agent/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li>



                     @elseif (auth()->user()->role == 'host')
                     <li class="nav-item"><a href="{{ url('/host/seminars') }}">{{ __('welcome.managetask') }}</a></li>
              
                     <!-- <li class="dropdown nav-item active">
                        <a href="#" class="" data-toggle="dropdown">セミナー管理 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/host/seminars') }}">セミナー照会</a></li>
                              <li><a href="{{ url('/host/registerseminar') }}">セミナー登録</a></li>
                        </ul>
                     </li> -->
                     <!-- <li class="nav-item"><a href="{{ url('/host/payment') }}">{{ __('welcome.payment') }}</a></li> -->
<!--                      <li class="nav-item"><a href="{{ url('/host/sales') }}">売上管理</a></li>
                     <li class="dropdown nav-item active">
                        <a href="#" class="" data-toggle="dropdown">統計分析 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/host/analayticmarketing') }}">マーケット分析</a></li>
                              <li><a href="{{ url('/host/analayticexam') }}">試験成績分析</a></li>
                              <li><a href="{{ url('/host/analayticdifficulty') }}">問題難易度分析</a></li>
                        </ul>
                     </li> -->
                     <li class="nav-item"><a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li>
                     @elseif (auth()->user()->role == 'user')
                     <!-- <li class="nav-item"><a href="{{ url('/user') }}">スケジュール</a></li> -->
                     <li class="nav-item"><a href="{{ url('/application') }}">{{ __('welcome.managetask') }}</a></li>
                     <!-- <li class="nav-item"><a href="{{ url('/indexresult') }}">受験履歴</a></li> -->
                     <li class="nav-item"><a href="{{ url('/joinedseminars') }}">{{ __('手数料管理') }}</a></li>
                     <!-- <li class="nav-item"><a href="{{ url('/cart') }}">カート</a></li> -->
        
                     <li class="nav-item"><a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li>
                     @endif

                     <li class="dropdown nav-item active" id="notilist" style="display: none">
                        <a data-toggle="dropdown"><span><i class="fa fa-bell" style="display: contents; font-size: 130% !important;"></i><span id="totalnoti" class="badgenoti" style="display: none">0</span></span></a>
                        <ul style="color: #188fff" id="notiul" class="dropdown-menu" role="menu">
                              <!-- <li><a><i class="fa fa-circle" style="padding-right: 8px" aria-hidden="true"></i>セミナー照会</a></li>
                              <li><a><i class="fa fa-circle-o" style="padding-right: 8px" aria-hidden="true"></i>セミナー登録</a></li> -->
                        </ul>
                     </li>


                     <li class="header-ticket nav-item">
                      @if (session()->has('isadmincontrol'))
                          <form method="POST" action="{{ route('returnadmin') }}">
                          @csrf
                          <input type="hidden" name="adminid" value="{{ session()->get('isadmincontrol') }}">
                          <input type="hidden" name="returnurl" value="{{ session()->get('returnurl') }}">
                          <a class="ticket-btn btn" style='padding: 0px 10px; background: #c82333;' href="{{ route('returnadmin') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            @if(session()->get('rolecontrol') == 'hcompany')エージェント会社@else管理者@endifへ戻る</a>
                          </form>
                      @else
                          <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a class="ticket-btn btn" style='padding: 0px 10px;' href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> {{ __('welcome.logout') }}</a>
                          </form>
                      @endif
                     </li>   
                  </ul>
               </div>
               @endauth

            </nav>
         </div><!-- container end-->
      </header>
      <!--/ Header end -->
            {{ $slot }}

                <!-- Modal -->
               <div class="modal fade" id="askconfirmbox" tabindex="-1" role="dialog" aria-labelledby="askconfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="askconfirmtitle">kakunin title</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="askconfirmtext">kakunin message</p>
                     </div>
                     <div class="modal-footer" style="border-top: unset;">
                        <button type="button" id='yes' class="btn btn-danger" >yes</button>
                        <button type="button" id='no' class="btn btn-secondary" data-dismiss="modal" >{{ __('auth.close') }}</button>
                     </div>
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="downloadmodel" tabindex="-1" role="dialog" aria-labelledby="downloadmodelLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="downloadmodellLabel">ダウンロード</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>1) <a href="{{ url('/downloadguidance?d=履歴書_テンプレート.xls') }}">履歴書</a></p>
                        <p>2) <a href="{{ url('/downloadguidance?d=職務経歴書_テンプレート.doc') }}">職務経歴書</a></p>
                        <p>3) <a href="{{ url('/downloadguidance?d=その他の書類_テンプレート.doc') }}">その他の書類</a></p>
                     </div>
                     <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>


              <script type="text/javascript">
                    
                function askconfirmboxshow($this,$formid) {
                      if ($this.data('askconfirmtitle')) {
                        $('#askconfirmtitle').text($this.data('askconfirmtitle')); 
                      }

                      if ($this.data('askconfirmtext')) {
                        $('#askconfirmtext').text($this.data('askconfirmtext')); 
                      }

                      if ($this.data('yes')) {
                        $('#yes').text($this.data('yes')); 
                      }

                      $('#askconfirmbox').modal('show');
                      
                      $('#yes').click(function() {
                        if(!$formid){
                          $this.closest("form").submit();
                        } else {
                          $("#"+$formid).submit();
                        }
                      });        
                }


                $(document).ready(function() {

                   

                  $(".askconfirm").click(function(e){
                      // console.log($(this).closest("form").attr("id"));
                      
                      e.preventDefault();
                      askconfirmboxshow($(this));

                  }); 

                });

              </script>




               <div class="modal fade" id="noti" tabindex="-1" role="dialog" aria-labelledby="notiLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="notititle"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p id="seminarname" style="font-weight: bold"></p>
                        <p id="notitime"></p>
                        <p id="noticontent"></p>
                     </div>
                     <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger">設定確認する</button> -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div>


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
                           <!-- <li>株式会社ライズモアサポート</li> -->

                          @if (auth()->user()->role == 'user')


       <!--                     <li><a href="{{ url('/application') }}">{{ __('welcome.managetask') }}</a></li>
                           <li><a href="{{ url('/joinedseminars') }}">{{ __('welcome.payment') }}</a></li>
                           <li><a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li> -->

                          @elseif (auth()->user()->role == 'host')
                           <!-- <li><a href="{{ url('/host') }}">{{ __('授業スケジュール') }}</a></li> -->
           <!--                 <li><a href="{{ url('/host/seminars') }}">{{ __('welcome.managetask') }}</a></li>
                           <li><a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li>
                           <li><a href=''  data-toggle="modal" data-target="#downloadmodel">{{ __('ダウンロード') }}</a></li> -->
                          @elseif (auth()->user()->role == 'hcompany')
<!--                            <li><a href="{{ url('/agent') }}">{{ __('auth.infllist') }}</a></li>
                           <li><a href="{{ url('/hcompany/seminars') }}">{{ __('welcome.managetask') }}</a></li>
                           <li><a href="{{ url('/hcompany/bill') }}">{{ __('auth.managebill') }}</a></li>
                           <li><a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">{{ __('welcome.profileedit') }}</a></li> -->
                          @else                      
                           <li><a href="{{ url('/schedule') }}">スケジュール</a></li>
                           <li><a href="{{ url('/admin/exhibit') }}">出展管理</a></li>
                           <!-- <li><a href="{{ url('/admin/events') }}">授業一覧</a></li> -->
                          @endif
                        </ul>
                     </div><!-- footer menu end-->

                     <div class="footer-menu text-center mb-25">
                        <ul>
                           <li>24EXPOジャパン株式会社</li>
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




<script type="text/javascript">
  
      // $(document).ready(function() {
      //     $("a.aaf").click(function() {
      //       var usersid =  $(this).attr("id");
      //       //post code
      //       alert('1212');
      //     })
      // });



    checknoti();


    $('#noti').on('hidden.bs.modal', function () {
        checknoti();
    })

    
    function myFunction(notidata) {
      // alert(title);
      console.log(notidata.doneread);
      $('#notititle').text('題名：' + notidata.title);
      $('#notitime').text('受送信日：' + notidata.time);
      if (notidata.seminarname) {
          $('#seminarname').text('セミナ名：'+ notidata.seminarname);
      } else {
          $('#seminarname').text('');
      }

      var html = urlify(notidata.content);
      $('#noticontent').html('内容：<br>' + notidata.content);
      // $('#noticontent').html(html);
      $('#noti').modal('show');

      if (!notidata.doneread) {
          markread(notidata);
          checknoti();
      }
    }

    function checknoti() {

        // alert("checknoti");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        var notiid = "{{ rand ( 10000 , 99999 ).auth()->user()->id }}";

        $.ajax({
            url: "{{ route('getnoti') }}",
            type:'POST',
            data: { notiid:notiid, 
                },

            success: function(data) {
                if($.isEmptyObject(data.error)){
                    //alert("success");
                    var ullist = "";

                    var totalnewnoti = 0;
                    var totalnoti = 0;
                    // console.log(data.success);
                    const obj = JSON.parse(data.success);
                    $.each( obj, function( key, value ) {
                      totalnoti = totalnoti + 1 ;
                      // alert( key + ": " + value );
                      var noti = JSON.parse(value);
                      // console.log(noti.title);

                      var dot = "fa-circle-o";
                      if (!noti.doneread) {
                          dot = "fa-circle";
                          totalnewnoti = totalnewnoti + 1 ;
                      } 
                      ullist = ullist + "<li class='noticlick'><a class='aaf' onclick='myFunction(" + value + ")' href='javascript:void(0)'><i class='fa "+dot+"' style='padding-right: 8px' aria-hidden='true'></i>"+noti.title+"</a></li>";

                    });

                    $("#totalnoti").text(totalnewnoti);
                    if (totalnewnoti > 0) {
                        $("#totalnoti").show();
                    } else {
                        $("#totalnoti").hide();
                    }

                    // alert(totalnoti);
                    if (totalnoti > 0) {
                        $("#notilist").show();
                    }
                    $("#notiul").empty().append(ullist);
                    // alert(ullist);

                    // var totalnoti= obj.length;
                    // alert(totalnoti);

                }else{
                    //alert("err");
                    console.log(data.error);

                }
            },
            fail: function(data) {
                    //alert("notication check err");
            }
        });
           

    }


    function markread(readnoti) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('markread') }}",
            type:'POST',
            data: { readnoti:readnoti, 
                },

            success: function(data) {
                if($.isEmptyObject(data.error)){
                    console.log('MARKREAD SUCCESS :' + data.success);
                    //alert("success");

                }else{
                    //alert("err");
                    console.log(data.error);

                }
            },
            fail: function(data) {
                    alert("markread err");
            }
        });
           

    }


    function urlify(text) {
      var urlRegex = /(https?:\/\/[^\s]+)/g;
      return text.replace(urlRegex, function(url) {
        return '<a href="' + url + '">' + url + '</a>';
      })
      // or alternatively
      // return text.replace(urlRegex, '<a href="$1">$1</a>')
    }

</script>



</html>