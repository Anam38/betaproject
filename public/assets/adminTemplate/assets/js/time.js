var $dOut = $('#date'),
    $hOut = $('#hours'),
    $mOut = $('#minutes'),
    $sOut = $('#seconds'),
    $ampmOut = $('#ampm');
    $server = $('.time-server');
var months = [
  'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
];

var days = [
  'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
];

function update(){
  var date = new Date();

  var ampm = date.getHours() < 12
             ? 'AM'
             : 'PM';

  var hours = date.getHours() == 0
              ? 12
              : date.getHours() > 12
                ? date.getHours() - 12
                : date.getHours();

  var minutes = date.getMinutes() < 10
                ? '0' + date.getMinutes()
                : date.getMinutes();

  var seconds = date.getSeconds() < 10
                ? '0' + date.getSeconds()
                : date.getSeconds();

  var dayOfWeek = days[date.getDay()];
  var month = months[date.getMonth()];
  var day = date.getDate();
  var year = date.getFullYear();

  var dateString = dayOfWeek + ', ' + month + ' ' + day + ', ' + year;
  var dateStrings = hours + ':' + minutes + ':' + seconds + ': ' + ampm;

  $server.text('Time server = '+dateStrings);
  $dOut.text(dateString);
  $hOut.text(hours);
  $mOut.text(minutes);
  $sOut.text(seconds);
  $ampmOut.text(ampm);
}

//get information server
getinformation = function() {
  $.ajax({
    headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
    url     : location.origin+'/cloud/information',
    method  : 'post',
    beforeSend:function () {
    },
    success : function(response){
      var memorycount = response.memory[0];
      var memoryuse = response.memory[1];
      var memoryspace = response.memory[5];

      var disckcount = response.disck[0];
      var disckuse = response.disck[1];
      var disckspace = response.disck[2];

      var calculation_memory_free = memoryspace*100/memorycount
      var calculation_memory_use = memoryuse*100/memorycount
      var result_free_memory = Math.round(calculation_memory_free)
      var result_use_memory = Math.round(calculation_memory_use)

      var calculation_disck_free = parseInt(disckspace.replace("G", ''))*100/parseInt(disckcount.replace("G", ''))
      var result_free_disck = Math.round(calculation_disck_free)
      var result_use_disck = response.disck[3]

      $('#host_name').text(response.host_name);
      $('#location').text();
      $('#operation_system').text(response.operation_system);
      $('#cpu_speed').text(response.cpu_speed+' MHz');
      $('#memory').html('<div class="form-check-inline my-1 font-10 " style="margin-left: -10px;">'+
                        '<i class="mdi mdi-circle-outline d-block pr-1 pl-2 font-18 text-primary"></i> Count= '+memorycount+'Mb'+
                        '<i class="mdi mdi-circle-outline d-block pr-1 pl-2 font-18 text-danger"></i> Used= '+memoryuse+'Mb'+
                        '<i class="mdi mdi-circle-outline d-block pr-1 pl-2 font-18 text-warning"></i>Free= '+memoryspace+'Mb</div>'+
                            '<div class="progress" style="background-color:#224ae5;">'+
                            '<div class="progress-bar bg-danger" title="Used" role="progressbar" style="width:'+result_use_memory+'%">'+result_use_memory+'%</div>'+
                            '<div class="progress-bar bg-warning" title="Free" role="progressbar" style="width:'+result_free_memory+'%">'+result_free_memory+'%</div>'+
                        '</div>');
      $('#disck').html('<div class="form-check-inline my-1 font-10 " style="margin-left: -10px;">'+
                        '<i class="mdi mdi-circle-outline d-block pr-1 pl-2 font-18 text-primary"></i> Count= '+disckcount+''+
                        '<i class="mdi mdi-circle-outline d-block pr-1 pl-2 font-18 text-danger"></i> Used= '+disckuse+''+
                        '<i class="mdi mdi-circle-outline d-block pr-1 pl-2 font-18 text-warning"></i>Free= '+disckspace+'</div>'+
                            '<div class="progress" style="background-color:#224ae5;">'+
                            '<div class="progress-bar bg-danger" title="Used" role="progressbar" style="width:'+result_use_disck+'">'+result_use_disck+'</div>'+
                            '<div class="progress-bar bg-warning" title="Free" role="progressbar" style="width:'+result_free_disck+'%">'+result_free_disck+'%</div>'+
                        '</div>');
    },
    error: function (e) {
        console.log("Internal error contact customer service");
    }
  })
}
update();
getinformation()
window.setInterval(update, 1000);
// setInterval(function(){getinformation(); },5000);
