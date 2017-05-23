<?php include('header-profile.php'); ?>
<div id="registration-member" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow textbg">TAMBAH MEMBER</h1>
    	</div>
        <div class="formregis">
        	<h2 class="formTittle red">ISI EMAIL MEMBER</h2>
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="row">
            	<textarea class="emailMember">lionel@gmail.com, robin@gmail.com, daniel@yahoo.com, totti@roma.co.id</textarea><br />
                <p class="infotext">Maximal 20 Email Member</p>
                <p class="infotext">Ex, (lionel@gmail.com, robin@gmail.com, daniel@yahoo.com, totti@roma.co.id) untuk setiap email di pisahkan dengan tanda koma (,).</p>
            </div>
            <div class="row">
                <a  href="index.php?menu=member-list" class="button">KIRIM</a>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->