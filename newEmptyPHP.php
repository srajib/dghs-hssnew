<script>
				function toggle() {
				var v = $('#answer_storage_month_year option:selected').val();
				var v = v.toString();
				$(function () 
			    {
				//-----------------------------------------------------------------------
				// 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
				//-----------------------------------------------------------------------
				$.ajax({                                      
				  url: 'api1.php',                  //the script to call to get data          
				  data: "org_id=<?php echo $org_code;?>&month="+v,                        //you can insert url argumnets here to pass to api.php
												   //for example "id=5&parent=6"
				  dataType: 'json',                //data format      
				  type: "POST",
				  success: function(data)          //on recieve of reply
				  { 
				    
				   	var v = $('#answer_storage_month_year option:selected').val();
					
					var vname = data;   //get name
					var t = v;          //get name
					
					
					if(vname > 0)
					{
					  	$('#output').html("<b><a href='report.php?month="+t+"' target='_blank'>Please click here to see your report.</a></b>"); //Set output element html
						$('.widget-accordion').hide();
					}
					else{
						$('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
						$('.widget-accordion').show();
					}
				  } 
				});
  });?> 
 
		       </script>
			
                       <? } else{?>
                       
                       		<script>
				function toggle(){
				var v = $('#answer_storage_month_year option:selected').val();
				var v = v.toString();
				$(function () 
			    {
				//-----------------------------------------------------------------------
				// 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
				//-----------------------------------------------------------------------
				$.ajax({                                      
				  url: 'api.php',                  //the script to call to get data          
				  data: "org_id=<?php echo $org_code;?>&month="+v,                        //you can insert url argumnets here to pass to api.php
												   //for example "id=5&parent=6"
				  dataType: 'json',                //data format      
				  type: "POST",
				  success: function(data)          //on recieve of reply
				  { 
				    
				   	var v = $('#answer_storage_month_year option:selected').val();
					
					var vname = data;           //get name
					var t = v;           //get name
					
					
					if(vname > 0)
					{
					  	$('#output').html("<b><a href='report.php?month="+t+"' target='_blank'>Please click here to see your report.</a></b>"); //Set output element html
						$('.widget-accordion').hide();
					}
					else{
						$('#output').html("<b>You have not insert any data for this month. </b>"); //Set output element html
						$('.widget-accordion').show();
					}
				  } 
				});
  }); 
			  
			     }?>

			</script>