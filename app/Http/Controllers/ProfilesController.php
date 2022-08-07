<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image as Image;


class ProfilesController extends Controller
{
    public function index(\App\Models\User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        // cache post count
        $postCount = Cache::remember(
            'count.posts' . $user->id, 
            now()->addSeconds(30), 
            function() use($user){
                return $user->posts->count();
            });
        // cache followers count
        $followersCount = Cache::remember(
            'count.followers' . $user->id, 
            now()->addSeconds(30), 
            function() use($user){
                return $user->profile->followers->count();
            });

        // cache following count
        $followingCount = Cache::remember(
            'count.following' . $user->id, 
            now()->addSeconds(30), 
            function() use($user){
                return $user->following->count();
            });


        
        return view('profiles.index' , compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }
    // edit controller
    public function edit(\App\Models\User $user)
    {
        // authorization
        $this->authorize('update', $user->profile);
        return view('profiles.edit' , compact('user'));
    }
    //udpate controller
    public function update(User $user)
    {
        // authorization
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);


        
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }


        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
