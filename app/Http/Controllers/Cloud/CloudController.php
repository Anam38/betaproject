<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CloudController extends Controller
{
    public function index()
    {
      return view('contents.cloud.index');

    }
}
