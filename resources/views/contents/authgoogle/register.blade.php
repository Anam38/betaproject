@extends('partials.content.master')
@include('contents.authgoogle.additional.register')
@section('content')
  <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="page-title-box">
                  <div class="float-right">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">Google Authenticator</li>
                      </ol>
                  </div>
                  <h4 class="page-title">Google Authenticator</h4></div>
              <!--end page-title-box-->
          </div>
          <!--end col-->
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                <h6 class="text-right mr-4 mt-3 time-server">Time in Server</h6>
                <div class="card-body" style="position: relative;">
                  <h4 class="text-center">Activation Google Authenticator</h4><br>
                  <h6 class="text-center">Scan barcode below with google Authenticator, then enter PIN generate</h6>
                  <div class="text-center">
                    <img class="" src="{{ $QR_Image }}" alt="">
                  </div>
                  <h6 class="text-center">OR</h6>
                  <h6 class="text-center">Enter manual setup key</h6>
                  <div class="text-center">
                    <h6 class="badge badge-secondary" style="font-size: 15px;">{{ $secret }}</h6>
                  </div>
                  <div class="row">
                  <div class="col-sm-4">
                  </div>
                    <div class="col-sm-4">
                      @if(session()->has("errors"))
                      <div class="alert alert-pink border-0 text-center" role="alert">
                          @foreach(session("errors") as $value)
                          <strong>Error!</strong> {{$value}} <br>
                          @endforeach
                        </div>
                      @endif
                      <form method="post" action="{{ route('submit.author')}}">
                        <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
                              <input type="text" name="pin" class="form-control" required placeholder="Enter PIN from Google Authenticator" onkeydown="this.value=this.value.replace(/[^0-9]/g,'');" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                              <input type="hidden" name="secret" class="form-control" value="{{ $secret }}">
                          </div>
                        </div>
                        @csrf()
                        <button type="submit" class="btn btn-block btn-primary btn-round">save</button>
                      </form>
                    </div>
                    <div class="col-sm-4">
                    </div>
                  </div>
                </div>
              </div>
              <!--end card-->
          </div>
          <!--end col-->
      </div>
      <!-- end row -->
  </div>
  <!-- container -->
@endsection
