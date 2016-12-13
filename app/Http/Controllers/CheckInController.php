<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use SoapClient;

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
         //$apidev=$devdonc->request('GET', 'http://doncampeon.app/api/v1/checkin/paquete/'.$paquete);
         $apidev=$devdonc->request('GET', 'https://devdonccscg.com/api/v1/checkin/paquete/'.$paquete);
          $miconte=$apidev->getBody()->getContents();
          
          return  $miconte;
           // return response()->json([$miconte],200);
    }

     public function storecheck(Request $request)
    {

      $action = 'AuthorizeCapture';
      /*$accountid = env('ACCOUNTID_BILLPRO');
      $authcode =  env('ACCOUNTAUTH_BILLPRO');*/
        $accountid = 43635166;
      $authcode =  'TTGtcutavepsZvRJ';
      $reference = 'Test Example Transaction';
      $amount=0.10;
      $currency='USD';
      $email='info@jupi.tech';
      $uip='45.55.212.97';
      $phone = '123123123';
      $dob = '19810530'; // 30th May 1981
      $ssn = '4344';
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

        $dte=array(
            'AccountID'=> $accountid,
            'AccountAuth'=> $authcode,
            'Transaction'=> array(
                     'Reference'=> $reference,
                     'Amount'=> $amount,
                     'Currency'=>$currency,
                     'IPAddress'=>$uip,
                     'Phone' => $phone,
                     'FirstName' =>  $FirstName,
                     'LastName' => $LastName,
                     'DOB' =>  $dob,
                     'SSN' => $ssn,
                     'Address' => $Address,
                     'City' => $City,
                     'State' => $State,
                     'PostCode' => $PostCode,
                     'Country' => $Country,
                     'CardNumber' => $CardNumber,
                     'CardExpMonth' => $mm,
                     'CardExpYear' => $aa,
                     'CardCVV' =>  $cvv
              )

          );

        try{
            $client = new \SoapClient('https://gateway.billpro.com/?wsdl',array( 'exceptions' => 1)); 

             $resultado=$client->AuthorizeCapture($dte);

        } catch (SoapFault $E) { 
          $objResponse->addAlert($E->faultstring);
      }


     /*
        // Add a new service to the wrapper
            SoapWrapper::add(function ($service) {
               $service
               ->name('billpro')
               ->wsdl('https://gateway.billpro.com/')
               ->trace(true);
             });
       
        // Using the added service
        SoapWrapper::service('billpro', function ($service) use ($dte) {

        var_dump($service->call('AuthorizeCapture', [$dte]));
        });
  
    
*/
 
       
       /**
        * Pruebas con Guzzle
        * @var GuzzleHttpClient
        */
       
       /*
        $billpro= new GuzzleHttpClient();

        $response  = $billpro->request('POST', 'https://www.billpro.com/payment/', [
              'query' => [
                  'acid' => $accountid,
                  'auth' =>  $authcode,
                  'successurl' => 'https://www.doncampeon.club/',
                  'Reference' => 'abc',
                  'product' => '123',
                  'amount' => $amount,
                  'description' => 'Prueba de producto',
                  'FirstName' =>  $FirstName,
                  'LastName' => $LastName,
                  'Address' => $Address,
                  'City' => $City,
                  'Country' => $Country,
                  'State' => $State,
                  'PostCode' => $PostCode,
                  'Phone' => $phone,
                  'Email' =>  $Email,
                  'CardNumber' => $CardNumber,
                  'ExpMonth' => $mm,
                  'EXpYear' => $aa,
                  'CardCVV' =>  $cvv
              ]
          ]);


              return $response->getBody()->getContents();
         */
        
             

    }
    
}
