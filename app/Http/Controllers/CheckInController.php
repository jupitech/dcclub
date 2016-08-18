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
           //$apidev=$devdonc->request('GET', 'http://doncampeon.app/api/v1/checkin/paquete/'.$paquete);
          $apidev=$devdonc->request('GET', 'https://devdonccscg.com/api/v1/checkin/paquete/'.$paquete);
          $miconte=$apidev->getBody()->getContents();
          
          return  $miconte;
           // return response()->json([$miconte],200);
    }
    
}
