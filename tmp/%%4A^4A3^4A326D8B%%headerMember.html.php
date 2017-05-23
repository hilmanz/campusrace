<?php /* Smarty version 2.6.13, created on 2016-03-24 17:26:17
         compiled from application/web//widgets/headerMember.html */ ?>
<div id="header">
	<div id="top">
        <a id="logo" href="<?php echo $this->_tpl_vars['basedomain']; ?>
member">
       	<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/logo.png" />
       </a>	
    </div>
    <div class="mobileMenu">
    	 <button class="menuTrigger"><span class="icon-menu">&nbsp;</span></button>
         	<div id="navMobile">
            	<ul>
                	<li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
member">HOME</a></li>
                    <li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
about">ABOUT</a></li>
                    <!--<li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
member/event">EVENT</a></li>-->
                    <li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
member/tantangan">CHALLENGE</a></li>       
                    <li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
member/leaderboard">LEADERBOARD</a></li>
					<li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
tebakskor">GAMES TEBAK SKOR</a></li>  					
					<li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
puzzle">GAMES PUZZLE</a></li>
                    <li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
mekanisme">MEKANISME</a></li> 
						  <li><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
logout.php">KELUAR</a></li>
                </ul>
            </div--><!--end.nav-->
    </div>
</div><!-- END .main-menu-wrapper -->
</div>
<script>
<?php echo '
	/*$(document).ready(function() {
		$(\'#fullpage\').fullpage({
			anchors: [\'firstPage\', \'secondPage\', \'3rdPage\',\'4thPage\'],
			slidesColor: [\'#84d15d\', \'#ffffff\', \'#3cbcd6\',\'#313131\'],
			autoScrolling: false,
			css3: true				
		});
	});*/
$(document).ready(function() {

	$(\'.menuTrigger\').click(function() {
		$(\'#navMobile\').slideToggle("fast");
	});
});
'; ?>

</script>