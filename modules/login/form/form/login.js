$(document).ready(function(){
	$('#username').focus();
	$('#label_rememberme').click(function(){
		if($('#rememberme:checked').length)$('#rememberme').attr('checked', false);
		else $('#rememberme').attr('checked', true);
	});
	
	//tooltip
	if($('#settings').length && $('#settings').val()){
		var settings = JSON.parse($('#settings').val());
		if(settings.wrongLogin == true){
			$('#tooltip').fadeIn('fast');
			setTimeout(function(){$('#tooltip').fadeOut();}, 5000);
		}
	}
})

