<?php /* Smarty version 2.6.13, created on 2016-03-24 17:17:38
         compiled from application/web/apps/member-profile.html */ ?>

<div id="member-profile" class="section">
	<div id="container">
        <div class="row-2">
              <h1 class="yellow textbg">PROFIL MEMBER </h1>
        </div>
            <div class="rows">
            	<div class="profileInfo">
                	<div class="avatarBox">
                        <div class="avatar-big gallery-image" >   
					<?php if ($this->_tpl_vars['memberprofile']['ava']): ?>
						<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/profile/<?php echo $this->_tpl_vars['memberprofile']['ava']; ?>
" >
					<?php else: ?>
                            <img src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/profile/images.jpg" >
					<?php endif; ?>
                        </div>
						<!-- <div style="display:none">
						  <form id="formuploadcv" enctype="multipart/form-data" method="post" name="fileinfo">
						  
					      <input type="file" class="myfile" id="myfile" name="myfile" /> 
					     
						  </form>
						  </div> -->
                      
                    </div><!--end avatarBox-->
                    <div class="chapterDetail">
                    	<!--<div class="rownya">
                    		<label>Nama Chapter :</label><div class="infonya yellow"> <?php echo $this->_tpl_vars['memberprofile']['nama_chapter']; ?>
</div>
                        </div>-->
                        <div class="rownya">
                        	<label>Nama Member :</label><div class="infonya yellow"> <?php echo $this->_tpl_vars['memberprofile']['name']; ?>
</div>
                        </div>
						<div class="rownya">
                        	<label>Status :</label><div class="infonya yellow"> <?php if ($this->_tpl_vars['memberprofile']['n_status'] == 1): ?>Verified<?php else: ?>Unverified <?php endif; ?></div>
                        </div>
						<div class="rownya">
                        	<label>Kampus :</label><div class="infonya yellow"> <?php echo $this->_tpl_vars['memberprofile']['kampus']; ?>
</div>
                        </div>
						<div class="rownya">
                                <label>Tipe Login :</label><div class="infonya yellow"> <?php if ($this->_tpl_vars['memberprofile']['type_login'] == 1): ?>Email<?php elseif ($this->_tpl_vars['memberprofile']['type_login'] == 2): ?>Twitter<?php elseif ($this->_tpl_vars['memberprofile']['type_login'] == 3): ?>Facebook<?php endif; ?></div>
                        </div>
                        <!--<div class="rownya">
                        	<label>Member ID:</label><div class="infonya yellow"><?php echo $this->_tpl_vars['memberprofile']['ssgte_id']; ?>
</div>
                        </div>-->
                        <div class="rownya rownsocial">
                        	<label>Social Media :</label><div class="infonya yellow"> <p><span class="icon-facebook2">&nbsp;</span><a href="https://www.facebook.com/<?php echo $this->_tpl_vars['memberprofile']['user_login']; ?>
" target="_blank"><?php echo $this->_tpl_vars['memberprofile']['fb_id']; ?>
</a></p><p><span class="icon-twitter2">&nbsp;</span><a href="https://twitter.com/<?php echo $this->_tpl_vars['memberprofile']['twiiter_id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['memberprofile']['twiiter_acc']; ?>
</a></p></div>
                        </div>
                    	
                        <p class="points yellow"><span class="bigNumber"><?php echo $this->_tpl_vars['memberprofile']['point']; ?>
</span> Points</p>
                        <a href="member/editmember/<?php echo $this->_tpl_vars['memberprofile']['ids']; ?>
/<?php echo $this->_tpl_vars['memberprofile']['name']; ?>
"><button class="button" >UBAH</button></a>
                    </div><!---end.chapterDetail-->
                </div><!--end.profileInfo-->
            </div><!--end.rows-->
            <div class="rows">
            	<div class="boxLine">
                	<div class="leftText">
                    	<p>Masukan kode voucher Anda setelah login ke <a href="http://fm.supersoccer.co.id/" target="_blank">fm.supersoccer.co.id</a> untuk mendapatkan fitur-fitur special di game Football Manager</p>
                    </div>
                    <div class="vocerText">
                    	<!--<p><i>Kode Voucer</i> <span class="codeVocher yellow"><?php if ($this->_tpl_vars['memberprofile']['voucer_id'] == 0): ?>Tidak Tersedia<?php else:  echo $this->_tpl_vars['memberprofile']['voucer'];  endif; ?></span></p>-->
						<p><i>Kode Voucher</i> <span class="codeVocher yellow"><?php if ($this->_tpl_vars['memberprofile']['voucer_id'] == 0): ?><a href="member/addkodevoucer/<?php echo $this->_tpl_vars['memberprofile']['ids']; ?>
