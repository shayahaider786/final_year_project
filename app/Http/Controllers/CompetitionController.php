<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\CompetitionUserEntry;
use Illuminate\Support\Facades\Storage;


class CompetitionController extends Controller
{
    public function competitionMain(){
      $competitions = Competition::latest()->paginate(5);
        return view('competitionMain',compact('competitions'));
    }
    public function competitionInfo($id){
      $competition = Competition::findOrFail($id);

        return view('competitionInfo',compact('competition'));
    }
    public function storeUserEntry(Request $request, $competitionId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instagram_name' => 'nullable|string|max:255',
            'tiktok_name' => 'nullable|string|max:255',
            'youtube_name' => 'nullable|string|max:255',
            'terms' => 'accepted'
        ]);

        $competition = Competition::findOrFail($competitionId);

        $entry = new CompetitionUserEntry();
        $entry->name = $request->input('name');
        $entry->email = $request->input('email');
        $entry->instagram_name = $request->input('instagram_name');
        $entry->tiktok_name = $request->input('tiktok_name');
        $entry->youtube_name = $request->input('youtube_name');
        $entry->competition()->associate($competition);
        $entry->save();

        return redirect()->back()->with('success', 'Entry submitted successfully!');
    }
    public function competitionIndex(){
      $competitions = Competition::latest()->paginate(5);
        return view('backend.competitions.competitionIndex',compact('competitions'));
    }
    public function competitionCreate(){
        return view('backend.competitions.competitionCreate');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'video_path' => 'nullable|file|mimetypes:video/mp4|max:20480', // Adjust max size as needed
            'prize1_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust max size as needed
            'prize1_description' => 'nullable|string|max:255',
            'prize2_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prize2_description' => 'nullable|string|max:255',
            'prize3_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prize3_description' => 'nullable|string|max:255',
            'insta_link' => 'nullable|string|max:255',
            'tiktok_link' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
        ]);
    
        // Create a new Competition instance
        $competition = new Competition();
        $competition->name = $request->name;
        $competition->start_date = $request->start_date;
        $competition->end_date = $request->end_date;
        $competition->description = $request->description;
    
        // Handle video file upload
        if ($request->hasFile('video_path')) {
            $videoPath = 'videos/';
            $videoName = date('YmdHis') . '.' . $request->file('video_path')->getClientOriginalExtension();
            $request->file('video_path')->move(public_path($videoPath), $videoName);
            $competition->video_path = $videoPath . $videoName;
        }
    
        // Handle prize1 image file upload
        if ($image = $request->file('prize1_image_path')) {
            $prize1ImagePath = 'images/';
            $prize1ImageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($prize1ImagePath), $prize1ImageName);
            $competition->prize1_image_path = $prize1ImagePath . $prize1ImageName;
        }
        $competition->prize1_description = $request->prize1_description;
    
        // Handle prize2 image file upload
        if ($image = $request->file('prize2_image_path')) {
            $prize2ImagePath = 'images/';
            $prize2ImageName = date('YmdHis') . '_prize2.' . $image->getClientOriginalExtension();
            $image->move(public_path($prize2ImagePath), $prize2ImageName);
            $competition->prize2_image_path = $prize2ImagePath . $prize2ImageName;
        }
        $competition->prize2_description = $request->prize2_description;
    
        // Handle prize3 image file upload
        if ($image = $request->file('prize3_image_path')) {
            $prize3ImagePath = 'images/';
            $prize3ImageName = date('YmdHis') . '_prize3.' . $image->getClientOriginalExtension();
            $image->move(public_path($prize3ImagePath), $prize3ImageName);
            $competition->prize3_image_path = $prize3ImagePath . $prize3ImageName;
        }
        $competition->prize3_description = $request->prize3_description;
    
        // Save other fields
        $competition->insta_link = $request->insta_link;
        $competition->tiktok_link = $request->tiktok_link;
        $competition->youtube_link = $request->youtube_link;
    
        // Save the Competition model
        $competition->save();
    
        // Redirect with success message
        return redirect()->route('competitionIndex')->with('success', 'Competition created successfully!');
    }
    
    public function competitionEdit($id)
    {
        $competition = Competition::findOrFail($id);
        return view('backend.competitions.competitionEdit', compact('competition'));
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi',
            'prize1_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prize1_description' => 'nullable|string|max:255',
            'prize2_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prize2_description' => 'nullable|string|max:255',
            'prize3_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prize3_description' => 'nullable|string|max:255',
            'insta_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
        ]);

        // Find the competition by ID
        $competition = Competition::findOrFail($id);

        // Update basic fields
        $competition->name = $request->name;
        $competition->start_date = $request->start_date;
        $competition->end_date = $request->end_date;
        $competition->description = $request->description;

        // Update video if provided
        if ($request->hasFile('video_path')) {
            $videoPath = 'videos/';
            $videoName = date('YmdHis') . '.' . $request->file('video_path')->getClientOriginalExtension();
            $request->file('video_path')->move(public_path($videoPath), $videoName);

            // Check if the competition already has a video, if so, delete it
            if ($competition->video_path) {
                Storage::delete($competition->video_path);
            }

            $competition->video_path = $videoPath . $videoName;
        }

        // Update prize1 image if provided
        if ($request->hasFile('prize1_image_path')) {
            $prize1ImagePath = 'images/';
            $prize1ImageName = date('YmdHis') . '_prize1.' . $request->file('prize1_image_path')->getClientOriginalExtension();
            $request->file('prize1_image_path')->move(public_path($prize1ImagePath), $prize1ImageName);

            // Check if the competition already has a prize1 image, if so, delete it
            if ($competition->prize1_image_path) {
                Storage::delete($competition->prize1_image_path);
            }

            $competition->prize1_image_path = $prize1ImagePath . $prize1ImageName;
        }

        // Update prize2 image if provided
        if ($request->hasFile('prize2_image_path')) {
            $prize2ImagePath = 'images/';
            $prize2ImageName = date('YmdHis') . '_prize2.' . $request->file('prize2_image_path')->getClientOriginalExtension();
            $request->file('prize2_image_path')->move(public_path($prize2ImagePath), $prize2ImageName);

            // Check if the competition already has a prize2 image, if so, delete it
            if ($competition->prize2_image_path) {
                Storage::delete($competition->prize2_image_path);
            }

            $competition->prize2_image_path = $prize2ImagePath . $prize2ImageName;
        }

        // Update prize3 image if provided
        if ($request->hasFile('prize3_image_path')) {
            $prize3ImagePath = 'images/';
            $prize3ImageName = date('YmdHis') . '_prize3.' . $request->file('prize3_image_path')->getClientOriginalExtension();
            $request->file('prize3_image_path')->move(public_path($prize3ImagePath), $prize3ImageName);

            // Check if the competition already has a prize3 image, if so, delete it
            if ($competition->prize3_image_path) {
                Storage::delete($competition->prize3_image_path);
            }

            $competition->prize3_image_path = $prize3ImagePath . $prize3ImageName;
        }

        // Update other fields
        $competition->prize1_description = $request->prize1_description;
        $competition->prize2_description = $request->prize2_description;
        $competition->prize3_description = $request->prize3_description;
        $competition->insta_link = $request->insta_link;
        $competition->tiktok_link = $request->tiktok_link;
        $competition->youtube_link = $request->youtube_link;

        // Save the updated competition
        $competition->save();

        // Redirect back with a success message
        return redirect()->route('competitionIndex')->with('success', 'Competition updated successfully.');
    }

    public function destroy($id)
{
    // Find the competition by ID
    $competition = Competition::findOrFail($id);
    // Delete video file if exists
    if ($competition->video_path && file_exists(public_path($competition->video_path))) {
        unlink(public_path($competition->video_path));
    }
    // Delete prize1 image if exists
    if ($competition->prize1_image_path && file_exists(public_path($competition->prize1_image_path))) {
        unlink(public_path($competition->prize1_image_path));
    }
    // Delete prize2 image if exists
    if ($competition->prize2_image_path && file_exists(public_path($competition->prize2_image_path))) {
        unlink(public_path($competition->prize2_image_path));
    }
    // Delete prize3 image if exists
    if ($competition->prize3_image_path && file_exists(public_path($competition->prize3_image_path))) {
        unlink(public_path($competition->prize3_image_path));
    }
    // Delete the competition record
    $competition->delete();
    // Redirect back with a success message
    return redirect()->route('competitionIndex')->with('success', 'Competition deleted successfully!');
}

}
