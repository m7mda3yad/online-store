<?php
namespace App\Entities\Admin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
class Product extends Model implements Transformable {
    use TransformableTrait;
    use SearchableTrait;

    protected $fillable = ['name','description','price','real_price','amount','photo','sub_category_id',];
    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.description' => 10,
        ],
    ];
    // $products = Product::where('status', 'active')->search($query)->paginate(10);
    // https://github.com/Sheaffy/searchable

    public function getPhotoAttribute($photo){
        return $photo? asset('images/products/'.$photo):null;
    }
    public function getKeyAttribute(){
        return array_unique($this->sub_filters->whereNotNull('pivot.key')->pluck('pivot.key')->toArray());
    }
    public function key($key)
    {
        return  $this->sub_filters->where('pivot.key',$key);

    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::Class, 'sub_category_id');
    }
    public function sub_filters()
    {
        return $this->belongsToMany(SubFilter::Class,'product_sup_filters')->withPivot(['amount','key','price']);
    }

}
