	<?php include('header.php'); ?>
<div id="registration" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow yellow">REGISTRASI MEMBER</h1>
            <p>Lengkapi data diri Anda di bawah ini untuk mulai bergabung dengan Chapter dan mengumpulkan poin terbanyak untuk menjadi finalis yang berkesempatan memenangkan Supersoccer Tour langsung ke Inggris/Italia! Selain itu, Anda juga bisa melakukan redeem coins untuk mendapatkan merchandise keren dari Supersoccer!</p>
    	</div>
        <div class="rows">
        	<div class="profileInfo">
                <div class="tr avatarBox">
                    <div class="avatar-big">   
                        <img src="images/profile-chap.jpg">
                    </div>
                </div><!--end avatarBox-->
                <div class="chapterDetail">
                    <h3>No Member</h3>
                    <p>1023</p>
                </div><!---end.chapterDetail-->
            </div><!--end.profileInfo-->
        </div>
        <div class="formregis">
        	<h2 class="formTittle red">Biodata Member</h2>
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="reg1">
            <div class="row">
                <input type="text" placeholder="Nama Member">
            </div>
            <div class="row">
                <input type="text"  placeholder="Email Member">
            </div>
            <div class="row">
                <input type="password"  placeholder="Password">
            </div>
            <div class="row">
                <input type="password"  placeholder="Confirm Password">
            </div>
            <div class="row">
                <input type="text"  placeholder="ID KTP/SIM">
            </div>
            
            <div class="row">
                <input type="text"  placeholder="Facebook Account Member">
            </div>
            <div class="row">
                <input type="text"  placeholder="Twitter Account Member">
            </div>
            <div class="row">
                <a  href="index.php?menu=member-registration-confirm" class="button fl">LANJUT</a>
            </div>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->