<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Interfaces\RoleRepositoryInterface;
use App\Models\Item;
use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepositoryInterface;

    public function __construct(RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepositoryInterface->getAll($request->q, $request->sort);
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permissons = $this->roleRepositoryInterface->getPermissions();
        return view('role.create', compact('permissons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {

        $role = $this->roleRepositoryInterface->store(['created_user' => $request->user()->id, 'name' => $request->name], $request->permissions);
        return redirect(route('roles.show', $role))->with('success', 'Role created successfully!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\View\View
     */
    public function show(Role $role)
    {
        $role = $this->roleRepositoryInterface->show($role);
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissons = $this->roleRepositoryInterface->getPermissions();
        return view('role.edit', compact('role', 'permissons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $this->roleRepositoryInterface->update($role, ['created_user' => $request->user()->id, 'name' => $request->name], $request->permissions);
        return redirect(route('roles.show', $role->id))->with('success', 'Role updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $this->roleRepositoryInterface->delete($role);
        return redirect(url()->previous())->with('success', 'Role deleted successfully!');
    }
}
