<?php /* Smarty version 2.6.13, created on 2016-08-01 10:14:26
         compiled from application/web/home.html */ ?>
<div id="homepage" class="section">
    	<div class="headerHome">
        	<div class="logohome">
            	<div class="logonya">
                	<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/logo.png" />
                </div>
            </div>
        </div><!--end.ehaderHOme-->
        <div class="rowsLogin">
            <div class="col2">
            	<div class="mobileDesc">
                    <div class="headTrigger">
                        <a id="descTrigger" href="#"><h2>APA ITU SUPER SOCCER CAMPUS LEAGUE ?</h2></a>
                        <span class="arrowdown"></span>
                    </div>
                    <div id="desclandingMobile" class="descLanding tr">
                    <p>Welcome! Supersoccer Campus League adalah program kompetisi antar pelajar kampus/universitas di seluruh Indonesia, pecinta sepakbola Liga Inggris dan Italia yang diselenggarakan oleh <a class="yellow" href="http://www.supersoccer.co.id/" target="_blank">www.supersoccer.co.id.</a>. Disini anda dapat mendaftarkan diri sebagai member dan memenangkan Supersoccer Campus League dengan bermain Supersoccer Football Manager untuk mengumpulkan poin dan berbagai challenge seru guna menjadi manager sepakbola terbaik di Supersoccer Football Manager</p><br />
                    
                    <p>Untuk member-member dengan poin terbaik, anda akan menjadi finalis yang berkesempatan memenangkan hadiah Tour ke Inggris atau Italia. Selain itu, anda juga bisa melakukan redeem coins untuk mendapatkan merchandise keren dari Supersoccer!</p><br />
        <p>Kumpulkan poin dan koin sebanyak-banyaknya dan jadilah Manager (Member) terbaik di musim ini hanya di Supersoccer Football Manager! </p>
                    </div><!--descLanding-->
                </div><!--mobileDesc-->
                
            	<div id="desclandingDesktop" class="descLanding tr">
                	<h4 class="title-entry yellow textbg">APA ITU SUPER SOCCER CAMPUS LEAGUE ?</h4>
                    <p>Welcome! Supersoccer Campus League adalah program kompetisi antar pelajar kampus/universitas di seluruh Indonesia, pecinta sepakbola Liga Inggris dan Italia yang diselenggarakan oleh <a class="yellow" href="http://www.supersoccer.co.id/" target="_blank">www.supersoccer.co.id.</a>. Disini anda dapat mendaftarkan diri sebagai member dan memenangkan Supersoccer Campus League dengan bermain Supersoccer Football Manager untuk mengumpulkan poin dan berbagai challenge seru guna menjadi manager sepakbola terbaik di Supersoccer Football Manager</p><br />
                    
                    <p>Untuk member-member dengan poin terbaik, anda akan menjadi finalis yang berkesempatan memenangkan hadiah Tour ke Inggris atau Italia. Selain itu, anda juga bisa melakukan redeem coins untuk mendapatkan merchandise keren dari Supersoccer!</p><br />
        <p>Kumpulkan poin dan koin sebanyak-banyaknya dan jadilah Manager (Member) terbaik di musim ini hanya di Supersoccer Football Manager! </p>
                </div><!--descLanding-->
            </div><!--end col-2-->
            <div class="col2">
            	 <div class="loginForm tr">
                 	<p class="titleLogin">Masukan Email Address dan Password</p>
                    <form method="post" class="formlogin" action="<?php echo $this->_tpl_vars['basedomain']; ?>
login" enctype="application/x-www-form-urlencoded">
					
                    <div class="row">
                         <input type="text" name="email" class="email" placeholder="EMAIL ADDRESS">
                    </div>
                    <div class="row">
                        <input type="password" name="password" class="password" placeholder="PASSWORD">
						<input type="hidden" name="login" value="1">
                        <label class="row msgerorr" ><?php echo $this->_tpl_vars['msg']; ?>
</label>
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="verification" value="1">Anda setuju dengan <a class="yellow" href="<?php echo $this->_tpl_vars['basedomain']; ?>
tnc" target="_blank">Syarat dan Ketentuan</a>
                        </label>
                      </div>
                    <div class="row btLogins">
						<!--<a  href="javascript:;" class="fr button" onclick="openFbDialog();">LOGINFB</a>-->
						
                   	 	<a class="button fr " href="<?php echo $this->_tpl_vars['basedomain']; ?>
home/registerMember">SIGN UP</a>
                        <a  href="javascript:void(0)" class="submitlogin fr button">LOGIN</a>
                    </div>
					<div class="row btLogins">
						<!--<a  href="javascript:;" class="fr button" onclick="openFbDialog();">LOGINFB</a>-->
						
                        <a id="loginFb"  href="<?php echo $this->_tpl_vars['urlfb']; ?>
" class="fr button" title="Login dengan facebook">LOGINFB</a>
                   	 	<a id="loginTwit" class="button fr " href="<?php echo $this->_tpl_vars['basedomain']; ?>
