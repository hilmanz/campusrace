<?php /* Smarty version 2.6.13, created on 2016-08-01 10:14:26
         compiled from application/web//master.html */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html dir="ltr" lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7]>    <html dir="ltr" lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8]>    <html dir="ltr" lang="en-US" class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" lang="en-US"> <!--<![endif]-->
<?php if ($this->_tpl_vars['pages'] == 'puzzle' || $this->_tpl_vars['pages'] == 'puzzle2'): ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php endif; ?>
<head>
<?php echo $this->_tpl_vars['meta']; ?>

</head>
<?php if ($this->_tpl_vars['pages'] == 'puzzle' || $this->_tpl_vars['pages'] == 'puzzle2'): ?>
<body onload="init();">

<?php else: ?>
<body id='<?php if ($this->_tpl_vars['pages'] == '' || $this->_tpl_vars['pages'] == 'login'): ?>landing<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>'>
<?php endif; ?>
<div id="body">
<div id="mainContainer">
	<div id="universal">
	
    	<?php if ($this->_tpl_vars['pages'] == '' || $this->_tpl_vars['pages'] == 'login' || $this->_tpl_vars['pages'] == 'loginfb' || $this->_tpl_vars['pages'] == 'home' && $this->_tpl_vars['act'] == 'loginfb' || $this->_tpl_vars['pages'] == 'chapter' && $this->_tpl_vars['act'] == 'proseseditchapter' || $this->_tpl_vars['pages'] == 'member' && $this->_tpl_vars['act'] == 'proseseditmember' || $this->_tpl_vars['pages'] == 'chapter' && $this->_tpl_vars['act'] == 'prosesadEvent'): ?>
		<?php else: ?>
		<?php echo $this->_tpl_vars['header']; ?>

		<?php endif; ?>
		
		
		<?php echo $this->_tpl_vars['mainContent']; ?>

        
    	<?php if ($this->_tpl_vars['pages'] == 'login' || $this->_tpl_vars['pages'] == 'loginfb' || $this->_tpl_vars['pages'] == 'home' && $this->_tpl_vars['act'] == 'loginfb' || $this->_tpl_vars['pages'] == 'chapter' && $this->_tpl_vars['act'] == 'proseseditchapter' || $this->_tpl_vars['pages'] == 'member' && $this->_tpl_vars['act'] == 'proseseditmember' || $this->_tpl_vars['pages'] == 'chapter' && $this->_tpl_vars['act'] == 'prosesaddMember' || $this->_tpl_vars['pages'] == 'chapter' && $this->_tpl_vars['act'] == 'prosesadEvent' || $this->_tpl_vars['pages'] == 'chapter' && $this->_tpl_vars['act'] == 'prosesRegistrasi'): ?>
		<?php else: ?>
		<?php echo $this->_tpl_vars['footer']; ?>

		<?php endif; ?>
		
		
      </div>
</div>	
</div>
</body>
</html>