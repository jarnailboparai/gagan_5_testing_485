<?php

Yii::import('application.vendors.*');
require_once 'GCMPushMessage.php';

class NotificationController extends Controller {

    public function beforeAction($action) {
        $this->layout = '//layouts/column2';
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $model = new Notification();
        $user = Notification::model()->findByAttributes(array('app_id' => $_GET['app_id']));
        $profile = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $gcmAppAll = Gcm::model()->findAllByAttributes(array('app_id' => $_GET['app_id']));
        $apnAppAll = Apn::model()->findAllByAttributes(array('app_id' => $_GET['app_id']));
//        echo '<pre>'.$_GET['app_id'];
//        print_r($user->attributes);
//        print_r($apnAppAll->attributes);
//        print_r($gcmAppAll->attributes);
//        die;
        
        if (!empty($gcmAppAll) || !empty($apnAppAll)) {
            $gcmRegId = 'yes';
        } else {
            $gcmRegId = 'no';
        }

        if (isset($_GET["message"])) {

            $message = $_GET["message"];

            foreach ($apnAppAll as $apn) {

                $apn->message = $message;
                $apn->save();
                $this->send_notification_ios($apn->token, $profile->apple_p12_password, $apn->message, $user->certification_push_pem_path);
            }
            $data = array("message" => $message, "app_id" => $_GET['app_id']);

            foreach ($gcmAppAll as $gcmApp) {
                
                $registatoin_ids = array($gcmApp->gcm_regid);
                            print_r($registatoin_ids);
                            echo '<br>';
               
                $gcmApp->message = $message;
                $gcmApp->save();
                echo $this->send_notification($registatoin_ids, $data);
            }
        }

        $this->render('index', array('user' => $user, 'model' => $model, 'gcmRegId' => $gcmRegId));
    }

    public function send_notification_ios($deviceToken, $passphrase, $message, $ck_pem_path) {

////////////////////////////////////////////////////////////////////////////////

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', Yii::getPathOfAlias('webroot') . '/apple_certificate_files_pem/' . $ck_pem_path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

// Encode the payload as JSON
        $payload = json_encode($body);

// Build the binary notification
        echo $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
        echo $result = fwrite($fp, $msg, strlen($msg));

        return $result;
//        if (!$result)
//            echo 'Message not delivered' . PHP_EOL;
//        else
//            echo 'Message successfully delivered' . PHP_EOL;
// Close the connection to the server
        fclose($fp);
    }

    public function send_notification($registatoin_ids, $data) {

        $notification = Notification::model()->findByAttributes(array('app_id' => $_GET['app_id']));
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $data,
        );

        $headers = array(
            'Authorization: key=' . $notification->google_api_key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        return $result;
    }

    public function actionRegistered() {

        if (isset($_POST["regId"]) && isset($_POST['app_id']) && isset($_POST['from'])) {
            switch ($_POST['from']) {
                case "android":
                    $gcmResult = Gcm::model()->findByAttributes(array('app_id' => $_POST['app_id'], 'gcm_regid' => $_POST["regId"]));
                    if (!isset($gcmResult)) {
                        $gcm = new Gcm();
                        $gcm->app_id = $_POST['app_id'];
                        $gcm->gcm_regid = $_POST["regId"];
                        $gcm->save();
                    } else {
                        if ($gcmResult->message == NULL)
                            echo 'noMessage';
                        else
                            echo $gcmResult->message;
                    }

                    break;
                case "ios":
                    $apnResult = Apn::model()->findByAttributes(array('app_id' => $_POST['app_id'], 'token' => $_POST["regId"]));
                    if (!isset($apnResult)) {
                        $apn = new Apn();
                        $apn->app_id = $_POST['app_id'];
                        $apn->token = $_POST["regId"];
                        $apn->save();
                    } else {
                        if ($apnResult->message == NULL)
                            echo 'noMessage';
                        else
                            echo $apnResult->message;
                    }
                    break;
            }
        }
    }

    function mytested() {
        echo "here is login";
        exit;
    }

}
