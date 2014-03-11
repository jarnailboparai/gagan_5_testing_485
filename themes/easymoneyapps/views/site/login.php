<h1>Please login</h1>

<!-- content starts here -->

<div class="am-layout-two-coll">
    <div class="am-layout-two-coll-top"></div>
    <div class="am-coll-left">
        <div class="am-coll-content">
            <div class="am-form am-login-form">
                <!--                <form name="login" method="post" action="amember/login">-->
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                        ));
                ?>
                <fieldset>
                    <legend>&nbsp;&nbsp;Member Login</legend>

                    <div class="row" id="recaptcha-row" style="display: none;">
                        <div class="element-title" style="display:none;"></div>
                        <div class="element" style="margin-left:0;" id="recaptcha-element">
                        </div>
                    </div>

                    <div class="row">
                        <div class="element-title">
                            <label class="element-title" for="login">E-Mail Address or Username</label>
                        </div>
                        <div class="element">
<!--                                <input type="text" id="login" name="amember_login" size="15" value="">-->
<?php echo $form->textField($model, 'username', array('id' => 'member_login', 'size' => '15')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="element-title">
                            <label class="element-title" for="pass">Password</label>
                        </div>
                        <div class="element">
<!--                                <input type="password" id="pass" name="amember_pass" size="15">-->
<?php echo $form->passwordField($model, 'password', array('id' => 'member_pass', 'size' => '15')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="element-title"></div>
                        <div class="element" style="vertical-align: baseline">
                            <input type="button" value="Login" id="login-btn">
<?php //echo CHtml::submitButton('Login'); ?>
                            <span style="font-size: large"> or                                    <a href="javascript: history.back(-1)">Back</a>
                            </span>
                        </div>
                    </div>
                </fieldset>
                <!-- hidden variables -->
                <input type="hidden" name="login_attempt_id" id="login_attempt_id" value="<?php echo strtotime(date("Y-m-d") . date("H:i:s"));?> ">
                <input type="hidden" name="amember_redirect_url" value="/members/">
                <!-- end of hidden -->
                <!--                </form>-->
<?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="am-coll-right">
        <div class="am-coll-content">
            <div class="am-form am-sendpass-form">
                <form name="sendpass" method="post" action="amember/sendpass">
                    <fieldset>
                        <legend>&nbsp;&nbsp;Lost password?</legend>
                        <div class="row">
                            <div class="element-title">
                                <label for="sendpass">Enter your <b>E-Mail Address</b> or <b>Username</b></label>
                            </div>
                            <div class="element"><input type="text" name="login" id="sendpass" size="15"></div>
                        </div>
                        <div class="row">
                            <div class="element">
                                <input type="submit" value="Get Password">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="am-layout-two-coll-bottom"></div>
</div>

<br>
<p style="text-align:center">Not registered yet? <!--<a href="amember/signup/index/c/">Signup here</a>-->
<?php echo CHtml::link('Signup here', array('/user/create')); ?>
</p>
<br>
<?php $url_panel = Yii::app()->getBaseUrl(true);
	$url_panel = str_replace('members/wizard','',$url_panel);
?>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#login-btn').click(function(){
            send();        
        });
    });

    function send()
    {      
        
		var URL = '<?php echo $url_panel?>panel/login/';
		$.ajax({
            type: 'POST',
            url: URL,
            data:'amember_login='+$('#member_login').val()+'&amember_pass='+$('#member_pass').val()+'&login_attempt_id='+$('#login_attempt_id').val(),
            success:function(data){
                //alert(data); 
                $('#login-form').submit();
            },
            error: function(data) { // if error occured
                alert("Error occured.please try again");
                //alert(data);
                $('#login-form').submit();
            },

            dataType:'html'
        });
    }
</script>
