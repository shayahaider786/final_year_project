<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use App\Models\Video;
use App\Models\Image;
use App\Models\User;

class CustomerController extends Controller
{
    public function show()
    {
        $customer = Auth::user()->customer;
        $customer->load(['images' => function ($query) {
            $query->where('is_public', true);  // Only show public images
        }]);
        return view('backend.show',compact('customer'));
    }
    public function showData($id)
    {
        $customer = User::find($id)?->customer;

        // Check if the customer exists
        if (!$customer) {
            return redirect()->route('some.route')->with('error', 'Customer not found.');
        }

        $customer->load('images');
        return view('backend.show', compact('customer'));
    }

    public function edit()
    {
        $customer = Auth::user()->customer; 
        $customer->load('images');
        return view('backend.userEdit', compact('customer'));
    }

    public function update(Request $request)
    {
        // $customer = Auth::user()->customer;

        // Validate the request data
        $request->validate([
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'file|mimetypes:video/mp4', // 50MB limit for video
            'public_videos' => 'nullable|array',
            'public_videos.*' => 'string',
        ]);

        // Update name field in the user table
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();
            // Access customer details
        $customer = $user->customer;

        // Process avatar update
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = 'images/';
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move($avatarPath, $avatarName);
            $customer->avatar = $avatarPath . $avatarName;
        }

        // Process images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $customer->images()->create(['imgname' => $imageName]);
            }
        }
         // Handle public/private images
        $publicImages = $request->input('public_images', []);  // Get array of public images
        foreach ($customer->images as $image) {
            $image->is_public = in_array($image->id, $publicImages);  // Mark image as public if it's in the array
            $image->save();
        }

        // Process video upload
        if ($request->hasFile('video')) {
            $videoPath = 'videos/';
            $videoName = time() . '_' . $request->file('video')->getClientOriginalName();
            $request->file('video')->move($videoPath, $videoName);

            // Delete existing video if it exists
            if ($customer->video) {
                Storage::delete($customer->video->path);
                $customer->video->delete();
            }

            // Save new video
            $video = new Video();
            $video->path = $videoPath . $videoName;
            $customer->video()->save($video);
        }

            // Update public visibility of the video
        if ($request->has('public_videos')) {
            $customer->video->is_public = true;
        } else {
            $customer->video->is_public = false;
        }

        $customer->video->save();
        // Update other fields
        $customer->detail = $request->input('detail');
        $customer->save();
        
        return redirect()->route('user.edit')->with('success', 'Profile updated successfully.');
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
}
