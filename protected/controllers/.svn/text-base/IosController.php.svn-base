<?php

Yii::import('application.vendors.*');
require_once 'phonagap.php';

class IosController extends Controller {

    public function beforeAction($action) {
        $this->layout = '//layouts/column2';
        return parent::beforeAction($action);
    }

    public function actionView() {
        $model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $model_android = AndroidProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if ($model == null)
            $model = new AppleProfile;

        if ($model_android == null)
            $model_android = new AndroidProfile;

        $this->render('view', array(
            'model' => $model,
            'model_android' => $model_android,
        ));
    }

    public function actionDeveloperDetails() {
        $model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if ($model == null)
            $model = new AppleProfile;
        if (isset($_POST['AppleProfile'])) {
            $model->attributes = $_POST['AppleProfile'];
            $model->user_id = Yii::app()->user->id;
            if ($model->save()) {
                $this->redirect(array('/ios/view'));
            }
        }

        $this->render('developer_details', array(
            'model' => $model,
        ));
    }

    public function actionDistributionCertificate() {
        $user_id = Yii::app()->user->id;
        $model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $model->scenario = 'p12_file';
//        $email = $model->apple_email;
//        $name = $model->apple_developer_name;
//        $certificate_file_url = Yii::app()->baseUrl . '/certificate_files/CertificateSigningRequest_' . $model->user_id . '.certSigningRequest';

        $key = 'mykey_' . $user_id . '.key';
//            if ($model->certificate_signing_request==''){
//                exec("openssl genrsa -out $key 2048");
//                exec('openssl req -new -key '.$key.' -out CertificateSigningRequest.certSigningRequest  -subj "/emailAddress='.$email.', CN='.$name.', C=US"');
//
//                $cerf_name = 'CertificateSigningRequest_'.$model->user_id.'.certSigningRequest';
//                $certificate_file_name = Yii::app()->basePath.'/../certificate_files/'.$cerf_name;
//                
//                copy(Yii::app()->basePath.'/../CertificateSigningRequest.certSigningRequest', $certificate_file_name);
//                copy(Yii::app()->basePath.'/../'.$key, Yii::app()->basePath.'/../certificate_files/'.$key);
//                unlink(Yii::app()->basePath.'/../CertificateSigningRequest.certSigningRequest');
//                unlink(Yii::app()->basePath.'/../'.$key);
//                
//                AppleProfile::model()->updateByPk($model->id, array('certificate_signing_request'=>$cerf_name));
//            }

        if (isset($_POST['AppleProfile'])) {
            $model->attributes = $_POST['AppleProfile'];

            $distribution_certificate = CUploadedFile::getInstance($model, 'p12_file');
//                    $file_name = "certificate_".$model->user_id."_".str_replace(' ', '', $distribution_certificate);
            $file_name = "certificate_" . $user_id . ".p12";
            if ($distribution_certificate) {
                $model->p12_file = $file_name;
            }
//            CVarDumper::dump($model->attributes, 10, TRUE);die;
            if ($model->save()) {
                $distribution_certificate->saveAs('apple_certificate_files/' . $file_name);





                //system("openssl x509 -in $file_name -inform DER -out certificate_file.pem -outform PEM");
//                            system("openssl pkcs12 -nocerts -out certificate_file.pem -in path/to/TestingKey.p12 -passout pass:yournewpassphrase -passin pass:initialpassphrase");
//                            system("openssl rsa -in TestingKey.pem -out TestingKey-noenc.pem -passin pass:yournewpassphrase"); 
//                $path = Yii::app()->basePath;
//                exec("openssl x509 -in certificate_files/$file_name -inform DER -out certificate_files/{$user_id}_developer_identity.pem -outform PEM");
//                exec("openssl pkcs12 -password pass:12345 -export -nokeys -in certificate_files/{$user_id}_developer_identity.pem -out certificate_files/{$user_id}_iphone_dev.p12");
//                if (file_exists(Yii::app()->basePath . "/../certificate_files/{$user_id}_iphone_dev.p12"))
//                    AppleProfile::model()->updateByPk($model->id, array('p12_file' => "{$user_id}_iphone_dev.p12"));

                $this->redirect(array('/ios/view'));
            }
        }

        $this->render('distribution_certificate', array(
            'model' => $model
        ));
    }

    public function actionStoreProvisioningProfile() {
        $user_id = Yii::app()->user->id;
        $model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $model->scenario = 'store_provisioning_profile';

        if (isset($_POST['AppleProfile'])) {
            $model->attributes = $_POST['AppleProfile'];
            $store_provisioning_profile = CUploadedFile::getInstance($model, 'store_provisioning_profile');
            $file_name = "store_provisioning_profile_" . $model->user_id . "_" . str_replace(' ', '', $store_provisioning_profile);
            if ($store_provisioning_profile) {
                $model->store_provisioning_profile = $file_name;
            }
            //CVarDumper::dump($model->attributes, 10, TRUE);die;
            if ($model->save()) {
                $store_provisioning_profile->saveAs('apple_certificate_files/' . $file_name);
//                $result = exec('curl -u tayyabshabab@yahoo.com:tayyab -F cert=@certificate_files/' . $user_id . '_iphone_dev.p12 -F profile=@certificate_files/' . $model->store_provisioning_profile . ' -F \'data={"title":"DeveloperCert_' . $user_id . '","password":"12345"}\' https://build.phonegap.com/api/v1/keys/ios');
//                $data = json_decode($result);
                $phonegap_id = $this->uploadKey($model);
                AppleProfile::model()->updateByPk($model->id, array('phonegap_id' => $phonegap_id));
                $this->redirect(array('/ios/view'));
            }
        }

        $this->render('store_provisioning_profile', array(
            'model' => $model,
        ));
    }

    public function uploadKey($model) {
        $phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
        $res = $phone->setKeysIOS(Yii::app()->user->username."_".$model->id, $model->apple_p12_password, "./apple_certificate_files/" . $model->p12_file, "./apple_certificate_files/" . $model->store_provisioning_profile);
        if ($res) {
            return $res->id;
        }
    }

}
