<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Entities\Admin\Favorite;
use App\Entities\Admin\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Admin\ProductRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductsController extends Controller
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $products = $this->repository->all();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $products,
            ]);
        }
        $sub_category = SubCategory::select(['id','name'])->get();
        return view('admin.products.index', compact('products','sub_category'));
    }
    public function create($id=0){
        $subCategory = SubCategory::findOrFail($id);
        return view('admin.products.create', compact('subCategory'));
     }
    public function store(Request $request)
    {
            $product = $this->repository->create($request->all(),['active'=>0]);
            if($request->hasFile('photo')){
                $secvice=new MediaService();
                $product->photo=$secvice->fileUpload('products',$request->photo);
                $product->save();
            }
            return view('admin.products.show', compact('product'))->with('message','Product created.');

    }
    public function showFavorite()
    {
        return view('customer.favorite');
    }
    public function editFilter(Request $request)
    {
        \DB::table('product_sup_filters')->
        where('key',$request->key)->update([
            'amount'=>$request->amount,
            'price'=>$request->price
        ]);

        return redirect()->back();
    }
        public function favorite($id)
    {
        $user = auth()->guard('customer')->user();
        $product = $this->repository->findOrFail($id);
        if(!in_array($product->id,$user->favoriteIds))
        $user->favorites()->syncWithoutDetaching($id);
        else
        $user->favorites()->detach($id);
        return redirect()->back();

    }
    public function show($id)
    {
        $product = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $product,
            ]);
        }
        return view('admin.products.show', compact('product'));
    }

    public function filter($id,Request $request)
    {

        $product = $this->repository->findOrFail($id);
        $key=\Str::uuid();
        foreach ($request->sub_filter as $id) {
            \DB::table('product_sup_filters')->insert([
                'product_id'=>$product->id,
                'sub_filter_id'=>$id,
                'price'=>$request->price,
                'amount'=>$request->amount,
                'key'=>$key
            ]);
        }
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->repository->findOrFail($id);
        $sub_category = SubCategory::select(['id','name'])->get();
        return view('admin.products.edit', compact('product','sub_category'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $product = $this->repository->update($request->all(), $id);
            if($request->hasFile('photo')){
                $secvice=new MediaService();
                $product->photo!=null?$secvice->delete_image(public_path('images/products/'.$product->getRawOriginal('photo'))):null;
                $product->photo=$secvice->fileUpload('products',$request->photo);
                $product->save();
            } $response = [
                'message' => 'Product updated.',
                'data'    => $product->toArray(),
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
                'message' => 'Product deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Product deleted.');
    }
}
