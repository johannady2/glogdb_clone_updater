var updatingicon = '<img src="img/updating.gif" class="status-icon">';
var successicon = '<img src="img/check.png" class="status-icon">';
var tablesuccessionarr = $('.tablesuccession').val().split(',');
var lastTableIndex = tablesuccessionarr.length-1;
var countdownmiliseconds = 3600000;

$(document).ready(function()
{
	startUpdating();
	$("#countdown").countdown({
		until: new Date(new Date().getTime() + (countdownmiliseconds )),onExpiry:  function() { location.reload(); }
	});
	
	
});




function startUpdating()
{
	 
	tablesuccessionarr = $('.tablesuccession').val().split(',');
	$('.update-status-cont').empty();
	
	updateThisTable(tablesuccessionarr[0]);
}


function updateThisTable(tablename)
{
		$('.update-status-cont').append('<li class="'+tablename+'-updating">updating '+tablename+' '+updatingicon+'</li>');
	
            $.ajax(
			{
               type: "POST",
               url: tablename+".php",
               cache: false,
               success: function(data)
               {
				
				if(data.substring(0, 7) == "success")
				{
					$('.'+tablename+'-updating').html(tablename+' updated'+successicon);
					tablesuccessionarr.splice(0,1); //removes first(tablessuccessionarr[0]) table from list of tables. The second one then becomes the first one.
					if(tablesuccessionarr[0] != tablesuccessionarr[lastTableIndex])//if this is not last item in array
					{
						updateThisTable(tablesuccessionarr[0]);
					}
				}
				else
				{
					$('.'+tablename+'-updating').html(tablename+' update failed <button class="retrybtn" data-url="'+tablename+'.php"><img src="img/retry.jpg" class="status-icon"></button>');
					
				}

				
				
               }
			});//data: data, // data to send to above script page if any
			
			
}

$('body').on('click','.retrybtn', function()
{	
	$('ul.update-status-cont > li:last').remove();
	if(tablesuccessionarr[0] != tablesuccessionarr[lastTableIndex])//if this is not last item in array
	{
		updateThisTable(tablesuccessionarr[0]);
	}
});




	/*
	$('.update-status-cont').append('<li class="glog_product-updating">updating glog_product'+updatingicon+'</li>');
            $.ajax(
			{
               type: "POST",
               url: "glog_product.php",
               cache: false,
               success: function(data)
               {
				
				if(data.substring(0, 7) == "success")
				{
					$('.glog_product-updating').html('glog_product updated'+successicon);
				}
				else
				{
					$('.glog_product-updating').html('glog_product update failed <button class="retrybtn" data-url="glog_product.php"><img src="img/retry.jpg" class="status-icon"></button>');
				}

				
				
               }
			});//data: data, // data to send to above script page if any
	*/