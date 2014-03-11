<?php

Yii::import('application.vendors.*');
require_once 'phonagap.php';

class AndroidController extends Controller {

    public function beforeAction($action) {
        $this->layout = '//layouts/column2';
        return parent::beforeAction($action);
    }

    public function actionDeveloperDetails() {
        $model = AndroidProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if ($model == null)
            $model = new AndroidProfile;
        if (isset($_POST['AndroidProfile'])) {
            $model->attributes = $_POST['AndroidProfile'];
//            $model->android_file_keystore = CUploadedFile::getInstance($model, 'android_file_keystore');
            $model->user_id = Yii::app()->user->id;





            if ($model->save()) {
                $model->android_file_keystore = $this->genratekeyandroid($model->android_keystore_password);
                $model->phonegap_id = $this->uploadKey($model);
                $model->save();
//                $model->android_file_keystore->saveAs('certificate_files/' . $model->android_file_keystore);
                $this->redirect(array('/ios/view'));
            }
        }

        $this->render('developer_details', array(
            'model' => $model,
        ));
    }

//    public function actionDistributionCertificate() {
//        $user_id = Yii::app()->user->id;
//        $model = AndroidProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
//        if (isset($_POST['AndroidProfile'])) {
//            $model->attributes = $_POST['AndroidProfile'];
//            $android_file_keystore = CUploadedFile::getInstance($model, 'android_file_keystore');
//
//            $file_name = "ks_" . $user_id . ".keystore";
//            if ($android_file_keystore) {
//                $model->android_file_keystore = $file_name;
//            }
//            $android_file_keystore->saveAs('android_keys/' . $model->android_file_keystore);
//
////     CVarDumper::dump($model->attributes, 10, TRUE);die;
//            $model->phonegap_id = $this->uploadKey($model);
//
//            if ($model->save()) {
////                $android_file_keystore->saveAs('android_keys/' . $model->android_file_keystore);
//                $path = Yii::app()->basePath;
//                $this->redirect(array('/ios/view'));
//            }
//        }
//        $this->render('distribution_certificate', array(
//            'model' => $model,
//        ));
//    }

    public function genratekeyandroid($key_password) {
        $user_id = Yii::app()->user->id;
        $keystore_file = "ks_" . $user_id . ".keystore";
        $base = Yii::getPathOfAlias("webroot") . "/android_keys";
        shell_exec("keytool -genkey -v -keystore $base/$keystore_file -alias $keystore_file -keyalg RSA -validity 10000 -keypass $key_password -storepass $key_password -dname \"cn=Noman iqbal\"");
        return $keystore_file;
    }

    public function uploadKey($model) {
        $phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
        $res = $phone->setKeysAndroid($model->android_file_keystore, $model->android_keystore_password, $model->android_file_keystore, $model->android_keystore_password, Yii::getPathOfAlias("webroot") . '/android_keys/' . $model->android_file_keystore);
        if (property_exists($res, "id")) {
            return $res->id;
        }
    }

}
