<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RequestController extends Controller
{
  public function index()
  {
    $req = DB::table('request')->first();

    echo json_encode($req); exit;
  }
}
