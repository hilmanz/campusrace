<?php /* Smarty version 2.6.13, created on 2016-03-22 10:03:19
         compiled from application/admin//apps/editpuzzle.html */ ?>
<div class="page_section" id="project-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-books">&nbsp;</span>Edit Puzzle</h2>
            <h2 class="fr"><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
puzzlemanagement" class="button2">Back</a></h2>
        </div><!-- end .titlebox -->
        <div class="content">

            <form id="forms" class="forms" method="post" action="<?php echo $this->_tpl_vars['basedomain']; ?>
puzzlemanagement/editpuzzle" enctype="multipart/form-data">

            <div id="new-project" class="boxcontent">
			
			<div class="row">
				<label for="Date">Gambar besar Puzzle :<br></label>
				<img src="http://<?php echo $this->_tpl_vars['basedomainpath']; ?>
/public_html/public_assets/puzzle/<?php echo $this->_tpl_vars['listpuzzle']['gbr_besar']; ?>
">
				<i> *ukuran File 500 x 333 pixel </i>							
			</div><!-- end .row -->
           
			<div class="row">
				<label for="Date">Upload Gambar besar Puzzle :<br></label>
				<input name="big_img" id="big_img"  type="file" class="required big_img"  style="width: 200px;">
				<i> *ukuran File 500 x 333 pixel </i><br>
				<label class="events_erorr error_red"><font color="red"><?php echo $this->_tpl_vars['big_img_no']; ?>
</font></label>
			</div><!-- end .row -->
			
			<div class="row">
				<label for="Date">Gambar kecil Puzzle :<br></label>
				<img src="http://<?php echo $this->_tpl_vars['basedomainpath']; ?>
/public_html/public_assets/puzzle/<?php echo $this->_tpl_vars['listpuzzle']['gbr_kecil']; ?>
">
				<i> *ukuran File 285 x 190 pixel</i>							
			</div><!-- end .row -->
			
			<div class="row">
				<label for="Date">Upload Gambar kecil Puzzle :<br></label>
				<input name="small_img" id="small_img"  type="file" class="required small_img"  style="width: 200px;">
				<i> *ukuran File 285 x 190 pixel</i><br>
				<label class="events_erorr error_red"><font color="red"><?php echo $this->_tpl_vars['small_img_no']; ?>
</font></label>							
			</div><!-- end .row -->
			
			<div class="row">				
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['listpuzzle']['id']; ?>
">				
			</div><!-- end .row -->
               

        <div class="row">
			<input type="submit" class="fr button3" value="Save" name="submit"  >
            <!-- <a class="fr button3 submitevent"  />	Submit	</a> -->
			<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
