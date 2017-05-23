<?php /* Smarty version 2.6.13, created on 2016-02-25 13:22:55
         compiled from application/admin//apps/listchapter.html */ ?>
<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-users">&nbsp;</span>List Chapter</h2>
			<h2 class="fr"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement/addchapter" class="button2">Tambah Baru</a></h2>
             
        </div><!-- end .titlebox -->
        <div class="content chapter">
        	<div class="summary">
       		 <div class="short">
			  <form method="GET" action="" id="shorter">
             	
                <div class="leftShorter">
                	<div class="select_box">
                    	<label>Sort by City :</label>
                        <select name="kota" class="sort kota">
                            <option value="">Semua Kota</option>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listcity']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
							<?php if ($this->_tpl_vars['kota'] == $this->_tpl_vars['listcity'][$this->_sections['i']['index']]['id']): ?>
							<option value="<?php echo $this->_tpl_vars['listcity'][$this->_sections['i']['index']]['id']; ?>
" selected><?php echo $this->_tpl_vars['listcity'][$this->_sections['i']['index']]['city']; ?>
</option>
                            <?php else: ?>
                            <option value="<?php echo $this->_tpl_vars['listcity'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['listcity'][$this->_sections['i']['index']]['city']; ?>
</option>
                            <?php endif; ?>
							<?php endfor; endif; ?>

                        </select>
                    </div>
                    <div class="select_box">
                    	<label>Favorite Club :</label>
                        <select name="clubs" class="sort clubs">
			    <option value="">Semua Klub</option>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listclub']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
							<?php if ($this->_tpl_vars['clubs'] == $this->_tpl_vars['listclub'][$this->_sections['i']['index']]['id']): ?>
							<option value="<?php echo $this->_tpl_vars['listclub'][$this->_sections['i']['index']]['id']; ?>
" selected><?php echo $this->_tpl_vars['listclub'][$this->_sections['i']['index']]['name_club']; ?>
</option>
							<?php else: ?>
							<option value="<?php echo $this->_tpl_vars['listclub'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['listclub'][$this->_sections['i']['index']]['name_club']; ?>
</option>
							<?php endif; ?>
                            <?php endfor; endif; ?>
                        </select>
                    </div>
                    <div class="select_box">
                    	<label>Sort by Points :</label>
                        <select name="points" class="sort points">
						
                            <option value="">Tampilkan Semua</option>
                            <option value="1" <?php if ($this->_tpl_vars['points'] == 1): ?>selected<?php endif; ?> >Tertinggi</option>
                            <option value="2" <?php if ($this->_tpl_vars['points'] == 2): ?>selected<?php endif; ?> >Terendah</option>
                        </select>
                    </div>
                </div><!--end.row-->
             	<div class="rightShorter">
						 <div id="datePick">
                                <span class="fl">Tanggal :</span>
                                <div class="inputDate fl">
                                    <input type="text" value="<?php echo $this->_tpl_vars['startdate']; ?>
" name="startdate" class="datepicker submitter startdate " id="dp1403509217274">
                                </div><!-- /.rows -->
                                
                                <span class="fl">Sampai</span>
                                <div class="inputDate fl">
                                    <input type="text" value="<?php echo $this->_tpl_vars['enddate']; ?>
" name="enddate" class="datepicker enddate " id="dp1403509217275">
                                </div><!-- /.rows -->
						</div>
                        <div id="searchPick">
						<span class="fl">Cari :</span>
						<input type='text' name='search' value="<?php echo $this->_tpl_vars['search']; ?>
" class='selectEvent fl search' style="width:150px" placeholder="nama/email chapter">
						<input type="submit" class="button2" style="margin-top:0px;" value="Go">
						</div>
					</form>	
           		</div><!--end.row-->
				</div>
            </div><!-- end .summary -->
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead>
				<tr>
					<th class="head0">No</th>
					<th class="head0">Nama Chapter</th> 
					<th class="head0">Klub</th> 
					<th class="head0">Chapter Head </th> 
					<th class="head0">Tanggal Registrasi</th> 
					<th class="head0">Member Actived</th> 
					<th class="head0">Member Inactived</th>
					<th class="head0">Member Deleted</th>
					<th class="head0">Point</th> 
					<th class="head0">Status</th> 
					<th class="head0" >Aksi</th> 
				</tr>
			</thead>
			<tbody class="pagilist">
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
					<tr>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['no']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name_chapter']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name_club']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['date_register']; ?>
</td>
					<td class="text-center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['total_member_active']; ?>
</td>
					<td class="text-center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['total_member_inactive']; ?>
</td>
					<td class="text-center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['total_member_delete']; ?>
</td>
					<td class="text-center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['point']; ?>
</td>
					<td><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 1): ?>Active<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 0): ?>Inactive<?php else: ?>Delete<?php endif; ?></td>
					<td>
						<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 0): ?>
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement?paramactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement/editchapter/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 1): ?>
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement?paraminactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Inactive</a> | <a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
chaptermanagement/editchapter/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a>
						<?php endif; ?>
					</td>
					</tr>
					<?php endfor; endif; ?>	
			</tbody>
			</table>
            
			<!-- <div id="paging_of_chapter_list" class="paging">-->
			<div id="paging_of_chapter_list" class="paging">
            
            </div>
           <!-- <p>asasas</p>asasas
            </div> -->
        </div><!-- end .chapter -->
    </div><!-- end #container -->
