@extends('partials.content.master')
@section('content')
  <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="page-title-box">
                  <div class="float-right">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">Cloud</li>
                      </ol>
                  </div>
                  <h4 class="page-title">Cloud</h4></div>
              <!--end page-title-box-->
          </div>
          <!--end col-->
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
    <div class="col-12">
        <div class="chat-box-left">
            <div class="chat-search">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" id="chat-search" name="chat-search" class="form-control" placeholder="Search"> <span class="input-group-append"><button type="button" class="btn btn-primary shadow-none"><i class="fas fa-search"></i></button></span></div>
                </div>
            </div>
            <!--end chat-search-->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 363px;">
                <div class="tab-content chat-list slimscroll" id="pills-tabContent" style="overflow: hidden; width: auto; height: 363px;">
                    <div class="tab-pane fade active show" id="general_chat">
                      @foreach($user as $item)
                        <a href="#" class="media new-message">
                            <div class="media-left"><img src="{{ asset('assets/adminTemplate/assets/images/widgets/opp-1.png') }}" alt="user" class="rounded-circle thumb-md"> <span class="round-10 bg-success"></span></div>
                            <!-- media-left -->
                              <div class="media-body">
                                  <div class="d-inline-block">
                                      <h6>{{$item->name}}</h6>
                                      <p>Good morning!</p>
                                  </div>
                                  <div><span>20 Feb</span> <span>3</span></div>
                              </div>
                            <!-- end media-body -->
                        </a>
                        @endforeach

                        <!--end media-->
                    </div>
                    <!--end general chat-->
                    <!--end group chat-->

                    <!--end personal chat-->
                </div>
                <div class="slimScrollBar" style="background: rgb(118, 129, 173); width: 7px; position: absolute; top: 87px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 577.089px;"></div>
                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
            <!--end tab-content-->
        </div>
        <!--end chat-box-left -->
        <div class="chat-box-right">
            <div class="chat-header">
                <a href="#" class="media">
                    <div class="media-left"><img src="{{ asset('assets/adminTemplate/assets/images/widgets/opp-1.png') }}" alt="user" class="rounded-circle thumb-md"></div>
                    <!-- media-left -->
                    <div class="media-body">
                        <div>
                            <h6 class="mb-1 mt-0">Mary Schneider</h6>
                            <p class="mb-0">Last seen: 2 hours ago</p>
                        </div>
                    </div>
                    <!-- end media-body -->
                </a>
                <!--end media-->
            </div>
            <!-- end chat-header -->
            <div class="chat-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 363px;">
                    <div class="chat-detail slimscroll" style="overflow: hidden; width: auto; height: 363px;">
                        <!--isi chats-->
                    </div>
                    <div class="slimScrollBar" style="background: rgb(118, 129, 173); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 550.444px;"></div>
                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
                <!-- end chat-detail -->
            </div>
            <!-- end chat-body -->
            <div class="chat-footer">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <input type="text" class="form-control" placeholder="Type something here...">
                    </div>
                    <!-- col-8 -->
                    <div class="col-3 text-right">
                        <div class="d-none d-sm-inline-block chat-features"><a href="#"><i class="fas fa-camera"></i></a> <a href="#"><i class="fas fa-paperclip"></i></a> <a href="#"><i class="fas fa-microphone"></i></a></div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end chat-footer -->
        </div>
        <!--end chat-box-right -->
    </div>
    <!-- end col -->
</div>
      <!-- end row -->
  </div>
  <!-- container -->
@endsection
@include('contents.cloud.modal')
