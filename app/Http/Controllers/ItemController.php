<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    private ItemRepositoryInterface $itemRepositoryInterface;

    private CategoryRepositoryInterface $categoryRepositoryInterface;

    private SubCategoryRepositoryInterface $subCategoryRepositoryInterface;

    public function __construct(ItemRepositoryInterface $itemRepositoryInterface, CategoryRepositoryInterface $categoryRepositoryInterface, SubCategoryRepositoryInterface $subCategoryRepositoryInterface)
    {
        $this->itemRepositoryInterface = $itemRepositoryInterface;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->subCategoryRepositoryInterface = $subCategoryRepositoryInterface;
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
        $subCategories = $this->subCategoryRepositoryInterface->getSubCategories();
        return view('item.create', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreItemRequest $request)
    {
        $item = $this->itemRepositoryInterface->store($request->validated() + ['created_user' => $request->user()->id]);
        return redirect(route('items.show', $item))->with('success', 'Item created successfully!');
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
