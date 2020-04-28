<?php

namespace App\Http\Controllers;


use App\Defect;
use App\Role;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RoleController extends Controller
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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Roles
     *
     * @param Role $model
     * @return View
     */
    public function index(Role $model)
    {
        $totalCount = $this->total;
        $createdCount = $this->created;
        $inProgressCount = $this->inprogress;
        $closedCount = $this->closed;
        $roles = $model->paginate(15);

        return view('roles.index', compact('roles','totalCount','createdCount','inProgressCount','closedCount'));
    }

    /**
     * Show the form for creating a new role
     *
     * @return View
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  Request  $request
     * @param Role $model
     * @return RedirectResponse
     */
    public function store(Request $request, Role $model)
    {
        $model->create($request->merge(['guard_name' => 'web' ])->all());

        return redirect()->route('role.index')->withStatus(__('Role successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified user in storage
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role  $role)
    {
        $role->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
                ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Role  $role)
    {
        $role->delete();

        return redirect()->route('role.index')->withStatus(__('Role successfully deleted.'));
    }
}
