<?php
$paypal_report_url = 'http://otservteam/paypal_report.php';
$paypal_return_url = 'http://otsetrvteam/?subtopic=paypal';
$paypal_image = 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif';
$paypal_payment_type = '_xclick'; // '_xclick' (Buy Now) or '_donations'

$paypals[0]['mail'] = 'yourmail@gmail.com'; // your paypal login
$paypals[0]['name'] = '200 premium points on server otservteam.com for 2 EURO';
$paypals[0]['money_amount'] = '2';
$paypals[0]['money_currency'] = 'EUR'; // USD, EUR, more codes: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes
$paypals[0]['premium_points'] = 200;

$paypals[1]['mail'] = 'yourmail@gmail.com'; // your paypal login
$paypals[1]['name'] = '550 premium points on server otservteam.com for 5 EURO';
$paypals[1]['money_amount'] = '5';
$paypals[1]['money_currency'] = 'EUR'; // USD, EUR, more codes: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes
$paypals[1]['premium_points'] = 550;

$paypals[2]['mail'] = 'yourmial@gmail.com'; // your paypal login
$paypals[2]['name'] = '1200 premium points on server otservteam.com for 10 EURO';
$paypals[2]['money_amount'] = '10';
$paypals[2]['money_currency'] = 'EUR'; // USD, EUR, more codes: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes
$paypals[2]['premium_points'] = 1200;
