<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>

@if (\Request::is('rtl'))
  <html dir="rtl" lang="ar">
@else
  <html lang="en" >
@endif

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/public/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('/public/assets/img/fevicon.jpg')}}">
  <title>{{ env('APP_NAME') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/public/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('/public/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('/public/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('/public/assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />
  <!-- sweet alert css-->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

  <!--Bootstarp-->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
  <!--Datetimepicker-->

  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css"> --}}
  <!-----Toastr----->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />


  <style>

    .navbar-vertical.navbar-expand-xs {
        box-shadow: 0 2px 12px 0 rgba(0,0,0,.16);
        background-color: #0d395c;
    }

    .nav-link-text{
      color:white
    }

    .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
      background-image: none !important;
    }

    .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon svg .color-background, .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon svg .color-foreground {
      fill: #3a416f !important;
    }
    .join,.page-item.active .page-link {
    background-color: #0d395c !important;
    color:white;
    border-color:transparent !important;
    }
    .fa-bell,.zoomicon{
      color: #0d395c !important;
    }
  
    .navbar-vertical .navbar-nav>.nav-item .nav-link.active .nav-link-text{
      color:black
    }
    .fa, .fas {
    font-weight: 900;
    color: white;
     }
    .navbar .nav-link, .navbar .navbar-brand {
    color: white;
    font-size: .875rem;
    }
    .toggled{
      width:0 !important;
      padding-left: 0;
    }
    .toggled-main{
      margin-left:0 !important;
    }
    ul.sub-navbar{
    box-shadow: 0 8px 26px -4px hsla(0,0%,8%,.15), 0 8px 9px -5px hsla(0,0%,8%,.06);
    }
    ul.navbar-nav li span {
    float: left;
    text-align: right;
    margin-right: 15px;
    }
    ul.navbar-nav li .profile-img {
        float: right;
    }
    ul.navbar-nav li .profile-img img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #ddd;
    }
    .dropdown-menu[data-bs-popper] {
    margin-top: 0!important;
    }
    .dropdown-menu li a{
      border-radius: 0.5rem;
      text-align: center;
    }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      color: white !important;
      border:transparent;
      background: transparent !important;
      border: transparent !important;
  }
  .li_itemx:hover {
            background-color: #f2f2f2
  }
  .form-select:focus {
      border-color: #0d395c !important;
      box-shadow: 0 0 0 2px #0d395c !important;
      outline: 0;
  }
  .form-control:focus {
    background-color: #fff;
    border-color: #0d395c !important;
    box-shadow: 0 0 0 2px #0d395c;
    color: #495057;
    outline: 0;
}

.flatpickr-calendar .flatpickr-day.today {
      background: #0d395c!important;
      border: none;
      color: #fff;
  }
  
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  
  @auth
    @yield('auth')
  @endauth
  @guest
  @yield('guest')
@endguest
  {{-- @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif --}}

 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--Datetimepicker-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
  <!--Sweetalert-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <!--   Core JS Files   -->
  <script src="{{ asset('/public/assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('/public/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/public/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('/public/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{ asset('/public/assets/js/plugins/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('/public/assets/js/plugins/chartjs.min.js')}}"></script>
    <!-----Toastr----->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
  
<script>
    @if (!empty($errors))
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    @endif
    @if (Session::has('message'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('success'))
    
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

{{-- notification Unread --}}
<script>
  $(document).ready(function () {
    $('.leave-btn').on('click',function(){
      // alert();
      var id= $(this).data('id');
      console.log(id);
        $.ajax({
          type: "GET",
          url: "unread/"+id,
          success: function (response) {
            // console.log('dfadf');
            window.location.href = "leave";
          }
        });
    });
  });
</script>  

{{-- notification time counter --}}
 <script>
  $(document).ready(function () {
  
    function timedifference(firstDate,id)
    {  
        var startDay = new Date(firstDate);  
        // var endDay = new Date(secondDate); 

        var endDay = new Date($.now());

      // Determine the time difference between two dates     
        var millisBetween = startDay.getTime() - endDay.getTime(); 
        milli = Math.round(Math.abs(millisBetween)); 
        // console.log(milli)

      // Determine the second differcence between two dates  
        var seconds = Math.round(Math.abs(Math.floor((millisBetween / 1000) % 60)));
 
      // Determine the minutes differcence between two dates  
        var minutes = Math.round(Math.abs(Math.floor((millisBetween / (1000 * 60)) % 60)));

      // Determine the hours differcence between two dates  
        var hours = Math.round(Math.abs(Math.floor((millisBetween / (1000 * 60 * 60)) % 24)));
    
      // Determine the number of days between two dates  
        var days = Math.round(Math.abs(millisBetween / (1000 * 3600 * 24)));  

      // Determine the number of Years between two dates  
        var years = Math.round(Math.abs(millisBetween / (1000 * 3600 * 24 * 365)));  

        // if(milli >= 1 && milli < 60000) // 1second == 60,000 millisec
        // {
        //   $('.t'+id).html(Math.round(Math.abs(seconds))+" seconds ago")
        // }
        if(milli >= 0 && milli <= 3600000)
        {
          $('.t'+id).html(Math.round(Math.abs(minutes))+" minutes ago")
        }
        else if(milli >= 3600000 && milli <= 86400000 )
        {
          $('.t'+id).html(Math.round(Math.abs(hours))+" hours ago")
        }
        else if(milli >= 86400000 && milli <= 31556952000)
        {
          $('.t'+id).html(Math.round(Math.abs(days))+" days ago")
        }
        else if(milli >= 31556952000)
        {
          $('.t'+id).html(Math.round(Math.abs(years))+"  years ago")          
        }
        else
        {
          $('.t'+id).html("long time ago")          
        }

    }

    $('[id^="time_"]').each(function() {

        var time= $('#'+this.id).val();
        let id=this.id;
        setInterval(function() {timedifference(time,id); }, 1000);
    });

  });
</script>   

  @stack('rtl')
  @stack('dashboard')
  @stack('custom-scripts')
  <script>
     
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  {{-- @yield('jquery') --}}


  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/public/assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
  <script>
      function closeNav() {
        event.preventDefault();
        $(".wrapper").toggleClass("toggled");
        $(".main-content").toggleClass("toggled-main");
        $(".side").removeClass('d-none');
    };
    function openNav() {
        event.preventDefault();
        $(".wrapper").removeClass("toggled");
        $(".main-content").removeClass("toggled-main");
        $(".side").addClass('d-none');
    };
  </script>
</body>

</html>
