<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\Item;
use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    private AdminRepositoryInterface $adminRepositoryInterface;
    private RoleRepository $roleRepositoryInterface;

    public function __construct(AdminRepositoryInterface $adminRepositoryInterface, RoleRepository $roleRepositoryInterface)
    {
        $this->adminRepositoryInterface = $adminRepositoryInterface;
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = $this->adminRepositoryInterface->getAll($request->q, $request->sort);
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->roleRepositoryInterface->getRoles();
        return view('admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdminRequest $request)
    {
        $item = $this->adminRepositoryInterface->store($request->validated() + ['created_user' => $request->user()->id], $request->roles);
        return redirect(route('admins.show', $item))->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\View\View
     */
    public function show(User $admin)
    {
        $admin = $this->adminRepositoryInterface->show($admin);
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\View\View
     */
    public function edit(User $admin)
    {
        $roles = $this->roleRepositoryInterface->getRoles();
        return view('admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        $this->adminRepositoryInterface->update($admin, $request->validated() + ['updated_user' => $request->user()->id], $request->roles);
        return redirect(route('admins.show', $admin))->with('success', 'User updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $admin)
    {
        try {
            $this->adminRepositoryInterface->delete($admin);
            return redirect(url()->previous())->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect(url()->previous())->with('error', $e->getMessage());
        }
    }
}
