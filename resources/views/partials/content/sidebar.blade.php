<div class="left-sidenav">
    <div class="main-icon-menu"></div>
    <!--end main-icon-menu-->
    <div class="main-menu-inner active">
        <div class="slimScrollDiv active" style="position: relative; overflow: hidden; width: auto; height: 363px;">
            <div class="menu-body slimscroll in" style="overflow: hidden; width: auto; height: 363px;">
                <!-- end Analytic -->
                <div id="MetricaCrypto" class="main-icon-menu-pane active mm-active">
                    <div class="title-box active">
                        <h6 class="menu-title">Menu</h6>
                      </div>
                      <ul class="nav">
                        <li class="nav-item"><a class="nav-link @if( Request::segment(1) == '/') active @endif" href="{{ route('home') }}"><i class="dripicons-device-desktop"></i>Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link @if( Request::segment(1) == 'cloud') active @endif" href="{{ route('cloud.index') }}"><i class="dripicons-cloud"></i>Cloud</a></li>
                      </ul>
                </div>
            </div>
        </div>
        <!--end menu-body-->
    </div>
    <!-- end main-menu-inner-->
</div>
