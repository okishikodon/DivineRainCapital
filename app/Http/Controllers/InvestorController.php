<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvestorController extends Controller
{
    public function privateDocuments()
    {
        // retrieve files from the storage disk
        $privateDocuments = Storage::disk('local')->files('uploads/private_documents');
    
        return view('investor.private-documents', compact('privateDocuments'));
    }

    public function legalDisclaimers()
    {
        // retrieve files from the storage disk
        $legalDisclaimers = Storage::disk('local')->files('uploads/legal_disclaimers');

        return view('investor.legal-disclaimers', compact('legalDisclaimers'));
    }

    public function performance()
    {
        // retrieve performance files
        $performanceFiles = Storage::disk('local')->files("uploads/performance");

        return view('investor.performance', compact('performanceFiles'));
    }

    public function investorReports()
    {
        // retrieve investor reports
        $investorReportFiles = Storage::disk('local')->files("uploads/investor_reports");

        return view('investor.investor-reports', compact('investorReportFiles'));
    }

    public function fundInformation()
    {
        // retrieve fund information files
        $fundInfoFiles = Storage::disk('local')->files("uploads/fund_information");

        return view('investor.fund-information', compact('fundInfoFiles'));
    }

    public function uploadFile(Request $request)
    {
        $user = Auth::user();
        $section = $request->input('category'); // 'private_documents' or 'legal_disclaimers'
        $file = $request->file('file');
    
        $subdirectory = config("filesystems.disks.$section.uploads_subdirectory"); // get the sub dir
    
        // store the file in the specified subdirectory
        $path = Storage::disk($section)->putFile($subdirectory, $file, 'public');
    
        return back()->with('success', 'File uploaded successfully.');
    }
}
