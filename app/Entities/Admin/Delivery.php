<?php
namespace App\Entities\Admin;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Delivery extends Authenticatable implements Transformable{

    use TransformableTrait;    use HasApiTokens;    use HasFactory, Notifiable;
    protected $table='deliveries';
    protected $guard = 'delivery';
    protected $guard_name='delivery';
    protected $fillable = ['email','password','name','phone','photo','address'];


    public function orders()
    {
        return $this->hasMany(Order::Class);
    }

}
