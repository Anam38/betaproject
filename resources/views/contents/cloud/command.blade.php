@extends('partials.content.master')
@include('contents.cloud.additional.command')
@section('content')
  <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="page-title-box">
                  <div class="float-right">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item active">Cloud / Command line</li>
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
                              <td id="host_name">
                                <div class="br-loader animate-loader initBeforeMount" for="wallet" style="height: 20px; background: #777; width: 100px;"></div>
                              </td>
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
                              <td id="operation_system">
                                <div class="br-loader animate-loader initBeforeMount" for="wallet" style="height: 20px; background: #777; width: 170px;"></div>
                              </td>
                          </tr>
                          <tr>
                              <td>CPU(s) Speed</td>
                              <td id="cpu_speed">
                                <div class="br-loader animate-loader initBeforeMount" for="wallet" style="height: 20px; background: #777; width: 120px;"></div>
                              </td>
                          </tr>
                          <tr>
                              <td>Memory</td>
                              <td id="memory">
                                <div class="br-loader animate-loader initBeforeMount" for="wallet" style="height: 20px; background: #777; width: 300px;"></div>
                            </td>
                          </tr>
                          <tr>
                              <td>Disck Space</td>
                              <td id="disck">
                                <div class="br-loader animate-loader initBeforeMount" for="wallet" style="height: 20px; background: #777; width: 300px;"></div>
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
                  <h5 class="ml-2 mb-0">Information for command Git</h5>
                  <ul class="mb-2">
                      <li>Git Push example : "git push https://username:password@yourrepository.biz/file.git --all"</li>
                  </ul>
                  <form class="command-form" action="javascript:void(0)" method="post" {{ $location ? "data-cloud" : "" }} data-id="{{ $id }}">
                    <div><input name="levelup" id="levelup" type="hidden"></div>
                    <div><input name="changedirectory" id="changedirectory" type="hidden"></div>
                    <div class="form-control" id="command-output" style="height:610px;overflow:auto;font-size: 12px; word-spacing: 2px; ">
                      <div class="command-output">
                        <!-- show command -->
                        @foreach((Session::has('output') ? Session::get('output') : array()) as $item)
                          @if(is_array($item))
                            @foreach($item as $items)
                              @if($items)
                                <div style="padding-left:20px;">
                                  {!! $items !!} <br>
                                </div>
                              @endif
                            @endforeach
                          @else
                            @if(strpos($item, '$') === false)
                              @if(strpos($item, '\n') == false)
                                <div style="padding-left:20px;">
                                  {!! trim(preg_replace('/\n/', '<br>', $item)) !!} <br>
                                </div>
                              @endif
                            @else
                                {!! $item !!} <br>
                            @endif
                          @endif
                        @endforeach
                      </div>
                      <div class="row">
                        <div style="display: inline-flex;width:100%;padding-left:5px;">
                          <label style="padding: 5px 2px;" id="cwd_name" >~{{ Session::get('cwd_name') }}$</label>
                          <input style="height:30px;" type="text" id="command" name="command" class="form-control" placeholder="Input here" autofocus>
                        </div>
                      </div>
                    </div>
                    @csrf()
                  </form>
                  <button type="button" id="scrolltop" top="1" class="btn btn-outline-info btn-round float-right" style="margin:-55px 15px;position:relative;">
                    <i class="fas fa-angle-double-up"></i>
                  </button>
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
