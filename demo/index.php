<!DOCTYPE html>
<!--[if lt IE 7]> <html dir="ltr" lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7]>    <html dir="ltr" lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8]>    <html dir="ltr" lang="en-US" class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" lang="en-US"> <!--<![endif]-->
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Supersoccer Community Race</title>
<!--Stylesheets-->
<link rel="stylesheet" href="css/suppersoccer-gte.css" type="text/css"  media="all" />
<link rel="stylesheet" href="css/responsive.css" type="text/css"  media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css"  media="all" />

<!--Favicon-->
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
<!--JavaScript-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

<script type="text/javascript" src="js/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
</head>
<body <?php if(@$_GET['menu']=='landing'){ ?>
          id="landing"
      <?php   } ?>>
<div <?php if(@$_GET['menu']=='landing'){ ?>
         id="landingbody"
      <?php   } else { ?>
            id="body"
        <?php }?>
      >
<div id="mainContainer">
	<div id="universal">
    	
        
		<?php 
        if(@$_GET['menu']=='landing'){
            include("home.php");
        }else if(@$_GET['menu']=='registration1'){ 
            include("registration1.php");
		 }else if(@$_GET['menu']=='leaderboard'){ 
            include("leaderboard.php");
		}else if(@$_GET['menu']=='member-leaderboard'){ 
            include("member-leaderboard.php");
		}else if(@$_GET['menu']=='member-registration1'){ 
            include("member-registration1.php");
		}else if(@$_GET['menu']=='member-registration2'){ 
            include("member-registration2.php");
        }else if(@$_GET['menu']=='registration2'){ 
            include("registration2.php");
		}else if(@$_GET['menu']=='registration-confirm'){ 
            include("registration-confirm.php");
			
		}else if(@$_GET['menu']=='member-registration-confirm'){ 
            include("member-registration-confirm.php");
		}else if(@$_GET['menu']=='chapter-profile'){ 
            include("chapter-profile.php");
		}else if(@$_GET['menu']=='edit-chapter'){ 
            include("edit-chapter.php");
		}else if(@$_GET['menu']=='edit-member'){ 
            include("edit-member.php");
		}else if(@$_GET['menu']=='member-profile'){ 
            include("member-profile.php");
		
		}else if(@$_GET['menu']=='about'){ 
            include("about.php");
		}else if(@$_GET['menu']=='tnc'){ 
            include("tnc.php");
		}else if(@$_GET['menu']=='mekanisme'){ 
            include("mekanisme.php");
		}else if(@$_GET['menu']=='member-mekanisme'){ 
            include("member-mekanisme.php");
		}else if(@$_GET['menu']=='member-about'){ 
            include("member-about.php");
		}else if(@$_GET['menu']=='member-list'){ 
            include("member-list.php");
		}else if(@$_GET['menu']=='event-list'){ 
            include("event-list.php");
		}else if(@$_GET['menu']=='member-event-list'){ 
            include("member-event-list.php");
			
		}else if(@$_GET['menu']=='tantangan-list'){ 
            include("tantangan-list.php");
		}else if(@$_GET['menu']=='member-tantangan-list'){ 
            include("member-tantangan-list.php");
		}else if(@$_GET['menu']=='add-tantangan'){ 
            include("add-tantangan.php");
			
		}else if(@$_GET['menu']=='event-detail'){ 
            include("event-detail.php");
		}else if(@$_GET['menu']=='event-detail-past'){ 
            include("event-detail-past.php");
		}else if(@$_GET['menu']=='reservation'){ 
            include("reservation.php");
			
		}else if(@$_GET['menu']=='member-event-detail'){ 
            include("member-event-detail.php");
		}else if(@$_GET['menu']=='member-event-detail-coming'){ 
            include("member-event-detail-coming.php");
		}else if(@$_GET['menu']=='tantangan-detail'){ 
            include("tantangan-detail.php");
		}else if(@$_GET['menu']=='member-tantangan-detail'){ 
            include("member-tantangan-detail.php");
		}else if(@$_GET['menu']=='add-event'){ 
            include("add-event.php");
		}else if(@$_GET['menu']=='add-member'){ 
            include("add-member.php");
			
		}else if(@$_GET['menu']=='detail-member'){ 
            include("member-detail.php");
		}else if(@$_GET['menu']=='registration2'){ 
            include("registration2.php");
			
        }else if(@$_GET['menu']=='demographic-data'){ 
            include("demographic-data.php");
        }else{ 
            include("home.php");
        }?>
    <?php include('footer.php'); ?>
    </div>
</div>	
</div>
</body>
</html>
