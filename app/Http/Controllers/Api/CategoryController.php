<?php

namespace App\Http\Controllers\Api;


use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends BaseApiController
{
    private CategoryRepositoryInterface $categoryRepositoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepositoryInterface->getAll($request->q, $request->sort);

        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $categories,
            ], Response::HTTP_OK);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $category,
            ], Response::HTTP_OK);
    }
}
