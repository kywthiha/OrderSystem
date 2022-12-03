<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\Item;
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
        return view('admin.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdminRequest $request)
    {
        $item = $this->adminRepositoryInterface->store($request->validated() + ['created_user' => $request->user()->id],$request->roles);
        return redirect(route('admins.show', $item))->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\View\View
     */
    public function show(Item $item)
    {
        $item = $this->itemRepositoryInterface->show($item);
        return view('item.show', compact('item'));
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
