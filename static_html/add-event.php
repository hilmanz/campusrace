<?php include('header-profile.php'); ?>

<script>
  function initialize() {
	var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
	  center: new google.maps.LatLng(44.5403, -78.5463),
	  zoom: 8,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(mapCanvas, mapOptions)
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="add-event" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">BUAT EVENT</h1>
    	</div>
        <div class="formregis">
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="row">
            	<p>Nama Event</p>
                <input type="text" placeholder="">
            </div>
            <div class="row">
            	<p>Keterangan Event</p>
                <textarea></textarea>
            </div>
            
            <div class="row">
            	<p>Kategori Event:</p>
                <select>
                  <option value="">Pilih Kategori</option>
                  <option value="">Kategori 1</option>
                  <option value="">Kategori 2</option>
                  <option value="">Kategori 3</option>
                </select>
            </div>
            <div class="row">
            	<p>Waktu Event</p>
                	<div class="dateEvent">
                    <input id="datepicker1" type="text"  placeholder="Tanggal"> - <input id="datepicker2" type="text"  placeholder="Tanggal">
                    </div>
                    <div class="timeEvent">
                    <input id="timepicker1" type="text"  placeholder="Jam" data-scroll-default="6:00am" > - <input id="timepicker2" type="text"  placeholder="Jam"data-scroll-default="6:00am" >
                    </div>	
                
            </div>
            <div class="row">
            	<p>Jumlah Undangan Event</p>
                <input type="text" placeholder="">
            </div>
            <div class="row">
            	<p>Alamat Event</p>
            	<textarea></textarea>
            </div>
            <div class="row">
            	<div id="map-canvas"></div>
            </div>
            <div class="row">
                <a  href="index.php?menu=event-list" class="button">BUAT EVENT</a>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->
