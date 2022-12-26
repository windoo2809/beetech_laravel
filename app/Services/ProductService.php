<?php
namespace App\Services;
use App\Models\Product;

class ProductService{
    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id

     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteProduct($id){
        $product = Product::where('id', $id)->delete();

        if($product){
            return true;
        }else{
            return false;
        }
    }

    public function upload($request){
        if($request->file('avatar')){
            $avatar = $request->file('avatar');
            $image_name = $avatar->getClientOriginalName();
            $storedPath = $avatar->move('upload/product/', $image_name);

            return $image_name;
        }
        return false;
    }
}

?>
