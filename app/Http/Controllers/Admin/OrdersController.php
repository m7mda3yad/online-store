<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Entities\Admin\Delivery;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\OrderRepository;

class OrdersController extends Controller
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orders = $this->repository->withCount('products')->all();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $orders,
            ]);
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function store(OrderRequest $request)
    {
        try {
            $order = $this->repository->create($request->all());
            $response = [
                'message' => 'Order created.',
                'data'    => $order->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function show($id)
    {
        $order = $this->repository->findOrFail($id);
        if(auth()->guard('delivery')->check())
        return view('delivery.orders_show', compact('order'));
        $deliveries = Delivery::all();
        return view('admin.orders.show', compact('order','deliveries'));
    }
    public function delivery(Request $request)
    {
        $order = $this->repository->findOrFail($request->order_id);
        $delivery = Delivery::findOrFail($request->delivery_id);
        $order->delivery_id = $delivery->id;
        $order->save();
        return redirect()->back()->with('message', 'assigned successfully');
    }

    public function edit($id)
    {
        $order = $this->repository->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $order = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Order updated.',
                'data'    => $order->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Order deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Order deleted.');
    }

    public function    new(){
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orders = $this->repository->whereNull('delivery_id')->withCount('products')->get();
        return view('admin.orders.index', compact('orders'));

    }
    public function    assign(){
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orders = $this->repository->whereNotNull('delivery_id')->where('delivery_type',0)->withCount('products')->get();
        return view('admin.orders.index', compact('orders'));

    }
    public function    delivered(){
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orders = $this->repository->whereNotNull('delivery_id')->where('delivery_type',1)->withCount('products')->get();
        return view('admin.orders.index', compact('orders'));

    }


    public function deliveredOrder($id)
    {
        $order = $this->repository->findOrFail($id);
        $order->delivery_type=1;
        $order->save();
        return redirect()->back()->with('message', 'Order Delivered.');

    }
    public function cancelledOrder($id)
    {
        $order = $this->repository->findOrFail($id);
         foreach($order->products as $item) {
            if($item->pivot->key){
                \DB::table('product_sup_filters')->where('key',$item->pivot->key)->increment('amount',$item->pivot->amount);
            }
            else {
                $item->amount = $item->amount + $item->pivot->amounts  ;
                $item->save();
            }
         }
        $order->delivery_type=3;
        $order->save();
        return redirect()->back()->with('message', 'Order Dancelled.');
    }


}
