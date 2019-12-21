@section('style_custom')
@endsection
@section('script_custom')
<script type="text/javascript">
  // $(document).ready(function(){
  //   submitCommand()
  // })
  $(document).on("click","#captcha_register",function functionName() {
    $(this).attr('src', '/captcha/flat?'+Math.random());
    $('#validation').val('')
  })
    function levelup(d) {
        $('#levelup').val(d);
        $('.command-form').submit() ;
    }
    // function changesubdir(d) {
    //     document.shell.changedirectory.value=document.shell.dirselected.value ;
    //     document.shell.submit() ;
    // }
  // submit command
  $(document).on('submit','.command-form',function() {
    $(this).submit()
    // submitCommand($(this).serialize())
  })
  // function submitCommand(serialize=null){
  //   var result = ''
  //   $.ajax({
  //     headers :{
  //       'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
  //     },
  //     data : serialize,
  //     url  : location.origin+'/command',
  //     method : 'POST',
  //     beforeSend:function () {
  //     },
  //     success:function (response) {
  //       if (response.success) {
  //         // return output
  //         $.each(response.data.output,function(index, value) {
  //           if (Array.isArray(value)) {
  //             console.log(response.data);
  //             if (value.indexOf('$')) {
  //               result += '<div style="padding-left:20px;">'+value+'<br></div>'
  //             }else {
  //               result += value+'<br>'
  //             }
  //           }else {
  //             if (value.indexOf('$')) {
  //               result += '<div style="padding-left:20px;">'+value+'<br></div>'
  //             }else {
  //               result += value+'<br>'
  //             }
  //           }
  //         })
  //         $(document).find('#command-output').html(result)
  //       }else {
  //
  //       }
  //     },
  //     error: function (request, status, error) {
  //        alert(request.responseText);
  //    }
  //   });
  // }
</script>
@endsection
