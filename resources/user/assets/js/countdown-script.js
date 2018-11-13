var counter = null;
var counter_stop = null;
$(function(){
	
	var ts = new Date(2012, 0, 1),
		newYear = true;
	
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = (new Date()).getTime() + 1000 * 60 * 60 * 2;//10*24*60*60*1000;
		newYear = false;
	}
		
	 counter_stop = $('#countdown_stop').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
		},
		stopeed : true
	});
	
	counter = $('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
		}
		
	});
	
		
	
});
