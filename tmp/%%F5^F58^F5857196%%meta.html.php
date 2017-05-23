<?php /* Smarty version 2.6.13, created on 2016-03-22 14:01:12
         compiled from application/admin//meta.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'application/admin//meta.html', 35, false),)), $this); ?>
<head>
	<meta charset="utf-8">
	<title>Admin SuperSoccer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link rel="icon" href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/favicon-2.png" type="image/x-icon">

    <link href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/css/colpick.css" rel="stylesheet" type="text/css" />
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/css/admin-ssgte.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/css/jquery.timepicker.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/css/atooltip.css" rel="stylesheet"  media="screen" />
    
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/css/bootstrap-select.css">
	<?php echo '
	<style>
		#textcontent{width:100px; height: 100px;} 
		</style>
    '; ?>

	
    
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.atooltip.js"></script>
    
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
	<!-- JS library -->
	<script>
		var basedomain = "<?php echo $this->_tpl_vars['basedomain']; ?>
" ;
		var basedomainpath = "<?php echo $this->_tpl_vars['basedomainpath']; ?>
" ;
		var pages = "<?php echo $this->_tpl_vars['pages']; ?>
" ;
		var locale = <?php echo json_encode($this->_tpl_vars['locale']); ?>
;
	</script> 
	<!--- END ---->
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.steps.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/colpick.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/php.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/kipagination.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/contentviews.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/contentHelper.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/jquery.timepicker.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/touchbase.js"></script>
    <script src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/bootstrap-select.js"></script>
    <script src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/highcharts.js"></script>
    <script src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/modules/exporting.js"></script>
	 <script type="text/javascript" src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/js/validationkana.js"></script>
    <script type="text/javascript">
    <?php echo '
        $(document).ready(function() {
            $("#datepicker").datepicker({dateFormat:"yy-mm-dd"});
        }); 
		  $(\'.selectpicker\').selectpicker();
    '; ?>

    </script>
</head>
