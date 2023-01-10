<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    protected $OrderService;
    /**
     *
     * @param \App\Services\OrderService; $OrderService;
     * @return void
     */
    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $order = Order::select(
            'id',
            'customer_id',
            'quantity',
            'total',
            'created_at',
            'updated_at'
        )->paginate(15);

        return view('user.layout.order.index', compact('order'));
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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order != null) {
            return view('user.layout.order.view', compact('order'));
        } else {
            abort(404);
        }
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
        $order = $this->OrderService->DeleteOrder($id);
    }

    /**
     * download pdf
     *
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function downPDF($id)
    {
        $order = Order::findOrFail($id);
        $data = [
            'order' => $order,
        ];

        $pdf = PDF::loadView('user.layout.order.pdf', $data);
        return $pdf->download('Order.pdf');
    }
}
