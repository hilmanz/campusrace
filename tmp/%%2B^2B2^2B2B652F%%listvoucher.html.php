<?php /* Smarty version 2.6.13, created on 2016-03-21 17:11:23
         compiled from application/admin//apps/listvoucher.html */ ?>
<script>
<?php echo '
	//UNTUK DOWNLOAD XLS
		$(document).ready(function(){
			$(".unduhxls").on("click", function(){
				
				var chapternya=$(\'.chapternya option:selected\').val();
				var status=$(\'.status option:selected\').val();
				var points=$(\'.points option:selected\').val();
				var startdate=$(\'.startdate\').val();
				var enddate=$(\'.enddate\').val();
				var searchname=$(\'.searchname\').val();
				
				location.href = basedomain+"Vouchermanagement?download=report&chapternya="+chapternya+"&status="+status+"&points="+points+"&startdate="+startdate+"&enddate="+enddate+"&search="+searchname+"";
			});
		});
		



	
'; ?>

	</script>
	
<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-users">&nbsp;</span>List Voucher</h2>
			<!--<h2 class="fr"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement/addVoucher" class="button2">Tambah Baru</a></h2>-->
			<h2 class="fr"><a  href="<?php echo $this->_tpl_vars['basedomain']; ?>
vouchermanagement/addvoucher" class="button2">Tambah voucher</a></h2>
             
        </div><!-- end .titlebox -->
        <div class="content chapter">
        	<div class="summary">
       		 <div class="short">
			  <form method="GET" action="" id="shorter">
             	<div class="leftShorter">
				
                	<div class="select_box">
                    	<label>Sort by Status :</label>
                        <select name="status" class="sort status">
                            <option value="">Semua Status</option>
                            <option value="1"  <?php if ($this->_tpl_vars['status'] == 1): ?>selected<?php endif; ?>>Actived</option>
                            <option value="2"  <?php if ($this->_tpl_vars['status'] == 2): ?>selected<?php endif; ?>>Inactived</option>
			    <option value="3"  <?php if ($this->_tpl_vars['status'] == 3): ?>selected<?php endif; ?>>Deleted</option>
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
                                    <input type="text"  value="<?php echo $this->_tpl_vars['enddate']; ?>
" name="enddate" class="datepicker enddate " id="dp1403509217275">
                                </div><!-- /.rows -->
                                
                        </div>
						<div id="searchPick">
						<span class="fl">Cari :</span>
						<input type='text' name='search' value="<?php echo $this->_tpl_vars['search']; ?>
" class='selectEvent fl searchname' style="width:150px" placeholder="kode voucher">
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
					<th class="head0">Kode Voucher</th> 													
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
					<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['voucer']; ?>
</td>												
					<td><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 1): ?>Actived<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 0): ?>Inactived<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 2): ?>Deleted<?php else: ?>Gagal<?php endif; ?></td>
					<td>
						<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 0): ?>
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement?paramactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Active</a> |                     
						<a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> |
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement/editVoucher/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['n_status'] == 1): ?>
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement?paraminactive=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Inactive</a> |                     
						<a href="javascript:void(0)" onClick="confirmation('<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement?paramcancel=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
','Confirm to Delete?')" style="color:#19CFA8;">Hapus</a> |
						<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
Vouchermanagement/editVoucher/<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="color:#19CFA8;">Edit</a>
						<?php endif; ?>
					</td>
					</tr>
					<?php endfor; endif; ?>	
			</tbody>
			</table>
			<div id="paging_of_chapter_list" class="paging">
            
            </div>
        </div><!-- end .chapter -->
    </div><!-- end #container -->
</div><!-- end #home -->

<script type="text/javascript">
	getpaging(0,<?php echo $this->_tpl_vars['total']; ?>
,"paging_of_chapter_list","paging_ajax_voucher",10);
</script>


<script>
<?php echo '
//select bootstarp

function paging_ajax_voucher(fungsi,start){

	
	var startdate=$(\'.startdate\').val();
	var enddate=$(\'.enddate\').val();	
	var search=$(\'.search\').val();	
	var status=$(\'.status option:selected\').val();

				
	$.post(basedomain+"vouchermanagement/pagingvoucher",{\'startdate\':startdate,\'enddate\':enddate,\'search\':search,\'status\':status,\'start\':start,ajax:1},function(response){
	
		if(response){
			  if(response.status==true){
				var str="";
				$.each(response.data,function(k,v){
					console.log(response.data);
					str+=\'<tr>\';
					str+=\'<td>\'+v.no+\'</td>\';					
					str+=\'<td>\'+v.voucer+\'</td>\';													
					str+=\'<td>\'
					if (v.n_status==1){str+=\'Actived\';}else if(v.n_status==0){str+=\'Inactived\';}else if(v.n_status==2){str+=\'Deleted\';}else{str+=\'Gagal\';}str+=\'</td>\';
					//str+=\'<td><a href="\'+basedomain+\'Vouchermanagement?paramactive=\'+v.id+\'" style="color:#19CFA8;">Active</a>|<a href="\'+basedomain+\'chapter?paraminactive=\'+v.id+\'" style="color:#19CFA8;">Inactive</a>|<a href="\'+basedomain+\'chapter?paramcancel=\'+v.id+\'" style="color:#19CFA8;">Cancel</a></td>\';					
					str+=\'<td>\'
			
					if (v.n_status==1){str+=\'<a href="\'+basedomain+\'Vouchermanagement?paraminactive=\'+v.id+\'" style="color:#19CFA8;">Inactive</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'Vouchermanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;"> Delete</a> | <a href="\'+basedomain+\'Vouchermanagement/editVoucher/\'+v.id+\'" style="color:#19CFA8;">Edit</a>\'}
					else if(v.n_status==0){str+=\'<a href="\'+basedomain+\'Vouchermanagement?paramactive=\'+v.id+\'" style="color:#19CFA8;">Active</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'Vouchermanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;"> Delete</a> | <a href="\'+basedomain+\'Vouchermanagement/editVoucher/\'+v.id+\'" style="color:#19CFA8;">Edit</a>\'}str+=\'</td>\';
					
					str+=\'</tr>\';
						
				});
				console.error;
				$(\'.pagilist\').html(str);
				likeunlike();	
					
			}
		}
	},"JSON");
}

$(\'.selectpicker\').selectpicker();
likeunlike();

function likeunlike(){

$(document).ready(function(){
			$(".checkactive").on("click", function(){
			var idnya=$(this).val();
			var thisnya=$(this);
					  $.ajax({
                        \'type\': \'POST\',
                        \'url\': basedomain+\'Vouchermanagement/checkit\',
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
										\'url\': basedomain+\'Vouchermanagement/incheckit\',
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
                        \'url\': basedomain+\'Vouchermanagement/incheckit\',
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
