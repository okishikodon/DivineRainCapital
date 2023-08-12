<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicFileController extends Controller
{
    public function showPitchDeck()
    {
        $pitchDeckFiles = Storage::disk('public')->files('pitch_deck');
        return view('public.pitch-deck', compact('pitchDeckFiles'));
    }

    public function showReports()
    {
        $reportFiles = Storage::disk('public')->files('reports');
        return view('public.reports', compact('reportFiles'));
    }

    public function uploadPitchDeck(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('public/pitch-deck');

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function uploadReport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
    
        $filePath = $request->file('file')->store('public/reports');
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
}