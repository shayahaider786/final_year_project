<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;


class FrontendController extends Controller
{
  public function index(){
    return view('frontend');
  }
}