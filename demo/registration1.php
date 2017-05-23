<?php include('header.php'); ?>
<div id="registration" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow textbg">REGISTRASI CHAPTER</h1>
            <p>Lengkapi data chapter yang akan Anda kelola. Setelah akun chapter terverifikasi, Anda dapat langsung mengundang Member dan membesarkan chapter Anda.</p>
    	</div>
        <div class="formregis">
        	<h2 class="formTittle red">Biodata Chapter</h2>
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="reg1">
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
            	<textarea placeholder="Alamat"></textarea>
            </div>
            <div class="row">
            	<div class="selectBox">
                    <select>
                      <option value="">Club Favorit</option>
                      <option value="">Manchester United</option>
                      <option value="">Lazio</option>
                      <option value="">Barcelona</option>
                    </select>
                </div>
            </div>
            <div class="row">
            	<div class="selectBox">
                    <select>
                      <option value="">Kota Chapter</option>
                      <option value="">Jakarta</option>
                      <option value="">Bandung</option>
                      <option value="">Medan</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="text"  placeholder="Facebook Account Chapter">
            </div>
            <div class="row">
                <input type="text"  placeholder="Twitter Account Chapter">
            </div>
            <div class="row">
                <a  href="index.php?menu=registration2" class="button fl">LANJUT</a>
            </div>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->