home/logintwiiter" title="Login dengan twitter">LOGINTW</a>
                    </div>
                    <!--<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>-->
                    <a class="twitter-share-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></a>
					
                </form>
                </div><!--end.login-->
            </div>
        </div><!--ends-rowLogin-->
        
        <div class="rows">
            <div class="leaderInfo tabsInfo">
            	<h3 class="textbg">LEADERBOARD</h3>
            	<div id="tabs">
                  <ul>
                    <!--<li><a href="#tabs-1">CHAPTER</a></li>-->
                    <li><a href="#tabs-2">MEMBER</a></li>
                  </ul>
                  <!--<div id="tabs-1">
				  <?php if ($this->_tpl_vars['leaderChapter']): ?>
                		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['leaderChapter']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    	<div class="leftleader">
                            <a class="smallerThumb" href="#">
							<?php if ($this->_tpl_vars['leaderChapter'][$this->_sections['i']['index']]['img_avatar']): ?>
                             <img src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/profile/<?php echo $this->_tpl_vars['leaderChapter'][$this->_sections['i']['index']]['img_avatar']; ?>
" />
							<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/profile/images.jpg" />
							<?php endif; ?>
						   </a>
                        	<p class="leadClub"><?php echo $this->_tpl_vars['leaderChapter'][$this->_sections['i']['index']]['name_chapter']; ?>
  <span class="chapterLead yellow">( <?php echo $this->_tpl_vars['leaderChapter'][$this->_sections['i']['index']]['citinya']; ?>
 )</span></p>
                        </div>
                        <div class="leaderboard-points">
                            <span class="points"><?php echo $this->_tpl_vars['leaderChapter'][$this->_sections['i']['index']]['total']; ?>
</span>
                        </div>
                    </div>
					<?php endfor; endif; ?>
				<?php endif; ?>
                   
                  </div>-->
                  
                  <div id="tabs-2">
				  <?php if ($this->_tpl_vars['leaderMember']): ?>
                		<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['leaderMember']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    	<div class="leftleader anngotalead">
                    		<p class="leadClub"><?php echo $this->_tpl_vars['leaderMember'][$this->_sections['j']['index']]['name']; ?>
  <?php if ($this->_tpl_vars['leaderMember'][$this->_sections['j']['index']]['kampus']): ?><span class="chapterLead yellow">(<?php echo $this->_tpl_vars['leaderMember'][$this->_sections['j']['index']]['kampus']; ?>
)</span><?php endif; ?></p>
                        </div>
                        <div class="leaderboard-points"> 
                        	<span class="points"><?php echo $this->_tpl_vars['leaderMember'][$this->_sections['j']['index']]['total']; ?>
</span>
                        </div>
                    </div>
					<?php endfor; endif; ?>
				<?php endif; ?>
                   
                  </div>
                  </div>
                 
                </div><!--end#tabs-->
                
            </div><!--endleaderInfo-->
        </div><!--endleaderBoardrows-->
    
</div><!--end.section-->
<script>
<?php echo '
$( ".headTrigger" ).click(function() {
  $( ".arrowdown" ).toggleClass( "arrowUp" );
  $( "#desclandingMobile" ).slideToggle( "slow" );
});
'; ?>

</script>
<script>
<?php echo '
	$(document).on (\'click\',\'.submitlogin\',function(){
		$(\'.msgerorr\').html(\'\');
		var valid="";
		if($(\'.email\').val()==\'\' || $(\'.password\').val()==\'\')
		{
			$(\'.msgerorr\').html(\'Username atau Password yang Anda masukan salah.\');
			valid="ada";
		}
		if(valid)
		{
			return false;
		}
		else
		{
			$(\'.formlogin\').trigger(\'submit\');
		}
	}); 
'; ?>


</script>

<script>
<?php echo '
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log(\'statusChangeCallback\');
    console.log(response);
    
    if (response.status === \'connected\') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === \'not_authorized\') {
      // The person is logged into Facebook, but not your app.
      document.getElementById(\'status\').innerHTML = \'Please log \' +
        \'into this app.\';
    } else {
      // The person is not logged into Facebook, so we\'re not sure if
      // they are logged into this app or not.
      document.getElementById(\'status\').innerHTML = \'Please log \' +
        \'into Facebook.\';
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      if (response.status === \'connected\') {
    console.log(response.authResponse.accessToken);
  }
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : \'1512068332418124\',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : \'v2.2\' // use version 2.2
  });
  
  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, \'script\', \'facebook-jssdk\'));

  function testAPI() {
    console.log(\'Welcome!  Fetching your information.... \');
    FB.api(\'/me\', function(response) {
      console.log(\'Successful login for: \' + response.name);
      document.getElementById(\'status\').innerHTML =
        \'Thanks for logging in, \' + response.name + \'!\';
    });
  }
  '; ?>

</script>
<div id="fb-root"></div>
<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>-->
<script>
<?php echo '
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1512068332418124";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));
'; ?>

</script>