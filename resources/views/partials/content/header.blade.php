<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Metrica - Responsive Bootstrap 4 Admin Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta content="A premium admin dashboard template by Mannatthemes" name="description">
  <meta content="Mannatthemes" name="author">
  <link rel="shortcut icon" href="{{ asset('assets/adminTemplate/assets/images/cloud2.png') }}">
  <!-- App favicon -->
  @include('partials.content.snipets.style')
  </head>
  <body>
    <div class="topbar">
      <div class="topbar-left"><a href="crypto-index.html" class="logo"><span><img src="{{ asset('assets/adminTemplate/assets/images/cloud2.png') }}" height="25" alt="logo-small" class="logo-sm"> </span>
        <span><img src="{{ asset('assets/adminTemplate/assets/images/text.png') }}" width="75" height="18" alt="logo-large" class="logo-lg"></span></a></div>
      <!--end logo-->
      <!-- Navbar -->
      <nav class="navbar-custom">
          <ul class="list-unstyled topbar-nav float-right mb-0">
              <li class="dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <!-- <img src="{{ asset('assets/adminTemplate/assets/images/users/user-4.jpg') }}" alt="profile-user" class="rounded-circle"> -->
                    <span class="ml-1 nav-user-name hidden-sm">
                      {{ Session::get('authuser')['username']}}
                      <i class="mdi mdi-chevron-down"></i>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <!-- <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Terminal</a> -->
                  <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
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
