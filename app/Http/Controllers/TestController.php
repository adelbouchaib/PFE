<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\helper;


class TestController extends Controller
{
    public function index()
{
    Helper::matricule();
}
    

}
