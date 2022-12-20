<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Alert;
use Carbon\Carbon;
use App\models\Product;
use App\models\ProductCategory;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select(
            'id',
            'name',
            'stock',
            'expired_at',
            'avatar',
            'sku',
            'category_id'
            )->paginate(15);
           
        return view('user.layout.product.show', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::whereNull('parent_id')->get();
        return view('user.layout.product.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $image_name = time().'.'.$request->avatar->extension();
        $request->avatar->move(public_path('upload/product/'), $image_name);
    
        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->sku = $request->sku;
        $product->expired_at = $request->date('expired_at');
        $product->category_id = $request->category_id;
        $product->avatar = $image_name; 
        $product->save();

        Alert::success('Success', 'Create success');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::whereNull('parent_id')->get();

        if($product != null){
           return view('user.layout.product.update',compact('product','categories'));
        }else{
            Alert::error('Error', 'ID does not exist');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\UpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
    
        if($product != null){
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->stock = $request->stock;
            $product->expired_at = $request->expired_at;
            $product->category_id = $request->category_id;
            if($request->hasFile('avatar')){
                $image_name = time().'.'.$request->avatar->extension();
                $request->avatar->move(public_path('upload/product/'), $image_name);
                $product->avatar = $image_name;
            }
            $product->save();

            Alert::success('Success', 'Update success');
            return redirect()->route('product.index');
         }else{
             Alert::error('Error', 'ID does not exist');
             return redirect()->back();
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        $product = Product::find($id);
        if($product != null){
            $product->delete();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product has been Deleted'
                ]
            );
        }else{
            return redirect()->back();
        }
    }
}