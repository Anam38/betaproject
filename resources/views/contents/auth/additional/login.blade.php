@section('authstyle_custom')
@endsection
@section('authscript_custom')
<script type="text/javascript">
$(document).on("click","#captcha_register",function functionName() {
  $(this).attr('src', '/captcha/flat?'+Math.random());
  $('#validation').val('')
})
</script>
@endsection
