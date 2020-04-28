<?php

namespace App\Http\Controllers;

use App\Defect;
use App\DefectType;
use App\Http\Requests\CaseRequest;
use App\Responsibility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\PdfToImage\Pdf;

class CaseController extends Controller
{
    public $total, $created, $inprogress, $closed;

    public function __construct()
    {
        $this->total = Defect::count();
        $this->created = Defect::where('status', 1)->get()->count();
        $this->inprogress = Defect::where('status', 2)->get()->count();
        $this->closed = Defect::where('status', 3)->get()->count();
    }

    /**
     * Display a listing of the users
     *
     * @param \App\User $model
     * @return \Illuminate\View\View
     */
    public function index(Defect $model)
    {
        $defects = $model->paginate(15);

        $totalCount = $this->total;
        $createdCount = $this->created;
        $inProgressCount = $this->inprogress;
        $closedCount = $this->closed;

        return view('cases.index', compact('defects','totalCount','createdCount','inProgressCount','closedCount'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $defectTypes = DefectType::all();
        $responsibilities = Responsibility::all();
        return view('cases.create', compact('defectTypes', 'responsibilities'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CaseRequest $request, Defect $model)
    {
        $fileName = $this->upload($request);
        $defect = $model->create($request->merge(['drawing' => $fileName, 'status' => 1])->all());

        foreach ($request->file('image') as $image){
            $path = $image->move(public_path().'/uploads/images/', $image->hashName());
            $defect->images()->create(['url' => basename($path)]);
        }

        return redirect()->route('case.index')->withStatus(__('Defect reporting successfully created.'));
    }

    private function upload(Request $request)
    {
        $file = Storage::disk('public_uploads')->put('uploads/drawing/', $request->file('file'));
        $hashName = Str::replaceLast('.pdf', '', $request->file('file')->hashName());
        $pathToPdf = Storage::disk('public_uploads')->path('uploads/drawing/' . basename($file));
        $pdf = new Pdf($pathToPdf);
        $pdf->getGhostscript()->setGsPath('C:\gs\gs952\bin\gswin64c.exe');
        $pdf->setOutputFormat('png')->saveImage($hashName);

        Storage::disk('public_uploads')->delete('uploads/drawing/' . basename($file));

        return $hashName . '.png';
    }

    /**
     * Show the form for editing the specified user
     *
     * @param $id
     * @return View
     */
    public function show($id)
    {
        $defect = Defect::find($id);
        $totalCount = $this->total;
        $createdCount = $this->created;
        $inProgressCount = $this->inprogress;
        $closedCount = $this->closed;
        $images = $defect->images->where('is_closed', NULL);
        $images_closed = $defect->images->where('is_closed', 1);

        $url = "https://www.google.com/maps/search/?api=1&query=".$defect->latitude.",".$defect->longitude;
        return view('cases.show', compact('defect','url', 'images', 'images_closed','totalCount','createdCount','inProgressCount','closedCount'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param $id
     * @param \App\Defect $defect
     * @return View
     */
    public function edit($id)
    {
        $defect = Defect::findOrFail($id);
        $defectTypes = DefectType::all();
        $responsibilities = Responsibility::all();

        return view('cases.edit', compact('defect','defectTypes','responsibilities'));
    }

    /**
     * Update the specified user in storage
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $defectId)
    {
        $defect = Defect::findOrFail($defectId);
        $defect->update($request->all());

        return redirect()->route('case.index')->withStatus(__('Report information successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param \App\Defect $defect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Defect $defect)
    {
        $defect->delete();

        return redirect()->route('case.index')->withStatus(__('Report successfully deleted.'));
    }

    public function closed_report(Request $request){
        $defect = Defect::findOrFail($request->get('report_id'));

        foreach ($request->file('image') as $image){
            $path = $image->move(public_path().'/uploads/images/', $image->hashName());
            $defect->images()->create(['url' => basename($path), 'is_closed' => 1]);
        }

        $defect->closed_remark = $request->get('closed_remark');
        $defect->status = $request->get('status');
        $defect->closed_date = Carbon::now()->toDateTimeString();
        $defect->save();

        return redirect()->route('case.index')->withStatus(__('Report information successfully closed.'));

    }
}
