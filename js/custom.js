var updatingicon = '<img src="img/updating.gif" class="status-icon">';
var successicon = '<img src="img/check.png" class="status-icon">';
var tablesuccessionarr = $('.tablesuccession').val().split(',');
var lastTableIndex = tablesuccessionarr.length-1;
var originalLength  = tablesuccessionarr.length;
var numberOfTablesUpdated = 0;
var countdownmiliseconds = $('#setCountDownValue').val();
//alert(countdownmiliseconds);


				
	startUpdating();

		$("#countdown").countdown({
			until: new Date(new Date().getTime() + countdownmiliseconds*1000),
			onExpiry:  function() 
			{
				if(numberOfTablesUpdated == originalLength)//if all tables are updated
				{
					location.reload(); 
				}
				else
				{
					  setCountdown(120);
					//$('#countdown').countdown('option', { until: + countdownmiliseconds/1000 });    
				}
			}
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
					
					numberOfTablesUpdated++;
					
					if(tablesuccessionarr[0] != tablesuccessionarr[lastTableIndex])//if this is not last item in array
					{
						updateThisTable(tablesuccessionarr[0]);
					}
				}
				else
				{
					$('.'+tablename+'-updating').html(tablename+' update failed <button class="retrybtn" data-url="'+tablename+'.php"><img src="img/retry.jpg" class="status-icon"></button>');
					
					setTimeout(function()
					{
						$('.retrybtn').click();
					},5000);
					
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


$('#setCountDownValue').keydown(function(event)
{

				if( event.keyCode >= 1 && event.keyCode < 8)
				{
					event.preventDefault();
				}
				else if( event.keyCode >8 && event.keyCode < 37)
				{
					event.preventDefault();
				}
				else if(event.keyCode > 37 && event.keyCode < 39)
				{
					event.preventDefault();
				}
				else if( event.keyCode >39 && event.keyCode < 48)
				{
					event.preventDefault();
				}
				else if( event.keyCode >57 && event.keyCode < 96)
				{
					event.preventDefault();
				}
				else if(event.keyCode > 105)
				{
					event.preventDefault();
				}
				
});


function setCountdown(newTime)
{

	$('#countdown').countdown('option', { until: + newTime });
}

$('#update-btn').on('click',function()
{
	
	location.reload();
	
});



function runSETusedmilisecondsFile(usedvalue)
{
	$.ajax(
		{
		   type: "POST",
		   url: "SETusedmiliseconds.php",
		   data: {"usedcountdownseconds":usedvalue},
		   datatype: "json",
		   cache: false,
		   success: function(data)
		   {
			 //alert(data);
		   }
		});
}


$('#setCountDown').on('click',function()
{
	var inputedseconds = $('#setCountDownValue').val();
	
	var inputedsecondsTOmiliseconds = inputedseconds*1000;
	if(inputedseconds != '' && inputedseconds != 0 && inputedseconds != NaN)
	{
		setCountdown(inputedseconds);
		runSETusedmilisecondsFile(inputedsecondsTOmiliseconds);
	}
	else
	{
		
		setCountdown(300);
		runSETusedmilisecondsFile(300);
		$('#setCountDownValue').val(300);
		alert('invalide value');
		
	}
});

