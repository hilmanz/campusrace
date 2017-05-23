<?php /* Smarty version 2.6.13, created on 2016-03-24 17:26:17
         compiled from application/web/apps/puzzle.html */ ?>

<div id="container">
    <div id="gameContainer">
        <div id="landingGame" class="gameContent">
			<?php if ($this->_tpl_vars['status_puzzle'] == 'active'): ?>
            <img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/otakatikbola.png">
            <div class="rowbtn">
                <a href="#puzzle" class="btnshow button">MAIN SEKARANG!</a>
                <a href="#caramain" class="btnshow button">CARA BERMAIN</a>
            </div>
			<div id="keteranganbrowser"></div>	
			<?php else: ?>
			<div class="rows">
				<div class="descSkor rowboxs tr">							
					<h4 class="title-entry yellow">Maaf, GAME PUZZLE! periode ini sudah ditutup.</h4>						 
					<p>Anda dapat ikutan GAME PUZZLE! periode selanjutnya di pertandingan yang akan datang. Tetap update di game Supersoccer Community Race!</p>
				</div><!--end.skorInput-->
			</div><!--end.rows-->			 
			<?php endif; ?>
        </div>
        <div id="caramain" class="gameContent hide">
            <img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/cara.png">
            <ul>
                <li>Partisipan harus meng-klik tombol START untuk memulai permainan</li>

                <li>Partisipan harus menyusun gambar acak yang muncul hingga terbentuk gambar dengan susunan yang tepat</li>

                <li>Partisipan bisa bermain puzzle lebih dari 1 (satu) kali dalam sehari, namun skor yang terhitung hanya 
waktu yang tercepat</li>

                <li>Waktu bermain untuk 1 (satu) kali main adalah 60 detik</li>

                <li>Setiap gambar yang berhasil disusun, partisipan akan mendapatkan 5 (lima) poin</li>

                <li>1 (satu) orang pemenang ditentukan dari waktu permainan dan submission tercepat.</li>
            </ul>
            <div class="rowbtn">
                <a href="#puzzle" class="btnshow button">MAIN SEKARANG</a>
            </div>
        </div>
         <div id="puzzle" class="gameContent hide">
                <div class="timer">
                    <span id="clock" style="opacity:0;"></span>
					 <!--<span id="clock"></span>-->
                </div>
				<div id="support"></div>	
                <div id="progressbox">
                    <span class="medal medal1"></span>
                    <span class="medal medal2"></span>
                    <span class="medal medal3"></span>
                    <div id="progressbar"></div>
                </div>
               
                <div id="puzzlegame">
				
				<h2 class="hide">
                    <center>
                        <div id="keterangan1"></div>
                        <div id="keterangan2"></div>
                    </center>
                </h2>
				<div id="title" class="button"></div>
                    <div ng-include="type"></div>
					<canvas id="myCanvas1" width="440px" height="320px" onclick="onCanvasClick(event);" class="can1"></canvas>
					<canvas id="myCanvas2" width="253px" height="190px" onclick="onCanvasClick(event);" class="can2"></canvas>					
                    <div id="waktuhabis" class="hide">
                    	<img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/waktuhabis.png">
                		<a onclick="javscript:void(0);" id="playpuzzle"  class="playpuzzle button">COBA LAGI</a>
                    </div>
					
                </div>
        </div>
    </div>
</div>
<noscript>
   Agar fungsi di situs ini lebih baik, anda perlu mengaktifkan JavaScript.
   Berikut ini adalah <a href="http://www.enable-javascript.com/id/" target="_blank">
   petunjuk cara mengaktifkan JavaScript</a> di peramban web Anda.
</noscript>
<script>
var chapter_id = "<?php echo $this->_tpl_vars['memberprofile']['chapter_id']; ?>
";
var user_id = "<?php echo $this->_tpl_vars['memberprofile']['ids']; ?>
";
var puzzle_id = "<?php echo $this->_tpl_vars['puzzle_id']; ?>
" ;
var gbr_kecil = "<?php echo $this->_tpl_vars['gbr_kecil']; ?>
" ;
var gbr_besar = "<?php echo $this->_tpl_vars['gbr_besar']; ?>
" ;

<?php echo '

