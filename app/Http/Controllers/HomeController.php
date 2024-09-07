<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Images;
use App\Models\CustomerData;
use Illuminate\Support\Facades\Crypt;

// use Barryvdh\DomPDF\Facade as PDF;
// use PDF;
use Illuminate\Support\Facades\Storage;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::with('user')->get();
        $customerCount = Customer::count();
        
        $decryptedPassword=[];
        foreach($customers as $customer){
            $decryptedPassword[$customer->user->id] = Crypt::decryptString($customer->user->password);
        }
        return view('home' , compact('customers', 'customerCount','decryptedPassword'));
    }
    public function showCustomer()
    {
        
        $customersData = CustomerData::all();
        return view('backend.customerData', compact('customersData'));
    }
    
    public function userHome()
    {
        return view('userHome');
    }


    // public function generatePDF()
    // {
    //     // Fetch the customer data
    //     $customer = Customer::with('user')->first(); // Assuming you're fetching a single customer

    //     // Retrieve SVG content
    //     $svgContent = Storage::disk('public')->get('qr_codes/' . $customer->user->id . '.svg');
    //     $data = [
    //         'svgContent' => $svgContent,
    //     ];
    //     $pdf = PDF::loadView('pdf.my_pdf', $data);
    //     // Return the PDF as a stream
    //     return $pdf->stream('document.pdf');
    // }


}
