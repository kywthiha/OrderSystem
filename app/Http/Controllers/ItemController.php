<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Interfaces\ItemRepositoryInterface;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    private ItemRepositoryInterface $itemRepositoryInterface;

    public function __construct(ItemRepositoryInterface $itemRepositoryInterface)
    {
        $this->itemRepositoryInterface = $itemRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = $this->itemRepositoryInterface->getAll($request->q, $request->sort);
        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepositoryInterface->getCategories();
        return view('subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $this->subCategoryRepositoryInterface->store($request->validated() + ['created_user' => $request->user()->id]);
        return redirect(route('subcategories.index', ['sort' => ['created_at' => 'desc']]))->with('success', 'SubCategory created successfully!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\View\View
     */
    public function show(SubCategory $subcategory)
    {
        $subcategory = $this->subCategoryRepositoryInterface->show($subcategory);
        return view('subcategory.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\View\View
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = $this->categoryRepositoryInterface->getCategories();
        return view('subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreSubCategoryRequest $request, SubCategory $subcategory)
    {
        $this->subCategoryRepositoryInterface->update($subcategory, $request->validated() + ['updated_user' => $request->user()->id]);
        return redirect(route('subcategories.show', $subcategory->id))->with('success', 'SubCategory updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SubCategory $subcategory)
    {
        $this->subCategoryRepositoryInterface->delete($subcategory);
        return redirect(url()->previous())->with('success', 'SubCategory deleted successfully!');
    }
}
