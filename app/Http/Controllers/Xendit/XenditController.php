<?php

namespace App\Http\Controllers\Xendit;

use App\Http\Controllers\Controller;
use App\Xendit\XenditPHPClient;
use Illuminate\Http\Request;

class XenditController extends Controller
{
    public function index()
    {
      $options['secret_api_key'] = env('SECRET_XENDIT_KEY');

      $xenditPHPClient = new XenditPHPClient($options);

      $external_id = 'demo_1475459775872';
      $bank_code = 'BNI';
      $name = 'Rika Sutanto';
      // $response = $xenditPHPClient->getVirtualAccountBanks();

     $response = $xenditPHPClient->createCallbackVirtualAccount($external_id, $bank_code, $name);
      dd($response);
    }
}
