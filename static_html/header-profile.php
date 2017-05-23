<div id="header">
	<div id="top">
       <a id="logo" href="index.php">
       	<img src="images/logo.png" />
       </a>	
    </div>
    <div class="mobileMenu">
    	 <button class="menuTrigger"><span class="icon-menu">&nbsp;</span></button>
         	<div id="navMobile">
            	<ul>
                	<li><a href="index.php?menu=chapter-profile">HOME</a></li>
                    <li><a href="index.php?menu=about">ABOUT</a></li>
                    <li><a href="index.php?menu=member-list">ANGGOTA</a></li>
                    <li><a href="index.php?menu=event-list">EVENTS</a></li>
                    <li><a href="index.php?menu=tantangan-list">TANTANGAN</a></li>
                    <li><a href="index.php?menu=leaderboard">LEADERBOARD</a></li>
                </ul>
            </div--><!--end.nav-->
    </div>
</div><!-- END .main-menu-wrapper -->
</div>
<script>

	/*$(document).ready(function() {
		$('#fullpage').fullpage({
			anchors: ['firstPage', 'secondPage', '3rdPage','4thPage'],
			slidesColor: ['#84d15d', '#ffffff', '#3cbcd6','#313131'],
			autoScrolling: false,
			css3: true				
		});
	});*/
$(document).ready(function() {

	$('.menuTrigger').click(function() {
		$('#navMobile').slideToggle("fast");
	});
});


</script>