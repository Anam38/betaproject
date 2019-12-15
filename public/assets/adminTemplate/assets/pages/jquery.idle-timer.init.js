$.fn.scrollToBottom=function(){return this.scrollTop(this[0].scrollHeight),this},jQuery("#alert").click(function(){return alert("Hello!"),!1}),function(n){n(document).on("idle.idleTimer",function(t,e,o){n("#docStatus").val(function(t,e){return e+"Idle @ "+moment().format()+" \n"}).removeClass("alert-success").addClass("alert-warning").scrollToBottom()}),n(document).on("active.idleTimer",function(t,e,o,l){n("#docStatus").val(function(t,e){return e+"Active ["+l.type+"] ["+l.target.nodeName+"] @ "+moment().format()+" \n"}).addClass("alert-success").removeClass("alert-warning").scrollToBottom()}),n("#btPause").click(function(){return n(document).idleTimer("pause"),n("#docStatus").val(function(t,e){return e+"Paused @ "+moment().format()+" \n"}).scrollToBottom(),n(this).blur(),!1}),n("#btResume").click(function(){return n(document).idleTimer("resume"),n("#docStatus").val(function(t,e){return e+"Resumed @ "+moment().format()+" \n"}).scrollToBottom(),n(this).blur(),!1}),n("#btElapsed").click(function(){return n("#docStatus").val(function(t,e){return e+"Elapsed (since becoming active): "+n(document).idleTimer("getElapsedTime")+" \n"}).scrollToBottom(),n(this).blur(),!1}),n("#btDestroy").click(function(){return n(document).idleTimer("destroy"),n("#docStatus").val(function(t,e){return e+"Destroyed: @ "+moment().format()+" \n"}).removeClass("alert-success").removeClass("alert-warning").scrollToBottom(),n(this).blur(),!1}),n("#btInit").click(function(){return n(document).idleTimer({timeout:5e3}),n("#docStatus").val(function(t,e){return e+"Init: @ "+moment().format()+" \n"}).scrollToBottom(),n(document).idleTimer("isIdle")?n("#docStatus").removeClass("alert-success").addClass("alert-warning"):n("#docStatus").addClass("alert-success").removeClass("alert-warning"),n(this).blur(),!1}),n("#docStatus").val(""),n(document).idleTimer({timeout:5e3,timerSyncId:"document-timer-demo"}),n(document).idleTimer("isIdle")?n("#docStatus").val(function(t,e){return e+"Initial Idle State @ "+moment().format()+" \n"}).removeClass("alert-success").addClass("alert-warning").scrollToBottom():n("#docStatus").val(function(t,e){return e+"Initial Active State @ "+moment().format()+" \n"}).addClass("alert-success").removeClass("alert-warning").scrollToBottom(),n("#docTimeout").text(5)}(jQuery),function(l){l("#elStatus").on("idle.idleTimer",function(t,e,o){t.stopPropagation(),l("#elStatus").val(function(t,e){return e+"Idle @ "+moment().format()+" \n"}).removeClass("alert-success").addClass("alert-warning").scrollToBottom()}),l("#elStatus").on("active.idleTimer",function(t){t.stopPropagation(),l("#elStatus").val(function(t,e){return e+"Active @ "+moment().format()+" \n"}).addClass("alert-success").removeClass("alert-warning").scrollToBottom()}),l("#btReset").click(function(){return l("#elStatus").idleTimer("reset").val(function(t,e){return e+"Reset @ "+moment().format()+" \n"}).scrollToBottom(),l("#elStatus").idleTimer("isIdle")?l("#elStatus").removeClass("alert-success").addClass("alert-warning"):l("#elStatus").addClass("alert-success").removeClass("alert-warning"),l(this).blur(),!1}),l("#btRemaining").click(function(){return l("#elStatus").val(function(t,e){return e+"Remaining: "+l("#elStatus").idleTimer("getRemainingTime")+" \n"}).scrollToBottom(),l(this).blur(),!1}),l("#btLastActive").click(function(){return l("#elStatus").val(function(t,e){return e+"LastActive: "+l("#elStatus").idleTimer("getLastActiveTime")+" \n"}).scrollToBottom(),l(this).blur(),!1}),l("#btState").click(function(){return l("#elStatus").val(function(t,e){return e+"State: "+(l("#elStatus").idleTimer("isIdle")?"idle":"active")+" \n"}).scrollToBottom(),l(this).blur(),!1}),l("#elStatus").val("").idleTimer({timeout:3e3,timerSyncId:"element-timer-demo"}),l("#elStatus").idleTimer("isIdle")?l("#elStatus").val(function(t,e){return e+"Initial Idle @ "+moment().format()+" \n"}).removeClass("alert-success").addClass("alert-warning").scrollToBottom():l("#elStatus").val(function(t,e){return e+"Initial Active @ "+moment().format()+" \n"}).addClass("alert-success").removeClass("alert-warning").scrollToBottom(),l("#elTimeout").text(3)}(jQuery);