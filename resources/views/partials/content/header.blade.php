<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Metrica - Responsive Bootstrap 4 Admin Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta content="A premium admin dashboard template by Mannatthemes" name="description">
  <meta content="Mannatthemes" name="author">
  <!-- App favicon -->
  @include('partials.content.snipets.style')
  </head>
  <body>
    <div class="topbar">
      <div class="topbar-left"><a href="crypto-index.html" class="logo"><span><img src="{{ asset('assets/adminTemplate/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm"> </span><span><img src="{{ asset('assets/adminTemplate/assets/images/logo.png') }}" alt="logo-large" class="logo-lg"></span></a></div>
      <!--end logo-->
      <!-- Navbar -->
      <nav class="navbar-custom">
          <ul class="list-unstyled topbar-nav float-right mb-0">
              <li class="hidden-sm"><a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript: void(0);" role="button" aria-haspopup="false" aria-expanded="false">English <img src="{{ asset('assets/adminTemplate/assets/images/flags/us_flag.jpg') }}" class="ml-2" height="16" alt=""> <i class="mdi mdi-chevron-down"></i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript: void(0);">
                      <span>German </span>
                      <img src="{{ asset('assets/adminTemplate/assets/images/flags/germany_flag.jpg') }}" alt="" class="ml-2 float-right" height="14">
                    </a>
                    <a class="dropdown-item" href="javascript: void(0);">
                      <span>Italian </span>
                      <img src="{{ asset('assets/adminTemplate/assets/images/flags/italy_flag.jpg') }}" alt="" class="ml-2 float-right" height="14">
                    </a>
                    <a class="dropdown-item" href="javascript: void(0);">
                      <span>French </span>
                      <img src="{{ asset('assets/adminTemplate/assets/images/flags/french_flag.jpg') }}" alt="" class="ml-2 float-right" height="14">
                    </a>
                    <a class="dropdown-item" href="javascript: void(0);">
                      <span>Spanish </span>
                      <img src="{{ asset('assets/adminTemplate/assets/images/flags/spain_flag.jpg') }}" alt="" class="ml-2 float-right" height="14">
                    </a>
                    <a class="dropdown-item" href="javascript: void(0);">
                      <span>Russian </span>
                      <img src="{{ asset('assets/adminTemplate/assets/images/flags/russia_flag.jpg') }}" alt="" class="ml-2 float-right" height="14">
                    </a>
                  </div>
              </li>
              <li class="dropdown notification-list"><a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="dripicons-bell noti-icon"></i> <span class="badge badge-danger badge-pill noti-icon-badge">2</span></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-lg" style="">
                      <!-- item-->
                      <h6 class="dropdown-item-text">Notifications (18)</h6>
                      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 363px;">
                          <div class="slimscroll notification-list" style="overflow: hidden; width: auto; height: 363px;">
                              <!-- item-->
                              <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                  <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                  <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                              </a>
                              <!-- item-->
                              <a href="javascript:void(0);" class="dropdown-item notify-item">
                                  <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                  <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                              </a>
                              <!-- item-->
                              <a href="javascript:void(0);" class="dropdown-item notify-item">
                                  <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                  <p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
                              </a>
                              <!-- item-->
                              <a href="javascript:void(0);" class="dropdown-item notify-item">
                                  <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                  <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                              </a>
                              <!-- item-->
                              <a href="javascript:void(0);" class="dropdown-item notify-item">
                                  <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                  <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                              </a>
                          </div>
                          <div class="slimScrollBar" style="background: rgb(118, 129, 173); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                          <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                      </div>
                      <!-- All--><a href="javascript:void(0);" class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a></div>
              </li>
              <li class="dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="{{ asset('assets/adminTemplate/assets/images/users/user-4.jpg') }}" alt="profile-user" class="rounded-circle"> <span class="ml-1 nav-user-name hidden-sm">Amelia <i class="mdi mdi-chevron-down"></i></span></a>
                  <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
              </li>
          </ul>
          <!--end topbar-nav-->
          <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light"><i class="dripicons-menu nav-icon"></i></button>
            </li>
          </ul>
      </nav>
      <!-- end navbar-->
  </div>
  <div class="page-wrapper">
    <!-- Left Sidenav -->
      @include('partials.content.sidebar')
    <!-- end left-sidenav-->
  <!-- Page Content-->
  <div class="page-content">
