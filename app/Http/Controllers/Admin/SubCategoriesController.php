<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\Admin\Filter;
use App\Entities\Admin\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Repositories\Admin\SubCategoryRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class SubCategoriesController extends Controller
{
    protected $repository;

    public function __construct(SubCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $sub_categories = $this->repository->withCount('products')->get();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $sub_categories,
            ]);
        }
        $categoryies=Category::all();
        return view('admin.sub_categories.index', compact('sub_categories','categoryies'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $subCategory = $this->repository->create($request->all());
            $response = [
                'message' => 'SubCategory created.',
                'data'    => $subCategory->toArray(),
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
        $subCategory = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $subCategory,
            ]);
        }
        return view('admin.sub_categories.show', compact('subCategory'));
    }

    public function create($id=0){
        $subCategory = $this->repository->findOrFail($id);
        return view('admin.sub_categories.create', compact('subCategory'));
     }
    public function assign_filter($id)
    {
        $subCategory = $this->repository->findOrFail($id);
        $ids=$subCategory->filters->pluck('id')->toArray();
        $filters=Filter::all();
        return view('admin.sub_categories.assign_filter', compact('subCategory','ids','filters'));
    }

    public function post_assign_filter(Request $request)
    {
        $subCategory = $this->repository->findOrFail($request->sub_category_id);
         $subCategory->filters()->sync($request->filter_id);

        return redirect()->route('sub_categories.assign_filter',$subCategory->id);
    }

    public function edit($id)
    {
        $subCategory = $this->repository->findOrFail($id);
        $category = Category::all();
        return view('admin.sub_categories.edit', compact('subCategory','category'));
    }

    public function update(SubCategoryRequest $request, $id)
    {
        try {
            $subCategory = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'SubCategory updated.',
                'data'    => $subCategory->toArray(),
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
                'message' => 'SubCategory deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'SubCategory deleted.');
    }
}
