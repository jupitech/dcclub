<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class CheckInController extends Controller
{
      public function indexuser($token)
    {
          $devdonc= new GuzzleHttpClient();
         // $apidev=$devdonc->request('GET', 'http://doncampeon.app/api/v1/checkin/'.$token);
         $apidev=$devdonc->request('GET', 'https://devdonccscg.com/api/v1/checkin/'.$token);
          $miconte=$apidev->getBody()->getContents();
          
          return  $miconte;
           // return response()->json([$miconte],200);
    }
     public function indexpaquete($paquete)
    {
          $devdonc= new GuzzleHttpClient();
          // $apidev=$devdonc->request('GET', 'http://doncampeon.app/api/v1/checkin/paquete/'.$paquete);
          $apidev=$devdonc->request('GET', 'https://devdonccscg.com/api/v1/checkin/paquete/'.$paquete);
          $miconte=$apidev->getBody()->getContents();
          
          return  $miconte;
           // return response()->json([$miconte],200);
    }

     public function storecheck(Request $request)
    {

      $action = 'AuthorizeCapture';
      $accountid = env('ACCOUNTID_BILLPRO');
      $authcode =  env('ACCOUNTAUTH_BILLPRO');
      $reference = 'Test Example Transaction';
      $amount=0.10;
      $currency='USD';
      $email='info@jupi.tech';
      $uip='127.0.0.1';
      $phone = '123123123';
      $posturl = 'https://gateway.billpro.com';
      //Datos recibidos
        $FirstName=$request['FirstName'];
        $LastName=$request['LastName'];
        $Email=$request['Email'];
        $Address=$request['Address'];
        $City=$request['City'];
        $State=$request['State'];
        $PostCode=$request['PostCode'];
        $Country=$request['Country'];
        $CodEnvio=$request['CodEnvio'];
      //Conviertiendo codenvio

        $tarp3=substr($CodEnvio, 0, -19);
        $cvv=substr($CodEnvio, 4, -16); 
        $tarp4=substr($CodEnvio, 7, -12);
        $aa=substr($CodEnvio, 11, -10);
        $tarp1=substr($CodEnvio, 13, -6); 
        $mm=substr($CodEnvio, 17, -4);
        $tarp2=substr($CodEnvio, 19);

        $CardNumber= $tarp1.$tarp2.$tarp3.$tarp4;
        

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
                          <FirstName>'.$FirstName.'</FirstName>
                          <LastName>'.$LastName.'</LastName>
                          <Address>'.$Address.'</Address>
                          <City>'.$City.'</City>
                          <State>'.$State.'</State>
                          <PostCode>'.$PostCode.'</PostCode>
                          <Country>'.$Country.'</Country>
                          <CardNumber>'.$CardNumber.'</CardNumber>
                          <CardExpMonth>'.$mm.'</CardExpMonth>
                          <CardExpYear>'.$aa.'</CardExpYear>
                          <CardCVV>'.$cvv.'</CardCVV>
                          </Transaction>
                          </Request>';
            $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $posturl);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
                  curl_setopt($ch, CURLOPT_POST, 1);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlquerybuild);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
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
                  if($responsecode != '100') {
                     $status = 'Error al procesar la tarjeta';
                      $mirespuesta=([
                               'ResponseCode' => $responsecode,
                               'Status' => $status,
                               'Description' => $msg,
                               'Reference' => $reference,
                               'TransactionID' => $txid,
                               'ProcessingTime' => $processingtime,
                               'StatusCode' => $statuscode,
                               'StatusDescription' => $statusdescription,
                         ]);
                    return response()->json(['error' => $mirespuesta],200);
                    }
                  if($responsecode == '100') { 
                    $status = 'Tarjeta Aceptada Correctanmente';
                    $mirespuesta=([
                               'ResponseCode' => $responsecode,
                               'Status' => $status,
                               'Description' => $msg,
                               'Reference' => $reference,
                               'TransactionID' => $txid,
                               'ProcessingTime' => $processingtime,
                               'StatusCode' => $statuscode,
                               'StatusDescription' => $statusdescription,
                         ]);
                      return response()->json(['datos' => $mirespuesta],200);
                     }
                  } else {
                       $status = 'Error al procesar la tarjeta';
                      $mirespuesta=([
                               'ResponseCode' => $responsecode,
                               'Status' => $status,
                               'Description' => $msg,
                               'Reference' => $reference,
                               'TransactionID' => $txid,
                               'ProcessingTime' => $processingtime,
                               'StatusCode' => $statuscode,
                               'StatusDescription' => $statusdescription,
                         ]);
                  return response()->json(['error' => $mirespuesta],200);
                  }              

    }
    
}
