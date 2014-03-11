<?php
$this->renderPartial("app_menu", array('style' => $style));
?>

<?php ?>

<div class="body_right">
    <h1 class="app_details_style style_left">
        Customize Modules <br/><span>Please enter relevant information to customize
            your App. </span>
    </h1>
    <div class="span7">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'cusomize_module-form',
			//'action'=>'index.php?r=applicationnew/customizeModules',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
            ),
        ));
        ?>
        <fieldset>

            <div class="builder-main" >
                <?php
                foreach ($model as $obj):
                    $module = $obj['attributes'];
                    $btn = ($module['activated'] == 'yes') ? 'btn-success' : 'btn-danger';
                    $icon = ($module['activated'] == 'yes') ? 'icon-ok' : 'icon-remove';
                    $customize_btn = ($module['activated'] == 'yes') ? 'btn-success' : 'btn-warning';

                    $skip_arr = array('local_news', 'local_events', 'deals', 'barcode_scanner');
                    if (in_array($module['name'], $skip_arr))
                        continue;
                    ?>
                    <div class="feature-icons-box" style="margin-bottom: 20px;" >
                        <div class="feature-icon">
                            <?php
                            if (substr($module['name'], 0, 7) == 'content')
                                $src = 'content';
                            else
                                $src = $module['name'];
                            ?>
                            <img src="<?= Yii::app()->theme->baseUrl; ?>/images/icon_new/<?= $src; ?>.png"  /></div>
                        <?php if ($src == 'content') { ?>
                            <label for="articles">Number of Articles</label>
                            <input type="text" name="articles" id="articles_<?php echo $module['id']; ?>" value="<?php echo $module['articles'] ?>" />
                        <?php } ?>
                        <div class="feature-check">
                            <?php if ($module['tab_title'] == NULL)
                                $name = $module['name'];
                            else
                                $name = $module['tab_title'];
                            ?>
                            <?php
                            $name = ($name == 'Admob') ? 'Tapgage' : $name;
                            echo str_replace('_', ' ', ucfirst($name));
                            ?><br/><br/>
                            <?php if ($name != 'Admob'): ?>
                            <?php endif; ?>
                            <?php if ($src == 'content') { ?> 
                                <a class="gray_btn" <?php echo $customize_btn; ?> onclick="makeURL('<?php echo $module['id'] ?>')">Customize</a>
    <?php } else { ?>
                                <a class="gray_btn" <?php echo $customize_btn; ?> href="<?php echo Yii::app()->createUrl('/applicationnew/customizemoduledetails', array('module_id' => $module['id'])); ?>">Customize</a>
                    <?php } ?>
                        </div>
                    </div>
    <?php
endforeach;
?>
            </div>


            <!--            <div class="form-actions">
<?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large', 'style' => 'margin-top:40px')); ?>
                        </div>-->



            <div class="control-group" style="display: none;" >
                <label class="control-label ctrl_style">Master Keyword</label>
                <div class="controls">
<?php echo $form->textField($application_model, 'master_keyword', array('class' => 'span5', 'placeholder' => 'Enter A Master Keyword (Optional)', 'id' => 'masterKeyword')); ?>
                </div>
            </div>

            <div class="control-group" style="display: none;" >
                <label class="control-label ctrl_style">Master Street Address</label>
                <div class="controls">
<?php echo $form->textField($application_model, 'master_address', array('class' => 'span5', 'placeholder' => 'Enter A Master Street Address (Optional)', 'id' => 'masterAddress')); ?>
                </div>
            </div>

            <input id="submitted" name="submitted" value="1" type="hidden">
            <div class="form-actions">
<?php echo CHtml::submitButton('Save & Continue', array('class' => 'btn btn-primary btn-large')); ?>
            </div>


        </fieldset>

<?php $this->endWidget(); ?>
    </div>
    <div class="span4">
    </div>
</div>


<script type="text/javascript">
                            $(document).ready(function() {
                                $(".tooltip-selector").each(function() {
                                    $(this).tooltip();
                                    $(this).click(function() {
                                        return false;
                                    })
                                });
                            });

                            function makeURL(id)
                            {
                                var no_of_art = $('#articles_' + id).val();

                                if (no_of_art != '' && no_of_art != '0' && no_of_art != 'undefined') {

                                    //alert(no_of_art);
                                    if (isNaN(no_of_art)) {
                                        alert('Please enter Numeric value for articles .');
                                        return;
                                    }

                                    URL = "<?php echo Yii::app()->createUrl('/applicationnew/customizemoduledetails'); ?>" + "&module_id=" + id + "&num_articles=" + no_of_art;
                                    window.location = URL;
                                } else {
                                    alert('Please enter number of articles first.');
                                }

                            }
</script>
