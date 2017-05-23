<?php /* Smarty version 2.6.13, created on 2016-03-21 17:25:38
         compiled from application/admin//apps/addvoucher.html */ ?>
  <?php echo '
<script>
 $(function() {
		function convertDate(inputFormat) {
		  function pad(s) { return (s < 10) ? \'0\' + s : s; }
		  var d = new Date(inputFormat);
		  return [pad(d.getMonth()), pad(d.getDate()+1), d.getFullYear()].join(\'/\');
		}
		
		$(\'#datepickers1\').change(function()
									{
										
										var today = new Date();     
										var tglintv =  convertDate($(this).val());   
										var miliday = 24 * 60 * 60 * 1000;
										var selisih = (tglintv - today) / miliday;
										 console.log(selisih);
										 $(\'.dateintrv_no\').html(\'\');
										if(selisih<=2)
										{
										console.log(\'ss\');
											$(\'.dateintrv_no\').html(\'The date you selected is less than 2 days from today.\');
										}
									});	
		$(\'#timepicker1\').timepicker();
	});
	  $(function() {
	  $(\'#datepicker2\').datepicker();
		$(\'#timepicker2\').timepicker();
	});
'; ?>

</script>
<script>
<?php echo '
 // This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.



  


$(function() {
    $( "#datepickers1" ).datepicker({
	dateFormat:"dd-mm-yy",
     // defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#datepickers2" ).datepicker( "option", "minDate", selectedDate );
		$(\'#timepicker1\').val(\'\');
		$(\'#timepicker2\').val(\'\');
		
      }
    });
    $( "#datepickers2" ).datepicker({
	dateFormat:"dd-mm-yy",
     // defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) { 
        $( "#datepickers1" ).datepicker( "option", "maxDate", selectedDate );
		$(\'#timepicker1\').val(\'\');
		$(\'#timepicker2\').val(\'\');
      }
    });
	
	

});
    </script>
 '; ?>

<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-event">&nbsp;</span>Add Voucher</h2>            
        </div><!-- end .titlebox -->
        <div class="content">
            <form id="forms" class="forms"  method="post" enctype="multipart/form-data" action="<?php echo $this->_tpl_vars['basedomain']; ?>
vouchermanagement/uploadvoucer">			
				<div id="new-project" class="boxcontent">
					<section class="step1">	
						<!--
						<div class="row">
							<label for="name">Nama Member<br></label>
								<select name="member_id[]" class="member_id selectpicker"  multiple data-selected-text-format="count>2">					   
									<option value="">Pilih Member</option>						 
									<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listmember']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
										<option value="<?php echo $this->_tpl_vars['listmember'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['listmember'][$this->_sections['i']['index']]['name']; ?>
</option>						
									<?php endfor; endif; ?>					  
								</select><br>
							<label class="member_id_erorr msg_name"  style="color: red;"></label>
						</div>
						-->						

						<div class="row">
							<label for="name">Upload csv<br></label>
							<input name="voucher" id="voucher"  type="file" class="voucher"  style="width: 200px;"><br>
							<label class="voucher_erorr msg_name"  style="color: red;"></label>
						</div><!-- end .row -->
					  	<!--				
						<div class="row">
							<label>Deskripsi Challenge<br></label>
							<textarea id="description" name="description" class="description"></textarea><br>						
							<label class="description_erorr msg_name" style="color: red;"></label>						
						</div><!-- end .row -->												
						
										
												
						
						<div class="row" >						
							<input type="submit" value="Simpan" name="submit" class="fr button3 submitevent"  />					
							<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement" class="button4 fr text-center">Batal</a>
						</div><!-- end .row -->
					</section>
				</div><!-- end #wizard -->			
            </form>
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
<script>
<?php echo '
	$(document).on(\'click\',\'.submitevent\',function(){
		$(\'.description_erorr\').html(\'\');
		$(\'.voucher_erorr\').html(\'\');
		
		var valid=\'\';
		
		if($(\'.voucher\').val()==\'\')
		{
			$(\'.voucher_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		
		
		if(valid)
		{
			return false;
		}
		else
		{
			$(\'.fromevent\').trigger(\'submit\');
		}
	})
	
	
'; ?>

</script>