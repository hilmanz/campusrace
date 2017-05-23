<?php include('header-profile.php'); ?>
<div id="event-detail" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">EVENTS DETAIL</h1>
    	</div>
        
        <div class="row">
            <div id="map-canvas"></div>
        </div>
        <div class="row">
            <div class="box-grey">
            	<div class="infoDetailEvent">                            
                    <h1 class="yellow">14-15 MEI 2015</h1>               
                    <h1 class="yellow">EVENT A <br />Nobar Chapter 1</h1>
                    <p>Cafe cafe an</p>
                    <address>Jl Kemang Timur Raya No 1003 <br /> Jakarta Selatan</address>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis at risus quis tincidunt. Vivamus arcu orci, laoreet vitae porta vel, finibus id risus. Etiam eu nulla at sapien commodo euismod. Maecenas finibus neque lorem. Aenean a lacus ac odio tincidunt vehicula. Donec mollis nunc in gravida porttitor. Nunc volutpat libero in nibh fringilla, a dapibus risus viverra.</p>
                </div>
            </div>
        </div><!--end.row-->
        
        <div class="rows">
            <div id="memberListTabs" class="leaderInfo">
            	
            	<div id="tabs">
                  <ul>
                    <li><a href="#tabs-1">ANGGOTA CHECK-IN</a></li>
                  </ul>
                  <div id="tabs-1">
                  	<div class="rows-list">
                    	<div class="infoMembers fl">
                        	<p class="name_member fl">Anggita Slavina</p>
                            <span class="cekin fr icon-checkmark">&nbsp;</span>
                        </div>
                    
                    </div><!--end rows-->
                    <div class="rows-list">
                    	<div class="infoMembers fl">
                        	<p class="name_member fl">Pangki Arifin</p>
                            <span class="cekin fr icon-checkmark">&nbsp;</span>
                        </div>
                    
                    </div><!--end rows-->
                    <div class="rows-list">
                    	<div class="infoMembers fl">
                        	<p class="name_member fl">Melody</p>
                            <span class="cekin fr icon-checkmark">&nbsp;</span>
                        </div>
                    
                    </div><!--end rows-->
                  	
                    
                  </div><!--end#tabs1-->
                  
                 
                </div><!--end#tabs-->

            </div><!--endleaderInfo-->
        </div><!--end.rows-->
        
    </div><!--end#container-->
</div><!--end.section-->
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