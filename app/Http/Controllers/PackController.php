<?php

namespace App\Http\Controllers;

use App\Interfaces\PackRepositoryInterface;
use App\Models\Pack;
use Illuminate\Http\Response;

class PackController extends Controller
{
    private PackRepositoryInterface $packRepository;

    public function __construct(PackRepositoryInterface $packRepository)
    {
        $this->packRepository = $packRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->packRepository->getAll();
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $data,
            ], Response::HTTP_OK);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function show(Pack $pack)
    {
        $data = $this->packRepository->getDetailByPack($pack);
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $data,
            ], Response::HTTP_OK);
    }
}
