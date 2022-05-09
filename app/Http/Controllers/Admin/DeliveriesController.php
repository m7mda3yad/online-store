<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryRequest;
use App\Repositories\Admin\DeliveryRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class DeliveriesController extends Controller
{
    protected $repository;

    public function __construct(DeliveryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $deliveries = $this->repository->paginate(10);
        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function store(DeliveryRequest $request)
    {
            $delivery = $this->repository->create($request->all());
            return redirect()->back()->with('message', "Delivery created.");
    }

    public function show($id)
    {
        $delivery = $this->repository->findOrFail($id);
        return view('admin.deliveries.show', compact('delivery'));
    }

    public function edit($id)
    {
        $delivery = $this->repository->findOrFail($id);
        return view('admin.deliveries.edit', compact('delivery'));
    }

    public function update(DeliveryRequest $request, $id)
    {
            $delivery = $this->repository->update($request->except('password'), $id);
            if($request->password){
                $delivery->password=Hash::make($request->password);
                $delivery->save();
            }
            return redirect()->back()->with('message', "Delivery updated.");
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('message', 'Delivery deleted.');
    }
}
