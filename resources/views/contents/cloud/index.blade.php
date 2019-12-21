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
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                          <thead>
                              <tr role="row">
                                  <th class="sorting">No</th>
                                  <th class="sorting">IP Address</th>
                                  <th class="sorting">Username</th>
                                  <th class="sorting">Status</th>
                                  <th class="sorting">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr role="row" class="odd">
                                  <td tabindex="0" class="sorting_1">Airi Satou</td>
                                  <td>Accountant</td>
                                  <td>Tokyo</td>
                                  <td>33</td>
                                  <td>
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;">
                                          <button type="button" class="tabledit-info-button btn btn-sm btn-info" style="float: none; margin: 4px;"><span class="ti-info-alt"></span></button>
                                          <button type="button" class="tabledit-edit-button btn btn-sm btn-warning" style="float: none; margin: 4px;"><span class="ti-pencil"></span></button>
                                          <button type="button" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none; margin: 4px;"><span class="ti-trash"></span></button>
                                        </div>
                                    </div>
                                  </td>
                              </tr>
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
