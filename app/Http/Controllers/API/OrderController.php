<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return false|\Illuminate\Http\JsonResponse
     */
    public function order(Request $request)
    {
        DB::beginTransaction();
        $idCustomer = auth()->guard('api')->user()->id;
        $idProduct = $request->ids;
        if(empty($idProduct)){
            return response()->json([
                'message' => 'No ids was found',
            ]);
        }
        $products = Product::select('id', 'name', 'stock', 'price')->whereIn('id', $idProduct)->get();
        $productCount = array_count_values($idProduct);
        $total = 0;
        $quantity_order = 0;
        $orders = array();
        try {
            foreach ($products as $product){
                if($product->stock > 0){
                    $product->stock -= $productCount[$product->id];
                    $product->save();
                    $orders = array(
                        'customer_id' => $idCustomer,
                        'quantity' => $quantity_order += $productCount[$product->id],
                        'total' => $total += $product->price * $productCount[$product->id]
                    );
                }else{
                    $message = 'Out of stock product '. $product->name;
                }
            }
            $order = Order::create($orders);
            foreach ($products as $pro){
                if($pro->stock > 0){
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $pro->id,
                        'quantity' => $productCount[$pro->id],
                        'price' => $pro->price * $productCount[$pro->id],
                        'status' => 1
                    ]);
                }
            }
            $order_detail = OrderDetail::select('order_detail.id', 'order_id', 'product_id', 'quantity', 'order_detail.price', 'status', 'name')
                ->where('order_id', $order->id)->join('product', 'product.id', '=', 'order_detail.product_id')
                ->get()->toArray();
            DB::commit();

            return response()->json([
                'order' => $order,
                'order_detail' => $order_detail,
            ]);
        }catch (Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $message,
            ]);
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
