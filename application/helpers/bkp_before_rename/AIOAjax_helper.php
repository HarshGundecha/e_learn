<?php
// latest version 28-02-2018
//*
	function AIOAjax()
	{
		return "
			function AIOAjax(ajaxUrl, actionType, ajaxDataContainer=false, ajaxOPType=false, ajaxOPID=false)
			{
				//ajaxOPType=[1|2|3] (1=datatable, 2=container, 3=nothing/no output no ajaxOPID)
				var isImageUpload=$(ajaxDataContainer+' input[type=\'file\']').length;
				formData=isImageUpload==true?new FormData($(ajaxDataContainer)[0]):$(ajaxDataContainer).serialize();
				//alert(isImageUpload);
		    $.ajax({
		      url: 					'".site_url('/')."'+ajaxUrl,
		      data: 				formData,
		      type: 				'POST',
		      cache:				isImageUpload==1?false:true,				//default true
		      contentType: 	isImageUpload==1?false:'application/x-www-form-urlencoded',
		      								//default application/x-www-form-urlencoded
		      processData: 	isImageUpload==1?false:true,	//default true
		      success: 			function(result)
		      {
		      	if(ajaxOPType==1 && (actionType==1 || actionType==3 || actionType==5))
		      	{
		      		//alert('choida');
							var Jresult = JSON.parse(result);
			        //alert(JSON.stringify(Jresult));
		        	if(Jresult.status==true)
		        	{
			        	$('#pageAlert')
			        		.html(Jresult.message)
										.parent()
				        			.css('display','block');
		        		if(actionType==1)
		        		{
									$(ajaxOPID).DataTable().ajax.reload(null, false);
									$('#addModal form')[0].reset();
									$('.alert button.close').trigger('click');
									$('#addModal').modal('toggle');
		        		}
		        		else if(actionType==3)
		        		{
									$(ajaxOPID).DataTable().ajax.reload(null, false);
									$('#updateModal form')[0].reset();
									$('.alert button.close').trigger('click');
									$('#updateModal').modal('toggle');
		        		}
		        		else if(actionType==5)
		        		{
									$(ajaxOPID).DataTable().ajax.reload(null, false);
		        		}
		        	}
		        	else if(Jresult.status==false)
		        	{
		        		if(actionType==1)
		        		{
				        	$('#formAddAlert')
				        		.html(Jresult.message)
											.parent()
					        			.css('display','block');
		        		}
		        		else if(actionType==3)
		        		{
				        	$('#formUpdateAlert')
				        		.html(Jresult.message)
											.parent()
					        			.css('display','block');
		        		}
		        	}
		      	}
		      	else if(ajaxOPType==2)
		      	{
							$(ajaxOPID).html(result);
	      			if(actionType==2)
	        		{
								$('#updateModal').modal('toggle');
	        		}
	      			if(actionType==4)
	        		{
								$('#infoModal').modal('toggle');
	        		}
		      	}
		      },
		      error: function(xhr)
		      {
		        alert('An error occured: ' + xhr.status + ' ' + xhr.statusText);
		      }
		    });
			}
		";
	}

/*/function AIOAjax()
	{
		return "
			function AIOAjax(ajaxUrl, ajaxDataContainer, ajaxOPType, ajaxOPID, isImageUpload=false)
			{
				//type=[1,2,3] (1=datatable, 2=container, 3=nothing/no output no ajaxOPID)
				formData=isImageUpload==true?new FormData($(ajaxDataContainer)[0]):$(ajaxDataContainer).serialize();
		    $.ajax({
		      url: ajaxUrl,
		      data: formData,
		      type: 'POST',
		      cache:isImageUpload==true?false:true,				//default true
		      contentType: isImageUpload==true?false:'application/x-www-form-urlencoded',
		      //default application/x-www-form-urlencoded
		      processData: isImageUpload==true?false:true,	//default true
		      success: function(result)
		      {
		      	if(ajaxOPType==1)
		      	{
			        $(ajaxOPID).DataTable().ajax.reload(null, false);
		      	}
		      	else if(ajaxOPType==2)
		      	{
							$(ajaxOPID).html(result);
		      	}
		      },
		      error: function(xhr)
		      {
		        alert('An error occured: ' + xhr.status + ' ' + xhr.statusText);
		      }
		    });
			}
		";
	}*/
?>