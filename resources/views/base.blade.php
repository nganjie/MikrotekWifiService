<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset("assets/img/favicon.png")}}" rel="icon">
  <link href="{{asset("assets/img/apple-touch-icon.png")}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
  <link href="{{asset("assets/vendor/bootstrap-icons/bootstrap-icons.css" )}}"rel="stylesheet">
  <link href="{{asset("assets/vendor/aos/aos.css" )}}"rel="stylesheet">
  <link href="{{asset("assets/vendor/glightbox/css/glightbox.min.css" )}}"rel="stylesheet">
  <link href="{{asset("assets/vendor/swiper/swiper-bundle.min.css" )}}"rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Main CSS File -->
  <link href="{{asset("assets/css/main.css" )}}"rel="stylesheet">

</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    
          <a href="index.html" class="logo d-flex align-items-center">
            <h1 class="sitename">MikrotekWifi</h1>
          </a>
    
          <nav id="navmenu" class="navmenu">
            <ul>
              <li><a href="#hero" class="active">{{__("site.Home")}}</a></li>
              <li><a href="#about">{{__("site.About")}}</a></li>
              <li><a href="#features">{{__("site.Features")}}</a></li>
              <li><a href="#pricing">{{__("site.Pricing")}}</a></li>
              <li><a href="{{route('site.signup.user')}}">{{__("site.create account")}}</a></li>
              <li class="dropdown"><a href="#"><span>{{__("site.Language")}}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="site/language-en">Englais</a></li>
                  <li><a href="site/language-fr">Francais</a></li>
                </ul>
              </li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
    
        </div>
      </header>
      <main class="main">
        @yield('main')
      </main>
      <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
              <a href="index.html" class="logo d-flex align-items-center">
                <span class="sitename">MikrotekWifi</span>
              </a>
              <div class="footer-contact pt-3">
                <p>Douala Makepe bloc L</p>
                <p class="mt-3"><strong>{{__("site.Phone")}}:</strong> <span>674659490 / 699277529</span></p>
                <p><strong>Email:</strong> <span>nguegouealain@gmail.com</span></p>
              </div>
              <div class="social-links d-flex mt-4">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
    
    
    
          </div>
        </div>
    
        <div class="container copyright text-center mt-4">
          <p>© <span>Copyright</span> <strong class="px-1 sitename">MikrotekWifi</strong> <span>All Rights Reserved</span></p>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://github.com/nganjie?tab=repositories">Nganjie Nzatsi thede reinel</a> Distributed By <a href="#">MikrotekWifi</a>
          </div>
        </div>
    
      </footer>
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <script src="{{asset("assets/vendor/php-email-form/validate.js")}}"></script>
  <script src="{{asset("assets/vendor/aos/aos.js")}}"></script>
  <script src="{{asset("assets/vendor/glightbox/js/glightbox.min.js")}}"></script>
  <script src="{{asset("assets/vendor/purecounter/purecounter_vanilla.js")}}"></script>
  <script src="{{asset("assets/vendor/swiper/swiper-bundle.min.js")}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js" integrity="sha512-vCgNjt5lPWUyLz/tC5GbiUanXtLX1tlPXVFaX5KAQrUHjwPcCwwPOLn34YBFqws7a7+62h7FRvQ1T0i/yFqANA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Main JS File -->
  <script src="{{asset("assets/js/main.js")}}"></script>
  @if(session()->has('success'))
  <script>
    toastr.options={
        'progessBar':true,
        'closeButton':true
    };
    toastr.success("{{Session::get("success")}}",{timeOut:12000})
    console.log('un monde de merde')
</script>
 @endif
 @if(session()->has('error'))
 <script>
   toastr.options={
       'progessBar':true,
       'closeButton':true
   };
   let err={!! Session::get('error') !!};
   //console.log(err)
   //console.log(err[0])
   //console.log(err.length)
   //toastr.success("{{Session::get("message")}}",{timeOut:12000})
   //toastr.info("{{Session::get("message")}}")
   //toastr.warning("{{Session::get("message")}}")
   for (const [key, value] of Object.entries(err)) {
  console.log(`${key}: ${value}`);
  toastr.error(value,{timeOut:12000});
}
   
   //console.log('un monde de merde')
</script>
@endif
    
</body>
</html>