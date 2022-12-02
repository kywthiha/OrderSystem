<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SubCategoryController extends BaseApiController
{
    private SubCategoryRepositoryInterface $subCategoryRepositoryInterface;


    public function __construct(SubCategoryRepositoryInterface $subCategoryRepositoryInterface)
    {
        $this->subCategoryRepositoryInterface = $subCategoryRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $subCategories = $this->subCategoryRepositoryInterface->getAll($request->q, $request->sort, $request->filter);
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $subCategories,
            ], Response::HTTP_OK);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SubCategory $subcategory)
    {
        $subcategory = $this->subCategoryRepositoryInterface->show($subcategory);

        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $subcategory,
            ], Response::HTTP_OK);
    }
}
