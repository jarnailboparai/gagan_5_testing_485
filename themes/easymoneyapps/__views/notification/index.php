<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
               
    });
    function sendPushNotification(id){
        var data = $('form#'+id).serialize();
        $('form#'+id).unbind('submit');                
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('notification/index'); ?>",
            type: 'GET',
            data: data,
            beforeSend: function() {
                        
            },
            success: function(data, textStatus, xhr) {
                $('.txt_message').val("");
            },
            error: function(xhr, textStatus, errorThrown) {
                        
            }
        });
        return false;
    }
</script>

<style type="text/css">
    .container{
        width: 950px;
        margin: 0 auto;
        padding: 0;
    }
    h1{
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 24px;
        color: #777;
    }
    div.clear{
        clear: both;
    }
    ul.devices{
        margin: 0;
        padding: 0;
    }
    ul.devices li{
        float: left;
        list-style: none;
        color: #555;
    }
    ul.devices li label, ul.devices li span{
        display: block;
        float: left;
    }
    ul.devices li label{
        width: 67px;
        font-size: 16px;
        font-weight: bold;
        color: gray;
        line-height: 23px;                
    }
    ul.devices li textarea{
        float: left;
        resize: none;
    }
    ul.devices li .send_btn{
        background: url(themes/easymoneyapps/images/button_small_not.png) no-repeat 0 0px transparent;
        width: 78px;
        height: 35px;
        border: none!important;
        line-height: 7px;
        text-align: center;
        color: white;
        text-shadow: 1px 1px 8px black;

    }
    ul.devices li .send_btn:hover{
        opacity: 0.8;
    }
    ul.devices li .send_btn:active{
        background: url(themes/easymoneyapps/images/button_small_reverse_not.png) no-repeat 0 0px transparent;
    }
    .textmessage-form label{
        color:#555;
    }
    .textmessage-form{
        margin:0;
    }
    .ul-wrapper{
        width: 380px;
        margin: 0 auto;
        overflow: hidden;
    }
    .ul-wrapper ul{
        border-radius: 7px;
        -webkit-box-shadow:2px 2px 9px silver; 
        -moz-box-shadow:2px 2px 9px silver;
        box-shadow: 2px 2px 9px silver;
        border: 1px solid #dedede;
        padding: 10px;
        margin: 0 15px 25px 0;
        overflow:hidden;
        width: 350px;
    }
    .ul-wrapper ul textarea{

        width: 334px;
        min-height: 93px;
        height: auto;
        margin-top: 20px;

    }
    .ul-wrapper ul textarea:focus{
        outline: none;
        border: 1px solid #9393C5;
        border-radius: 7px;
        box-shadow: 1px 1px 8px #9393C5;
    }
    #backArrow{
        background-image: url(themes/easymoneyapps/images/back_arrow.png);
        width: 76px;
        height: 46px;
        float: left;
        margin-right: 10px;
    }
    #backArrow:hover{
        opacity: 0.8;
        cursor: pointer;
    }
    #backArrow:active{
        background-image: url(themes/easymoneyapps/images/back_arrow_active.png);
    }
</style>



<div class="container">
    <a href="<?php echo Yii::app()->createUrl('/application/dashboard'); ?>" ><span id="backArrow"></span></a><h1>You can send <b>Notification</b> in all devices that have this application.(only Android)</h1>
    <hr/>
    <div class="ul-wrapper">
        <ul class="devices">
            <?php
            if (!empty($user)) {

                if ($gcmRegId == 'yes') {
                    ?>
                    <li>
                        <form id="<?php echo $user->id; ?>" class="textmessage-form" name="" method="post" onsubmit="return sendPushNotification('<?php echo $user->id; ?>')">

                            <label>Name: </label> <span><?php echo $user->name; ?></span>
                            <div class="clear"></div>

                            <label>Email:</label> <span><?php echo $user->email ?></span>
                            <div class="clear"></div>

                            <div class="send_container">
                                <textarea rows="3" name="message" cols="25" class="txt_message" placeholder="Type message here"></textarea><br/>
                                <input type="hidden" name="app_id" value="<?php echo $_GET['app_id']; ?>"/>
                                <input type="submit" class="send_btn" value="Send" onclick=""/>
                            </div>

                        </form>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <h1>No registered devices!</h1>
                    </li>
                    <?php
                }
            } else {
                ?> 
                <li>
                    You don't activate <b>Notification</b> yet!
                </li>
            <?php } ?>
        </ul>
    </div>
</div>