puzzlemanagement" class="button4 fr">Cancel</a>
        </div><!-- end .row -->

            </div><!-- end #wizard -->

			
            </form>
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->
<script>
<?php echo '
	$(\'.typeuser\').click(function()
	{

			console.log($(this).val());
			if($(this).val()==9)
			{
				$(".checkboxmenu").prop("checked", true);
				$(".checkboxmenu").attr("disabled", true);
			}
			else {
				$(".checkboxmenu").prop("checked", false);
				$(".checkboxmenu").removeAttr("disabled");
				}
	});
	/**$(\'.submitsave\').click(function()
		{
			console.log(\'asa\');return false;
			var name_no=\'.name_no\';
			$(name_no).html(\' \');
			var mailformat = /^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$/;
			var email_no=".email_no";
			$(email_no).html(\' \');
			var username_no=\'.username_no\';
			$(username_no).html(\' \');
			var password=\'.password_no\';
			$(password_no).html(\' \');
			var checkboxmenu=\'.checkboxmenu_no\';
			$(checkboxmenu_no).html(\' \');
			var valid=\'\';
			if($(\'.checkboxmenu:checked\').length ==0)
				{

					$(subcategory_no).html(\'You cannot leave this field empty\');
					valid=\'ada\';
				}
			if($(\'.name\').val()==\'\')
			{
				$(name_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.username\').val()==\'\')
			{
				$(username_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.password\').val()==\'\')
			{
				$(password_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			if($(\'.email\').val()==\'\')
			{
				$(email_no).html(\'You cannot leave this field empty\');
				valid=\'ada\';
			}
			else if(!$(\'.email\').val().match(mailformat))
			{
				$(email_no).html(\'format email salah\');
				valid=\'ada\';
			}
			if(valid)
			{
				return false;

			}
			else
			{
				$(\'input[type="submit"]\').attr(\'disabled\',\'disabled\');

			}
		}**/

	$(document).on(\'click\',\'.submitevent\',function(){
		$(\'.name_erorr\').html(\'\');
		$(\'.email_erorr\').html(\'\');
		$(\'.ktp_sim_erorr\').html(\'\');
		$(\'.alamat_erorr\').html(\'\');
		$(\'.fb_id_erorr\').html(\'\');
		$(\'.twitter_id_erorr\').html(\'\');
		$(\'.date_register_erorr\').html(\'\');
		$(\'.chapter_id_erorr\').html(\'\');
		$(\'.emailmember_erorr\').html(\'\');
		$(\'.no_telp_erorr\').html(\'\');

		var valid=\'\';


		if($(\'.emailMember\').val()==\'\')
		{
			$(\'.emailmember_erorr\').html(\'kolom ini harus di isi\');
			 valid=\'ada\';
		}

		var valid=\'\';
		if($(\'.name\').val()==\'\')
		{
			$(\'.name_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.email\').val()==\'\')
		{
			$(\'.email_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.ktp_sim\').val()==\'\')
		{
			$(\'.ktp_sim_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}

		if($(\'.alamat\').val()==\'\')
		{
			$(\'.alamat_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.fb_id\').val()==\'\')
		{
			$(\'.fb_id_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.twitter_id\').val()==\'\')
		{
			$(\'.twitter_id_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.date_register\').val()==\'\')
		{
			$(\'.date_register_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.chapter_id\').val()==\'\')
		{
			$(\'.chapter_id_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}
		if($(\'.no_telp\').val()==\'\')
		{
			$(\'.no_telp_erorr\').html(\'kolom ini harus di isi\');
			valid=\'ada\';
		}


		if(valid)
		{
			return false;
		}
		else
		{

		vlidemail(valid)





		}

	})

	function vlidemail(valid)
	{
	var valid= valid;
	emailsplit = $(\'.emailMember\').val().split(\',\');
	emailformat=\'\';
	var emailSame=\'\';
	var ix=0;
	var mailformat = /^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,15})+$/;
	if(emailformat==\'\' && emailSame==\'\')
		{
			if(emailsplit.length > 20 )
			{
				$(\'.emailmember_erorr\').html(\'Maximal 20 Email Member\');
				 valid=\'ada\';

			}
		}
		//console.log(emailsplit);
		$.each(emailsplit,function(ind,value)
		{
			mailnya = value.trim();

			if(!mailnya.match(mailformat))
			{
			console.log(\'masuksini salah format\');
				$(\'.emailmember_erorr\').html(\' format email salah (e.g. example@gmail.com)\');

				valid=\'ada\';
				emailformat=\'ada\';
				//console.log(mailnya);
			}
			else
			{

				$.ajax ({
					type	 : \'POST\',
					url	 :  basedomain+\'membermanagement/checkEmail\' ,
					data:{email:mailnya},
					dataType:\'json\',
					success	: function (result)
						{
							++ix;

							if(result.status==1)
							{
								//console.log(emailSame);
								if(emailSame==\'\')
								{
									emailSame +=result.email;

								}
								else
								{
									emailSame +=\',\'+result.email;
								}
								if(emailSame)
									{
										$(\'.emailmember_erorr\').html(\'email <span class="emailsama" > \'+emailSame+\'</span> sudah terdaftar\');
										valid=\'ada\';

									}
							}
							//console.log(valid);
							if(emailsplit.length==ix)
							{
								if(valid)
								{
									console.log(\'masuk dah\');
									return false;
									end;
								}else{
									 $(\'.submitnya\').trigger(\'click\');
								}

							}
						}
				});

			}
		});
		if(valid)
		{
			return false;
		}
		return false;



}
'; ?>

</script>