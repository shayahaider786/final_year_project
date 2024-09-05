<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        
        Contact::create($request->all());
         
        return redirect()->route('index')
                        ->with('success','Your Information Added Successfully.');
    }
}
