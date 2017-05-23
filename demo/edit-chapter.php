<?php include('header-profile.php'); ?>
<div id="Edit-Chapter" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">UBAH CHAPTER</h1>  
    	</div>
        <div class="formregis">
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="row">
                <div class="tr avatarBox">
                    <div class="avatar-big">   
                        <img src="images/profile-chap.jpg">
                    </div>
                    <p class="infotext" style="margin:10px 0;">Maximal file 2MB (JPG,JPEG)</p>
                    <a href="index.php?menu=edit-chapter" class="button" id="btn_upload">UNGGAH</a>
                    
                    
                </div><!--end avatarBox-->
            </div>
             <div class="row">
                <input type="text" value="Diego Lopez" placeholder="Nama Head Chapter">
            </div>
            <div class="row">
                <input type="text" placeholder="Email" value="diegoL@yahoo.com">
            </div>
            <div class="row">
                <input type="text"  placeholder="No Telp/HP" value="08780232311">
            </div>
            <div class="row">
                <input type="text"  placeholder="Facebook Account Komunitas" value="D10 Lopez">
            </div>
            <div class="row">
                <input type="text"  placeholder="Twitter Account Komunitas" value="@di10Lopez">
            </div>
            
            <div class="row">
                <input type="password"  placeholder="Password" value="000000">
            </div>
            <div class="row">
                <input type="password"  placeholder="Confirm Password" value="000000">
            </div>
            <div class="row">
            	<textarea placeholder="Alamat">Jl KEmang Timur Raya</textarea>
            </div>
            
            <div class="row">
                <a  href="index.php?menu=chapter-profile" class="button">SIMPAN</a>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->