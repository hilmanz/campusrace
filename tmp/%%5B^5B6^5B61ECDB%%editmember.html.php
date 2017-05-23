<?php /* Smarty version 2.6.13, created on 2016-03-22 11:05:35
         compiled from application/admin//apps/editmember.html */ ?>
<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-books">&nbsp;</span>Edit Member</h2>
                    </div><!-- end .titlebox -->
        <div class="content">

            <form id="forms" class="forms" method="post" action="../../membermanagement">
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listnya']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <div id="new-project" class="boxcontent">
                <section class="step1">	
				<div class="row">
                        <label for="name">Type Login<br></label>
                        <input id="name" name="name"  value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['nama_login']; ?>
" type="text" class="required login"disabled ><br>
						<label class="msg_name login_no"  style="color: red;"><?php echo $this->_tpl_vars['name_no']; ?>
</label>
                    </div><!-- end .row -->
                    <div class="row">
                        <label for="name">Nama<br></label>
                        <input id="name" name="name"  value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['name']; ?>
" type="text" class="required name" ><br>
						<label class="msg_name name_no"  style="color: red;"><?php echo $this->_tpl_vars['name_no']; ?>
</label>
                    </div><!-- end .row -->
					  <div class="row">
                        <label for="email">Email<br></label>
                        <input id="email" name="email" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['username']; ?>
" type="text" class="required email" readonly><br>
						<label class="msg_name email_no" style="color: red;"><?php echo $this->_tpl_vars['email_no']; ?>
</label>
                    </div><!-- end .row -->
					<div class="row">
						<label for="password">Password<br></label>
						<input type="text" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['password']; ?>
"  placeholder="Password" name="password" class="passwordanggota">
						<label class="passwordanggota_error error_red"></label>
					</div>
					<div class="row">
                        <label for="idktp">No Telp<br></label>
                        <input id="no_tlp" name="no_tlp" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['no_tlp']; ?>
"  type="text" class="required no_tlp" ><br>
						<label class="msg_name"  style="color: red;"><?php echo $this->_tpl_vars['name_no']; ?>
</label>
                    </div><!-- end .row -->
                    <div class="row">
                        <label for="idktp">ID KTP/SIM<br></label>
                        <input id="idktp" name="idktp" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['ktp_sim']; ?>
"  type="text" class="required idktp" ><br>
						<label class="msg_name"  style="color: red;"><?php echo $this->_tpl_vars['name_no']; ?>
</label>
                    </div><!-- end .row -->
                    
					  
                     <div class="row">
                        <label for="facebookak">Akun Facebook<br></label>
                        <div class="relative rowfesbuk">
                            <span class="fbText">http://www.facebook.com/</span>
                        <input id="akunface" name="facebook" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['fb_id']; ?>
" type="text" class=" " ></div><br>
						<label class="msg_name " style="color: red;"></label>
                    </div><!-- end .row -->
                    <div class="row">
                        <label for="twitter">Akun Twitter<br></label>
                        <div class="relative rowtwitter">
                            <span class="tweetText">http://www.twitter.com/</span>
                        <input id="twitter" name="twitter" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['twiiter_id']; ?>
" type="text" class=" " ></div><br>
						<label class="msg_name " style="color: red;"></label>
                    </div><!-- end .row -->
		
		    <!--	
                     <div class="row">
                        <label for="headchapter">Nama Chapter<br></label>
                        <input id="headchapter" name="nama_chapter" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['name_chapter']; ?>
"  type="text" class=" " readonly><br>
						<label class="msg_name " style="color: red;"></label>
                    </div>
		   -->

                    <div class="row">
                        <label for="headchapter">Tanggal Registrasi<br></label>
                        <input name="regdate" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['date_register']; ?>
"   type="text" class=" " readonly><br>
						<label class="msg_name " style="color: red;"></label>
                    </div><!-- end .row -->
                     
                    <div class="row">
					<input type="hidden" name="submit" value="1">
					<input type="hidden" name="idnya" value="<?php echo $this->_tpl_vars['listnya'][$this->_sections['i']['index']]['id']; ?>
">
                        <input type="submit" value="Simpan" name="submit" class="fr button3 submitsave"  />&nbsp;
						 <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
membermanagement" class="button4 text-center fr">Batal</a>
                        <small class="msg"><?php echo $this->_tpl_vars['status']['msgee']; ?>
</small>
                        <small class="msg"><?php echo $this->_tpl_vars['status']['msg']; ?>
</small>
                    </div><!-- end .row -->
                </section>
            </div><!-- end #wizard -->
			
			<?php endfor; endif; ?>
            </form>
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
<script>
<?php echo '
	$(\'.typeuser\').click(function()
	{
			
			console.log($(this).val());
			if($(this).val()==9)
			{
				$(".checkboxmenu").prop("checked", true);
				$(".checkboxmenu").attr("disabled", true);				
			}
			else {
				$(".checkboxmenu").prop("checked", false);
				$(".checkboxmenu").removeAttr("disabled"); 	
				}
	});
	$(\'.submitsave\').click(function()
		{
			console.log(\'asa\');return false;
			var name_no=\'.login_no\';
			$(login_no).html(\' \');
			var name_no=\'.name_no\';
			$(name_no).html(\' \');
			var mailformat = /^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$/; 
			var email_no=".email_no";
			$(email_no).html(\' \');
			var username_no=\'.username_no\';
			$(username_no).html(\' \');
			var password=\'.password_no\';
			$(password_no).html(\' \');
			var checkboxmenu=\'.checkboxmenu_no\';
			$(checkboxmenu_no).html(\' \');
			var valid=\'\';
			if($(\'.checkboxmenu:checked\').length ==0)
				{
				
					$(subcategory_no).html(\'You cannot leave this field empty\');
					valid=\'ada\';
				}
			if($(\'.login\').val()==\'\')
			{
				$(login_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.name\').val()==\'\')
			{
				$(name_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.username\').val()==\'\')
			{
				$(username_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.password\').val()==\'\')
			{
				$(password_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.email\').val()==\'\')
			{
				$(email_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			else if(!$(\'.email\').val().match(mailformat))  
			{  
				$(email_no).html(\'format email salah\');
				valid=\'ada\';
			} 
			if(valid)
			{
				return false;
			
			}
			else
			{
				$(\'input[type="submit"]\').attr(\'disabled\',\'disabled\');
			
			}
		}
'; ?>

</script>