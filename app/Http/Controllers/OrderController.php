<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepositoryInterface;


    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepositoryInterface->getAll($request->q, $request->sort);
        return view('order.index', compact('orders'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order = $this->orderRepositoryInterface->show($order);
        return view('order.show', compact('order'));
    }
}
