@section('style_custom')
<!-- DataTables -->
<link href="{{asset('assets/adminTemplate/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/adminTemplate/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('script_custom')
<!-- Required datatable js -->
<script src="{{asset('assets/adminTemplate/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('assets/adminTemplate/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
$(document).ready( function () {
    $('#datatable').DataTable();
} );
// button check connection
$(document).on('click','.testconnection',function() {
  form = $(this).attr('data-form');
  TestConnection($('.'+form).serialize());
})
// button get data for update
$(document).on('click','.update_data',function() {
  getdata($(this).attr('data-id'));
})
// button get data for delete
$(document).on('click','.delete_data',function() {
  $('#modal-delete').modal('show');
  $('#id_cloud_delete').val($(this).attr('data-id'));
  $('#name_connection_delete').text($(this).attr('data-name'));

})

//get data with id
getdata = function(data_id) {
  $.ajax({
    headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    url     : location.origin+'/cloud/update',
    method  : 'get',
    data    : { id:data_id },
    beforeSend:function () {
    },
    success : function(response){
      $('#modal-update').modal('show');
      $('#id_cloud').val(response.id);
      $('#connection_name').val(response.connection_name);
      $('#ip_address').val(response.ip_address);
      $('#port').val(response.port);
      $('#username').val(response.username);
      $('#password').val(response.password);
      $('#directory').val(response.directory);
      if (response.isactive == 1) {
        $('#Active_update').attr('checked','checked');
      }else {
        $('#Nonactive_update').attr('checked','checked','checked');
      }
    },
    error: function (e) {
        console.log("Internal error contact customer service");
    }
  })
}
//check connection
TestConnection = function(serialize) {
  $.ajax({
    headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    url     : location.origin+'/cloud/testconnection',
    method  : 'post',
    data    : serialize,
    beforeSend:function () {
    },
    success : function(response){
      if (response.errors) {
        $('.alert-danger').show().html(response.errors);
      }else if (response.success) {
        $('.alert-success').show().html(response.success);
      }else {
        $('.alert-danger').show().html(response);
      }
      setTimeout(function(){ $('.alert').hide(1000); }, 3000);
    },
    error: function (e) {
        console.log("Internal error contact customer service");
    }
  })
}
</script>
@endsection
