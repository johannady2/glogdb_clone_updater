<!DOCTYPE html>
<html lang="en">
<head>
<title>glogdb_clone_updater</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/jquery.countdown.css"> 
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->


</head>

<body>


	<div class="container">
		<header>
			<div class="header-row">
				<h1 class="header-title">glogdb_clone Updater</h1>
			</div>
		</header>
		
		<div class="content">
			<div id="countdown"></div>
			
			<div class="fieldgroup"><span>Set Countdown(seconds):<input type="text" value="<?php if(isset($_COOKIE['UsedcountDownValue'])){echo $_COOKIE['UsedcountDownValue']/1000;}else{ echo 300;} ?>" id="setCountDownValue"><button id="setCountDown">Save</button></span></div>
			
			
			<br>
			<textarea class="tablesuccession"/>glog_marketplace_shop_product,glog_marketplace_shop,glog_marketplace_shipping,glog_marketplace_seller_reviews,glog_marketplace_seller_product_category,glog_marketplace_seller_product,glog_marketplace_seller_orders,glog_marketplace_seller_info,glog_marketplace_query_records,glog_marketplace_product_image,glog_marketplace_payment_mode,glog_marketplace_order_commision,glog_marketplace_delivery,glog_marketplace_customer_query,glog_marketplace_customer_payment_detail,glog_marketplace_customer,glog_marketplace_commision_calc,glog_marketplace_commision,glog_order_detail,glog_state,glog_country_lang,glog_country,glog_address,glog_order_state_lang,glog_order_state,glog_order_history,glog_carrier,glog_cart_rule,glog_order_cart_rule,glog_message,glog_orders,glog_guest,glog_customer,glog_category_product,glog_category_lang,glog_category_group,glog_category,glog_manufacturer,glog_supplier_lang,glog_supplier,glog_attribute_group_lang,glog_attribute_lang,glog_attribute_impact,glog_attribute_group,glog_attribute,glog_product_lang,glog_product_sale,glog_product_attribute,glog_product,glog_product_attribute_combination,glog_stock_available</textarea>
			<br>
			<button id="update-btn">Update</button>
		
			
		
			<ul class="update-status-cont">
			</ulhttps://www.youtube.com/watch?v=Rtu3xoz5K90>
		
		
		</div>
		

		<footer>
			<p>&copy; 2015 Smart Minds Software Development Inc. All rights reserved.</p>
		</footer>
	
		
	</div>


</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery.plugin.js"></script> <!--http://keith-wood.name/countdown.html-->
<script type="text/javascript" src="js/jquery.countdown.js"></script>
<script src="js/custom.js"></script>
</html>
