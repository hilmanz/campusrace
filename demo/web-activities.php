<div class="section">
	<ul class="columns-content page-content clearfix">
    	<div id="tabs">
					
    		<ul class="nav">
                <li class="nav-one"><a href="#userActivities" class="current">User Activities</a></li>
                <li class="nav-two"><a href="#topUsers">Top Users</a></li>
                <li class="nav-three"><a href="#topVisited">Top Visited Page</a></li>
                <li class="nav-four"><a href="#topContent">Top Content</a></li>
                <li class="nav-five last"><a href="#mostViewed" id="most">Most Viewed Artists</a></li>
            </ul>
    		<div class="list-wrap">
    			<ul id="userActivities">
    				<?php include('widget/userActivities.php'); ?>
    			</ul>
        		 <ul id="topUsers" class="hide">
                     <?php include('widget/topUsers.php'); ?>
        		 </ul>
        		 <ul id="topVisited" class="hide">
                 	<?php include('widget/topVisited.php'); ?>
        		 </ul>
        		 <ul id="topContent" class="hide">
	                 <?php include('widget/topContent.php'); ?>
        		 </ul>
                 <ul id="mostViewed" class="hide">
                   	<?php include('widget/mostViewArtist.php'); ?>
        		 </ul>
        		 
    		 </div> <!-- END List Wrap -->
		 
		 </div> <!-- END tabs -->
    </ul><!---end.columns-content page-content clearfix-->
</div><!--end.section-->