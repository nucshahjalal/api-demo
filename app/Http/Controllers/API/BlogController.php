<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Blog;
use App\Models\EncodeFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        // if (!$token) {
        //     return response()->json([
        //         'message' => 'Unauthorized. Bearer token missing.'
        //     ], 401);
        // }

        //$user = $request->user();

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
           // 'user_id' => $user ? $user->id : null, 
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

    public function encode(Request $request)
    {
        $request->validate([
            'file_name' => 'required|file'
        ]);

        $file = $request->file('file_name');

        // Convert file to base64
        $base64 = base64_encode(file_get_contents($file));

        $storedFile = EncodeFile::create([
            'file_name' => $base64,
        ]);

        return response()->json([
            'message' => 'File stored successfully',
            'data' => $storedFile
        ]);
    }

    public function decode(Request $request, $id)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized. Token missing.'
            ], 401);
        }
        $encodeFile = EncodeFile::findOrFail($id);

        $base64 = $encodeFile->file_name;

        $base64 = preg_replace('/^data:\w+\/\w+;base64,/', '', $base64);

        $fileData = base64_decode($base64);

        if ($fileData === false) {
            return response()->json([
                'message' => 'Invalid base64 data'
            ], 400);
        }

        $fileName = Str::random(10) . '.file';
        $filePath = 'uploads/' . $fileName;

        Storage::disk('public')->put($filePath, $fileData);

        return response()->json([
            'message' => 'File decoded successfully',
            'path' => $filePath,
            'url' => asset('storage/' . $filePath)
        ]);
    }

    public function decodePost(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $encodeFile = EncodeFile::findOrFail($request->id);

        $base64 = $encodeFile->file_name; 
        // Remove base64 prefix if exists
        $base64 = preg_replace('/^data:\w+\/\w+;base64,/', '', $base64);

        // Decode base64
        $fileData = base64_decode($base64);

        // Generate file name
        $fileName = Str::random(10) . '.file';
        $filePath = 'uploads/' . $fileName;

        Storage::disk('public')->put($filePath, $fileData);

        return response()->json([
            'message' => 'File decoded successfully',
            'path' => $filePath,
            'url' => asset('storage/' . $filePath)
        ]);
    }

    public function blogList(){

        $this->data['blogs'] = Blog::orderBy('id', 'desc')->get();
        return view('blog.index', $this->data);
    }

    public function blogCreate(){

        return view('blog.create');
    }

}
