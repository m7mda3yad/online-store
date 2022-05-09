<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FilterRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\FilterRepository;

class FiltersController extends Controller
{
    protected $repository;

    public function __construct(FilterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $filters = $this->repository->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $filters,
            ]);
        }

        return view('admin.filters.index', compact('filters'));
    }

    public function store(FilterRequest $request)
    {
        try {
            $filter = $this->repository->create($request->all());
            $response = [
                'message' => 'Filter created.',
                'data'    => $filter->toArray(),
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
        $filter = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $filter,
            ]);
        }
        return view('admin.filters.show', compact('filter'));
    }

    public function edit($id)
    {
        $filter = $this->repository->findOrFail($id);
        return view('admin.filters.edit', compact('filter'));
    }

    public function update(FilterRequest $request, $id)
    {
        try {
            $filter = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Filter updated.',
                'data'    => $filter->toArray(),
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
                'message' => 'Filter deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Filter deleted.');
    }
}
