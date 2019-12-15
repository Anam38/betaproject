@extends('partials.auth.master')
@include('contents.auth.additional.login')
@section('auth_content')
    <!-- Log In page -->
    <div class="row vh-100">
        <div class="col-12 align-self-center">
            <div class="auth-page">
                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <div class="px-3">
                            <div class="auth-logo-box">
                                <a href="{{ route('home')}}" class="logo logo-admin"><img src="{{ asset('assets/adminTemplate/assets/images/logo-sm.png') }}" height="55" alt="logo" class="auth-logo"></a>
                            </div>
                            <!--end auth-logo-box-->
                            <div class="text-center auth-logo-text">
                                <h4 class="mt-0  mt-5">Let's Get Started Metrica</h4>
                            </div>
                            <!--end auth-logo-text-->
                            @if(session()->has("errors"))
                              <div class="alert alert-pink border-0" role="alert">
                                @foreach(session("errors") as $value)
                                <strong>Error!</strong> {{$value}} <br>
                                @endforeach
                              </div>
                            @endif
                            <form class="form-horizontal auth-form my-4" method="post" action="{{ route('login.submit') }}">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group "><span class="auth-form-icon"><i class="dripicons-user"></i> </span>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                    </div>
                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <div class="input-group "><span class="auth-form-icon"><i class="dripicons-lock"></i> </span>
                                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userpassword">Validation</label>
                                    <div class="row">
                                      <div class="input-group col-sm-7">
                                          <input type="text" class="form-control" id="validation" name="validation" placeholder="Code validation" maxlength="4" autocomplete="off" onkeydown="this.value=this.value.replace(/[^0-9]/g,'');" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                                      </div>
                                      <div class="col-sm-5">
                                        {!! Captcha::img('flat',['id' => 'captcha_register','style' => 'height:35px;border-radius: 50px;width: 145px;']) !!}
                                      </div>
                                  </div>
                                </div>
                                <!--end form-group-->
                                <div class="row mt-4 mb-2">
                                    <!--end col-->
                                    <div class="col-sm-12 text-center"><a href="#" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a></div>
                                    <!--end col-->
                                </div>
                                <!--end form-group-->
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        @csrf()
                                        <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end form-group-->
                            </form>
                            <!--end form-->
                        </div>
                        <!--end /div-->
                        <div class="m-3 text-center text-muted">
                            <p class="">Don't have an account ? <a href="{{ route('register.index')}}" class="text-primary ml-2">Free Resister</a></p>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
                <div class="account-social text-center mt-4">
                    <h6 class="my-4">Or Login With</h6>
                    <ul class="list-inline mb-4">
                        <li class="list-inline-item"><a href="#" class=""><i class="fab fa-facebook-f facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class=""><i class="fab fa-twitter twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class=""><i class="fab fa-google google"></i></a></li>
                    </ul>
                </div>
                <!--end account-social-->
            </div>
            <!--end auth-page-->
        </div>
        <!--end col-->
    </div>
@endsection
