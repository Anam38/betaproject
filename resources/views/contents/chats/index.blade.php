@extends('partials.content.master')
@section('content')
  <div class="container-fluid">
    <div class="row">
          <div class="col-sm-12">
              <div class="page-title-box">
                  <div class="float-right">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">Chat</li>
                      </ol>
                  </div>
                  <h4 class="page-title">Chat</h4></div>
              <!--end page-title-box-->
          </div>
          <!--end col-->
      </div>
      <div class="row">
        <chats-component :user="{{ Auth::user() }}"></chats-component>
    </div>
  </div>
  <!-- container -->
@endsection