//alert(user_id);
/*
var ua = navigator.userAgent.toLowerCase();
var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
var isIphone = ua.indexOf("iphone") > -1; //&& ua.indexOf("mobile");
if(isAndroid) {
  // Do something!
  // Redirect to Android-site?
 alert("ini Adroid")
}else if(isIphone) {
  // Do something!
  // Redirect to Android-site?
 alert("ini Iphone")
}

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 // some code..
 $(\'#can2\').show();
  $(\'#can1\').hide();
 //alert("mobile");
}else{
$(\'#can1\').show();
  $(\'#can2\').hide();
}
*/
	
		function timepuzzle(){		
		var waktu = 59;
		 var totalSeconds = 0;
		counter=setInterval(function() {
		waktu--;

					++totalSeconds;
					$(\'#clock > #seconds\').html(pad(totalSeconds%60));
					$(\'#clock > #minutes\').html(pad(parseInt(totalSeconds/60)));
					
		if(waktu < 0) {
			clearInterval ( counter );		
			gameOver();
		}else{
		waktu2=(waktu/5.9)*10;
		$(\'#namanya\').html("");
		$(\'#waktunya\').html("");

		//document.getElementById("countdown").innerHTML = waktu2;
		$( "#progressbar" ).progressbar({
					value: waktu2
				});
		}
		}, 1000);
			
		}

		$(\'#clock\').prepend(\'<label id="minutes">00</label>:<label id="seconds">00</label>\');
         var totalSeconds = 0;
        //counter=setInterval(setTime, 1000);
        
        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
		
		 $(".stop").click(function(){				
		
					$(".start").hide();
					$(".stop").show();
					alert("stop");
					
					clearInterval ( counter );
					
								var menit=document.getElementById("minutes").innerHTML;
								var detik=document.getElementById("seconds").innerHTML;
								var timer=menit+":"+detik;
								
									$.ajax ({ 
										type	 : \'POST\', 
										url	 :  basedomain+\'puzzle/savedata\' , 
										data:{user_id:user_id,chapter_id:chapter_id,timer:timer},
										dataType:\'json\',
										success	: function (result) 
											{
												
												alert("You Won "+name+" waktu "+timer);
											}
									});					
               

            });
		
		
		
		function init(){
		onReady();
		
		}
		
		var can;
		var ctx;		
		var img;
		
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		 // some code..
		 var blockSize = 63;
		
		}else{
		
		
		var blockSize = 110;
		}
		
		
		
		var clickX;
		var clickY;
		
		var selected1;
		var selected2;
		
		var piecesArray = new Array();
		var correctOrder = new Array();
		
		var _puzzle;
       
		
		
		function onReady()
		{
		
		
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			 // some code..
			can = document.getElementById(\'myCanvas2\');
			}else{
			can = document.getElementById(\'myCanvas1\');
			}
		
			
			
			if(!can.getContext)
			{
				can.style.display = \'none\';
				//document.getElementById(\'sorry\').style.display = \'inline\';
				document.getElementById(\'support\').innerHTML = "Your browser is not supported.  Please use one of the browsers above.";
				$(\'#keteranganbrowser\').html(\'Your browser is not supported.  Please use one of the browsers above.\');
			}
			/**/
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				 // some code..
			ctx = can.getContext(\'2d\');
			img = new Image();
			img.onload = onImage1Load;
			img.src = basedomain+"public_assets/puzzle/"+gbr_kecil;
			console.log(basedomain+"public_assets/puzzle/"+gbr_kecil);
				}else{
			ctx = can.getContext(\'2d\');
			img = new Image();
			img.onload = onImage1Load;
			img.src = basedomain+"public_assets/puzzle/"+gbr_besar;	
			console.log(basedomain+"public_assets/puzzle/"+gbr_besar);
			}
            
		}
		
				
		function onImage1Load()
		{
			var r=null;
			
			for(var i = 0; i < 4; i++)
			{
				for(var j = 0; j < 3; j++)
				{
				
					r = new Rectangle(i * blockSize, j * blockSize, i*blockSize + blockSize, j * blockSize + blockSize);
					piecesArray.push(r);
					correctOrder.push(r);
					
				}				
			}
			_puzzle=\'1\';
				
			document.getElementById(\'title\').innerHTML = "START";
			scrambleArray();
			
			drawImage();
		}
		
		function onImageLoad()
		{
			
					for(var u = 0; u < piecesArray.length; u++)
						{
							piecesArray[u] = correctOrder[u]
							
						}
			
			
			_puzzle=\'1\';
			
			document.getElementById(\'title\').innerHTML = "START";
			scrambleArray();
			
			drawImage();
		}
		
		
	
		function onCanvasClick(evt)
		{
		//
			
			if(_puzzle==1){
			scrambleArray();
			
			drawImage();
			
			//scrambleArray(piecesArray, 30);			
			//drawImage();
			//_puzzle=\'2\';
			//document.getElementById(\'title\').innerHTML = \'\';
			//timepuzzle();
			
			}else if(_puzzle==2){
			$(\'#title\').addClass("hide");
			clickX = evt.offsetX;
			clickY = evt.offsetY;
			
			var drawX = Math.floor(clickX / blockSize);
			var drawY = Math.floor(clickY / blockSize);
		
			var index = drawX * 3 + drawY;
			
			var targetRect = piecesArray[index];
			var drawHighlight = true;
			
			drawX *= blockSize;
			drawY *= blockSize;
			
			ctx.clearRect(0, 0, 500, 333);
			
			if(selected1 != undefined && selected2 != undefined)
			{
				selected1 = selected2 = undefined;
			}
			
			if(selected1 == undefined)
			{
				selected1 = targetRect;
			}
			else
			{
				selected2 = targetRect;
				swapRects(selected1, selected2);
				drawHighlight = false;
			}
			
		
			drawImage();
			
			if(drawHighlight)	
				highlightRect(drawX, drawY);
				
		}
		
		}
		
		function highlightRect(drawX, drawY)
		{
			console.log(drawX, drawY);
			ctx.beginPath();
			ctx.moveTo(drawX, drawY);
			ctx.lineTo(drawX + blockSize, drawY);
			ctx.lineTo(drawX + blockSize, drawY + blockSize);
			ctx.lineTo(drawX, drawY + blockSize);
			ctx.lineTo(drawX, drawY);
			ctx.lineWidth = 2;

			// set line color
			ctx.strokeStyle = "#ff0000";
			ctx.stroke();
		}
		
		function swapRects(r1, r2)
		{
			var index1;
			var index2;
			var temp = r1;
			
			index1 = piecesArray.indexOf(r1);
			index2 = piecesArray.indexOf(r2);
			
			piecesArray[index1] = r2;
			piecesArray[index2] = temp;			
			
			checkWinner();
		}
		
		function checkWinner()
		{
			var match = true;
			
			for(var i = 0; i < piecesArray.length; i++)
			{
				if(piecesArray[i] != correctOrder[i])
				{
					match = false;
				}
			}
			
			if(match)
			{
				//console.log(\'complete\');
				
				clearInterval(counter);
				
						//counter ended, do something here								
								var menit=document.getElementById("minutes").innerHTML;
								var detik=document.getElementById("seconds").innerHTML;
								var timer=menit+":"+detik;
								$("#myCanvas1").addClass("hide");
								$("#myCanvas2").addClass("hide");
								$(\'#keterangan1\').html(\'Selamat\');
								$(\'#keterangan2\').html(\'Anda berhasil menyelesaikan game Otak-Atik Bola dan mendapatkan 5 poin.\');
								$("#title").addClass("hide");
								$("#puzzlegame h2").removeClass("hide");
							
							
									$.ajax ({ 
										type	 : \'POST\', 
										url	 :  basedomain+\'puzzle/savedata\' , 
										data:{puzzle_id:puzzle_id,user_id:user_id,chapter_id:chapter_id,timer:timer},
										dataType:\'json\',
										success	: function (result) 
											{
												
												//alert("You Won!!");
												onImageLoad()
												//onCanvasClick(evt)
											}
									});
									
									
				
			}
			else
			{
				console.log(\'not complete\');
				//alert(\'not complete\');
			}
		}
		
		
		
		function drawImage()
		{		
			for(var k = 0; k < 4; k++)
			{
				for(var l = 0; l < 3; l++)
				{
					r = piecesArray[k*3+l];					
					ctx.drawImage(img, r.left, r.top, r.width, r.height, k*blockSize, l*blockSize, blockSize, blockSize);
				}
			}
		}
		
		
		
		function scrambleArray(ar, times)
		{
			var count = 0;
			var temp;
			var index1;
			var index2;
			//var times=0;
			while(count < times)
			{
				index1 = Math.floor(Math.random()*piecesArray.length);
				index2 = Math.floor(Math.random()*piecesArray.length);
				
				temp = piecesArray[index1];
				piecesArray[index1] = piecesArray[index2];
				piecesArray[index2] = temp;
				
				count++;
			}
		}
		
		
		
		function Rectangle(left, top, right, bottom)
		{
			this.left = left;
			this.top  = top;
			this.right = right;
			this.bottom = bottom;
			
			this.width = right - left;
			this.height = bottom - top;
		}
		
		function isCanvasSupported()
		{
		  var elem = document.createElement(\'canvas\');
		  return (elem.getContext && elem.getContext(\'2d\'));
		}
		
		
		
		function gameOver(){
		/*
		piecesArray = null;
		correctOrder = null;
		*/
		 	$("#waktuhabis").removeClass("hide");
			onImageLoad()
		
            can.onmousedown = null;
            can.onmousemove = null;
            can.onmouseup = null;
		     
        }
		
			
		
            $(document).ready(function(){
			
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					 // some code..
					 $(\'#myCanvas2\').show();
					  $(\'#myCanvas1\').hide();
					 //alert("mobile");
					}else{
					$(\'#myCanvas1\').show();
					  $(\'#myCanvas2\').hide();
					  //alert("no mobile");
					}

                $("a.btnshow").click(function(){
                    var targetID = jQuery(this).attr(\'href\');
                    $(".gameContent").removeClass("show");
                    $(".gameContent").addClass("hide");
                    $(targetID).addClass("show");
                    return false;
                });

                $("#playpuzzle").click(function(){
                	$("#waktuhabis").addClass("hide");
                	$("#title").removeClass("hide");
                	onImageLoad();
                });

                $("#title").click(function(){
				
					scrambleArray(piecesArray, 30);			
					drawImage();
					_puzzle=\'2\';
					timepuzzle();
                	onCanvasClick();
                	$(this).addClass("hide");
				
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					 // some code..
					 $("#myCanvas2").removeClass("hide");
					 
					 //alert("mobile 2 show");
					}else{
					$("#myCanvas1").removeClass("hide");
					}
					//$("#myCanvas").removeClass("hide");
					$(\'#keterangan1\').html(\'\');
					$(\'#keterangan2\').html(\'\');
								
                });
            });

		'; ?>

</script>


