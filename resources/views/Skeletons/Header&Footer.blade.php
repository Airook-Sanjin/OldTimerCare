
<!-- -------------------------------------------------------------------Bottome is original -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/Header&Footer.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('css/our-services.css') }}"> -->
        <!-- <link rel="stylesheet" href="{{ asset('css/who-we-are.css') }}"> -->
        <!-- <link rel="stylesheet" href="{{ asset('css/lancaster-oaks.webflow.css') }}"> -->
        @yield('styles')
    </head>

    <div class="navbar-logo-left">
    <div data-w-id="62c0d4fd-1778-12cc-56af-49fd799ded68" data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="brix---header-wrapper w-nav">
      <div class="container-default w-container">
        <div class="header-content-wrapper">
          <div class="header-left-col">
            <a href="index.html" class="header-logo-link-left w-nav-brand"><img src="{{asset('images/Lancaster_logo.png') }}" srcset="{{asset('images/Lancaster_logo.png') }} 500w, {{asset('images/Lancaster_logo.png') }} 800w, {{asset('images/Lancaster_logo.png') }} 1024w" width="150" sizes="150px" alt="" class="brix---header-logo"></a>
            <nav role="navigation" class="header-menu-wrapper w-nav-menu">
              <ul role="list" class="header-nav-menu-list">
                <li class="header-nav-list-item-left">
                  <a href="{{ route('home')}}" class="header-nav-link w-nav-link w--current">Home</a>
                </li>
                <li class="header-nav-list-item-left">
                  <a href="{{route('who-we-are')}}" class="header-nav-link w-nav-link">Who We Are</a>
                </li>
                <li class="header-nav-list-item-left">
                  <a href="{{route('our-services')}}" class="header-nav-link w-nav-link">Our Services</a>
                </li>
                <li class="header-nav-list-item-left">
                  <a href="{{route('our-facility')}}" aria-current="page" class="header-nav-link w-nav-link">Our Facility</a>
                </li>
                
              </ul>
            </nav>
          </div>
          <div class="header-right-col">
            @auth
            
            
            
            @if(isset($isEmployee))
            
            
            @if((int)($isEmployee->RoleID ?? 0)===1) 
            <!-- Admin -->
             <div class="btn-header-hidden-on-mbl">
              <a class="link-wrapper w-inline-block" href ="{{ route('admin.approvalPage')}}" >
                <div class="link-text">Approvals</div>
              </a>
            </div>
             
            
            @endif
            @if((int)($isEmployee->RoleID ?? 0)===2)
            <!--Supervisor -->
            <div class="btn-header-hidden-on-mbl">
              <a class="link-wrapper w-inline-block" href ="{{ route('Rostercreate')}}" >
                <div class="link-text">Schedule</div>
              </a>
            </div>
           
            
            @endif
            @if((int)($isEmployee->RoleID ?? 0)===3)
            <!-- Doctor -->
             
            @endif
            @if((int)($isEmployee->RoleID ?? 0)===4) 
            <!-- Caregiver -->
             
            @endif
            @endif

            <div class="btn-header-hidden-on-mbl">
              <a class="link-wrapper w-inline-block" href ="{{ route('CalendarView')}}" >
                <div class="link-text">Calendar</div>
              </a>
            </div>
            
            <div class="btn-header-hidden-on-mbl">
                <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <button type="submit" class="btn-primary-small w-button">Logout</button>
                </form>
            </div>
            
            </ul>
            
            <div class="hamburger-menu-wrapper w-nav-button">
              <div style="-webkit-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)" class="brix---hamburger-menu-bar-top"></div>
              <div style="-webkit-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-moz-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);-ms-transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0);transform:translate3d(0, 0px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0deg) skew(0, 0)" class="brix---hamburger-menu-bar-bottom"></div>
            </div>
            @else
            <div class="btn-header-hidden-on-mbl">
              <a href="{{route('login')}}" class="link-wrapper w-inline-block">
                <div class="link-text">Login</div>
              </a>
            </div>
            <div class="btn-header-hidden-on-mbl">
              <a href="#" class="btn-primary-small w-button">Get started</a>
            </div>
            @endauth
          </div>
        </div>
      </div>
    </div>
    
  </div>
    <!-- ------------------------------------------bottom is original -->

    <body class="Main">
        @yield('content')
    </body>
    
    <div class="hero-without-image">
        <div class="container"></div>
        <div class="brix---container-default w-container"></div>
<footer class="brix---footer-wrapper">
      <div class="brix---container-default w-container">
        <div class="brix---footer-top">
          <div class="w-layout-grid brix---grid-footer-v1">
            <div id="w-node-a88d5bb0-0865-e270-57c5-a375f9fb1024-4cf4282d">
              <div class="brix---mg-bottom-24px">
                <a href="#" class="brix---footer-logo-wrapper w-inline-block"><img src="{{asset('images/Lancaster_logo_white.png') }}" srcset="{{asset('images/Lancaster_logo_white.png') }} 500w, {{asset('images/Lancaster_logo_white.png') }} 800w, {{asset('images/Lancaster_logo_white.png') }} 1024w" width="190" sizes="190px" alt="" class="brix---footer-logo"></a>
              </div>
            </div>
            <div class="div-block-2">
              <div class="brix---footer-col-title">Quick Links</div>
              <ul role="list" class="brix---footer-list-wrapper">
                <li class="brix---footer-list-item">
                  <a href="index.html" aria-current="page" class="brix---footer-link w--current">Home</a>
                </li>
                <li class="brix---footer-list-item">
                  <a href="who-we-are.html" class="brix---footer-link">Who We Are</a>
                </li>
                <li class="brix---footer-list-item">
                  <a href="our-services.html" class="brix---footer-link">Our Services</a>
                </li>
                <li class="brix---footer-list-item">
                  <a href="our-facility.html" class="brix---footer-link">Our Facility</a>
                </li>
                <li class="brix---footer-list-item"></li>
              </ul>
            </div>
            <div class="div-block">
              <div class="brix---footer-col-title">Contact Us</div>
              <ul role="list" class="brix---footer-list-wrapper">
                <li class="brix---footer-list-item">
                  <a href="#" class="brix---footer-link">123 Oakwood Lane, Lancaster PA</a>
                </li>
                <li class="brix---footer-list-item">
                  <a href="#" class="brix---footer-link">(555) 232 - 3332</a>
                </li>
                <li class="brix---footer-list-item">
                  <a href="#" class="brix---footer-link">Info@lancasteroaks.com</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
</div>

    @yield('scripts')
</html>
