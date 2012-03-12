$(document).ready(function(){
	var dt = new Date();
	var t = {
		day: weekDay(dt.getDay()),
		date: zpad(dt.getDate()),
		month: zpad(dt.getMonth()+1),
		year: dt.getFullYear(),
		hour: zpad(dt.getHours()),
		min: zpad(dt.getMinutes()),
		sec: zpad(dt.getSeconds())
	}
	
	
	$('#bigtime').text(t.day+', '+t.date+'.'+t.month+'.'+t.year+' - '+t.hour+':'+t.min+':'+t.sec);
	
	
	function niceTime(){
		
		
		
		
		
		
		
	}
	
	function weekDay(index){
		var day =['Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Četvrtak', 'Petak', 'Subota'];
		return day[index];
	}
	
	function zpad(num){
		return (num<10)?'0'+num:num;
	}
	
});

