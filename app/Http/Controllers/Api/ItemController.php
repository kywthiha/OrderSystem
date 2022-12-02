<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\ItemRepositoryInterface;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends BaseApiController
{
    private ItemRepositoryInterface $itemRepositoryInterface;


    public function __construct(ItemRepositoryInterface $itemRepositoryInterface)
    {
        $this->itemRepositoryInterface = $itemRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $items = $this->itemRepositoryInterface->getAll($request->q, $request->sort, $request->filter);
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $items,
            ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Item $item)
    {
        $item = $this->itemRepositoryInterface->show($item);
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $item,
            ], Response::HTTP_OK);
    }
}
