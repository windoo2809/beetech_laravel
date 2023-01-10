<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderService
{
    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id

     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteOrder($id)
    {
        $order = Order::where('id', $id)->delete();

        if ($order->OrderDetail->status == 1) {
            return false;
        } elseif ($order->OrderDetail->status == 2) {
            return false;
        } elseif ($order->OrderDetail->status == 3) {
            return false;
        } else {
            return true;
        }
    }
}
