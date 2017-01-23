<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use SoapClient;
use SoapFault;

class CheckInController extends Controller
{


public function __construct() {
//    parent::__construct();
    ini_set('soap.wsdl_cache_enabled', 0);
    ini_set('soap.wsdl_cache_ttl', 0);
    ini_set('default_socket_timeout', 300);
    ini_set('max_execution_time', 0);
}


      public function indexuser($token)
    {
          $devdonc= new GuzzleHttpClient();
        //$apidev=$devdonc->request('GET', 'http://donchamps.app/api/v1/checkin/'.$token);
        $apidev=$devdonc->request('GET', 'https://devdonccscg.com/api/v1/checkin/'.$token);
          $miconte=$apidev->getBody()->getContents();
          
          return  $miconte;
           // return response()->json([$miconte],200);
    }
     public function indexpaquete($paquete)
    {
          $devdonc= new GuzzleHttpClient();
         //$apidev=$devdonc->request('GET', 'http://donchamps.app/api/v1/checkin/paquete/'.$paquete);
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
     /* $accountid = '43635166';
      $authcode =  'TTGtcutavepsZvRJ';*/
      $referencia = $request['Referencia'];
      //$amount= $request['Amount'];
      $amount='1.00';
      $currency='USD';
      $email='info@jupi.tech';
      $uip='45.55.212.97';
      $phone = '50257401297';
      $posturl = 'https://gateway.billpro.com';
      //Datos recibidos
        $FirstName=$request['FirstName'];
        $LastName=$request['LastName'];
        $Email=$request['Email'];
        $Address=$request['Address'];
        $City=$request['City'];
        $State=$request['State'];
        $PostCode=$request['PostCode'];
        $Country='GT';
        $CodEnvio=$request['CodEnvio'];
      //Conviertiendo codenvio

        $tarp3=substr($CodEnvio, 0, -19);
        $cvv=substr($CodEnvio, 4, -16); 
        $tarp4=substr($CodEnvio, 7, -12);
        $aa='20'.substr($CodEnvio, 11, -10);
        $tarp1=substr($CodEnvio, 13, -6); 
        $mm=substr($CodEnvio, 17, -4);
        $tarp2=substr($CodEnvio, 19);

        $CardNumber= $tarp1.$tarp2.$tarp3.$tarp4;


        $xmlquerybuild = '<?xml version="1.0" encoding="utf-8"?>
                  <Request type="'.$action.'">
                        <AccountID>'.$accountid.'</AccountID>
                        <AccountAuth>'.$authcode.'</AccountAuth>
                        <Transaction>
                              <Reference>'.$referencia.'</Reference>
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
                  if($responsecode != '100') { $status = "ERROR";
                      return response()->json(['codigo_respuesta' =>$responsecode,'descripcion' =>$msg,'referencia' =>$reference,'id_transaccion' =>$txid,'tiempo_respuesta' =>$processingtime, 'codigo_status' =>$statuscode,'descripcion_status' =>$statusdescription],400);
                 }
                  if($responsecode == '100') { $status = "SUCCESS"; 
                     return response()->json(['codigo_respuesta' =>$responsecode,'descripcion' =>$msg,'referencia' =>$reference,'id_transaccion' =>$txid,'tiempo_respuesta' =>$processingtime, 'codigo_status' =>$statuscode,'descripcion_status' =>$statusdescription],200);
                   }
                  } else {
                  $status = "ERROR";

                    return response()->json(['ERROR' => $status],400);
                  }


             

    }
    
}
