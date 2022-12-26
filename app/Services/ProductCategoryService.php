<?php
namespace App\Services;
use App\Models\ProductCategory;

class ProductCategoryService{
    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id

     * @return \Illuminate\Http\JsonResponse
     */
    public function DeleteProductCategory($id){
        $product_category = ProductCategory::where('id', $id)->delete();

        if($product_category){
            return true;
        }else{
            return false;
        }
    }
}

?>
