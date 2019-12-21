@extends('partials.content.master')
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
                <div class="card-body" style="position: relative;">
                  <h4 class="text-center">Login Google Authenticator</h4><br>
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
                      <form method="post" action="{{ route('submitlogin.author')}}">
                        <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
                              <input type="text" name="pin" class="form-control" placeholder="Enter PIN from Google Authenticator" onkeydown="this.value=this.value.replace(/[^0-9]/g,'');" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                          </div>
                        </div>
                        @csrf()
                        <button type="submit" class="btn btn-block btn-primary btn-round">Login</button>
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
