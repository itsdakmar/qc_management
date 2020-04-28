<?php

namespace App\Http\Controllers;

use App\Defect;

class HomeController extends Controller
{
    public $total, $created, $inprogress, $closed;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->total = Defect::count();
        $this->created = Defect::where('status', 1)->get()->count();
        $this->inprogress = Defect::where('status', 2)->get()->count();
        $this->closed = Defect::where('status', 3)->get()->count();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalCount = $this->total;
        $createdCount = $this->created;
        $inProgressCount = $this->inprogress;
        $closedCount = $this->closed;

        return view('dashboard', compact('totalCount','createdCount','inProgressCount','closedCount'));
    }
}