</div><!-- end #home -->

<script type="text/javascript">
	getpaging(0,<?php echo $this->_tpl_vars['total']; ?>
,"paging_of_chapter_list","paging_ajax_chapter",10);
</script>

<script>
<?php echo '
function paging_ajax_chapter(fungsi,start){ 
var status=$(\'.status option:selected\').val();
var kota=$(\'.kota option:selected\').val();		
var startdate=$(\'.startdate\').val();
var enddate=$(\'.enddate\').val();	
var search=$(\'.search\').val();	
var clubs=$(\'.clubs option:selected\').val();
var points=$(\'.points option:selected\').val();
				
	$.post(basedomain+"chaptermanagement/pagingchapter",{\'start\':start,ajax:1,\'status\':status,\'kota\':kota,\'startdate\':startdate,\'enddate\':enddate,\'search\':search,\'clubs\':clubs,\'points\':points},function(response){
	
		if(response){
			  if(response.status==true){
				var str="";
				$.each(response.data,function(k,v){
		
						str+=\'<tr>\';
						str+=\'<td>\'+v.no+\'</td>\';
						str+=\'<td>\'+v.name_chapter+\'</td>\';
						str+=\'<td>\'+v.name_club+\'</td>\';
						str+=\'<td>\'+v.name+\'</td>\';
						str+=\'<td>\'+v.date_register+\'</td>\';	
						str+=\'<td>\'+v.total_member_active+\'</td>\';	
						str+=\'<td>\'+v.total_member_inactive+\'</td>\';
						str+=\'<td>\'+v.total_member_delete+\'</td>\';
						str+=\'<td>\'+v.point+\'</td>\';
						str+=\'<td>\'
						if (v.n_status==1){str+=\'Actived\';}else if(v.n_status==0){str+=\'Inactived\';}else{str+=\'Deleted\';}str+=\'</td>\';
						str+=\'<td>\'
						if(v.n_status==0){str+=\'<a href="\'+basedomain+\'chaptermanagement?paramactive=\'+v.id+\'" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'chaptermanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;"> Delete</a> | <a href="\'+basedomain+\'chaptermanagement/editchapter/\'+v.id+\'" style="color:#19CFA8;">Edit</a>\';}
						else if(v.n_status==1){str+=\'<a href="\'+basedomain+\'chaptermanagement?paraminactive=\'+v.id+\'" style="color:#19CFA8;">Inactive</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'chaptermanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;"> Delete</a> | <a href="\'+basedomain+\'chaptermanagement/editchapter/\'+v.id+\'" style="color:#19CFA8;">Edit</a>\';}str+=\'</td>\';
						
						str+=\'</tr>\';
						
						});
						
						$(\'.pagilist\').html(str);
						likeunlike();	
					
				}
			}
		},"JSON");
	}
	
'; ?>

	</script>

<script>
<?php echo '
//select bootstarp

$(\'.selectpicker\').selectpicker();
likeunlike();

function likeunlike(){

$(document).ready(function(){
			$(".checkactive").on("click", function(){
			var idnya=$(this).val();
			var thisnya=$(this);
					  $.ajax({
                        \'type\': \'POST\',
                        \'url\': basedomain+\'chaptermanagement/checkit\',
                        \'data\': {idnya:idnya},
						\'dataType\':\'json\',
                        \'success\': function(result){
						
							thisnya.hide();
							thisnya.parent().html(\'<center><input type="checkbox" class="checkinactives" value=\'+idnya+\' checked>Checked</center>\');
							
							$(document).ready(function(){
							$(".checkinactives").on("click", function(){
							var idnya=$(this).val();
							var thisnya=$(this);
									  $.ajax({
										\'type\': \'POST\',
										\'url\': basedomain+\'chaptermanagement/incheckit\',
										\'data\': {idnya:idnya},
										\'dataType\':\'json\',
										\'success\': function(result){
										
											thisnya.hide();
											thisnya.parent().html(\'<center><input type="checkbox" class="checkactive" value=\'+idnya+\'></center>\');
											likeunlike();
										}
										
										});

								});
							});
						}
						
						});

				});
			});
			
$(document).ready(function(){
			$(".checkinactive").on("click", function(){
			var idnya=$(this).val();
			var thisnya=$(this);
					  $.ajax({
                        \'type\': \'POST\',
                        \'url\': basedomain+\'chaptermanagement/incheckit\',
                        \'data\': {idnya:idnya},
						\'dataType\':\'json\',
                        \'success\': function(result){
						
							thisnya.hide();
							thisnya.parent().html(\'<center><input type="checkbox" class="checkactive" value="\'+idnya+\'"></center>\');
							likeunlike();
						}
						
						});

				});
			});
}


'; ?>

</script>