"><button class="button" >Dapatkan Voucer</button></a><?php else:  echo $this->_tpl_vars['memberprofile']['voucer'];  endif; ?></span></p>
                    </div>
                </div>
            </div>
            
            <div class="rows">
            <div id="memberListTabs" class="leaderInfo">
			<!--
              <div class="rows">
            	<div id="tabs">
                  <ul>
                    <li><a href="#tabs-1">EVENT YANG AKAN DATANG</a></li>
                  </ul>
                  <div id="tabs-1">
				  <?php if ($this->_tpl_vars['listevent']): ?>
				  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listevent']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  	<div class="rows-list">
                    	<div class="infoMembers fl">
                        	<div class="rowsEvent">
                        		<p class="name_member yellow"><?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['name']; ?>
</p>
                            </div>
                            <div class="rowsdateEvent">
                            <p class=""><?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['time_start']; ?>
 - <?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['time_end']; ?>
</p>
                            <p class=""><?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['jam_awal']; ?>
 - <?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['jam_akhir']; ?>
</p>
                            </div>
                            <p class="addressEvent"><?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['alamat']; ?>
</p>
                          
                            <div class="buttonAction">
                        		<a id="detail" class="button" href="<?php echo $this->_tpl_vars['basedomain']; ?>
member/eventDetail/<?php echo $this->_tpl_vars['listevent'][$this->_sections['i']['index']]['id']; ?>
">Lihat Event</a>
                            </div>
                        </div>
                    </div>
                  	<?php endfor; endif; ?>
                    <?php else: ?>
					<div class="rows-list">
                    	<div class="infoMembers fl">
                        	<center>Belum ada Event dari Chapter Anda.</center>
                        </div>
                    </div>
					
					<?php endif; ?>
                  </div>                  
                </div>
                </div>
                -->
                <div class="rows">
                <div id="tabs2">
                  <ul>
                    <li><a href="#tabs-1">CHALLENGE YANG AKAN DATANG</a></li>
                  </ul>
                  <div id="tabs-1">
				    <?php if ($this->_tpl_vars['listantangan']): ?>
                		<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['listantangan']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
							<div class="rows-list">
								<div class="infoMembers fl">
									<p class="name_member yellow"><?php echo $this->_tpl_vars['listantangan'][$this->_sections['j']['index']]['time_start']; ?>
 - <?php echo $this->_tpl_vars['listantangan'][$this->_sections['j']['index']]['time_end']; ?>
</p>
									<p class=""><?php echo $this->_tpl_vars['listantangan'][$this->_sections['j']['index']]['name']; ?>
</p>
									<div class="buttonAction">
										<a id="detail" class="button" href="<?php echo $this->_tpl_vars['basedomain']; ?>
member/detailtantangan/<?php echo $this->_tpl_vars['listantangan'][$this->_sections['j']['index']]['id']; ?>
">Lihat Challenge</a>
									</div>
								</div>
							</div><!--end rows-->
                  		<?php endfor; endif; ?>
					<?php else: ?>
						<div class="rows-list">
								<div class="infoMembers fl">
									<center>Belum ada challenge untuk Anda.</center>
								</div>
							</div><!--end rows-->
					<?php endif; ?>
                  </div>
                  
                 
                </div><!--end#tabs-->
                </div><!--end rows-->
               <div></div>

            </div><!--endleaderInfo-->
        </div><!--end.rows-->

    	
    </div><!--end#container-->
</div><!--end.section-->


<script>
<?php echo '
upload_foto();
'; ?>

</script>