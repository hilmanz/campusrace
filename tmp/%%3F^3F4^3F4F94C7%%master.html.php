<?php /* Smarty version 2.6.13, created on 2016-03-22 14:01:12
         compiled from application/admin//master.html */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php echo $this->_tpl_vars['meta']; ?>

<body>
  <div id="body">
    <div id="page">
      <?php if ($this->_tpl_vars['pages'] != 'login' && $this->_tpl_vars['pages'] != 'logout'): ?>
      <div id="sidebar">
          <div id="navbar">
            <ul>
			<li class="adminList"><a class="adminmenu"  id="adminmenu"><span> MENU</span></a></li>
            
           <div class="subadmin1">
            <?php if ($this->_tpl_vars['menus']): ?>
				<?php unset($this->_sections['imn']);
$this->_sections['imn']['name'] = 'imn';
$this->_sections['imn']['loop'] = is_array($_loop=$this->_tpl_vars['menus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['imn']['show'] = true;
$this->_sections['imn']['max'] = $this->_sections['imn']['loop'];
$this->_sections['imn']['step'] = 1;
$this->_sections['imn']['start'] = $this->_sections['imn']['step'] > 0 ? 0 : $this->_sections['imn']['loop']-1;
if ($this->_sections['imn']['show']) {
    $this->_sections['imn']['total'] = $this->_sections['imn']['loop'];
    if ($this->_sections['imn']['total'] == 0)
        $this->_sections['imn']['show'] = false;
} else
    $this->_sections['imn']['total'] = 0;
if ($this->_sections['imn']['show']):

            for ($this->_sections['imn']['index'] = $this->_sections['imn']['start'], $this->_sections['imn']['iteration'] = 1;
                 $this->_sections['imn']['iteration'] <= $this->_sections['imn']['total'];
                 $this->_sections['imn']['index'] += $this->_sections['imn']['step'], $this->_sections['imn']['iteration']++):
$this->_sections['imn']['rownum'] = $this->_sections['imn']['iteration'];
$this->_sections['imn']['index_prev'] = $this->_sections['imn']['index'] - $this->_sections['imn']['step'];
$this->_sections['imn']['index_next'] = $this->_sections['imn']['index'] + $this->_sections['imn']['step'];
$this->_sections['imn']['first']      = ($this->_sections['imn']['iteration'] == 1);
$this->_sections['imn']['last']       = ($this->_sections['imn']['iteration'] == $this->_sections['imn']['total']);
?>   
					
					<?php if ($this->_tpl_vars['menus'][$this->_sections['imn']['index']]['id'] != 5 && $this->_tpl_vars['menus'][$this->_sections['imn']['index']]['id'] != 6): ?>
						<li><a class="<?php if ($this->_tpl_vars['pages'] == $this->_tpl_vars['menus'][$this->_sections['imn']['index']]['module']): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['basedomain'];  echo $this->_tpl_vars['menus'][$this->_sections['imn']['index']]['module']; ?>
" ><span><?php echo $this->_tpl_vars['menus'][$this->_sections['imn']['index']]['name_menu']; ?>
 </span></a></li>
						<?php endif; ?>
                        
					
				<?php endfor; endif; ?>
             <!--  <li><a class="<?php if ($this->_tpl_vars['pages'] == 'challangemanagement'): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement" ><span>Challange Management </span></a></li> -->
						  
			<?php endif; ?>
			</div>
			<?php if ($this->_tpl_vars['menus'] && $this->_tpl_vars['user']->type == 9): ?>
				<li class="adminList"><a class="adminmenu2"  id="adminmenu2"><span> ADMIN </span></a></li>
				<div class="subadmin2">
				<?php unset($this->_sections['imna']);
$this->_sections['imna']['name'] = 'imna';
$this->_sections['imna']['loop'] = is_array($_loop=$this->_tpl_vars['menus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['imna']['show'] = true;
$this->_sections['imna']['max'] = $this->_sections['imna']['loop'];
$this->_sections['imna']['step'] = 1;
$this->_sections['imna']['start'] = $this->_sections['imna']['step'] > 0 ? 0 : $this->_sections['imna']['loop']-1;
if ($this->_sections['imna']['show']) {
    $this->_sections['imna']['total'] = $this->_sections['imna']['loop'];
    if ($this->_sections['imna']['total'] == 0)
        $this->_sections['imna']['show'] = false;
} else
    $this->_sections['imna']['total'] = 0;
if ($this->_sections['imna']['show']):

            for ($this->_sections['imna']['index'] = $this->_sections['imna']['start'], $this->_sections['imna']['iteration'] = 1;
                 $this->_sections['imna']['iteration'] <= $this->_sections['imna']['total'];
                 $this->_sections['imna']['index'] += $this->_sections['imna']['step'], $this->_sections['imna']['iteration']++):
$this->_sections['imna']['rownum'] = $this->_sections['imna']['iteration'];
$this->_sections['imna']['index_prev'] = $this->_sections['imna']['index'] - $this->_sections['imna']['step'];
$this->_sections['imna']['index_next'] = $this->_sections['imna']['index'] + $this->_sections['imna']['step'];
$this->_sections['imna']['first']      = ($this->_sections['imna']['iteration'] == 1);
$this->_sections['imna']['last']       = ($this->_sections['imna']['iteration'] == $this->_sections['imna']['total']);
?>   
					
					<?php if ($this->_tpl_vars['menus'][$this->_sections['imna']['index']]['id'] == 5 && $this->_tpl_vars['user']->type == 9): ?>
						<li><a class="<?php if ($this->_tpl_vars['pages'] == $this->_tpl_vars['menus'][$this->_sections['imna']['index']]['module']): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['basedomain'];  echo $this->_tpl_vars['menus'][$this->_sections['imna']['index']]['module']; ?>
" ><span><?php echo $this->_tpl_vars['menus'][$this->_sections['imna']['index']]['name_menu']; ?>
 </span><?php if ($this->_tpl_vars['menus'][$this->_sections['imna']['index']]['id'] == 9): ?><span class="notifRound"><?php echo $this->_tpl_vars['countnotif']; ?>
 </span><?php endif; ?></a></li>
						<?php endif; ?>
					<?php if ($this->_tpl_vars['menus'][$this->_sections['imna']['index']]['id'] == 6 && $this->_tpl_vars['user']->type == 9): ?>
						<li><a class="<?php if ($this->_tpl_vars['pages'] == $this->_tpl_vars['menus'][$this->_sections['imna']['index']]['module']): ?>active<?php endif; ?>" href="<?php echo $this->_tpl_vars['basedomain'];  echo $this->_tpl_vars['menus'][$this->_sections['imna']['index']]['module']; ?>
" ><span><?php echo $this->_tpl_vars['menus'][$this->_sections['imna']['index']]['name_menu']; ?>
 </span><?php if ($this->_tpl_vars['menus'][$this->_sections['imna']['index']]['id'] == 9): ?><span class="notifRound"><?php echo $this->_tpl_vars['countnotif']; ?>
 </span><?php endif; ?></a></li>
						<?php endif; ?>
					
				<?php endfor; endif; ?>
				
			
							
                </div>
			<?php else: ?>	
					
			<?php endif; ?>
              </ul>
          </div>
      </div><!-- end #sidebar -->
		  <?php echo $this->_tpl_vars['header']; ?>

      <?php endif; ?>
        <div id="thecontent">
             <?php echo $this->_tpl_vars['mainContent']; ?>

        </div><!-- /#thecontent -->
		  <?php echo $this->_tpl_vars['footer']; ?>

    </div><!-- end #page -->
  </div><!-- end #body -->    
</body>
</html>