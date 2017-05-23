<?php include('header.php'); ?>
<div id="registration" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">CHAPTER REGISTRATION</h1>
            <p class="tittleForm"><strong>Lengkapilah Data Chapter Anda</strong></p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis at risus quis tincidunt. Vivamus arcu orci, laoreet vitae porta vel, finibus id risus. Etiam eu nulla at sapien commodo euismod. Maecenas finibus neque lorem. Aenean a lacus ac odio tincidunt vehicula. Donec mollis nunc in gravida porttitor. Nunc volutpat libero in nibh fringilla, a dapibus risus viverra.</p>
    	</div>
        <div class="formregis">
        	<h2 class="formTittle red">Biodata Head Chapter</h2>
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
            	<textarea></textarea>
            </div>
            <div class="row">
                <select>
                  <option value="">Club Favorit</option>
                  <option value="">Manchester United</option>
                  <option value="">Lazio</option>
                  <option value="">Barcelona</option>
                </select>
            </div>
            <div class="row">
                <select>
                  <option value="">Kota Chapter</option>
                  <option value="">Jakarta</option>
                  <option value="">Bandung</option>
                  <option value="">Medan</option>
                </select>
            </div>
            <div class="row">
                <input type="text"  placeholder="Facebook Account Chapter">
            </div>
            <div class="row">
                <input type="text"  placeholder="Twitter Account Chapter">
            </div>
            <div class="row">
                <a  href="index.php?menu=registration2" class="button">LANJUT</a>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->