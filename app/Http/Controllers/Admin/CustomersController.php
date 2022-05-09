<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Repositories\Admin\CustomerRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class CustomersController extends Controller
{
    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $customers = $this->repository->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $customers,
            ]);
        }

        return view('admin.customers.index', compact('customers'));
    }

    public function store(CustomerRequest $request)
    {
        try {
            $customer = $this->repository->create($request->all());
            $response = [
                'message' => 'Customer created.',
                'data'    => $customer->toArray(),
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
        $customer = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $customer,
            ]);
        }
        return view('admin.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = $this->repository->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, $id)
    {
        try {
            $customer = $this->repository->update($request->except('password'), $id);
            if($request->password){
                $customer->password=Hash::make($request->password);
                $customer->save();
            }
            $response = [
                'message' => 'Customer updated.',
                'data'    => $customer->toArray(),
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
                'message' => 'Customer deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Customer deleted.');
    }
}
