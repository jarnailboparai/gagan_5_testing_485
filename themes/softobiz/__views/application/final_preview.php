<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jscolor/jscolor.js"></script>
<style>
    .ui-accordion-content-active
    {
        padding: 0 !important;
        background-color: transparent;
        background-image: none;
    }

</style>
<script>
    $(document).ready(function() {
        $('#myframe').attr('src', $('#myframe').attr('src'));
        $('#loader').fadeOut(3000);
        setTimeout(function(){
            $('#loader').remove();
            $('#myframe').css('visibility', 'visible');
        },3000);
        $('#myframe').css('top','-613px')
        $( "#accordion" ).accordion();
        $( ".customize" ).click(function(){
            if($( "#div1" ).css('display') == 'none'){
                $("#div1").slideDown("slow");
                $( "#accordion" ).accordion("refresh");
                $("#h1customize").slideDown("slow");
                $("#previewUpDown").slideUp("slow");
            }
            else{
                $("#div1").slideUp("slow");
                $("#h1customize").slideUp("slow");
                $("#previewUpDown").slideDown("slow");
            }
        });
   
      
        var iframeObj = $('#myframe').contents();
        
        $('#backgroundColor').change(function(){ 
            
            iframeObj = $('#myframe').contents();
            if($('#hiddenInput').val() != 'index.html')    
                iframeObj.find('.ui-page').css('background-image','none');
            iframeObj.find('.ui-page').css('background-color','#'+jQuery('#backgroundColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#mainFontColor').change(function(){ 
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-content').css('color','#'+jQuery('#mainFontColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#titleBackgroundColor').change(function(){ 
            iframeObj = $('#myframe').contents(); 
            iframeObj.find('.ui-bar').css('background','#'+jQuery('#titleBackgroundColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#titleBackgroundGradientColor').change(function(){ 
            iframeObj = $('#myframe').contents(); 
            iframeObj.find('.ui-bar').css('background-image','-webkit-linear-gradient(#'+jQuery('#titleBackgroundColor').val()+',#'+jQuery('#titleBackgroundGradientColor').val()+')');
            $('.saveChanges').css('color','red');
        });
        $('#titleFontColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-bar center').css('color','#'+jQuery('#titleFontColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#titleTextShadowColor').change(function(){
            iframeObj = $('#myframe').contents();  
            iframeObj.find('h1').css('text-shadow','2px 2px 2px #'+jQuery('#titleTextShadowColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#titleTextShadowLink').click(function(){
            iframeObj = $('#myframe').contents();  
            iframeObj.find('h1').css('text-shadow','none');
            $('#titleTextShadowColor').val('');
            $('#titleTextShadowColor').css('background-color','white');
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'link' : 'titleTextShadowLink','page' : $('#hiddenInput').val()},
                success : function(data){
                }
            });
        });
        $('#titleBorderColor').change(function(){
            iframeObj = $('#myframe').contents();  
            iframeObj.find('.ui-header').css('border','1px solid #'+jQuery('#titleBorderColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#titleBorderLink').click(function(){
            iframeObj = $('#myframe').contents();  
            iframeObj.find('.ui-header').css('border','none');
            $('#titleBorderColor').val('');
            $('#titleBorderColor').css('background-color','white');
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'link' : 'titleBorderLink','page' : $('#hiddenInput').val()},
                success : function(data){
                }
            });
        });
        $('#iconBackgroundColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('a[data-icon="custom"]').css('background','#'+jQuery('#iconBackgroundColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#iconBackgroundGradientColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('a[data-icon="custom"]').css('background-image','-webkit-linear-gradient(#'+jQuery('#iconBackgroundColor').val()+',#'+jQuery('#iconBackgroundGradientColor').val()+')');
            $('.saveChanges').css('color','red');
        });
        $('#iconTextColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('a[data-icon="custom"]').css('color','#'+jQuery('#iconTextColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#iconShadowColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('a[data-icon="custom"]').css('text-shadow','2px 2px 2px #'+jQuery('#iconShadowColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#iconTextShadowLink').click(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-btn-inline').css('text-shadow','none');
            $('#iconShadowColor').val('');
            $('#iconShadowColor').css('background-color','white');
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'link' : 'iconTextShadowLink','page' : $('#hiddenInput').val()},
                success : function(data){
                }
            });
        });
        $('#buttonBorderColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-btn-up-c').css('border','1px solid #'+jQuery('#buttonBorderColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#buttonBorderLink').click(function(){
            iframeObj = $('#myframe').contents();  
            iframeObj.find('.ui-btn-up-c').css('border','none');
            $('#buttonBorderColor').val('');
            $('#buttonBorderColor').css('background-color','white');
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'link' : 'buttonBorderLink','page' : $('#hiddenInput').val()},
                success : function(data){
                }
            });
        });
        $('#buttonFontColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-btn-up-c').css('color','#'+jQuery('#buttonFontColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#buttonBackgroundColor').change(function(){ 
            iframeObj = $('#myframe').contents(); 
            iframeObj.find('.ui-btn-up-c').css('background','#'+jQuery('#buttonBackgroundColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#buttonBackgroundGradientColor').change(function(){ 
            iframeObj = $('#myframe').contents(); 
            iframeObj.find('.ui-btn-up-c').css('background-image','-webkit-linear-gradient(#'+jQuery('#buttonBackgroundColor').val()+',#'+jQuery('#buttonBackgroundGradientColor').val()+')');
            $('.saveChanges').css('color','red');
        });
        $('#buttonTextShadowColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-btn-up-c').css('text-shadow','0 1px 0 #'+jQuery('#buttonTextShadowColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#buttonTextShadowLink').click(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-btn-up-c').css('text-shadow','none');
            $('#buttonTextShadowColor').val('');
            $('#buttonTextShadowColor').css('background-color','white');
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'link' : 'buttonTextShadowLink','page' : $('#hiddenInput').val()},
                success : function(data){
                }
            });
        });
        $('#listsOddRowColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-listview li:nth-child(odd)').css('background','#'+jQuery('#listsOddRowColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#listsEvenRowColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.ui-listview li:nth-child(even)').css('background','#'+jQuery('#listsEvenRowColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#listsLinkColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.more-link').css('color','#'+jQuery('#listsLinkColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#listsLinkTextShadowColor').change(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.more-link').css('text-shadow','0 1px 1px #'+jQuery('#listsLinkTextShadowColor').val());
            $('.saveChanges').css('color','red');
        });
        $('#listsLinkTextShadowLink').click(function(){  
            iframeObj = $('#myframe').contents();
            iframeObj.find('.more-link').css('text-shadow','none');
            $('#listsLinkTextShadowColor').val('');
            $('#listsLinkTextShadowColor').css('background-color','white');
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'link' : 'listsLinkTextShadowLink','page' : $('#hiddenInput').val()},
                success : function(data){
                }
            });
        });
        
        $('.saveChanges').click(function(){
            var inputArr = []; 
            $('input').each(function(i){
                inputArr[i] = $(this).val();
            });
        
            $.ajax({
                url :"<?php echo Yii::app()->createUrl('application/changeappcolor'); ?>",
                type : "POST",
                data : {'inputArr' : inputArr,'page' : $('#hiddenInput').val()},
                success : function(data){
                    $('.saveChanges').css('color', 'white');
                }
            });
        });
        $('#myframe').load(function(){
            var frameBody = $('#myframe').contents().find('body');
            frameBody.find('.ui-link-inherit').click(function(){
                if($(this).attr('href').trim().indexOf('index.html') != -1)
                    $('#hiddenInput').val($(this).attr('href').slice(0,10));
                else
                    $('#hiddenInput').val($(this).attr('href'));
                
                
                
                $('input[type="text"]').each(function(){
                    $(this).val('');
                    $(this).css('background-color','white');
                });
                
            }); 
            frameBody.find('.ui-btn-inline').click(function(){
                $('#hiddenInput').val($(this).attr('href'));
                
                $('input[type="text"]').each(function(){
                    $(this).val('');
                    $(this).css('background-color','white');
                });
                
                
            }); 
            
                
        
            
    });
        
                
        
});/*document ready*/
 
