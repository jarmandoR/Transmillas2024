<?php
    
    function sendPushNotification($to = '', $data = array()) {
        
        $apiKey = 'AAAAsbfBaqU:APA91bFcjsCHuzMddz8qtcFZPJ5-vh7tosqbcI3DQLb0wjOkhFX1WgfIkquHFjXeB-1AWXWD11eaPhvrvLn-uVEkZPDv2eZZkOCRpXUVjVA3SNMI0g_3wbn-sp1Jd6Cq-JAdRcVo6zDj';
        $fields = array(
                        'to' => $to,
                        'data' => $data,
                        );
        
        $headers = array('Authorization: key='.$apiKey, 'Content-Type: application/json');
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        echo json_encode($fields);
        echo "<br><br>RESPUESTA SERVIDOR: ";
        
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return json_decode($result, true);
    }
    
    // DATOS DE  LOS DESTINATARIOS
    //$to = "cOXj3NXmBD8:APA91bEVt28g81V6bPl-NJxW8KiWaySnCBXy3gyGkusRRELoqKhONpsFp8P2tlBq7uPNh0H-zKEo55rKflqb0imDsw99j--u-OkLN1TRSA11AwItdqrPRGrwoCf1VPV7XgFJIveYSHa2";
    $to = "/topics/dispositivos";
    
    // DATOS DE LA NOTIFICACION
    $data = array(
                  'title' => 'Server',
                  'body' => 'Nuevo mensaje',
                  );
    
    //sendPushNotification($to,  $data)
    print_r(sendPushNotification($to,  $data));
    
    ?>
