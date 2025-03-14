<?php
$client_id = 'test_profile'; //Hukmat portali orqali beriladi
$redirect_uri = 'https://yourwebsite.com/callback.php'; // Sizning qaytish manzilingiz
$state = 'testState'; // Xavfsizlik uchun holat

$auth_url = "https://sso.egov.uz/sso/oauth/Authorization.do?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=profile&state=$state";

header("Location: $auth_url");
exit;
?>
