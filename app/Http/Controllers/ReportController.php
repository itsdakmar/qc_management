<?php

namespace App\Http\Controllers;

use App\Defect;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request){
        $reportId = $request->get('report_id');
        $defect = Defect::findOrFail($reportId);
        $images = $defect->images->where('is_closed', NULL);
        $images_closed = $defect->images->where('is_closed', 1);

        return view('report.index', compact('defect','images','images_closed'));

    }
}
