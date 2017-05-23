<?php /* Smarty version 2.6.13, created on 2016-03-22 11:41:16
         compiled from application/web/apps/tebak-skor.html */ ?>
<div id="tebak-skor" class="section">
	<div id="container">
        <div class="rows">
        	<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/banner-skor2.jpg" >
        </div>
		<?php if ($this->_tpl_vars['lispertandingan']): ?> 
        <div class="rows">
        	<div class="descSkor rowboxs tr">
            	
                      <h4 class="title-entry yellow">Cara Bermain</h4>
             
                <ul>
                	<li>Isi tebakan skor kamu untuk 3 pertandingan yang dipilih untuk ditebak.</li>
                    <li>Setelah mengisi seluruh tebakan yang kamu pikir paling jitu, klik tombol submit.</li>
                    <li>Pengumuman pemenang akan diumumkan disini pada tanggal <span class="yellow">2 November 2015</span>.</li>
                </ul>
                <br />
                <h4 class="title-entry yellow">Syarat & ketentuan</h4>
              
                <ul>
                	<li>Pemenang adalah peserta yang berhasil menebak skor ketiga pertandingan paling tepat dan cepat.</li>
                    <li>Setiap pertandingan yang berhasil ditebak secara jitu dan tepat, maka peserta akan mendapatkan 5 poin.</li>
                    <li>Poin yang dihasilkan dari TEBAK SKOR! Ini akan masuk ke dalam poin masing-masing peserta dalam Supersoccer Campus League.</li>
                    <li>Peserta dapat mengubah-ubah prediksi skornya hingga hari <span class="yellow">Jumat, 30 Oktober 2015 pukul 23:59 WIB</span>. Panitia akan menutup submission TEBAK SKOR! Pada <span class="yellow">Sabtu dini hari, pukul 00:00 WIB</span>.</li>
                </ul>
            </div><!--end.skorInput-->
        </div><!--end.rows-->
		<?php endif; ?>
		
		<form method="post" action="member/masukskor" name="myform" id="skor">
			<div class="rows skorRows">
            	<!--a href="#succespopup" class="showPopup">inini</a-->
				<?php if ($this->_tpl_vars['lispertandingan']): ?> 
				<h1 class="tittle yellow">SCOREBOARD</h1> 
					<div class="skorsInput tr">					
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lispertandingan']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<div class="rows skorRowss">
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['club1']; ?>
</h4>
									<div class="skorIn">
										<h5 class="skornya yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['skor1']; ?>
</h5>
									</div>
									
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<h1 class="textVs yellow">VS</h1>
									<span class="arrow-right">&nbsp;</span>
								</div>
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['club2']; ?>
</h4>
									<div class="skorIn">
										<h5 class="skornya yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['skor2']; ?>
</h5>								
									</div>
								</div>
							</div><!--end rows-->
						
							<div class="rows skorRowss">
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['club3']; ?>
</h4>
									<div class="skorIn">
										<h5 class="skornya yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['skor3']; ?>
</h5>
									</div>
									
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<h1 class="textVs yellow">VS</h1>
									<span class="arrow-right">&nbsp;</span>
								</div>
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['club4']; ?>
</h4>
									<div class="skorIn">
										<h5 class="skornya yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['skor4']; ?>
</h5>									
									</div>
								</div>
							</div><!--end rows-->
						
							<div class="rows skorRowss">
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['club5']; ?>
</h4>
									<div class="skorIn">
										<h5 class="skornya yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['skor5']; ?>
</h5>
									</div>
									
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<h1 class="textVs yellow">VS</h1>
									<span class="arrow-right">&nbsp;</span>
								</div>
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['club6']; ?>
</h4>
									<div class="skorIn">
										<h5 class="skornya yellow"><?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['skor6']; ?>
