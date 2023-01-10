<?php
namespace App\Services;

use App\Models\OrderDetail;

class OrderDetailService{
    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id

     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteOrderDetail($id){
        $order_detail = OrderDetail::where('id', $id)->delete();

        if($order_detail ){
            return true;
        }else{
            return false;
        }
    }
}

?>
