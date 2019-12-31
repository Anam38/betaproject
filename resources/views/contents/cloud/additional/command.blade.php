@section('style_custom')
@endsection
@section('script_custom')
<script src="{{ asset('assets/adminTemplate/assets/js/time.js') }}"></script>
<script type="text/javascript">
$(document).on('click','#scrolltop',function functionName() {
  elementheight = $('#command-output').prop('scrollHeight');
  if ($(this).attr('top') == 1) {
    $(this).attr('top','0');
    $(this).html('<i class="fas fa-angle-double-down"></i>');
    $('#command-output').animate({scrollTop:0}, 'slow')
  }else {
    $(this).attr('top','1');
    $(this).html('<i class="fas fa-angle-double-up"></i>');
    $('#command-output').animate({scrollTop: elementheight }, 'slow')
  }
});

$(document).on('submit','.command-form',function () {
  command($(this).serialize());
})

var command = function(serialize) {
  $.ajax({
    headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    url     : location.origin+'/cloud/runcommand',
    method  : 'post',
    cache: false,
    data : serialize,
    beforeSend:function () {
    },
    success : function(response){
      var output = ''
      console.log(response.original.sessionOutput);
      $('#cwd_name').text('~'+response.original.sessionCwdname+'$')
      $.each(response.original.sessionOutput,function(index,value){
        if (Array.isArray(value)) {
          $.each(value,function(indexs,values){
              output += '<div style="padding-left:20px;">'+values+'<br></div>'
          });
        }else {
          if (value.indexOf('$') > -1) {
              output += value+"<br>"
          }else {
            if (value.indexOf('\n') > -1) {
              output += '<div style="padding-left:20px;" >'+value.replace(/\n|\r/g, "<br>")+'</div>'
            }else {
              output += '<div style="padding-left:20px;" >'+value+'<br></div>'
            }
          }
        }
      });
      console.log(response.original.sessionOutput);
      $('.command-output').html(output);
      $('#command').val('').focus();
    },
    error: function (e) {
        console.log("Internal error contact customer service");
    }
  })
}

var attr = $('.command-form').attr('data-cloud');
if (typeof attr !== typeof undefined && attr !== false) {
  getlocation();
}

function getlocation() {
  $.ajax({
    headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    url     : location.origin+'/cloud/getlocation',
    method  : 'post',
    beforeSend:function () {
      $('#preloader').show();
      $('#location').html('<div class="br-loader animate-loader initBeforeMount" for="wallet" style="height: 20px; background: #777; width: 100px;"></div>');
    },
    success : function(response){
      $('#preloader').hide();
      if (response.status == 'success'){
        $('#location').html(response.data.continent_name);
      }else {
        console.log(response);
      }
    },
    error: function (e) {
        console.log("Internal error contact customer service");
    }
  })
}
</script>
@endsection
