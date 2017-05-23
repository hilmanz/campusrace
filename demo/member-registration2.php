<?php include('header.php'); ?>
<div id="registration" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">MEMBER REGISTRATION</h1>
            <p>Lengkapi data diri Anda di bawah ini untuk mulai bergabung dengan Chapter/Komunitas dan mengumpulkan poin terbanyak untuk menjadi finalis yang berkesempatan memenangkan Supersoccer Tour langsung ke Inggris/Italia! Selain itu, Anda juga bisa melakukan redeem coins untuk mendapatkan merchandise keren dari Supersoccer!</p>
    	</div>
        <div class="rows">
        	<div class="profileInfo">
                <div class="tr avatarBox">
                    <div class="avatar-big">   
                        <img src="images/profile-chap.jpg">
                    </div>
                </div><!--end avatarBox-->
                <div class="chapterDetail">
                    <h3>No Anggota</h3>
                    <p>1023</p>
                </div><!---end.chapterDetail-->
            </div><!--end.profileInfo-->
        </div>
        <div class="formregis">
        	<h2 class="formTittle red">Biodata Anggota</h2>     
            
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="reg1">
            <div class="row">
                <input type="text" placeholder="Nama Anggota" value="John Cena">
            </div>
            <div class="row">
                <input type="text"  placeholder="Email Anggota" value="john@gmail.com">
            </div>
           
            <div class="row">
                <input type="text"  placeholder="ID KTP/SIM" value="902840271482184284">
            </div>
            
            <div class="row">
                <input type="text"  placeholder="Facebook Account Anggota" value="John Cena wW">
            </div>
            <div class="row">
                <input type="text"  placeholder="Twitter Account Anggota" value="@JohnCena">
            </div><br /><br />
            <p style="text-align:left;">Harap konfirmasi password anda terlebih dahulu</p>
             <div class="row">
                <input type="password"  placeholder="Password">
            </div>
            <div class="row">
                <input type="password"  placeholder="Confirm Password">
            </div>
            <div class="row">
                <a  href="index.php?menu=member-registration-confirm" class="button fl">LANJUT</a><br />
                
            </div>
            
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->