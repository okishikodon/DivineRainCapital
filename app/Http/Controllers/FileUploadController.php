<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
            'category' => 'required|in:private_documents,legal_disclaimers,performance,investor_reports,fund_information,pitch_deck,reports',
        ]);
    
        $category = $request->input('category');
        $originalFileName = $request->file('file')->getClientOriginalName();
    
        // store file(s) in the appropriate directory based on the selected category
        $filePath = $request->file('file')->storeAs($category, $originalFileName, 'public');
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    

}
