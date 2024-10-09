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

class BackendController extends Controller
{
    public function index(){
        return view('index');
    }
  
    public function login(){
        return view('backend.login');
    }
    public function create(){
        return view('backend.create');
    }
    public function genrateqr(){
        return view('backend.genrateqr');
    }

    public function store(Request $request){
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'video' => 'file|mimetypes:video/mp4', // Add validation rule for video
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userInput = $request->only(['name', 'email', 'password']); // Get user input
        // $userInput['password'] = Hash::make($request->password); // Hash password
        $password = $request->password; // Generate a random password
        $hashedPassword = Crypt::encryptString($password);
        $userInput['password']=$hashedPassword;

        $user = User::create($userInput); // Create the user record

        $customerInput = $request->except(['images', 'name', 'email', 'password']); // Get customer input
        $customerInput['detail'] = $request->detail;

        if ($avatar = $request->file('avatar')) {
            $avatarPath = 'images/';
            $avatarImageName = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
            $avatar->move($avatarPath, $avatarImageName);
            $customerInput['avatar'] = $avatarPath . $avatarImageName;
        }

        // Create the customer record
        $customer = $user->customer()->create($customerInput);

        // Store the uploaded video
        if ($request->hasFile('video')) {
            $videoPath = 'videos/';
            $videoName = date('YmdHis') . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move($videoPath, $videoName);

            // Create a new video record associated with the customer
            $video = $customer->video()->create([
                'path' => $videoPath . $videoName,
            ]);
        }

        // Process uploaded images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . rand(1, 99) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $customer->images()->create(['imgname' => $imageName]);
            }
        }

        $qrCode = QrCode::size(100)->generate(route('user.showData', $customer->user->id));
        $filename = 'qr_codes/' . $customer->user->id . '.svg';
        Storage::disk('public')->put($filename, $qrCode);
        $publicUrl = Storage::disk('public')->url($filename);

        return redirect()->route('home')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer){
        $customer->load('images');
        return view('backend.edit',compact('customer'));
    }
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'file|mimetypes:video/mp4', // Add validation rule for video
        ]);
    
        // Update user's name
        $user = $customer->user;
        $user->name = $request->name;
        $user->save();
    
        // Exclude the 'name' field from the request
        $customerInput = $request->except(['images', '_method', '_token','name']);
    
        // Check if an avatar is uploaded and update it
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = 'images/';
            $avatarImageName = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
            $avatar->move($avatarPath, $avatarImageName);
            $customerInput['avatar'] = $avatarPath . $avatarImageName;
        }
    
        // Process uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . rand(1, 99) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $customer->images()->create(['imgname' => $imageName]);
            }
        }
    
        // Update the video if a new one is uploaded
        if ($request->hasFile('video')) {
            $videoPath = 'videos/';
            $videoName = date('YmdHis') . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move($videoPath, $videoName);
    
            // Check if the customer already has a video, if so, delete it
            if ($customer->video) {
                Storage::delete($customer->video->path);
                $customer->video()->delete();
            }
    
            // Create a new video record associated with the customer
            $customer->video()->create([
                'path' => $videoPath . $videoName,
            ]);
        }
    // dd($request->input('deleted_images'));
        if ($request->has('deleted_images')) {
            foreach ($request->input('deleted_images') as $imageId) {
                $image = Image::findOrFail($imageId);
                Storage::delete('images/' . $image->imgname); // Assuming images are stored in storage/app/public/images
                $image->delete();
            }
        }
    
        // Update the customer record
        $customer->update($customerInput);
    
        return redirect()->route('home')->with('success', 'Customer updated successfully.');
    }    
    
    public function show(Customer $customer)
    {
        $customer->load('images');
        return view('backend.show',compact('customer'));
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->user->delete();
        $customer->delete();
    
        return redirect()->back()->with('success', 'Customer and associated user deleted successfully.');
    }

    public function deleteImg($id)
    {
        $image = Image::find($id);
        if ($image) {
            $image->delete();
            return redirect()->back()->with('success', 'Image deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Image not found.');
        }
    }

    public function deleteVideo($videoPath)
    {
        // Find the video record by its path
        $video = Video::where('path', $videoPath)->first();

        if (!$video) {
            return response()->json(['error' => 'Video not found'], 404);
        }
        Storage::delete($videoPath);
        $video->delete();

        return response()->json(['message' => 'Video deleted successfully'], 200);
    }

}
