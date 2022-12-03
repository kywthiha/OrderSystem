<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
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
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdminRequest $request)
    {
        $item = $this->adminRepositoryInterface->store($request->validated() + ['created_user' => $request->user()->id]);
        return redirect(route('admins.index', ['sort' => ['created_at' => 'desc']]))->with('success', 'User created successfully!');;
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
     * @param  \App\Models\Item  $item
     * @return \Illuminate\View\View
     */
    public function edit(Item $item)
    {
        $categories = $this->categoryRepositoryInterface->getCategories();
        $subCategories = $this->subCategoryRepositoryInterface->getSubCategories();
        return view('item.edit', compact('item', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreItemRequest $request, Item $item)
    {
        $this->itemRepositoryInterface->update($item, $request->validated() + ['updated_user' => $request->user()->id]);
        return redirect(route('items.show', $item->id))->with('success', 'Item updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Item $item)
    {
        $this->itemRepositoryInterface->delete($item);
        return redirect(url()->previous())->with('success', 'Item deleted successfully!');
    }
}