</h5>									
									</div>
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<input class="weekid"  type="hidden" name="weekid" value="<?php echo $this->_tpl_vars['lispertandingan'][$this->_sections['i']['index']]['week_id']; ?>
"/>	
									<span class="arrow-right">&nbsp;</span>
								</div>
							</div><!--end rows-->
						<?php endfor; endif; ?>
						
						<div class="rows">							
							<a href="tebakskor/editskor/<?php echo $this->_tpl_vars['memberprofile']['ids']; ?>
"><span class="button" value="edit">EDIT</span></a>
						</div>
						
						
					</div><!--end.skorsInput-->
				 <?php else: ?>
					<div class="skorsInput tr">					
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lispertandingannya']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<div class="rows skorRowss">
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['club1']; ?>
</h4>
									<div class="skorIn">
										<input class="skornya1 number"  type="text" name="skor1" maxlength="2" />
										<input type="hidden" name="pertandingan1" value="<?php echo $this->_tpl_vars['lispertandingan1'][$this->_sections['i']['index']]['id']; ?>
"/>
                                        
									</div>
                                    <label class="skor1_error error_red"></label>
									
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<h1 class="textVs yellow">VS</h1>
									<span class="arrow-right">&nbsp;</span>
								</div>
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['club2']; ?>
</h4>
									<div class="skorIn">
										<input class="skornya2 number"  type="text" name="skor2" maxlength="2" />
                                        									
									</div>
                                    <label class="skor2_error error_red"></label>
								</div>
							</div><!--end rows-->
						
							<div class="rows skorRowss">
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['club3']; ?>
</h4>
									<div class="skorIn">
										<input class="skornya3 number"  type="text" name="skor3" maxlength="2" />
										<input type="hidden" name="pertandingan3" value="<?php echo $this->_tpl_vars['lispertandingan2'][$this->_sections['i']['index']]['id']; ?>
"/>
                                        
									</div>
                                    <label class="skor3_error error_red"></label>
									
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<h1 class="textVs yellow">VS</h1>
									<span class="arrow-right">&nbsp;</span>
								</div>
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['club4']; ?>
</h4>
									<div class="skorIn">
										<input class="skornya4 number"  type="text" name="skor4" maxlength="2" />
                                        									
									</div>
                                    <label class="skor4_error error_red"></label>
								</div>
							</div><!--end rows-->
					
							<div class="rows skorRowss">
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['club5']; ?>
</h4>
									<div class="skorIn">
										<input class="skornya5 number"  type="text" name="skor5" maxlength="2" />
										<input type="hidden" name="pertandingan5" value="<?php echo $this->_tpl_vars['lispertandingan3'][$this->_sections['i']['index']]['id']; ?>
"/>
                                        
									</div>
                                    <label class="skor5_error error_red"></label>
									
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<h1 class="textVs yellow">VS</h1>
									<span class="arrow-right">&nbsp;</span>
								</div>
								<div class="col3">
									<h4 class="namaClub yellow"><?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['club6']; ?>
</h4>
									<div class="skorIn">
										<input class="skornya6 number"  type="text" name="skor6" maxlength="2" />									
									</div>
                                    <label class="skor6_error error_red"></label>
								</div>
								<div class="col3 textSkor">
									<span class="arrow-left">&nbsp;</span>
									<input class="weekid"  type="hidden" name="weekid" value="<?php echo $this->_tpl_vars['lispertandingannya'][$this->_sections['i']['index']]['week_id']; ?>
"/>	
									<span class="arrow-right">&nbsp;</span>
								</div>
							</div><!--end rows-->
						
							
						<div class="popup popupdetail" id="succespopup">
							<div id="popup-imgbig" class="popup-container">
								<a class="closePopup" href="javascript: submitform()">&nbsp;</a>
								<div class="popup-content">
									<p><span class="bigtext">Terima kasih telah berpartisipasi dalam TEBAK SKOR!</span><br />
										Pemenang TEBAK SKOR! akan diumumkan pada <span class="white">2 November 2015</span>. Bagi pemenang yang beruntung berhak mendapatkan tambahan 15 poin dan 
										satu Jersey Bola Original! 
									</p>
								</div>
							</div><!-- END .popupContainer -->
						</div><!-- END .popup -->
						
						<div class="rows">
							<input type="hidden" name="id_member" value="<?php echo $this->_tpl_vars['memberprofile']['ids']; ?>
