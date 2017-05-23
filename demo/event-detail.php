<?php include('header-profile.php'); ?>
<div id="event-detail" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow textbg">EVENT DETAIL</h1>
    	</div>
        
        <div class="row">
            <div class="box-grey">
            	<div class="infoDetailEvent">                            
                    <h1 class="yellow textbg"><span class="startDates">14/05/2015</span>  <span class="dashDates">&ndash;</span> <span class="endDates">15/05/2015</span></h1>
                    <p class="">Waktu: 10:00 PM - 03:30 AM</p>               
                    <h1 class="">EVENT A Chapter 1<br /><span class="categoryEvents">Nobar</span></h1>
                    <p>Cafe Bola</p>
                    <address>Jl Kemang Timur Raya No 1003 <br /> Jakarta Selatan</address>
                    <p>Guys, jangan lupa weekend minggu depan kita akan ngadain acara nobar Manchester United vs Arsenal di  Cafe Bola, Jalan Kemang Timur No 100.</p>
                    <p>Supaya makin seru, jangan lupa pake jeysey kita ya!</p>
                    <p>Glory-glory Arsenal!!!!</p>
                </div>
            </div>
        </div><!--end.row-->
        
        <div class="rowss" style="overflow:inherit;">
		
			<div style="display:none">
					      <input type="file" class="myfile" id="myfile" name="myfile[]" /> 
					      <input type="hidden" id="talent_seeker_id" name="talent_seeker_id" value='{$uid}'>
			</div>
            <div class="uploadFoto">
			
            	 <div class="rowss">
                  
              
                
				
            	</div>
				<a   href="javascript:void(0)" class="button browsfile" id="browsfile">PILIH FILE</a>
				<button   href="javascript:void(0)" class=" button " >SIMPAN</button>
                <p class="infotext" style="margin:10px 0 0 10px;">Upload maximal 2 foto, ukuran 1 foto max. 2MB (JPG, JPEG)</p>
            </div>
        </div><!--end.rows-->
        
    </div><!--end#container-->
</div><!--end.section-->
<script>
var urt=0;
$('.browsfile').click(function(e)
 {
	console.log($('.filimg').length);
	console.log($('.myfile').length);
	if($('.filimg').length < 2  )
	{
		console.log($('.filimg').length);
		console.log('sss');
		if(($('.myfile').length >1 && $('.myfile').length<=2) || ($('.browsfile').length >1 && $('.browsfile').length<=2 ))
		{
			$(".myfile:last").trigger('click');
			thiss= $(".myfile:last");
		}
		else if($('.myfile').length==1)
		{
			$(".myfile").trigger('click');
			thiss= $(".myfile");
		}
		else
		{
			
			alert('Sorry, you can only upload up to 2 files');
		}
	}
	else
	{
		alert('Sorry, you can only upload up to 2 files');
	}
	if($('.myfile').length<=2)
	{
		thiss.change(function(e)
		 {
		   
			   e.preventDefault();
				
			    $(".upload_no").html('');
				
				var dataup = $('.filimg').length;
				console.log(this.files[0].size);
				if(this.files[0].size > 5000000)
				{
				
					alert('Sorry, maximum file size is 2 MB');
					
				}
				else
				{
					++urt;
				   if(this.files[0].type=='image/jpeg' || this.files[0].type=='image/png' )
					{
						 var reader = new FileReader();
						 reader.onload = function (ex) {
							ex.preventDefault();
							
						 $('.browsfile').prev().before(' <div class="imagePost  ros'+urt+'"><img width="150"  data-row="'+urt+'"  class="filimg ros'+urt+'" hegiht="50" src="'+ex.target.result+'"><label class="ros'+urt+'" onclick="delimgs('+urt+')" > x </label></div>  ');
						  }
					  reader.readAsDataURL(this.files[0]);
					  
					  $(this).after(' <input type="file" class="myfile ros'+urt+'" data-row="'+urt+'" id="myfile" name="myfile[]" />');
					  
					}
				 
				   else
				   {
				   
					alert('Sorry, we can only support JPG/PNG files');
				   }
				   end;
				}
			   
				
			   // $('browsfile')
			   // $('.bg_home').attr('src', e.target.result);   

		 });
	 }
	
 });
 
 function delimgs(rows)
		{
			
			$('.ros'+rows).remove();
		
		}
 function delimgst(rows)
		{
			
			$('.rot'+rows).remove();
		
		}
  
</script>

