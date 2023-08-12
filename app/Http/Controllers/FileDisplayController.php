<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileDisplayController extends Controller
{
    public function show($category)
    {
        $files = Storage::disk('local')->files("uploads/{$category}");

        return view('files.index', compact('files', 'category'));
    }

    public function showSingle($category, $file)
    {
        $filePath = "uploads/{$category}/{$file}";
        $fileExists = Storage::disk('local')->exists($filePath);
    
        if ($fileExists) {
            return response()->file(Storage::disk('local')->path($filePath));
        }
    
        abort(404);
    }    
}
