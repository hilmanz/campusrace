   

function listofuserviews(data){
	var html ="";

	$.each(data,function(k,v){
	 
		html+='<tr>';
			html+='<th>'+v.name+' '+v.last_name+'</th>';
			html+='<th>'+v.email+'</th>';
			html+='<th>'+v.pagename+'</th>';
			 html+='<th><a class="Btn icon-update" href="'+basedomain+'administrator/edit/'+v.id+'" ></a></th>';
			html+='<th><a class="Btn icon-delete" href="'+basedomain+'administrator/unusers/'+v.id+'" ></a></th>';
		html+='</tr>';
	});
	return html;
}	
 

function monthconverter(i){
	var i  = parseInt(i,10);
	var month=new Array();
	month[1]="January";
	month[2]="February";
	month[3]="March";
	month[4]="April";
	month[5]="May";
	month[6]="June";
	month[7]="July";
	month[8]="August";
	month[9]="September";
	month[10]="October";
	month[11]="November";
	month[12]="December";
return month[i];

}

function post_json(data){
	var response = jQuery.ajax({
                    type: "POST",
                    url: data.url,
                    data: data.params,
                    dataType: data.type
	            });
	return response;
}
 
 /* paging entourage report */ 
function paging_entourage_report(fungsi,start){
	var uid = $(".uid").val();
	var brandid = $(".brandid").val();
	var n_status = $(".n_status").val();
	var areaid = $(".areaid").val();
	var startdate = $(".startdate").val();
	var enddate = $(".enddate").val();
	$.get(basedomain+"home/ajaxPaging",{start:start,ajax:1,uid:uid,brandid:brandid,n_status:n_status,areaid:areaid,startdate:startdate,enddate:enddate},function(response){
		if(response){
			  if(response.status==1){
		var no = start+1;
		var str="";
		$.each(response.data.result,function(k,v){ 
			str+='<tr>';
				str+='<td class="center">'+no+'</td>'; 
                  	str+='<td>'+v.register_date+'</td>'; 
					str+='<td>'+v.name+'</td>';
					str+='<td>'+v.email+'</td>';
					str+='<td>'+v.phone_number+'</td>'; 
					if (v.facebookID==null){
							str+='<td> - </td>'; 
						}else{
							str+='<td>'+v.facebookID+'</td>'; 
						}
					str+='<td>'+v.twitterID+'</td>';
					if(v.instagramID==null){
						str+='<td> - </td>'; 
					}else{
						str+='<td>'+v.instagramID+'</td>'; 
					} 
				
					str+='<td>';
						if (v.images==null){
							str+='<img height="55px" width="55px" src="'+basedomainpath+'public_assets/contests/default.jpg" />';
						
						}else{
                        	str+='<a href="javascript:void(0)" class="showPopup arkPopupImages" call="'+basedomainpath+'public_assets/contests/'+v.images+'">';
							str+='<img height="55px" width="55px" src="'+basedomainpath+'public_assets/contests/'+v.images+'" />';
                           str+='</a>';
						}					
					str+='</td>';					
			str+='</tr>';
			no++;
		});
		$('.pagingenotourage').html(str);
		
	}else{
	   $('.pagingenotourage').html('<tr><td colspan="5">'+response.msg+'</td></tr>');
	 
	}
		}
	},"JSON");
}

				