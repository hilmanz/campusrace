$( document ).ready(function() {
var problem=0;

$('.number').keyup(function () {  
		if(this.value)
		{
			this.value = this.value.replace(/[^0-9\.]/g,''); 
			
		}
	});
$('.email').keyup(function () {  
		if(this.value)
		{
			var emailValid   = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
			
			 if (!email.match(emailValid)) {
			 
				var tribut= this.attr('name');
				this.find('.msg_name').html(tribut+' is not correct');
			 }
		}
		
	});

$('.url').keyup(function () {  
		if($(this).val())
		{
			var regxurl = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;

			
			 if (!regxurl.test($(this).val())) {
				var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html(tribut+' is not correct'); 
				problem=1;
			 }
			 else
			 {
				var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html(''); 
				problem=0;
			 }
		}
		
	});
$('.youtube').keyup(function () {  
		if($(this).val())
		{
			var regxurlYoutube = /^http:\/\/(?:www\.)?youtube.com\/watch\?(?=.*v=\w+)(?:\S+)?$/;
			if (!regxurlYoutube.test($(this).val())) {
						var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html(tribut+' is not correct');
						problem=1;
				 }
			else
				{
					var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html('');
					problem=0;
				}
			
		}
		
	});
$('.atitude').keyup(function () {  
		if($(this).val())
		{
			
			var regxurlatitude = /^-?([0-8]?[0-9]|90)\.[0-9]{1,6}/;
			 if (!regxurlatitude.test($(this).val())) {
						var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html(tribut+' is not corrects');
						problem=1;
				 }
			else
				{
					var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html('');
					problem=0;
				}
		}
		
	});
	$('.logtitude').keyup(function () {  
		if($(this).val())
		{
				var regxurllogtitude = /^-?((1?[0-7]?|[0-9]?)[0-9]|180)\.[0-9]{1,6}$/;
			 if (!regxurllogtitude.test($(this).val())) {
						var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html(tribut+' is not corrects');
						problem=1;
				 }
			else
				{
					var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html('');
					problem=0;
				}
		}
		
	});
	$('input[type=submit]').click(function () {
	var banyak =$( ".mandatory" ).length;
	
	var totalisi = 0;
		$( ".mandatory" ).each(function( index ) {
		tinyMCE.triggerSave();
		
			if($(this).val()=='')
				{
					var tribut= $(this).attr('name');
					$(this).parent().find('.msg_name').html(tribut+' is not correct'); 
					//problem=1;
					// totalKosong++;
				}
				else
				{
					++totalisi;
					
					var tribut= $(this).attr('name');
					
					$(this).parent().find('.msg_name').html('');
					
					/*var regxurl = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
					var urlValues = $(this).parent().find('.url');
					if(urlValues.val())
					{
						if (!regxurl.test(urlValues.val())) {
							var tribut= urlValues.attr('name');
								urlValues.parent().find('.msg_name').html(tribut+' is not correct'); 
							problem=1;
						 }
					}
					 
					
					 var regxurlYoutube = /^http:\/\/(?:www\.)?youtube.com\/watch\?(?=.*v=\w+)(?:\S+)?$/;
					 var YoutubeValues = $(this).parent().find('.youtube');
					 if(YoutubeValues.val())
					{
						 if (!regxurlYoutube.test(YoutubeValues.val())) {
							var tribut= YoutubeValues.attr('name');
								YoutubeValues.parent().find('.msg_name').html(tribut+' is not correct'); 
							problem=1;
						 }
					 }
					 
					 var regxurllogtitude = /^-?((1?[0-7]?|[0-9]?)[0-9]|180)\.[0-9]{1,6}$/;
					  var logtitudeValues = $(this).parent().find('.logitude');
					 if (logtitudeValues.val()) {
							if (!logtitudeValues.test(logtitudeValues.val())) {
								var tribut= logtitudeValues.attr('name');
								logtitudeValues.parent().find('.msg_name').html(tribut+' is not correct');
								problem=1;
								
							}
						 }
						 
					 var regxurlatitude = /^-?([0-8]?[0-9]|90)\.[0-9]{1,6}/;
					  var atitudeValues = $(this).parent().find('.atitude');
					 if (atitudeValues.val()) {
							if (!atitudeValues.test(atitudeValues.val())) {
								var tribut= atitudeValues.attr('name');
								atitudeValues.parent().find('.msg_name').html(tribut+' is not correct');
								problem=1;
								
							}
						 }
					*/
				}
			//problem =
		});
		 // if(problem>0)
		 // {
		 if(totalisi!=banyak || problem>0)
		 {
			return false;
		 }
		
			
		 // }
	
	});
});