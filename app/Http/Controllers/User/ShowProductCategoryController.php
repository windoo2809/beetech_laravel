<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use App\Http\Requests\ProductCategoryRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;


class ShowProductCategoryController extends Controller
{
    protected $ProductCategoryService;

    /**
     *
     * @param \App\Services\ProductCategoryService $ProductCategoryService
     * @return void
     */
    public function __construct(ProductCategoryService $ProductCategoryService){
        $this->ProductCategoryService = $ProductCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_category = ProductCategory::select(
            'id',
            'name',
            'parent_id',
            'created_at',
            'updated_at',
            )->paginate(15);

        $children = ProductCategory::whereNull('parent_id')->get();

        return view('user.layout.product-category.show', compact('product_category','children'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = ProductCategory::select('id','parent_id','name')->whereNull('parent_id')->get();
        return view('user.layout.product-category.create', compact('children'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $product_category = new ProductCategory();
            $product_category->name = $request->name;
            $product_category->parent_id = $request->parent_id;
            $product_category->save();
            DB::commit();

            Alert::success('Success', Lang::get('Created successfully'));
            return redirect()->route('product-category.index');
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', Lang::get('Something wrong!'));
            return redirect()->back();
            throw new Exception($e->getMessage());
        }
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
        $product_category = ProductCategory::find($id);
        $children = ProductCategory::select('id','parent_id','name')->whereNull('parent_id')->get();

        if($product_category != null){
           return view('user.layout.product-category.update',compact('product_category','children'));
        }else{
            Alert::error('Error', 'ID does not exist');
            return redirect()->back();
        }
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
        DB::beginTransaction();
        try {
            $product_category = ProductCategory::find($id);

            if($product_category != null){
                $product_category->name = $request->name;
                $product_category->parent_id = $request->parent_id;

                $product_category->save();
                DB::commit();

                Alert::success('Success', Lang::get('Updated successfully'));
                return redirect()->route('product-category.index');
            }else{
                Alert::error('Error', Lang::get('Something wrong!'));
                return redirect()->back();
            }
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', Lang::get('Something wrong!'));
            return redirect()->back();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product_category = $this->ProductCategoryService->DeleteProductCategory($id);

        if($product_category){
             return response()->json([
                'message' => 'delete product',
            ], 200);
        }else{
            return response()->json([
                'message' => 'Error',
            ], 404);
        }
    }
}
