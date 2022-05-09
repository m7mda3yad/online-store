<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\Admin\Filter;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SubFilterRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\SubFilterRepository;

class SubFiltersController extends Controller
{
    protected $repository;

    public function __construct(SubFilterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $sub_filters = $this->repository->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $sub_filters,
            ]);
        }
        $filters=Filter::all();
        return view('admin.subFilters.index', compact('sub_filters','filters'));
    }

    public function store(SubFilterRequest $request)
    {
        try {
            $subFilter = $this->repository->create($request->all());
            $response = [
                'message' => 'SubFilter created.',
                'data'    => $subFilter->toArray(),
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
        $subFilter = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $subFilter,
            ]);
        }
        return view('admin.subFilters.show', compact('subFilter'));
    }

    public function edit($id)
    {
        $sub_filter = $this->repository->findOrFail($id);
        $filters=Filter::all();
        return view('admin.subFilters.edit', compact('sub_filter','filters'));
    }

    public function update(SubFilterRequest $request, $id)
    {
        try {
            $subFilter = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'SubFilter updated.',
                'data'    => $subFilter->toArray(),
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
                'message' => 'SubFilter deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'SubFilter deleted.');
    }
}
