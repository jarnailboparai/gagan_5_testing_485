<script type="text/javascript" src="PushNotification.js"></script>
<script type="text/javascript">
    var pushNotification;
    var app_id = "%app_id%";
    var message;
            
    function onDeviceReady() {
                
        pushNotification = window.plugins.pushNotification;
				
        if (device.platform == 'android' || device.platform == 'Android') {
            pushNotification.register(successHandler, errorHandler, {"senderID":"%sender_id%","ecb":"onNotificationGCM"});
        } else {
            pushNotification.register(tokenHandler, errorHandler, {"badge":"true","sound":"true","alert":"true","ecb":"onNotificationAPN"});
        }
    }
            
    /* handle APNS notifications for iOS*/
    function onNotificationAPN(event) {
        if (event.alert) {
            navigator.notification.alert(event.alert);
        }
                
        if (event.sound) {
            var snd = new Media(event.sound);
            snd.play();
        }
                
        if (event.badge) {
            pushNotification.setApplicationIconBadgeNumber(successHandler, event.badge);
        }
    }
            
            
    function onNotificationGCM(e) {
        if(e.event == 'message'){
            if(e.payload.app_id == app_id)
                alert(e.message);
        }
    }
            
    function tokenHandler (result) {
        /*$("#app-status-ul").append('<li>token: '+ result +'</li>');*/
        /* Your iOS push server needs to know the token before it can push to this device*/
        /* here is where you might want to send it the token for later use.*/
    }
			
    function successHandler (result) {
        /*$("#app-status-ul").append('<li>success:'+ result +'</li>');*/
    }
            
    function errorHandler (error) {
        /*alert("function_errorHandler");*/
        /*$("#app-status-ul").append('<li>error:'+ error +'</li>');*/
    }
            
    document.addEventListener('deviceready', onDeviceReady, true);

</script>
