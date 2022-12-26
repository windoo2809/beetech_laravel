<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Alert;
use File;
use Carbon\Carbon;
use App\models\Product;
use App\models\ProductCategory;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(productService $productService){
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *  @param request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::select(
            'id',
            'name',
            'stock',
            'expired_at',
            'avatar',
            'sku',
            'category_id'
        );

        $search = request()->search;
        if($search){
            $product = Product::whereHas('product_category', function ($query) use($search){
                $query->where('product_category.name', 'LIKE','%'.$search.'%')
                ->orWhere('product.name', 'LIKE','%'.$search.'%');
            });
        }

        $stock = request()->stock;
        if($stock == 10){
            $product = Product::where('stock','<', 10);
        }
        elseif($stock === "10-100"){
            $product = Product::whereBetween('stock', [10,100]);
        }
        elseif($stock === "100-200"){
            $product = Product::whereBetween('stock', [100,200]);
        }
        elseif($stock === "200"){
            $product = Product::where('stock', '>',200 );
        }

        $product = $product->paginate(15);

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
        $image_name = $this->productService->upload($request);
        if (!empty($image_name)) {
            $product['avatar'] = $image_name;
        }

        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->sku = $request->sku;
        $product->expired_at = $request->expired_at;
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
        $categories = ProductCategory::select('id','parent_id','name')->whereNull('parent_id')->get();

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

            if ($request->file('avatar')) {
                $avatar = $request->file('avatar');
                $image_name = $avatar->getClientOriginalName();
                $storedPath = $avatar->move('upload/product',$image_name);
                $oldimage = $product->avatar;
                File::delete('upload/product/' . $oldimage);

                $product->avatar = $image_name;
            }

            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->stock = $request->stock;
            $product->expired_at = $request->expired_at;
            $product->category_id = $request->category_id;
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
        $product = $this->productService->DeleteProduct($id);

        if($product){
             return response()->json([
                'message' => 'delete product',
            ], 200);
        }else{
            return response()->json([
                'message' => 'Error',
            ], 404);
        }
    }
      /**
     * Create CSV
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse;
     */
    public function exportcsv(){
        return Excel::download(new ProductExport, 'Product.csv');
    }

   /**
     * Create PDF
     *
     * @return mixed
     */
    public function exportpdf(){

        $product = Product::select(
            'id',
            'name',
            'stock',
            'expired_at',
            'avatar',
            'sku',
            'category_id'
        )->get();
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        $datetime=$currentTime->toDateTimeString();

        $pdf = PDF::loadView('user.layout.product.pdf',compact('product','datetime'));
        return $pdf->download('Product.pdf');
    }
}
