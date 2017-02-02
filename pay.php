<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:4922a2e827541b7519cb91ca421c0664",
                  "X-Auth-Token:b0ba18008adeeaa5ef7500117744a3b1"));
$payload = Array(
    'purpose' => 'FIFA 16',
    'amount' => '2500',
    'phone' => '9962416408',
    'buyer_name' => 'John Doe',
    'redirect_url' => 'http://vitcmun.com/success.php',
    'send_email' => true,
    'webhook' => '',
    'send_sms' => true,
    'email' => 'pkpbhardwaj729@gmail.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

echo $response;
?>