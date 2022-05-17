<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\Admin\Filter;
use App\Services\MediaService;
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
            $subCategory = $this->repository->create($request->all());
            if($request->hasFile('photo')){
                $secvice=new MediaService();
                $subCategory->photo=$secvice->fileUpload('sub_categories',$request->photo);
                $subCategory->save();
            }
            return redirect()->back()->with('message', 'SubCategory created');
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
            $subCategory = $this->repository->update($request->all(), $id);
            if($request->hasFile('photo')){
                $secvice=new MediaService();
                $subCategory->photo!=null?$secvice->delete_image(public_path('images/sub_categories/'.$subCategory->getRawOriginal('photo'))):null;
                $subCategory->photo=$secvice->fileUpload('sub_categories',$request->photo);
                $subCategory->save();
            }
            return redirect()->back()->with('message', 'SubCategory updated');
    }

    public function destroy($id)
    {

        $deleted = $this->repository->delete($id);
        $category = $this->repository->findOrFail($id);
        $category->photo!=null?$secvice->delete_image(public_path('images/sub_categories/'.$category->getRawOriginal('photo'))):null;

        return redirect()->back()->with('message', 'SubCategory deleted.');
    }
}
