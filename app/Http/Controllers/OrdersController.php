<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::all();
        $response = [
            'message' => 'all orders',
            'orders' => $orders
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id' => ['required'],
            'nama_pemesan' => ['required'],
            'no_hp' => ['required'],
            'product_id' => ['required'],
            'address' => ['required'],
            'quantity' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $orders = Orders::create($request->all());
            $response = [
                'message' => 'Order Created',
                'orders' => $orders
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($ordersId)
    {
        $orders = Orders::where('order_id', $ordersId)->first();
        $response = [
            'message' => 'order detail',
            'order' => $orders
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function showOrderUser($user_id)
    {
        $orders = User::with('orders')->find($user_id)->orders()->get();
        $response = [
            'message' => 'orders history',
            'order' => $orders
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $ordersId)
    // {
    //     $orders = Orders::where('order_id', $ordersId);

    //     $validator = Validator::make($request->all(), [
    //         'user_id' => ['required'],
    //         'product_id' => ['required'],
    //         'address' => ['required'],
    //         'quantity' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    //     }

    //     try {
    //         $orders->update($request->all());
    //         $response = [
    //             'message' => 'Order Created',
    //             'orders' => $orders
    //         ];
    //         return response()->json($response, Response::HTTP_CREATED);
    //     } catch (QueryException $e) {
    //         return response()->json([
    //             'message' => 'Failed' . $e->errorInfo
    //         ]);
    //     }

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($ordersId)
    {
        $orders = Orders::where('order_id', $ordersId);

        try {
            $orders->delete();
            $response = [
                'message' => 'order deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "failed" . $e->errorInfo
            ]);
        }
    }
}
