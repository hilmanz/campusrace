<?php /* Smarty version 2.6.13, created on 2016-03-22 14:01:12
         compiled from application/admin//apps/listchalange.html */ ?>


<script>
<?php echo '
function paging_ajax_challange(fungsi,start){ 

var category=$(\'.category option:selected\').val();		
var startdate=$(\'.startdate\').val();
var enddate=$(\'.enddate\').val();	
var search=$(\'.search\').val();	
var status=$(\'.status option:selected\').val();

				
	$.post(basedomain+"challangemanagement/pagingchallange",{\'start\':start,ajax:1,\'category\':category,\'startdate\':startdate,\'enddate\':enddate,\'search\':search,\'status\':status},function(response){
	
		if(response){
			  if(response.status==true){
				var str="";
				$.each(response.data,function(k,v){
		
						str+=\'<tr>\';
						str+=\'<td>\'+v.no+\'</td>\';
						str+=\'<td>\'+v.namess+\'</td>\';
						str+=\'<td>\'+v.description+\'</td>\';
						str+=\'<td>\'+v.start_time+\'</td>\';
						str+=\'<td>\'+v.end_time+\'</td>\';
						str+=\'<td>\'+v.name_category+\'</td>\';
						//str+=\'<td>\'+v.name_chapter+\'</td>\';
						str+=\'<td>\'+v.create_challange+\'</td>\';	
						
						//str+=\'<td>\'+v.point+\'</td>\';
						str+=\'<td>\'
						if (v.n_status==1){str+=\'Actived\';}else if(v.n_status==0){str+=\'Inactived\';}else{str+=\'Finished\';}str+=\'</td>\';
						//str+=\'<td><a href="\'+basedomain+\'listtantangan?paramactive=\'+v.id+\'" style="color:#19CFA8;">Active</a> | <a href="\'+basedomain+\'listtantangan?paraminactive=\'+v.id+\'" style="color:#19CFA8;">Delete</a> | <a href="\'+basedomain+\'listtantangan/edittantangan/\'+v.id+\'" style="color:#19CFA8;">Edit</a></td>\';					
						if(v.n_status==0){str+=\'<td><a href="\'+basedomain+\'challangemanagement?paramactive=\'+v.id+\'" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'challangemanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;"> Delete</a> | <a href="\'+basedomain+\'challangemanagement/editchallange/\'+v.id+\'" style="color:#19CFA8;">Edit</a></td>\';}
						else if(v.n_status==1){str+=\'<td><a href="\'+basedomain+\'challangemanagement?paramfinish=\'+v.id+\'" style="color:#19CFA8;">Finish</a> | <a href="\'+basedomain+\'challangemanagement?paraminactive=\'+v.id+\'" style="color:#19CFA8;">Inactive</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'challangemanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;"> Delete</a> | <a href="\'+basedomain+\'challangemanagement/editchallange/\'+v.id+\'" style="color:#19CFA8;">Edit</a></td>\';}
						else if(v.n_status==3){str+=\'<td></td>\';}
						
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
	
<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-users">&nbsp;</span>List Challenge</h2>
			<h2 class="fr"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement/addchallange" class="button2">Tambah Baru</a></h2>
             
        </div><!-- end .titlebox -->
        <div class="content challange">
			<div class="summary">
       		 <div class="short">
			  <form method="GET" action="" id="shorter">
             	
                <div class="leftShorter">
                	<div class="select_box">
                    	<label>Status :</label>
                        <select name="status" class="sort status">
                            <option value="">Semua Status</option>
                            <option value="1" <?php if ($this->_tpl_vars['status'] == 1): ?>selected<?php endif; ?> >Active</option>
                            <option value="2"  <?php if ($this->_tpl_vars['status'] == 2): ?>selected<?php endif; ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="select_box">
                    	<label>Challange :</label>
                        <select name="category" class="sort category">
                            <option value="">Semua Challenge</option>
                            <option value="1" <?php if ($this->_tpl_vars['category'] == 1): ?>selected<?php endif; ?>>Games</option>
                            <option value="2" <?php if ($this->_tpl_vars['category'] == 2): ?>selected<?php endif; ?>>Twitter</option>
			    
                        </select>
                    </div>
                   
                </div><!--end.row-->
             	<div class="rightShorter">
                     <div class="" id="datePick">
                        <span class="fl">Tanggal :</span>
                        <div class="inputDate fl">
                            <input type="text" value="<?php echo $this->_tpl_vars['startdate']; ?>
" name="startdate" class="datepicker submitter startdate " id="dp1403509217274">
                        </div><!-- /.rows -->
                        
                        <span class="fl">Sampai</span>
                        <div class="inputDate fl">
                            <input type="text"  value="<?php echo $this->_tpl_vars['enddate']; ?>
" name="enddate" class="datepicker enddate " id="dp1403509217275">
                        </div><!-- /.rows -->
                    </div>
                    <div id="searchPick">
                    <span class="fl">Cari :</span>
                    <input type='text' name='search' value="<?php echo $this->_tpl_vars['search']; ?>
"  class='selectEvent fl search' style="width:150px" placeholder="challenge/description">
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
					<th class="head0">Nama Challenge</th> 
					<th class="head0">Deskripsi Challenge</th> 
					<th class="head0">Tanggal Mulai</th> 
					<th class="head0">Tanggal Berakhir </th> 
					<th class="head0">Jenis Challenge</th> 
					<!--<th class="head0">Nama Chapter</th>-->
					<th class="head0">Tanggal Dibuat</th>
					<th class="head0">Status</th> 
					<th class="head0">Action</th> 
					
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
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['namess']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['description']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['start_time']; ?>
</td>
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['end_time']; ?>
</td>					
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name_category']; ?>
</td>
					<!--<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name_chapter']; ?>
</td>-->
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['create_challange']; ?>
</td>					
					<td><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 1): ?>Actived<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 0): ?>Inactived<?php else: ?>Finished<?php endif; ?></td>
					<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 0): ?>
						<td><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Active</a> | 						
						<a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> |
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement/editchallange/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a></td>
						<?php else: ?>
						<td style="display:none"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement/editchallange/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a></td>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 1): ?>
						<td><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramfinish=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Finish</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paraminactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Inactive</a> | <a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement/editchallange/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a></td>
						<?php else: ?>
						<td style="display:none"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement/editchallange/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a></td>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 3): ?>
						<td> </td>
						<?php else: ?>
						<td style="display:none"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> | <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
challangemanagement/editchallange/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a></td>
					<?php endif; ?>
					
					
					
					</tr>
					<?php endfor; endif; ?>	
			</tbody>
			</table>
            <div id="paging_of_challange_list" class="paging">
            
            </div>
        </div><!-- end .chapter -->
    </div><!-- end #container -->
</div><!-- end #home -->

<script type="text/javascript">
	getpaging(0,<?php echo $this->_tpl_vars['total']; ?>
,"paging_of_challange_list","paging_ajax_challange",10);
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
                        \'url\': basedomain+\'challangemanagement/checkit\',
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
										\'url\': basedomain+\'challangemanagement/incheckit\',
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
                        \'url\': basedomain+\'challangemanagement/incheckit\',
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