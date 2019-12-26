@extends('partials.content.master')
@include('contents.cloud.additional.additional')
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
          <div class="col-lg-12">
              <div class="card">
                <div class="card-body" style="position: relative;">
                  @if(session()->has("errors"))
                  <div class="alert alert-pink border-0 text-center" role="alert">
                      @foreach(session("errors") as $value)
                      <strong>Error!</strong> {{$value}} <br>
                      @endforeach
                    </div>
                  @elseif(session()->has("success"))
                  <div class="alert alert-secondary border-0 text-center" role="alert">
                    {{ session("success") }}
                  </div>
                  @endif
                  <div class="text-right mr-1 mb-2">
                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-animation="bounce" data-target="#modal-add" title="Added New data">Added</button>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                          <thead>
                              <tr role="row">
                                  <th class="sorting" width="5">No</th>
                                  <th class="sorting">Connection Name</th>
                                  <th class="sorting">IP Address</th>
                                  <th class="sorting">Username</th>
                                  <th class="sorting" width="60">Status</th>
                                  <th class="sorting" width="20">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $no = 0 ?>
                            @forelse($cloud as $index => $item)
                            <?php
                              $no++ ;
                              if ($item->isactive == 1){
                                $status = 'Active';
                                $class = 'success';
                              }else{
                                $status = 'Nonactive';
                                $class = 'danger';
                              }
                            ?>
                              <tr role="row" class="odd">
                                  <td tabindex="0" class="sorting_1">{{ $no }}</td>
                                  <td>{{ $item->connection_name }}</td>
                                  <td>{{ $item->ip_address }}</td>
                                  <td>{{ $item->username }}</td>
                                  <td><i class="mdi mdi-circle-slice-8 font-18 mr-1 text-{{ $class }}"></i>{{ $status }}</td>
                                  <td>
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                          <form class="" action="{{ route('cloud.command') }}" method="post">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            @csrf()
                                            <button type="submit" class="tabledit-info-button btn btn-sm btn-info" style="float: none; margin: 4px;" title="Remote"><span class="ti-info-alt"></span></button>
                                            <button type="button" class="update_data tabledit-edit-button btn btn-sm btn-warning" title="Edit" data-id="{{ $item->id }}" style="float: none; margin: 4px;"><span class="ti-pencil"></span></button>
                                            <button type="button" class="delete_data tabledit-delete-button btn btn-sm btn-danger" title="Delete" data-id="{{ $item->id }}" data-name="{{ $item->connection_name }}" style="float: none; margin: 4px;"><span class="ti-trash"></span></button>
                                        </form>
                                        </div>
                                    </div>
                                  </td>
                              </tr>
                            @empty
                              <tr>
                                  <td colspan="6" class="text-center">Data not Found</td>
                              </tr>
                            @endforelse
                          </tbody>
                      </table>
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
@include('contents.cloud.modal')
