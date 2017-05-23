<?php include('header-profile.php'); ?>


<div id="add-tantangan" class="section">
	<div id="container">
    	<div class="row-2">
            <h1 class="yellow">BUAT TANTANGAN</h1>
    	</div>
        <div class="formregis">
        	<form method="post" action="/login" enctype="application/x-www-form-urlencoded">
            <div class="row">
            	<p>Nama Tantangan</p>
                <input type="text" placeholder="">
            </div>
            <div class="row">
            	<p>Keterangan Tantangan</p>
                <input type="text"  placeholder="">
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
            	<p>Kategori Tantangan:</p>
                <div id="kategoriSelect" class="select_kat">
                    <select id="selectCategor">
                      <option value="0">Pilih Kategori</option>
                      <option value="fmchoose">FM Supersoccer</option>
                      <option value="twitterchoose">Twitter</option>
                    </select>
                </div>
                <div id="pointSelect" class="select_katPoint">
                    <select id="selectPoint">
                      <option value="">Pilih Point</option>
                      <option value="wpoint">Weekly Point</option>
                      <option value="wcoint">Weekly Coin</option>
                      <option value="wranking">Weekly Ranking (In Top 100)</option>
                      <option value="regfm">Register FM</option>
                    </select>
               	</div>
                 <div id="twitSelect" class="select_katTwit">
                    <select id="selectwitt">
                      <option value="">Pilih Kategori Twitter</option>
                      <option value="hastag">#hastag</option>
                      <option value="retweet">Retweet Account Supersoccer</option>
                    </select>
               	</div>
            </div>
            <div class="row pointInput">
            	<p>Isi Jumlah Point</p>
                <input type="text"  placeholder="">
            </div>
            <div class="row coinInput">
            	<p>Isi Jumlah Coin</p>
                <input type="text"  placeholder="">
            </div>
            <div class="row hastagsInput">
            	<p>Social Media #hastag</p>
                <input type="text"  placeholder="">
            </div>
            <div class="row">
                <a  href="index.php?menu=tantangan-list" class="button">BUAT TANTANGAN</a>
            </div>
        </form>
        </div>
    </div><!--end#container-->
</div><!--end.section-->
<script>

$(function() {
    $(document).on('change','#selectCategor',function(){
        if($('#selectCategor').val() == 'fmchoose') {
          	$('#pointSelect').show();
        	$('#twitSelect').hide();
			$('.hastagsInput').hide();
        } else if($('#selectCategor').val() == 'twitterchoose') {
            $('#twitSelect').show();
        	$('#pointSelect').hide();
			$('.coinInput').hide();
        	$('.pointInput').hide()
        } 
    });
});

$(function() {
    $(document).on('change','#selectPoint',function(){
        if($('#selectPoint').val() == 'wpoint') {
          	$('.pointInput').show();
        	$('.coinInput').hide();
        } else if($('#selectPoint').val() == 'wcoint') {
            $('.coinInput').show();
        	$('.pointInput').hide();
        } else{
			$('.coinInput').hide();
        	$('.pointInput').hide()
		}
    });
});
$(function() {
    $(document).on('change','#selectwitt',function(){
        if($('#selectwitt').val() == 'hastag') {
          	$('.hastagsInput').show();
        	
        } else {
            $('.hastagsInput').hide();
        } 
    });
});
</script>
