<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wooden Grid Menu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="css/jquery.mobile-1.4.0.css" />
<link rel="stylesheet" href="css/wooden_theme.css" />
<link rel="stylesheet" href="css/common_layout.css" />
<link rel="stylesheet" href="css/common_layout.css" />
<link rel="stylesheet" href="css/grid_menu.css" />
<link rel="stylesheet" href="css/custom-responsive.css" />
<script src="js/jquery_1.9.1.js"></script>
<script src="js/jquery.mobile-1.4.0.js"></script>
<style type="text/css">
img {
	max-width:100%;
}
</style>
</head>

<body>
<!-- Start of first page -->
<div data-role="page" id="theme_layout" class="theme_bg">
<!-- Right Menu -->


<!-- Right Menu Ends Here -->
  <div data-role="header">
  <a class="refresh_link" href="#"><img src="images/refresh_icon.png" alt="refresh icon" /></a>
    <h1>My Wooden Theme</h1>
    <a class="help_link" href="#"><img src="images/help_icon.png" alt="help icon" /></a>
  </div>
  <!-- /header -->
  
  <div role="main" class="ui-content">
  <!-- Logo of app -->
    <div class="logo" align="center"><img src="images/Wooden.png" alt="logo" /></div>
  
  
  </div>
  <!-- /content -->
  
  <div data-role="footer">
    <div class="grid_menu">
      <div class="app_feature_list"> <a class="item link"><img src="images/fb.png" /></a>
        <label>Add Facebook</label>
      </div>
      <div class="app_feature_list"><a class="item link"><img src="images/notification.png" /></a>
        <label>Shopping Application</label>
      </div>
      <div class="app_feature_list"><a class="item link"><img src="images/opening_hours.png" /></a>
        <label>Opening Hours</label>
      </div>
      <div class="app_feature_list"><a class="item link"><img src="images/add_phone.png" /></a>
        <label>Push Notification</label>
      </div>
      <div class="app_feature_list"><a class="item link"><img src="images/add_location.png" /></a>
        <label>Add Location</label>
      </div>
      <div class="app_feature_list"> <a class="item link"><img src="images/custom_icon.png" /></a>
        <label>Custom Setting</label>
      </div>
     
    </div>
  </div>
  <!-- /footer --> 
</div>
<!-- /page --> 

<!-- Start of second page -->
<div data-role="page" id="bar">
 
  <div data-role="header">
  <a class="refresh_link" href="#"><img src="images/refresh_icon.png" alt="refresh icon" /></a>
    <h1>My Wooden Theme</h1>
    <a class="help_link"><img src="images/help_icon.png" alt="help icon" /></a>
  </div>
  <!-- /header -->
  
  <div role="main" class="ui-content">
    <p>I'm the second in the source order so I'm hidden when the page loads. I'm just shown if a link that references my id is beeing clicked.</p>
    <p><a href="#foo">Back to foo</a></p>
  </div>
  <!-- /content -->
  
  <div data-role="footer">
    <h4>Page Footer</h4>
  </div>
  <!-- /footer --> 
 
</div>


<!-- /page -->

</body>
</html>