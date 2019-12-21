  @extends('partials.content.master')
  @include('contents.command.additional.additional')
  @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Command</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Command Line</h4></div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body" style="position: relative;">
                      <form class="command-form" action="{{ route('command.submit')}}" method="post">
                        <div><input name="levelup" id="levelup" type="hidden"></div>
                        <div><input name="changedirectory" id="changedirectory" type="hidden"></div>
                        <div style="display: inline-flex;width:100%;padding-left:5px;">
                            <label style="padding: 5px 2px;">~{{ Session::get('cwd') }}$</label>
                            <input style="height:30px;" type="text" name="command" class="form-control" placeholder="Input here" autofocus>
                        </div>
                        <div class="form-control" id="command-output" style="height:700px;overflow:auto;font-size: 11px;margin-top: -38px;padding-top: 40px; word-spacing: 2px; ">
                          <!-- show command -->
                          @foreach(Session::get('output') as $item)
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
                                @else
                                  {!! $item !!} <br>
                                @endif
                              @endif
                          @endforeach
                        </div>
                        @csrf()
                      </form>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="px-3">
                          <h4 class="mt-0 text-center">Login Terminal</h4>
                          <!-- content -->
                          <form method="post" action="{{ route('command.login') }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control btn-round" name="username" id="" aria-describedby="emailHelp" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control btn-round" name="password" id="" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Validation</label>
                              <div class="row">
                                <div class="col-sm-8">
                                  <input type="text" class="form-control btn-round" name="validation" id="validation" placeholder="Validation" maxlength="4" autocomplete="off" onkeydown="this.value=this.value.replace(/[^0-9]/g,'');" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                                </div>
                                <div class="col-sm-4">
                                  {!! Captcha::img('flat',['id' => 'captcha_register','style' => 'height:35px;border-radius: 50px;width: 125px;']) !!}
                                </div>
                              </div>
                            </div>
                            @csrf()
                            <input type="hidden" name="nounce" value="{{ Session::get('nounce') }}">
                            <button type="submit" class="btn btn-block btn-primary btn-round">Submit</button>
                        </form>
                          <!--end form-->

                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!-- end row -->
    </div>
    <!-- container -->
@endsection