</script>
<input type="hidden" value="index.html" id="hiddenInput" />
<?php
$this->renderPartial("app_menu", array('style' => $style));
?>
<div class="row">
    <div class="span5">
        <div id="iphonePreview">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/preview-handset.png" width="395" height="722"><br>
            <div id="loader" style="background:#E1E1E1;width: 303px;height: 525px;position: relative;z-index: 2;top: -667px;left: 37px;background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/images/ajax-loader.gif');background-repeat:no-repeat;background-position:center center;" ></div>
            <iframe style="visibility: hidden;" id="myframe" src="<?php echo 'applications/' . $folder . '/index.html?cashbuster=' . time(); ?>"></iframe>
        </div>
    </div>
    <div class="span5" style="margin:5px 5px 5px 25px" >
        <h1 id="h1customize" style="display: none;" >Customize App</h1>
        <div id="previewUpDown" >
            <h1>App Preview <br>
                <span>Here is an initial preview of your app. If everything looks correct, you can progress to build a test version of the app for your mobile device, or a release version for submission.</span></h1>
            <div class="alert alertwarning alert-block">
                <a class="close" data-dismiss="alert">×</a>
                <h4 class="alert-heading"><strong></strong></h4>
                Please note that Native features will need to be tested on Actual Devices, and
                Graphical positioning may look different depending on your device. The Web
                preview is provided for basic reference &amp; you should always test your app on a
                Device before Releasing.
            </div>
        </div>
        <div id="div1" style="display:none;">
            <div id="accordion" >
                <h3><b>Main</b></h3>
                <div>
                    <p>
                        <label><b>Background Color:</b><input id="backgroundColor" class="color {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Main Font Color:</b><input id="mainFontColor" class="color {required:false}" type="text" maxlength="6" size="6"  /></label>
                    </p>
                </div>
                <h3><b>Title Bar</b></h3>
                <div>
                    <p>
                        <label><b>Title Background Color:</b><input id="titleBackgroundColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Title Background Gradient Color:</b><input id="titleBackgroundGradientColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Title Font Color:</b><input id="titleFontColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Title Text Shadow Color:</b><input id="titleTextShadowColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <a href="javascript:void(0)" id="titleTextShadowLink" ><small>Remove text shadow</small></a>
                        <label><b>Title Border Color:</b><input id="titleBorderColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <a href="javascript:void(0)" id="titleBorderLink" ><small>Remove border</small></a>
                    </p>
                </div>
                <h3><b>Icon Bar & Footer</b></h3>
                <div>
                    <p>
                        <label><b>Icon Background Color:</b><input id="iconBackgroundColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Icon Background Gradient Color:</b><input id="iconBackgroundGradientColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Icon Text Color:</b><input id="iconTextColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Icon Shadow Color:</b><input id="iconShadowColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <a href="javascript:void(0)" id="iconTextShadowLink" ><small>Remove text shadow</small></a>
                    </p>
                </div>
                <h3><b>Buttons</b></h3>
                <div>
                    <p>
                        <label><b>Button Border Color:</b><input id="buttonBorderColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <a href="javascript:void(0)" id="buttonBorderLink" ><small>Remove button border</small></a>
                        <label><b>Button Font Color:</b><input id="buttonFontColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Button Background Color:</b><input id="buttonBackgroundColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Button Background Gradient Color:</b><input id="buttonBackgroundGradientColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Button Text Shadow Color:</b><input id="buttonTextShadowColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <a href="javascript:void(0)" id="buttonTextShadowLink" ><small>Remove button text shadow</small></a>
                    </p>
                </div>
                <h3><b>Others</b></h3>
                <div>
                    <p>
                        <label><b>Lists Odd Row Color:</b><input id="listsOddRowColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Lists Even Row Color:</b><input id="listsEvenRowColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Lists Link Color:</b><input id="listsLinkColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <label><b>Lists Link Text Shadow Color:</b><input id="listsLinkTextShadowColor" class="color  {required:false}" type="text" maxlength="6" size="6"  /></label>
                        <a href="javascript:void(0)" id="listsLinkTextShadowLink" ><small>Remove text shadow</small></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="form-actions" style="padding-bottom:2px;">
            <span class="btn btn-primary2 btn-large customize" >Customize UI</span>
            <span class="btn btn-primary2 btn-large saveChanges" >Save Changes</span>
            <?php echo CHtml::link('Continue', array('/application/buildAppselections'), array('class' => 'btn btn-primary5 btn-large')); ?>
        </div>
    </div>
</div>
