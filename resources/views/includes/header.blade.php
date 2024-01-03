<!DOCTYPE html>
<html class="no-js" lang="en">

@include('includes.head')

<body>

    <!-- Header  -->
    <header class="header-area header-style-1 header-height-2">

        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{url('/')}}"><img src="{{ asset('frontend') }}/assets/imgs/theme/logo.svg"
                                alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">

                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">


                                <div class="header-action-icon-2">
                                    <a href="{{route('dashboard')}}">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-user.svg" />
                                    </a>

                                    @auth

                                    <span class="lable ml-0">Account</span>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{route('dashboard')}}"><i class="fi fi-rs-user mr-10"></i>My
                                                    Account</a>
                                            </li>

                                            <li>
                                                <a href="{{route('logout')}}"><i class="fi fi-rs-sign-out mr-10"></i>Sign
                                                    out</a>
                                            </li>
                                        </ul>
                                    </div>

                                    @else
                                    <a href="{{route('login')}}"><span class="lable ml-0">Login</span></a>
                                    <a class="me-2px">|</a>
                                    <a href="{{route('register')}}"><span class="lable ml-0">Register</span></a>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">


                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </header>

    <!-- End Header  -->


    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('frontend') }}/assets/imgs/theme/logo.svg"
                            alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">

                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">

                            <li class="menu-item-has-children">
                                <a href="#">Account</a>
                                <ul class="dropdown">

                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>

                                </ul>
                            </li>

                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>

            </div>
        </div>
    </div>
    <!--End header-->

    <main class="main">
