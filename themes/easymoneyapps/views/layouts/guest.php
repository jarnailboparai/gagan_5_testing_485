<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>Please login</title>
        <!-- userLayoutHead() start -->


<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" media="screen" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.10.1.js"></script>

<!-- userLayoutHead() finish -->
        
    <body>
            <div class="am-layout">
            <a name="top"></a>
            <div class="am-header">
                <div class="am-header-content-wrapper am-main">
                    <div class="am-header-content">
                    <!--<span style="color:#FFF;font-weight:bold;font-size:large;padding:margin-bottom:12px;">Easy Money Apps</span>-->  <!-- <img src="/amember/application/default/views/public/img/header-logo.png" alt="aMember Pro" /> -->
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl.'/images/logo1.png', '', array('height'=>'30px')); ?>
                    </div>
                </div>
            </div>
            <div class="am-header-line">

            </div>
            <div class="am-body">
                <div class="am-body-content-wrapper am-main">
                    <div class="am-body-content">
                                                                            
                        

                        <?php echo $content; ?>
                                                

                    </div>
                </div>
            </div>
        </div>
        <div class="am-footer">
            <div class="am-footer-content-wrapper am-main">
                <div class="am-footer-content">
                    <div class="am-footer-actions">
                        <a href="amember/protect/new-rewrite?f=5&url=/members/#top"><img src="images/top.png"></a>
                    </div>
                    © EasyMoney Apps 2012 <a href="aboutus" target="_blank">About EasyMoneyApps</a> | <a href="privacy" target="_blank">Privacy Policy</a> | <a href="terms" target="_blank">Terms of Service</a> | <a href="http://wpmage.com/support" target="_blank">Support</a>
                </div>
            </div>
        </div>
        <div id="popup">
    <div class="popup-header">
        <a href="javascript:" id="popup-close">
            <img src="images/modal-close.png">
        </a>
        <div class="popup-title">
            <h2 id="popup-title"></h2>
        </div>
    </div>
    <div class="popup-contet" id="popup-content"></div>
</div>            <!-- getclicky code -->
<a title="Real Time Analytics" href="http://getclicky.com/66502033" rel="nofollow"><img alt="Real Time Analytics" src="./Please login_files/badge.gif" border="0" width="1" height="1"></a>
<!-- end of GA code -->


</body></html>
