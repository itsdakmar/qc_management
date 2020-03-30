<?php

namespace App\Http\Controllers;

use App\Defect;
use App\DefectType;
use App\Http\Requests\CaseRequest;
use App\Responsibility;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Spatie\PdfToImage\Exceptions\PdfDoesNotExist;
use Spatie\PdfToImage\Pdf;

class CaseController extends Controller
{

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Defect $model)
    {
               return view('cases.index', ['defects' => $model->paginate(15)]);
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
        return view('cases.create', compact('defectTypes','responsibilities'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CaseRequest $request, Defect $model)
    {
        $fileName = $this->upload($request);
        $model->create($request->merge(['image' => $fileName])->all());
        return redirect()->route('case.index')->withStatus(__('Defect reporting successfully created.'));
    }

    private function upload(Request $request){
        $file = Storage::disk('public_uploads')->put('uploads/drawing/', $request->file('file'));
        $hashName = Str::replaceLast('.pdf','',$request->file('file')->hashName());
        $pathToPdf = Storage::disk('public_uploads')->path('uploads/drawing/'.basename($file));
        $pdf = new Pdf($pathToPdf);
        $pdf->getGhostscript()->setGsPath('C:\gs\gs952\bin\gswin64c.exe');
        $pdf->setOutputFormat('png')->saveImage($hashName);

        Storage::disk('public_uploads')->delete('uploads/drawing/'.basename($file));

        return $hashName.'.png';
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\Defect  $model
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('cases.show', ['defect' => Defect::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
                ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
