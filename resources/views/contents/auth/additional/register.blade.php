@section('authstyle_custom')
<!-- form-validation -->
<link rel="stylesheet" href="{{ asset('assets/adminTemplate/assets/plugins/form-validation/css/formValidation.min.css') }}">
<style media="screen">
  .fv-plugins-bootstrap .fv-help-block {
    margin: -10px 0px -20px;
    text-align: center;
}
</style>
@endsection
@section('authscript_custom')
<!-- form-validation -->
<script src="{{ asset('assets/adminTemplate/assets/plugins/form-validation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('assets/adminTemplate/assets/plugins/form-validation/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/adminTemplate/assets/plugins/form-validation/js/jquery.validate.js') }}"></script>
<script type="text/javascript">
$(document).on("click","#captcha_register",function functionName() {
  $(this).attr('src', '/captcha/flat?'+Math.random());
  $('#validation').val('')
})
document.addEventListener('DOMContentLoaded', function(e) {
    const form = document.getElementById('form-register');
    const fv = FormValidation.formValidation(
      form,
      {
        fields: {
          username: {
            verbose: false,
            validators: {
              notEmpty: {
                message: '@lang('validation.required',['attribute'=> 'username'])'
              },
              stringLength: {
                min: 4,
                max: 50,
                message: 'panjang'
              },
            }
          },
          email: {
            icon: true,
            validators: {
              notEmpty: {
                message: '@lang('validation.required',['attribute'=> 'email'])'
              },
              emailAddress: {
                  message: '@lang('validation.email',['attribute'=> 'email'])'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: '@lang('validation.required',['attribute' =>'password'])'
              },
              remote: {
                headers : {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: location.origin+'/register/checkPasswordFormat',
                delay: 1000,
                data: function() {
                    return {
                        'username': $("#user_name").val()
                    };
                  },
                message: '@lang('validation.password')'
              },
            }
          },
          password_confirmation: {
						validators: {
							notEmpty: {
								message: '@lang('validation.required',['attribute' =>'password_confirmation'])'
							},
							identical: {
								compare: function() {
									return form.querySelector('[name="password"]').value;
								},
								message: '@lang('validation.confirmed',['attribute' =>'password_confirmation'])'
							}
						}
					},
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap({
                // Do not show the error message in default area
                // defaultMessageContainer: false,
        }),
    submitButton: new FormValidation.plugins.SubmitButton(),
      defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            // tooltip: new FormValidation.plugins.Tooltip({
            //   placement: 'right',
            //   trigger: 'click', //hover
            // }),
            icon: new FormValidation.plugins.Icon({
              valid: 'fa fa-check',
              invalid: 'fa fa-times',
              validating: 'fa fa-refresh'
            }),
        },
    }
  );
  fv.on('core.element.validating' , function(event) {
  });
  fv.on('core.form.valid',function(){
    register($('#form-register').serialize())
  });
});
//post register
register = function(serialize) {
  $.ajax({
    headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    url     : location.origin+'/register/',
    method  : 'post',
    data    : serialize,
    beforeSend:function () {
      $('#preloader').show()
    },
    success : function(response){
      $('#preloader').hide()
      if (response.errors) {
        $.each(response.errors, function(index, value){
              $('#notif_danger').show();
              $('#notif_danger').html(value);
              var rand = Math.random();
              $('#captcha_register').attr('src','/captcha/flat?'+rand);
              $('#validation').val('')
        })
      }else if (response.success) {
        window.location.reload()
      }else {
          alert(response.errors);
      }
    },
    error: function (e) {
        console.log("Internal error contact customer service");
    }
  })
}
</script>
@endsection
