<?php include('header.php'); ?>
<div id="registration" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">MEMBER REGISTRATION</h1>
            <p class="tittleForm"><strong>Lengkapilah Data Anggota Anda</strong></p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis at risus quis tincidunt. Vivamus arcu orci, laoreet vitae porta vel, finibus id risus. Etiam eu nulla at sapien commodo euismod. Maecenas finibus neque lorem. Aenean a lacus ac odio tincidunt vehicula. Donec mollis nunc in gravida porttitor. Nunc volutpat libero in nibh fringilla, a dapibus risus viverra.</p>
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
            <div class="row">
                <input type="text" placeholder="Nama Chapter">
            </div>
            <div class="row">
                <input type="text"  placeholder="Email Chapter">
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
                <input type="text"  placeholder="Facebook Account Chapter">
            </div>
            <div class="row">
                <input type="text"  placeholder="Twitter Account Chapter">
            </div>
            <div class="row">
                <a  href="index.php?menu=member-registration-confirm" class="button">LANJUT</a>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->