<?php include('header.php'); ?>
<div id="registration" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow textbg">REGISTRASI Chapter </h1>
            <p>Lengkapi data diri Anda.</p>
           
    	</div>
        <div class="formregis">
        	<h2 class="formTittle red">Biodata Head Chapter</h2>
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="reg1">
            
            <div class="row">
                <input type="text" placeholder="Nama Head Chapter">
            </div>
            <div class="row">
                <input type="text" placeholder="Email">
            </div>
            <div class="row">
                <input type="text" placeholder="No. KTP/SIM">
            </div>
            <div class="row">
                <input type="text"  placeholder="No. Telp/HP">
            </div>
           
            <div class="row">
                <a  href="index.php?menu=registration-confirm" class="button fl">LANJUT</a>
            </div>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->