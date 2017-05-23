<?php /* Smarty version 2.6.13, created on 2016-03-21 13:49:54
         compiled from application/admin//apps/listskor.html */ ?>
<script>
<?php echo '
//UNTUK DOWNLOAD XLS
		$(document).ready(function(){
			$(".unduhxls2").on("click", function(){
				
				//console.log(\'masuk\');
				var status=$(\'.status option:selected\').val();
				var category=$(\'.category option:selected\').val();
				var startdate=$(\'.startdate\').val();
				var enddate=$(\'.enddate\').val();
				var search=$(\'.search\').val();
				
				location.href = basedomain+"eventmanagement?download=report&status="+status+"&category="+category+"&startdate="+startdate+"&enddate="+enddate+"&search="+search+"";
			});
		});

$(document).on(\'click\',\'.avatarnya\',function(){

	console.log($(this).attr(\'src\'));
	$gambarnya= $(this).attr(\'src\');
	console.log($(\'.gmbrpopup\'));
	$(\'.gmbrpopup\').attr(\'src\',$gambarnya);
})

$(document).on(\'click\',\'.idinput\',function(){

	$idnya= $(this).attr(\'idnya\');
	$chapteridnya= $(this).attr(\'chapteridnya\');
	$memberidnya= $(this).attr(\'memberidnya\');
	$weekidnya= $(this).attr(\'weekidnya\');
	$skor1=$(\'#skor1nya\').val();
	$skor2=$(\'#skor2nya\').val();
	$skor3=$(\'#skor3nya\').val();
	$skor4=$(\'#skor4nya\').val();
	$skor5=$(\'#skor5nya\').val();
	$skor6=$(\'#skor6nya\').val();


	$(\'.idchapter\').val($idnya);
	$(\'.memberidnya\').val($memberidnya);
	$(\'.chapteridnya\').val($chapteridnya);
	$(\'.weekidnya\').val($weekidnya);
	$(\'.skor1nya\').val($skor1);
	$(\'.skor2nya\').val($skor2);
	$(\'.skor3nya\').val($skor3);
	$(\'.skor4nya\').val($skor4);
	$(\'.skor5nya\').val($skor5);
	$(\'.skor6nya\').val($skor6);
	/*
	 $.ajax({
                        \'type\': \'POST\',
                        \'url\': basedomain+\'tebakskormanagement/statuspoints\',
                        \'data\': {idnya:idnya,pointnya:pointnya},
						\'dataType\':\'json\',
                        \'success\': function(result){
						//alert("sukses")
						}
						
						});
	*/
})
'; ?>

</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/admin/widgets/popup-images.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/admin/widgets/popup-tebakskorid.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-users">&nbsp;</span>List Tebak Skor</h2>
            <!--<h2 class="fr"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
eventmanagement/addevent" class="button2">Tambah Baru</a></h2>-->
            <!-- <h2 class="fr"><a href="#" class="button2 unduhxls2">Unduh XLS</a></h2>-->
        </div><!-- end .titlebox -->
        <div class="content event">
        	<div class="summary">
       		 <div class="short">
			  <form method="POST" action="" id="shorter">             	
             	<div class="skorShorter">
                     <div class="skorEach" id="">
                        <span class="fl">Club 1 </span>
                        <div class="skorRow fl">
                            <input type="text" value="<?php echo $this->_tpl_vars['skor1']; ?>
" name="skor1" class="skorInput" id="skor1nya">
                        </div><!-- /.rows -->
                        
                        <span class="fl">Vs Club 2</span>
                        <div class="skorRow fl">
                            <input type="text"  value="<?php echo $this->_tpl_vars['skor2']; ?>
" name="skor2" class="skorInput" id="skor2nya">
                        </div><!-- /.rows -->
                    </div>

                    <div class="skorEach" id="">
                        <span class="fl">Club 3 </span>
                        <div class="skorRow fl">
                            <input type="text" value="<?php echo $this->_tpl_vars['skor3']; ?>
" name="skor3" class="skorInput" id="skor3nya">
                        </div><!-- /.rows -->
                        
                        <span class="fl">Vs  Club 4 </span>
                        <div class="skorRow fl">
                            <input type="text"  value="<?php echo $this->_tpl_vars['skor4']; ?>
" name="skor4" class="skorInput" id="skor4nya">
                        </div><!-- /.rows -->
                    </div>

                    <div class="skorEach" id="">
                        <span class="fl">Club 5 </span>
                        <div class="skorRow fl">
                            <input type="text" value="<?php echo $this->_tpl_vars['skor5']; ?>
" name="skor5" class="skorInput" id="skor5nya">
                        </div><!-- /.rows -->
                        
                        <span class="fl">Vs Club 6 </span>
                        <div class="skorRow fl">
                            <input type="text"  value="<?php echo $this->_tpl_vars['skor6']; ?>
" name="skor6" class="skorInput" id="skor6nya">
                        </div><!-- /.rows -->
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
							<input type="hidden"  value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['week_id']; ?>
" name="weekid" >
						<?php endfor; endif; ?>
                        <input type="submit" class="button2" name="submit" style="margin-top:0px; margin-bottom: 0; margin-left: 20px;" value="Go">
                    </div>

                   
					</form>	
           		</div><!--end.row-->
				</div>
            </div><!-- end .summary -->
       
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead>
				<tr>
				
					<th class="head0">No</th>
					<th class="head0">Nama Member</th> 					
					<!--<th class="head0">Nama Chapter</th>					-->
					<th class="head0"><?php echo $this->_tpl_vars['pertandingan']['club1']; ?>
 vs <?php echo $this->_tpl_vars['pertandingan']['club2']; ?>
</th>					
					<th class="head0"><?php echo $this->_tpl_vars['pertandingan']['club3']; ?>
 vs <?php echo $this->_tpl_vars['pertandingan']['club4']; ?>
</th>					
					<th class="head0"><?php echo $this->_tpl_vars['pertandingan']['club5']; ?>
 vs <?php echo $this->_tpl_vars['pertandingan']['club6']; ?>
</th>												
					<th class="head0" >Tanggal Submit</th> 					
					<th class="head0">Insert Point</th> 				
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
						<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['membername']; ?>
</td>
						<!--<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name_chapter']; ?>
</td>-->
						<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor1'] == '' && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor2'] == ''): ?>
						<td class="center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor1']; ?>
 - <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor2']; ?>
</td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor1'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor1'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor2'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor2']): ?>
						<td class="center"><span class="trueA icon-checkmark">&nbsp;</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor1'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor1'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor2'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor2']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor1'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor1'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor2'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor2']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor1'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor1'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor2'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor2']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php else: ?>
						<td class="center">Tidak Terdaftar</td>
						<?php endif; ?>
						
						<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor3'] == '' && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor4'] == ''): ?>
						<td class="center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor3']; ?>
 - <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor4']; ?>
</td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor3'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor3'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor4'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor4']): ?>
						<td class="center"><span class="trueA icon-checkmark">&nbsp;</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor3'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor3'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor4'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor4']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor3'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor3'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor4'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor4']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor3'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor3'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor4'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor4']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php else: ?>
						<td class="center">Tidak Terdaftar</td>
						<?php endif; ?>
						
						<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor5'] == '' && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor6'] == ''): ?>
						<td class="center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor5']; ?>
 - <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor6']; ?>
</td>	
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor5'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor5'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor6'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor6']): ?>
						<td class="center"><span class="trueA icon-checkmark">&nbsp;</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor5'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor5'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor6'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor6']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor5'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor5'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor6'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor6']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor5'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor5'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor6'] != $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor6']): ?>
						<td class="center"><span class="wrongA">X</span></td>
						<?php else: ?>
						<td class="center">Tidak Terdaftar</td>
						<?php endif; ?>						
						<td><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['created']; ?>
</td>
						
						<td>
							<?php if (( $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor1'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor1'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor2'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor2'] ) && ( $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor3'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor3'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor4'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor4'] ) && ( $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor5'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor5'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['sekor6'] == $this->_tpl_vars['list'][$this->_sections['i']['index']]['skor6'] )): ?>
								<a href="#popup-eventbig" class="showPopup"><input type="submit" class="button2 idinput" style="margin-top:0px;" value="Insert" idnya="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" weekidnya="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['week_id']; ?>
" chapteridnya="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['chapter_id']; ?>
" memberidnya="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['member_id']; ?>
"></a>
							<?php endif; ?>
						 </td>
						
						 <!-- <td>
							<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['name_type'] == 'Supersoccer' && $this->_tpl_vars['list'][$this->_sections['i']['index']]['stat'] == '1'): ?>
								<a href="#popup-eventbig" class="showPopup"><input type="submit" class="button2 idinput" style="margin-top:0px;" value="Insert" idnya="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" chapteridnya="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['chapter_id']; ?>
"></a>
							<?php endif; ?>
						 </td> -->					
					</tr>					
				<?php endfor; endif; ?>				
			</tbody>
			</table>
			
            <!-- <div id="paging_of_event_list" class="paging"> -->
            
            </div>
			
		
        </div><!-- end .event -->
    </div><!-- end #container -->
</div><!-- end #home -->


<script type="text/javascript">
	getpaging(0,<?php echo $this->_tpl_vars['total']; ?>
,"paging_of_event_list","paging_ajax_event",10);
</script>

<script>
<?php echo '
function paging_ajax_event(fungsi,start){ 
var status=$(\'.status option:selected\').val();		
var startdate=$(\'.startdate\').val();
var enddate=$(\'.enddate\').val();	
var listchapter=$(\'.listchapter option:selected\').val();	
var search=$(\'.search\').val();	
var category=$(\'.category option:selected\').val();	
var kota=$(\'.kota option:selected\').val();
				
	$.post(basedomain+"eventmanagement/pagingevent",{\'start\':start,\'ajax\':1,\'status\':status,\'startdate\':startdate,\'enddate\':enddate,\'category\':category,\'search\':search,\'listchapter\':listchapter},function(response){
	
		if(response){
			  if(response.status==true){
				var str="";
			
				$.each(response.data,function(k,v){
		
						str+=\'<tr>\';
						str+=\'<td>\'+v.no+\'</td>\';
						str+=\'<td>\'+v.names+\'</td>\';
						str+=\'<td>\'+v.name_type+\'</td>\';
						str+=\'<td>\'+v.time_start+\'</td>\';
						str+=\'<td>\'+v.time_end+\'</td>\';
						str+=\'<td>\'+v.alamat+\'</td>\';
						str+=\'<td>\';
						if(v.upload_foto!=0){
						$.each(v.upload_foto,function(kk,vv){
							str+=\'<a href="#popup-imgbig" class="showPopup">\';
							if(vv.name)
							{
							str+=\'<img src="\'+basedomainpath+\'public_assets/uploadfoto/\'+vv.name+\'" class="avatarnya" width="40" height="40"></a>\';
							}
						});
						}
						str+=\'</td>\';
						if(v.name_chapter)
						{
						str+=\'<td>\'+v.name_chapter+\'</td>\';
						}else{
						str+=\'<td></td>\';
						}
						str+=\'<td>\'+v.date_create+\'</td>\';
						/**str+=\'<td>\'+v.jumlahundangan+\'</td>\';**/	
						str+=\'<td>\'+v.poin+\'</td>\';	
						str+=\'<td>\'
						
						if (v.stat==1){str+=\'Approved\';}else if(v.stat==0){str+=\'Inactived\';}else if(v.stat==3){str+=\'Finished\';}else if(v.stat==4){str+=\'Rejected\';}str+=\'</td>\';
						if(v.stat==0){
							str+=\'<td><a href="\'+basedomain+\'eventmanagement?paramactive=\'+v.id+\'" style="color:#19CFA8;">Approve</a> | <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'eventmanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;">Delete</a> | <a href="\'+basedomain+\'eventmanagement/editevent/\'+v.id+\'" style="color:#19CFA8;">Edit</a></td>\';
						}	
						else if(v.stat==\'1\' && v.name_type==\'Supersoccer\'){
                                                        str+=\'<td>   <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'eventmanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;">Delete</a> | <a href="\'+basedomain+\'eventmanagement/editevent/\'+v.id+\'" style="color:#19CFA8;">Edit</a></td>\';
                                                }
						else if(v.stat==1){
							str+=\'<td>   <a href="javascript:void(0)" onClick="confirmation(\\\'\'+basedomain+\'eventmanagement?paramcancel=\'+v.id+\'\\\',\\\'Confirm to Delete?\\\')" style="color:#19CFA8;">Delete</a> | <a href="\'+basedomain+\'eventmanagement/editevent/\'+v.id+\'" style="color:#19CFA8;">Edit</a>\';  
							if(v.upload_foto!=0){
							str+=\' | <a href="\'+basedomain+\'eventmanagement?paramfinish=\'+v.id+\'&&idchapter=\'+v.chapter_id+\'" style="color:#19CFA8;">Finish</a>\';
							}
							str+=\'</td>\';
						}
						else if(v.stat==3){
							str+=\'<td></td>\';
						}
						else if(v.stat==4){
                                                        str+=\'<td></td>\';
                                                }
						
						/**str+=\'<td><a href="\'+basedomain+\'eventmanagement?paramactive=\'+v.id+\'" style="color:#19CFA8;">Approve</a>   <a href="\'+basedomain+\'eventmanagement?paramcancel=\'+v.id+\'" style="color:#19CFA8;">Delete</a>  <a href="\'+basedomain+\'eventmanagement/editevent/\'+v.id+\'" style="color:#19CFA8;">Edit</a>\';
						if(v.name_type!=\'Supper Soccer\')
						{
						str+=\' <a href="\'+basedomain+\'eventmanagement?paramfinish=\'+v.id+\'&&idchapter=\'+v.chapter_id+\'&&pointnya=\'+v.point+\'" style="color:#19CFA8;">Finish</a>\';
						}
						str+=\'</td>\'**/
						
						<!-- if(v.name_type==\'Supersoccer\' && v.stat==\'1\') -->
						if (v.sekor1==v.skor1 && v.sekor2==v.skor2)&&(v.sekor3==v.skor1 && v.sekor4==v.skor2)&&(v.sekor5==v.skor1 && v.sekor6==v.skor2)
						{
						str+=\'<td><a href="#popup-eventbig" class="showPopup"><input type="submit" class="button2 idinput" style="margin-top:0px;" value="Insert" idnya="\'+v.id+\'" chapteridnya="\'+v.chapter_id+\'"></a></td>\';						
						}else{
						str+=\'<td></td>\';
						}
						str+=\'</tr>\';
						
						});
						$(\'.pagilist\').html(str);
						$(\'.showPopup\').magnificPopup({
							type:\'inline\',
							midClick: true 
						});
						
						
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
                        \'url\': basedomain+\'eventmanagement/checkit\',
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
										\'url\': basedomain+\'eventmanagement/incheckit\',
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
                        \'url\': basedomain+\'eventmanagement/incheckit\',
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