<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;

class BlogController extends Controller
{
    public $data = array();

    public function index(Request $request){

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized. Token missing.'
            ], 401);
        }
        return Blog::all();
    }

    //token use
    public function store(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized. Bearer token missing.'
            ], 401);
        }

        $user = $request->user();

        $request->validate([
            'name'    => 'nullable|string|max:255',
            'image'   => 'nullable',          
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePaths = [];

        if ($request->hasFile('image')) {

            $files = $request->file('image');

            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $img) {
                $name = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $path = $img->storeAs('fileUpload', $name, 'public');
                $imagePaths[] = $path;
            }
        }

        $blog = Blog::create([
            'user_id' => $user ? $user->id : null, 
            'name'    => $request->name,
            'image'   => $imagePaths
        ]);

        return response()->json([
            'message' => 'File upload created successfully',
            'data'    => $blog
        ], 201);
    }

    //without token use
    public function store2(Request $request)
    {
        $request->validate([
            'name'    => 'nullable|string|max:255',
            'image'   => 'nullable',          
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePaths = [];

        if ($request->hasFile('image')) {

            $files = $request->file('image');

            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $img) {
                $name = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $path = $img->storeAs('fileUpload', $name, 'public');
                $imagePaths[] = $path;
            }
        }

        $blog = Blog::create([
            'name'  => $request->name,
            'image' => $imagePaths
        ]);

        return response()->json([
            'message' => 'File upload created successfully',
            'data'    => $blog
        ], 201);
    }

}
