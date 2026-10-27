<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TinyMceUploadController extends Controller
{
    public function uploadImage(Request )
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

         = auth()->user();
        if (!in_array(->role, ['super_admin', 'ppid_admin', 'editor'])) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        ->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

         = ->file('file');
         = strtolower(->getClientOriginalExtension());
         = Str::random(40) . '.' . ;
         = 'posts/content/' . date('Y') . '/' . date('m');
         = ->storeAs(, , 'public');

         = Storage::disk('public')->url();

        return response()->json(['location' => ]);
    }
}

