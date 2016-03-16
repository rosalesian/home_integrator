 jQuery(document).ready(function(){

	var headerdatabase = [];

	$("#error-updatePass").hide();	//CONTAINER MESSAGE UPDATE PASS//
	var upload_loader = $("#upload-loader");
	var validate_loader = $("#validate-loader");

	upload_loader.hide();
	validate_loader.hide();
	var downloadlink = $("#downloadLink").hide();

	$("#searchInvoice").keyup(function(){	
		var val = $(this).val();
		if(val=='')
		{
			$("#result-container").empty().append("<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>");
		}
		else
		{
			$.ajax({
			    type: 'post',
			    url: 'searchLogByValueInvoice',
			    data: 'val='+val,
			    dataType:'json',
			    beforeSend: function()
			    {
			    	$("#norecordfound").show();
			    },
			    success: function (response)
			    {
			      console.log(response);
					if(response.status=='success') 
					{
						$("#result-container").empty();
						$("#result-container").html(response.searchResult);
					}
					else if(response.status=='fail')
					{
						$("#result-container").empty().append("<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>");
					}
			    }
		  	});
		}
	});
	$("#searchPO").keyup(function(){	
		var val = $(this).val();
		if(val=='')
		{
			$("#result-container").empty().append("<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>");
		}
		else
		{
			$.ajax({
			    type: 'post',
			    url: 'searchLogByValuePO',
			    data: 'val='+val,
			    dataType:'json',
			    beforeSend: function()
			    {
			    	$("#norecordfound").show();
			    },
			    success: function (response)
			    {
			      console.log(response);
					if(response.status=='success') 
					{
						$("#result-container").empty();
						$("#result-container").html(response.searchResult);
					}
					else if(response.status=='fail')
					{
						$("#result-container").empty().append("<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>");
					}
			    }
		  	});
		}
	});
	$("#searchIRA").keyup(function(){	
		var val = $(this).val();
		if(val=='')
		{
			$("#result-container").empty().append("<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>");
		}
		else
		{
			$.ajax({
			    type: 'post',
			    url: 'searchLogByValueIRA',
			    data: 'val='+val,
			    dataType:'json',
			    beforeSend: function()
			    {
			    	$("#norecordfound").show();
			    },
			    success: function (response)
			    {
			      console.log(response);
					if(response.status=='success') 
					{
						$("#result-container").empty();
						$("#result-container").html(response.searchResult);
					}
					else if(response.status=='fail')
					{
						$("#result-container").empty().append("<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>");
					}
			    }
		  	});
		}
	});
	$(".error-container").hide();
	$("#submit").click(function(){
		$("#stageone").removeAttr('class','custom-label-stages');
		$("#stagetwo").attr('class','custom-label-stages');
		$("#stagethree").removeAttr('class','custom-label-stages');
	});	
	$(".alternativeButton").click(function(){
		$("#stagetwo").removeAttr('class','custom-label-stages');
		$("#stageone").attr('class','custom-label-stages');
		$("#stagethree").removeAttr('class','custom-label-stages');
		$("#errorContainer").empty();
		$(".error-container").hide();
	});
	//VALIDATION CSV FORM//
	$("#csvFile").change(function(){
		$("#alternativeTextBox").val($("#csvFile").val());
		var filename = $(this).val();
		var extension = filename.replace(/^.*\./, '');
		if(extension=='csv')
		{
			$("#submit").removeAttr('disabled', true);
			$("#errorContainer").empty();
			$(".error-container").hide();
		}
		else if(extension=='xlsx' || extension=='xls')
		{
			$("#submit").attr('disabled', true);
			$(".error-container").show();
			downloadlink.hide();
			$("#errorContainer").html('<b>Invalid File.</b><br/>Change the excel file to csv format.<br/><b>Instruction:</b> <br/>1. Open the Excel File<br/>2. Click Save As<br/>3. Change the type to CSV(Comma Delimited) format<br/>4. Click Save<br/>5. Upload it again.');
		}
		else
		{
			$("#submit").attr('disabled', true);	
			$(".error-container").show();
			downloadlink.hide();
			$("#errorContainer").html('<b>Invalid File.</b>');	
		}
	});
	$("form#formValidate").submit(function(event)
	{
		var downloadlink = $("#downloadLink").hide();
		$("#remarks").html('');
 		event.preventDefault();
 		validate_loader.show();
 		$("#submit").attr('disabled', true);
 		$(".alternativeButton").attr('disabled', true);
		var formdata = new FormData(this);
			    $.ajax({
			    type: 'post',
			    url: 'validation/validate',
			    data: formdata,
			    dataType:'json',
			    success: function (response) {
			      console.log(response);

			      if(response.status=='error')
			      {
			      	$("#submit").attr('disabled', true);	
					$(".error-container").show();
					$("#alternativeTextBox").val('');
					validate_loader.hide();
					$("#submit").removeAttr('disabled', true);
					$(".alternativeButton").removeAttr('disabled', true);
					$("#errorContainer").html('<b>Invalid File</b>.<br/>File Selected does not fits with the Record type choosen.<br/>Please Follow the correct template provided.');	
			      }
			      else if(response.validateRecord=='pass')
			      {
			      		validate_loader.hide();
				      	upload_loader.show();
						$("#stageone").removeAttr('class','custom-label-stages');
						$("#stagetwo").removeAttr('class','custom-label-stages');							
						$("#stagethree").attr('class','custom-label-stages');
						$.ajax({
					    type: 'post',
					    data: 'filename='+response.filename,
					    url: 'validation/upload',
					    dataType:'json',
					    success: function (response){
						      console.log(response);
						      if(response.status=='success')
						      {
							      upload_loader.hide();
							      $("#submit").removeAttr('disabled', true);
							      $("#alternativeTextBox").val('');
								  $(".alternativeButton").removeAttr('disabled', true);		
							      $("#remarks").attr('class','alert alert-success').html('Added Successfully');
						      }
					 		 }
				     	 });
			  		}
			      else if(response.validateRecord=='fail')
			      {
			      	validate_loader.hide();
			      	$(".error-container").show();
		 			$("#errorContainer").html('Error Occured during upload<br/><br/>');
			      	downloadlink.show();
			      	$("#submit").removeAttr('disabled', true);
					$(".alternativeButton").removeAttr('disabled', true);
					$("#stageone").removeAttr('class','custom-label-stages');
					$("#stagetwo").attr('class','custom-label-stages');
			      }
			    },
			    processData: false,
			    contentType: false
			  	});
	});
	$("#newPass").focus(function(){
			$("#error-updatePass").hide().empty();
	});
	$("#confirmPass").focus(function(){
			$("#error-updatePass").hide().empty();
	});
	//UPDATE USER PASSWORD//
	$("form#formUpdatePass").submit(function(event)
	{
		event.preventDefault();
		var newPass = $("#newPass").val();
		var confirmPass = $("#confirmPass").val();
		if(newPass.length==0) $("#error-updatePass").removeAttr('class','alert alert-success').attr('class','alert alert-danger').show().html('<span>New Password Field is required.</span>');
		else if(confirmPass.length==0) $("#error-updatePass").removeAttr('class','alert alert-success').attr('class','alert alert-danger').show().html('<span>Confirm Password Field is required.</span>');
		else if(confirmPass!= newPass) $("#error-updatePass").removeAttr('class','alert alert-success').attr('class','alert alert-danger').show().html('<span>Password did not match.</span>');
		else if(confirmPass==newPass)
		{
			var formdata = new FormData(this);
			$.ajax({
				    type: 'post',
				    url: 'validation/updatePassword',
				    data: formdata,
				    dataType:'json',
				    success: function (response) {
				      console.log(response);
				      if(response.status=='success')
				      {
						$("#error-updatePass").removeAttr('class','alert alert-danger').attr('class','alert alert-success').show().html('<span>'+response.message+'</span>');
				      	$("#newPass").val('');
				      	$("#confirmPass").val('');
				      }
				      else
				      {
				      	$("#error-updatePass").removeAttr('class','alert alert-success').attr('class','alert alert-danger').show().html('<span>'+response.message+'</span>');
				      }
				    },
				    processData: false,
				    contentType: false
			});
		}	
	});
	
	//Request Reset Password//
	$("form#formRequestReset").submit(function(event){
		event.preventDefault();
		var username = $("#username_request").val();
		if(username=='')
		{
			$("#containerValidationUsernameRequestReset").html('<font style="font-size: 10px; color:#770404;">The Username field is required.</font>');
		}
		else
		{
			var formdata = new FormData(this);
			$.ajax({
			    type: 'post',
			    url: 'reset_request',
			    data: formdata,
			    dataType:'json',
			    success: function (response) {
			      console.log(response);
			      if(response.status=='failed')
			      {
					$("#messageContainer").removeAttr().attr('class','alert alert-danger').html('Invalid Username.');			      	
			      }
			      else
			      {
					$("#messageContainer").removeAttr().attr('class','alert alert-success').html('Request sent.');			   		
			      }
			    },
			    processData: false,
			    contentType: false
		  	});
		}
	});

	//Set ID for modal//
	$(".btnResetPasswordRequested").click(function(){
		var id = $(this).attr('id');
		$("#userid").val(id);
	});

	// File Template Create
	$('#btnAddHeader').click(function(){
		var headername = $('#headername').val();
		headerdatabase.push({headername:headername});
		// console.log(headerdatabase);
		
		$("#headerData").remove();
		var hiddenInput = document.createElement('input');
		$(hiddenInput).attr({type:'hidden', id:'headerData', name:'headerData', value:JSON.stringify(headerdatabase)});
		$('#header-container').find('ul').parent().append(hiddenInput);


		var row = $('#header-container').find('ul').append('<li style="padding:2px;">'+headername+'<a href="#" style="float:right;" id="header-'+headerdatabase.length+'"><span class="glyphicon glyphicon-remove"></span></a></li>');
		$('#header-'+headerdatabase.length).bind('click', function(){
			var hid = this.id;
			var arrid = hid.split('-');
			headerdatabase.splice(arrid[1]-1,1);
			var parentUL = $(this).parent().parent()[0];
			$(this).parent().remove();
			$($(parentUL).children()).each(function(index){
				$($(this).children()).each(function(){
					$(this).removeAttr('id');
					$(this).attr('id','header-'+parseInt(index+1));
				});
			});

			$("#headerData").remove();
			var hiddenInput = document.createElement('input');
			$(hiddenInput).attr({type:'hidden', id:'headerData', name:'headerData', value:JSON.stringify(headerdatabase)});
			$(parentUL).parent().append(hiddenInput);
		});

	});

 	// File Edit
	$('#btnEditAddHeader').click(function(){
		var headername = $('#headername').val();
		var headerdata = JSON.parse($('#headerData').val());
		headerdata.push(headername);
		headerdatabase = headerdata;
		
		$("#headerData").val('');
		$("#headerData").val(JSON.stringify(headerdata));

		var row = $('#header-container-edit').find('ul').append('<li style="padding:2px;">'+headername+'<a href="#" style="float:right;" id="header-'+headerdata.length+'"><span class="glyphicon glyphicon-remove"></span></a></li>');
		$('#header-'+headerdatabase.length).on('click', function(){
			var hid = this.id;
			var arrid = hid.split('-');
			headerdatabase.splice(arrid[1]-1,1);
			
			var parentUL = $(this).parent().parent()[0];
			$(this).parent().remove();
			$($(parentUL).children()).each(function(index){
				$($(this).children()).each(function(){
					$(this).removeAttr('id');
					$(this).attr('id','header-'+parseInt(index+1));
				});
			});
			$("#headerData").val(JSON.stringify(headerdatabase));
		});

	});

 	//Edit Delete Header
 	$($("#header-container-edit ul").children()).each(function(){
 		
 		$($(this).children()).each(function(){

 			$('#'+this.id).on('click', function(){
 				var datas = JSON.parse($('#headerData').val());
 				headerdatabase = datas;
 				var parentUL = $(this).parent().parent();
 				$(this).parent().remove();
 				var hid = $(this).attr('id');
 				var arrid = hid.split('-');
 				
 				headerdatabase.splice(arrid[1]-1,1);

 				$(parentUL.children()).each(function(index){
 					$(this).find('a').removeAttr('id');
 					$(this).find('a').attr({'id':'header-'+parseInt(index+1)});
 				});
 				$('#headerData').val();
 				$(parentUL).parent().find('#headerData').val(JSON.stringify(headerdatabase));
 			});

 		});

 	});	
});