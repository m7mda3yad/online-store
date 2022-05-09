<?php
namespace App\Entities\Admin;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable implements Transformable{

    use TransformableTrait;    use HasApiTokens;    use HasFactory, Notifiable;    use SoftDeletes ;
    protected $table='customers';
    protected $guard = 'customer';
    protected $guard_name='customer';
    protected $fillable = ['name','password','email','phone','photo','address','city_id'];

    protected $hidden = ['password'];

    public function getPhotoAttribute($photo){
        if($photo==null)
            return asset('images/default_user.png');
        if($this->type==1)
        return asset('images/users/'.$photo);

        return asset('images/customers/'.$photo);
    }

    // favoriteIds
    // favorite_ids
    public function getFavoriteIdsattribute()
    {
        return $this->favorites->pluck('id')->toArray();
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::Class, 'favorites', 'customer_id', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

}
