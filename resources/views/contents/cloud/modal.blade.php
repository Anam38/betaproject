<!-- modal add data -->
<div id="modal-add" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Added New Connection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- alert notification -->
              <div class="alert alert-pink border-0 text-center alert-danger" id="alert-danger" role="alert" style="display:none;"></div>
              <div class="alert alert-secondary border-0 text-center alert-success" id="alert-success" role="alert" style="display:none;"></div>
              <!-- end notification -->
              <form class="form-added-cloud" method="post" action="{{ route('cloud.submit')}}">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name Connection</label>
                  <div class="input-group">
                      <input type="text" name="connection_name" class="form-control" placeholder="Name your connection" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-8">
                      <label for="exampleInputEmail1">Hostname or IP Address</label>
                      <div class="input-group">
                          <input type="text" name="ip_address" class="form-control" placeholder="localhost or 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleInputEmail1">Port</label>
                      <div class="input-group">
                        <input type="text" name="port" required class="form-control" placeholder="2222" onkeydown="this.value=this.value.replace(/[^0-9]/g,'');" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <div class="input-group">
                      <input type="text" name="username" class="form-control" placeholder="Username Host" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="Password Host" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Initial Directory</label>
                  <div class="input-group">
                      <input type="text" name="directory" class="form-control" placeholder="/public_html/example">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <div class="input-group">
                    <div class="form-check-inline my-1">
                      <div class="custom-control custom-radio">
                          <input type="radio" id="Active" checked name="status" value="1" class="custom-control-input">
                          <label class="custom-control-label" for="Active">Active</label>
                      </div>
                  </div>
                  <div class="form-check-inline my-1">
                      <div class="custom-control custom-radio">
                          <input type="radio" id="Nonactive" name="status" value="0" class="custom-control-input">
                          <label class="custom-control-label" for="Nonactive">Nonactive</label>
                      </div>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  @csrf()
                  <button type="button" class="btn btn-secondary waves-effect testconnection" data-form="form-added-cloud" title="Test Connection">Test Connection</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </div>
              </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal update data -->
<div id="modal-update" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Update Connection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- alert notification -->
              <div class="alert alert-pink border-0 text-center alert-danger" id="alert-danger" role="alert" style="display:none;"></div>
              <div class="alert alert-secondary border-0 text-center alert-success" id="alert-success" role="alert" style="display:none;"></div>
              <!-- end notification -->
              <form class="form-update-cloud" method="post" action="{{ route('cloud.update')}}">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name Connection</label>
                  <div class="input-group">
                      <input type="text" id="connection_name" name="connection_name" class="form-control" placeholder="Name your connection" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-8">
                      <label for="exampleInputEmail1">Hostname or IP Address</label>
                      <div class="input-group">
                          <input type="text" id="ip_address" name="ip_address" class="form-control" placeholder="localhost or 127.0.0.1" required>
                          <input type="hidden" id="id_cloud" name="id" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <label for="exampleInputEmail1">Port</label>
                      <div class="input-group">
                        <input type="text" id="port" name="port" required class="form-control" placeholder="2222" onkeydown="this.value=this.value.replace(/[^0-9]/g,'');" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <div class="input-group">
                      <input type="text" id="username" name="username" class="form-control" placeholder="Username Host" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <div class="input-group">
                      <input type="password" id="password" name="password" class="form-control" placeholder="Password Host" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Initial Directory</label>
                  <div class="input-group">
                      <input type="text" id="directory" name="directory" class="form-control" placeholder="/">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <div class="input-group">
                    <div class="form-check-inline my-1">
                      <div class="custom-control custom-radio">
                          <input type="radio" id="Active_update" name="status" value="1" class="custom-control-input">
                          <label class="custom-control-label" for="Active_update">Active</label>
                      </div>
                  </div>
                  <div class="form-check-inline my-1">
                      <div class="custom-control custom-radio">
                          <input type="radio" id="Nonactive_update" name="status" value="0" class="custom-control-input">
                          <label class="custom-control-label" for="Nonactive_update">Nonactive</label>
                      </div>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  @csrf()
                  <button type="button" class="btn btn-secondary waves-effect testconnection" data-form="form-update-cloud" title="Test Connection">Test</button>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </div>
              </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal delete data -->
<div id="modal-delete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Delete Connection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="margin-bottom: -20px;">
              <form class="" method="post" action="{{ route('cloud.delete')}}">
                <div class="text-center">
                  <input type="hidden" id="id_cloud_delete" name="id" class="form-control" required>
                  <label>Are you sure delete <h5 id="name_connection_delete"></h5> Connection ?</label>
                </div>
                <div class="modal-footer">
                  @csrf()
                  <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Delete</button>
                </div>
              </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
