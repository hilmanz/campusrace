function upload_foto(){

$('#browsfile').click(function(e)
 {
	console.log('ss');
			$(".myfile").trigger('click');
			thiss= $(".myfile");
			thiss.change(function(e)
			{
		   
			   e.preventDefault();
		
			   if(this.files[0].size != '')
			   {
				if(this.files[0].size > 4000000)
				{
					alert('size tidak lebih dari 4 Mb')
					
				}
				if(this.files[0].type!='image/jpeg')
				{
					alert('type file Harus Jpeg')
				}
				
				if(this.files[0].size < 4000000 && this.files[0].type=='image/jpeg'){
					
				
					
					var formData = new FormData($("#formuploadcv")[0]);
			
					$.ajax({
					
						type: 'POST',
						url: ''+basedomain+'chapter/upload_foto',
						data: formData,
						dataType:'json',
						success: function (result) {
						$(".myfile").val('');
						var str="";
						str+='<img src="'+basedomain+'public_assets/profile/'+result.file+'" class="img-thumbnail overhereimg" >';
						
						$('.gallery-image').html(str);
						},
						
						contentType: false,
						processData: false,
						
					});
			
					END;
				


					//$("#formuploadcv").trigger('click');
				}
				}
				return false;
			});
			
});	
}