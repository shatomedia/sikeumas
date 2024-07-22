<?php

namespace App\Http\Controllers;

use App\Models\Ckeditor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CkeditorController extends Controller
{
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $ckeditorAsset = New Ckeditor();
                $ckeditorAsset->name = Str::uuid();
                $ckeditorAsset->save();

                $media = $ckeditorAsset->addMediaFromRequest('upload')
                    ->toMediaCollection('images');

                return response()->json(['fileName' => $media->file_name, 'uploaded' => 1, 'url' => $media->getUrl()]);
            }
        }catch (\Throwable $throwable){
            Log::error($throwable->getMessage());
        }

        return response()->json(['messages', 'Upload Invalid']);
    }
}
