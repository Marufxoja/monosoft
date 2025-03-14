<?php
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $client_id = 'test_profile';//Hukmat portali orqali beriladi
    $client_secret = 'test_profile';////Hukmat portali orqali beriladi
    $redirect_uri = 'https://yourwebsite.com/callback.php';

    // Token olish uchun POST so'rovini yuborish
    $url = 'https://sso.egov.uz/sso/oauth/Token.do';

    $data = array(
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
        'client_id' => $client_id,
        'client_secret' => $client_secret
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        die('Error occurred');
    }

    // JSON formatida qaytgan ma'lumotni qaytarish
    $response = json_decode($result, true);

    // Access tokenni olish
    if (isset($response['access_token'])) {
        $access_token = $response['access_token'];
        $_SESSION['access_token'] = $access_token; // Access tokenni saqlash

        // Endi foydalanuvchi ma'lumotlarini olish mumkin
        echo "Access Token: " . $access_token;
    } else {
        echo "Token olishda xato yuz berdi!";
    }
}
?>
