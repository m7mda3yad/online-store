<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Admin\CategoryRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class CategoriesController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $categories = $this->repository->withCount('sub_categories')->get();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $categories,
            ]);
        }
        return view('admin.categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
            $category = $this->repository->create($request->all());

            return redirect()->back()->with('message', 'Category created');
    }

    public function show($id)
    {
        $category = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $category,
            ]);
        }
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->repository->findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
            $category = $this->repository->update($request->all(), $id);
            return redirect()->back()->with('message', 'Category updated.');
    }

    public function destroy($id)
    {

        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('message', 'Category deleted.');
    }
}
