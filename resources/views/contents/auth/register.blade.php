@extends('partials.auth.master')
@include('contents.auth.additional.register')
@section('auth_content')
  <!-- Log In page -->
  <div class="row vh-100">
      <div class="col-12 align-self-center">
          <div class="auth-page">
              <div class="card auth-card shadow-lg">
                  <div class="card-body">
                      <div class="px-3">
                          <div class="auth-logo-box">
                              <a href="{{ route('home')}}" class="logo logo-admin"><img src="{{ asset('assets/adminTemplate/assets/images/cloud2.png') }}" height="70" alt="logo" class=""></a>
                          </div>
                          <!--end auth-logo-box-->
                          <div class="text-center auth-logo-text">
                              <h4 class="mt-0 mb-3 mt-5">Free Register for Metrica</h4>
                          </div>
                          <!--end auth-logo-text-->
                          <!-- notification -->
                          <div class="alert alert-pink border-0 hide" id="notif_danger" role="alert"></div>
                          <form id="form-register" class="form-horizontal auth-form my-4" method="post" action="javascript:void(0)">
                              <div class="form-group">
                                  <label for="username">Username</label>
                                  <div class="input-group mb-3"><span class="auth-form-icon"><i class="dripicons-user"></i> </span>
                                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                  </div>
                              </div>
                              <!--end form-group-->
                              <div class="form-group">
                                  <label for="useremail">Email</label>
                                  <div class="input-group mb-3"><span class="auth-form-icon"><i class="dripicons-mail"></i> </span>
                                      <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter Email">
                                  </div>
                              </div>
                              <!--end form-group-->
                              <div class="form-group">
                                  <label for="userpassword">Password</label>
                                  <div class="input-group mb-3"><span class="auth-form-icon"><i class="dripicons-lock"></i> </span>
                                      <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                  </div>
                              </div>
                              <span class="mb-2 text-primary">Wajib Kombinasi Huruf besar kecil, Angka, dan Simbol, Minimal karakter 6.</span>
                              <!--end form-group-->
                              <div class="form-group">
                                  <label for="conf_password">Confirm Password</label>
                                  <div class="input-group mb-3"><span class="auth-form-icon"><i class="dripicons-lock-open"></i> </span>
                                      <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Enter Confirm Password">
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
                              <!--end form-group-->
                              <div class="form-group row mt-4">
                                  <div class="col-sm-12">
                                      <div class="custom-control custom-switch switch-success">
                                          <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                          <label class="custom-control-label text-muted" for="customSwitchSuccess">By registering you agree to the Frogetor <a href="#" class="text-primary">Terms of Use</a></label>
                                      </div>
                                  </div>
                                  <!--end col-->
                              </div>
                              <!--end form-group-->
                              <div class="form-group mb-0 row">
                                  <div class="col-12 mt-2">
                                    @csrf()
                                    <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Register <i class="fas fa-sign-in-alt ml-1"></i></button>
                                  </div>
                                  <!--end col-->
                              </div>
                              <!--end form-group-->
                          </form>
                          <!--end form-->
                      </div>
                      <!--end /div-->
                      <div class="m-3 text-center text-muted">
                          <p class="">Already have an account ? <a href="{{ route('login.index') }}" class="text-primary ml-2">Log in</a></p>
                      </div>
                  </div>
                  <!--end card-body-->
              </div>
              <!--end card-->
          </div>
          <!--end auth-page-->
      </div>
      <!--end col-->
  </div>
  @endsection
