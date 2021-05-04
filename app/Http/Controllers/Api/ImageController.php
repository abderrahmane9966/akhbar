<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{



    public function show()
    {
        $user = Auth::user();
        return new ImageResource($user->image);
    }


    public function store(Request $request)
    {

        $request->validate([
            'image_url' => 'required',
        ]);

        $image = new Image;

        $image->user_id = Auth::user()->id;


        if ($request->hasFile('image_url')) {
            $image->image_url = $request->image_url->store('image');
        }


        $image->save();
    }
}
