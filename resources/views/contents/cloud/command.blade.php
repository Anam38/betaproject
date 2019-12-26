@extends('partials.content.master')
@include('contents.cloud.additional.command')
@section('content')
  <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="page-title-box">
                  <div class="float-right">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">Command line</li>
                      </ol>
                  </div>
                  <h4 class="page-title">Cloud</h4></div>
              <!--end page-title-box-->
          </div>
          <!--end col-->
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
          <div class="col-sm-4">
            <div class="card">
                <div class="card-body" style="position: relative;">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-centered" style="margin-bottom:0px;">
                        <thead>
                        <tr>
                            <th class="text-center pt-0 pb-0" colspan="2">
                                <h4>Detail</h4>
                            </th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 12px;">
                          <tr>
                              <td>Host Name</td>
                              <td id="host_name"></td>
                          </tr>
                          <tr>
                              <td>Location</td>
                              <td id="location">{{ (Session::has('location') ? Session::get('location')->data->continent_name : '-' )}}</td>
                          </tr>
                          <tr>
                              <td>IP Addres</td>
                              <td id="ip_address">{{ Session::get('cloud')->ip_address }}</td>
                          </tr>
                          <tr>
                              <td>Operating System</td>
                              <td id="operation_system"></td>
                          </tr>
                          <tr>
                              <td>CPU(s) Speed</td>
                              <td id="cpu_speed"></td>
                          </tr>
                          <tr>
                              <td>Memory</td>
                              <td id="memory"></td>
                          </tr>
                          <tr>
                              <td>Disck Space</td>
                              <td id="disck">
                              </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
              <div class="card">
                <div class="card-body" style="position: relative;">
                  <div class="text-center">
                      <h4>Command Line</h4>
                  </div>
                  <form class="command-form" action="{{ route('cloud.command')}}" method="post">
                    <div><input name="levelup" id="levelup" type="hidden"></div>
                    <div><input name="changedirectory" id="changedirectory" type="hidden"></div>
                    <div class="form-control" id="command-output" style="height:700px;overflow:auto;font-size: 12px; word-spacing: 2px; ">
                      <!-- show command -->
                      @foreach((Session::has('output') ? Session::get('output') : array()) as $item)
                        @if(is_array($item))
                          @foreach($item as $items)
                            @if(strpos($items, '$') === false)
                            <div style="padding-left:20px;">
                              {!! $items !!} <br>
                            </div>
                            @else
                              {!! $items !!} <br>
                            @endif
                          @endforeach
                        @else
                          @if(strpos($item, '$') === false)
                          <div style="padding-left:20px;">
                            {!! $item !!} <br>
                          </div>
                          @elseif(strpos($item, '\n') === false)
                            {!! $item !!} <br>
                          @else
                            {!! $item !!} <br>
                          @endif
                        @endif
                      @endforeach
                      <div class="row">
                        <div style="display: inline-flex;width:100%;padding-left:5px;">
                          <label style="padding: 5px 2px;">~{{ Session::get('cwd_name') }}$</label>
                          <input style="height:30px;" type="text" name="command" class="form-control" placeholder="Input here" autofocus>
                        </div>
                      </div>
                    </div>
                    @csrf()
                  </form>
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
@include('contents.cloud.modal')
