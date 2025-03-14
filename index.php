<?php
session_start();

if (isset($_SESSION['access_token'])) {
    $access_token = $_SESSION['access_token'];

    // Foydalanuvchi ma'lumotlarini olish
    $url = 'https://sso.egov.uz/api/user/profile';

    $options = array(
        'http' => array(
            'header'  => "Authorization: Bearer $access_token\r\n",
            'method'  => 'GET'
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        die('Error occurred');
    }

    $user_data = json_decode($result, true);

    // Foydalanuvchi ma'lumotlarini chiqarish
    echo "Full Name: " . $user_data['full_name'] . "<br>";
    echo "First Name: " . $user_data['first_name'] . "<br>";
    echo "Middle Name: " . $user_data['mid_name'] . "<br>";
    echo "PIN: " . $user_data['pin'] . "<br>";
    echo "Document Number: " . $user_data['doc_num'] . "<br>";
    echo "Surname: " . $user_data['sur_name'] . "<br>";
    echo "User ID: " . $user_data['user_id'] . "<br>";
    echo "Valid: " . $user_data['valid'] . "<br>";
    echo "Auth Method: " . $user_data['auth_method'] . "<br>";
    echo "Legal TIN: " . $user_data['pkcs_legal_tin'] . "<br>";
} else {
    echo "Foydalanuvchi tizimga kirish uchun token olishda xato yuz berdi.";
}
?>
