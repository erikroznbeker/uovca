$(document).ready(function(){
	
	var t = {}
	var BTsec = null;
	niceTime();//first run
	
	function niceTime(){
		
		var dt = new Date();
		t = {
			day: weekDay(dt.getDay()),
			date: zpad(dt.getDate()),
			month: zpad(dt.getMonth()+1),
			year: dt.getFullYear(),
			hour: zpad(dt.getHours()),
			min: zpad(dt.getMinutes()),
			sec: dt.getSeconds()
		}
		
		$('#bigtime').html('<span class="ccc">'+t.day+',</span> '+t.date+'.'+t.month+'.'+t.year+' &nbsp; '+t.hour+':'+t.min+'<span id="btsec" class="ccc">:'+zpad(t.sec)+'</span>');
		
		clearInterval(BTsec);
		BTsec = setInterval(BTsecUpdate, 1000);
	}
	
	function BTsecUpdate(){
		if(t.sec && t.sec==59){
			niceTime();
		}
		else {
			t.sec++;
			$('#btsec').text(':'+zpad(t.sec));
		}
	}
	
	
	function weekDay(index){
		var day =['Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Četvrtak', 'Petak', 'Subota'];
		return day[index];
	}
	
	function zpad(num){
		return (num<10)?'0'+num:num;
	}
	
});

