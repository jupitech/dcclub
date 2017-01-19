<?php
// Declare Variables
$action = 'AuthorizeCapture';
$accountid = '43635166';
$authcode = 'TTGtcutavepsZvRJ';
$reference = 'Paquete 1';
$amount = '2.00'; // will provide success response
$currency = 'USD';
$email = 'techsupport@billpro.com';
$uip = '45.55.212.97'; // this must be your REAL ip address
$phone = '123123123';
$firstname = 'Carlos';
$lastname = 'Ruano';
$dob = '19810530'; // 30th May 1981
$ssn = '4344';
$address ='Guatemala';
$city = 'Guatemala';
$state = 'Guatemala';
$postcode = '01001';
$countrycode = 'GT';
$card_no = '4313540764111224';
$card_exp_month = '05';
$card_exp_year = '2019';
$card_cvv = '974';
$posturl = 'https://gateway.billpro.com';

$xmlquerybuild = '<?xml version="1.0" encoding="utf-8"?>
<Request type="'.$action.'">
<AccountID>'.$accountid.'</AccountID>
<AccountAuth>'.$authcode.'</AccountAuth>
<Transaction>
<Reference>'.$reference.'</Reference>
<Amount>'.$amount.'</Amount>
<Currency>'.$currency.'</Currency>
<Email>'.$email.'</Email>
<IPAddress>'.$uip.'</IPAddress>
<Phone>'.$phone.'</Phone>
<FirstName>'.$firstname.'</FirstName>
<LastName>'.$lastname.'</LastName>
<DOB>'.$dob.'</DOB>
<SSN>'.$ssn.'</SSN>
<Address>'.$address.'</Address>
<City>'.$city.'</City>
<State>'.$state.'</State>
<PostCode>'.$postcode.'</PostCode>
<Country>'.$countrycode.'</Country>
<CardNumber>'.$card_no.'</CardNumber>
<CardExpMonth>'.$card_exp_month.'</CardExpMonth>
<CardExpYear>'.$card_exp_year.'</CardExpYear>
<CardCVV>'.$card_cvv.'</CardCVV>
</Transaction>
</Request>';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $posturl);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlquerybuild);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$result = curl_exec($ch);
curl_close($ch);
$xmlresult = simplexml_load_string($result);
// Simple display of the end result
if(isset($xmlresult->ResponseCode)) { $responsecode = $xmlresult->ResponseCode; }
if(isset($xmlresult->Description)) { $msg = $xmlresult->Description; }
if(isset($xmlresult->Reference)) { $reference = $xmlresult->Reference; }
if(isset($xmlresult->TransactionID)) { $txid = $xmlresult->TransactionID; }
if(isset($xmlresult->ProcessingTime)) { $processingtime = $xmlresult->ProcessingTime; }
if(isset($xmlresult->StatusCode)) { $statuscode = $xmlresult->StatusCode; }
if(isset($xmlresult->StatusDescription)) { $statusdescription = $xmlresult->StatusDescription; }
if(isset($responsecode)) {
if($responsecode != '100') { $status = "ERROR"; echo $msg; }
if($responsecode == '100') { $status = "SUCCESS"; echo $msg; }
} else {
$status = "ERROR";
}
?>