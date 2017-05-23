<?php /* Smarty version 2.6.13, created on 2016-01-14 10:19:48
         compiled from application/web//apps/profilechapter.html */ ?>

<div id="chapter-profile" class="section">
	<div id="container">
        <div class="row-2">
              <h1 class="yellow textbg">PROFIL CHAPTER</h1>
        </div>
            <div class="rows">
            	<div class="profileInfo">
                	<div class="tr avatarBox">
                        <div class="avatar-big">   
						<?php if ($this->_tpl_vars['userdata']['img_avatar']): ?>
						<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/profile/<?php echo $this->_tpl_vars['userdata']['img_avatar']; ?>
" >
					<?php else: ?>
                            <img src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/profile/images.jpg" >
					<?php endif; ?>
                        </div>
                    </div><!--end avatarBox-->
                    <div class="chapterDetail">
                    	<div class="rownya">
                    		<label>Nama / ID Chapter :</label><div class="infonya yellow"> <?php echo $this->_tpl_vars['userdata']['name_chapter']; ?>
 / <?php echo $this->_tpl_vars['userdata']['id']; ?>
</div>
                        </div>
                        <div class="rownya">
                        	<label>Kota :</label><div class="infonya yellow"> <?php echo $this->_tpl_vars['userdata']['citinya']; ?>
 </div>
                        </div>
                        <div class="rownya">
                        	<label>Head Chapter :</label><div class="infonya yellow"> <?php echo $this->_tpl_vars['userdata']['name']; ?>
 </div>
                        </div>
                        <div class="rownya rownsocial">
                        	<label>Social Media :</label><div class="infonya yellow"> <p><span class="icon-facebook2">&nbsp;</span><a href="https://www.facebook.com/<?php echo $this->_tpl_vars['userdata']['facebook']; ?>
" target="_blank"><?php echo $this->_tpl_vars['userdata']['facebook']; ?>
</a></p><p><span class="icon-twitter2">&nbsp;</span><a href="https://twitter.com/<?php echo $this->_tpl_vars['userdata']['twitter']; ?>
" target="_blank"><?php echo $this->_tpl_vars['userdata']['twitter']; ?>
</a></p></div>
                        </div>
						
                        <p class="points yellow"><span class="bigNumber"><?php echo $this->_tpl_vars['akumulasi']; ?>
</span> Points</p>
                        
                        <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
chapter/editchapter/<?php echo $this->_tpl_vars['userdata']['id']; ?>
/<?php echo $this->_tpl_vars['userdata']['name_chapter']; ?>
" class="button" id="btn_upload">UBAH</a>
                    </div><!---end.chapterDetail-->
                </div><!--end.profileInfo-->
            </div><!--end.rows-->
            <div class="rows">
            	<div class="mList-chapter">
                	<div class="box-grey">
                    	<div class="textAng fl">
                        	<p>Member</p>
                        </div>
                        <div class="textNumber fr">
                        	<p class="yellow"><?php echo $this->_tpl_vars['membertotal']; ?>
</p>
                        </div>
                    </div>
                </div><!--end.listchapter-->
            </div><!--end.rows-->
            <div class="rows">
            	<a class="button2 halfWidth fl" href="<?php echo $this->_tpl_vars['basedomain']; ?>
chapter/member">Lihat Member</a>
            	<a class="button2 halfWidth fr" href="<?php echo $this->_tpl_vars['basedomain']; ?>
chapter/addMember">Tambah Member</a>
            </div>
            
            <div class="rows">
            	<div class="mList-chapter">
                	<div class="box-grey">
                    	<div class="textAng fl">
                        	<p>Event</p>
                        </div>
                        <div class="textNumber fr">
                        	<p class="yellow"><?php echo $this->_tpl_vars['totalEvent']; ?>
</p>
                        </div>
                    </div>
                </div><!--end.listchapter-->
            </div><!--end.rows-->
            <div class="rows">
            	<a class="button2 halfWidth fl" href="<?php echo $this->_tpl_vars['basedomain']; ?>
chapter/event">Lihat Event</a>
          
            	<a class="button2 halfWidth fr" href="<?php echo $this->_tpl_vars['basedomain']; ?>
chapter/addEvent">Tambah Event</a>
            </div>
           
            <div class="rows">
            	<div class="mList-chapter">
                	<div class="box-grey">
                    	<div class="textAng fl">
                        	<p>Challenge</p>
                        </div>
                        <div class="textNumber fr">
                        	<p class="yellow"><?php echo $this->_tpl_vars['totalTantangan']; ?>
</p>
                        </div>
                    </div>
                </div><!--end.listchapter-->
            </div><!--end.rows-->
            <div class="rows">
            	<a class="button2 halfWidth fl" href="<?php echo $this->_tpl_vars['basedomain']; ?>
chapter/tantangan">Lihat Challenge</a>
           
            	            </div>
          
    	
    </div><!--end#container-->
</div><!--end.section-->