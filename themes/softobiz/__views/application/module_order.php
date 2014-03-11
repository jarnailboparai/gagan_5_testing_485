<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>
<style type="text/css">
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
       }
    #sortable li {
        padding: 0.4em;
        font-size: 18px;
        width: 150px;
        word-wrap: break-word;
        float: left;
        margin-right: 25px;
        text-align: center;
       }
       #sortable li:hover{
           cursor:pointer;
       }
    #sortable li span {
        position: absolute;
        margin-left: -1.3em;
    }
</style>

<script type="text/javascript">
    $(function() {
        var idsInOrder;
        $("#sortable").sortable({
            placeholder: 'ui-state-highlight',
            stop: function(i) {
                
                $('#orderingIframe').contents().find('.ordering1').find('.ui-btn-text').html($('#sortable li:nth-child(1)').find('div').text());
                $('#orderingIframe').contents().find('.ordering2').find('.ui-btn-text').html($('#sortable li:nth-child(2)').find('div').text());
                $('#orderingIframe').contents().find('.ordering3').find('.ui-btn-text').html($('#sortable li:nth-child(3)').find('div').text());
                $('#orderingIframe').contents().find('.ordering4').find('.ui-btn-text').html($('#sortable li:nth-child(4)').find('div').text());
                
                
                idsInOrder = $("#sortable").sortable("toArray");
                $("#form_fields").html("");
                for (var order in idsInOrder){
                    $index = parseInt(order)+1;
                    $pos = $("#order"+$index).index();
                    $name = $("#order"+$index).attr('data-name');

                    $input_field = "<input type='text' name='"+$name+"' value='"+$pos+"' />";
                    $("#form_fields").append($input_field);
                }
            }
        });
        $("#sortable").disableSelection();
    });
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'module_order_form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
?>
<?php
$this->renderPartial("app_menu", array('style' => $style));
?>

<div class="row">
    <h1 class="app_details_style">Set Module Order <br/>
        <span>You can now organize your modules to best fit your app. Your changes will automatically carry over to the preview tab.</span></h1>
    <div id="divIframe" >
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/preview-handset.png" width="395" height="722"><br>
    <iframe style="position: relative;left: 39px;width: 309px;height: 541px;top: -692px;"  src="<?= Yii::app()->baseUrl; ?>/www/customize_module_preview/ordering_preview.html" id="orderingIframe" ></iframe>
    </div>
    <div class="span7" style="width: 810px;margin-left: 20%;" >
        <div id="module_list">
            <fieldset>
                <ul id="sortable" class="ui-sortable">
                    <?php
                    $count = 0; $orderingStr = array(1 => "", 2 => "", 3 => "", 4 => "");
                    foreach ($model as $obj):
                        $module = $obj['attributes'];
                        $count++;
                        if($module['tab_title'] != NULL) $name = $module['tab_title']; else $name = $module['name'];
                        if($name == 'Admob')
                            continue;
                        
                        if($count < 5){
                            if(strlen($name) < 17) $name = str_replace('_', ' ', $name); else { $name = substr(str_replace('_', ' ', $name), 0, 13) . '...';}
                            $orderingStr[$count] = ucfirst($name);
                        }
                        
                        ?>
                        <li id="order<?php echo $count; ?>" class="ui-state-default capitalize" data-name="<?php echo $module['name']; ?>">
                            <img src="<?= Yii::app()->theme->baseUrl; ?>/images/icon_new/<?php echo $module['name']; ?>.jpg" width="150" height="140" /><br />
                            <div><?php if(strlen($name) < 17) echo str_replace('_', ' ', ucfirst ($name)); else { echo substr(str_replace('_', ' ', ucfirst($name)), 0, 13) . '...';} ?></div><br />
                        </li>
                        <?php
                    endforeach;
                    ?>					
                </ul>
            </fieldset>

            <div class="form-actions">
                <?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large')); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" >
        var ordering1 = '<?= $orderingStr[1]; ?>';
        var ordering2 = '<?= $orderingStr[2]; ?>';
        var ordering3 = '<?= $orderingStr[3]; ?>';
        var ordering4 = '<?= $orderingStr[4]; ?>';
        var count = 1;
        $('#orderingIframe').load(function(){
            if(ordering1 != ''){
                count++;
                $('#orderingIframe').contents().find('.ordering1').find('.ui-btn-text').html(ordering1);
            }
            else
                $('#orderingIframe').contents().find('.ordering1').parent().remove();
            
            if(ordering2 != ''){
                count++;
                $('#orderingIframe').contents().find('.ordering2').find('.ui-btn-text').html(ordering2);
            }
            else
                $('#orderingIframe').contents().find('.ordering2').parent().remove();
            
            if(ordering3 != ''){
                count++;
                $('#orderingIframe').contents().find('.ordering3').find('.ui-btn-text').html(ordering3);
            }
            else
                $('#orderingIframe').contents().find('.ordering3').parent().remove();
            
            if(ordering4 != ''){
                count++;
                $('#orderingIframe').contents().find('.ordering4').find('.ui-btn-text').html(ordering4);
            }
            else
                $('#orderingIframe').contents().find('.ordering4').parent().remove();
            
            $('#orderingIframe').contents().find('.ordering1').parent().css('width', 100/count + '%');
            $('#orderingIframe').contents().find('.ordering2').parent().css('width', 100/count + '%');
            $('#orderingIframe').contents().find('.ordering3').parent().css('width', 100/count + '%');
            $('#orderingIframe').contents().find('.ordering4').parent().css('width', 100/count + '%');
            $('#orderingIframe').contents().find('.more').parent().css('width', 100/count + '%');
            
        });
    </script>
</div>


<div id="form_fields" class="hidden">
    <?php
    foreach ($model as $obj):
        $module = $obj['attributes'];
        ?>
        <input type="text" name="<?php echo $module['name']; ?>" value="<?php echo $module['module_order']; ?>" />
        <?php
    endforeach;
    ?>
</div>
<?php $this->endWidget(); ?>   
