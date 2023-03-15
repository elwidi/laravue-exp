<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RequestController extends Controller
{
  public function index()
  {
    $req = DB::table('users')->get();

    $data = [
      'totalItems' => count($req),
      'tutorials' => $req,
      'totalPages' => 1,
      'currentPages' => 1
    ];

    echo json_encode($data); exit;
  }
}