">
							 <button class="button" name="submit" id="simpannya2">Submit</button>							 													
						</div>
					
						<div class="rows">
							<a href="#succespopup" style="opacity:0" class="showPopup button">Submit</a> 
							 <input id="simpannya" style="opacity:0"class="button simpan" type="submit" name="submit" value="Submit" onclick="mfp();">							
						</div>
						
					</div><!--end.skorsInput-->
					<?php endfor; endif; ?>
					
				 <?php endif; ?>
								<?php if ($this->_tpl_vars['nonlispertandingan'][0]['total_status'] == '0'): ?>
					<div class="rows">
						<div class="descSkor rowboxs tr">
							
								  <h4 class="title-entry yellow">Maaf, TEBAK SKOR! periode ini sudah ditutup.</h4>
						 
							<p>Anda dapat ikutan TEBAK SKOR! periode selanjutnya di pertandingan yang akan datang. Tetap update di game Supersoccer Community Race dan raih hadiah menarik setiap minggunya!</p>
						</div><!--end.skorInput-->
					</div><!--end.rows-->
				<?php endif; ?>
			</div><!--skorRows-->
		</form>
    </div><!--end#container-->
</div><!--end.section-->



<?php echo '
<script>
$(document).on(\'click\',\'#simpannya\',function(){

	$(\'.skor1_error\').html(\'\');
	$(\'.skor2_error\').html(\'\');
	$(\'.skor3_error\').html(\'\');
	$(\'.skor4_error\').html(\'\');
	$(\'.skor5_error\').html(\'\');
	$(\'.skor6_error\').html(\'\');
	
	var valid="";
	if($(\'.skornya1\').val()==\'\')
	{
		$(\'.skor1_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya2\').val()==\'\')
	{
		$(\'.skor2_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya3\').val()==\'\')
	{
		$(\'.skor3_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya4\').val()==\'\')
	{
		$(\'.skor4_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya5\').val()==\'\')
	{
		$(\'.skor5_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya6\').val()==\'\')
	{
		$(\'.skor6_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if(valid)
	{
		return false;
		
	}else{
	
	return true;
	}
	//return false;
										  
});


$(\'#simpannya2\').click(function() {
$(\'.skor1_error\').html(\'\');
	$(\'.skor2_error\').html(\'\');
	$(\'.skor3_error\').html(\'\');
	$(\'.skor4_error\').html(\'\');
	$(\'.skor5_error\').html(\'\');
	$(\'.skor6_error\').html(\'\');
	
	var valid="";
	if($(\'.skornya1\').val()==\'\')
	{
		$(\'.skor1_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya2\').val()==\'\')
	{
		$(\'.skor2_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya3\').val()==\'\')
	{
		$(\'.skor3_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya4\').val()==\'\')
	{
		$(\'.skor4_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya5\').val()==\'\')
	{
		$(\'.skor5_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if($(\'.skornya6\').val()==\'\')
	{
		$(\'.skor6_error\').html(\'Kolom ini harus diisi\');
		valid="ada";
	}
	if(valid)
	{
		return false;
		
	}else{
	 $.magnificPopup.open({
				items: {
					src: \'#succespopup\',
					type: \'inline\'

				}, 

	});
	return false;
	}
});

$(\'.number\').keyup(function () {  
	if(this.value)
	{
		this.value = this.value.replace(/[^0-9]/g,\'\'); 
		
	}
});

function mfp(){
$(document).on(\'click\',\'.mfp-close\',function(){
submitform()
});
}

 $(\'.showPopup\').magnificPopup({
						  type: \'inline\',
						});	
 
function submitform()
{
 // document.myform.submit();
  form.submit()
  alert("tes");
}
$(document).on(\'click\',\'.mfp-close\',function(){
	$("#simpannya").trigger("click");
});
</script>
'; ?>