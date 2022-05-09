<?php
namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Transformable {
    use TransformableTrait;    use HasApiTokens;    use HasFactory, Notifiable;    use SoftDeletes ;    use HasRoles;
    protected $fillable = [        'name', 'email', 'password','phone','photo','type'];
    protected $hidden = [        'password', 'remember_token'    ];
    protected $casts = [        'email_verified_at' => 'datetime',    ];

    public function getPhotoAttribute($photo){
        if($photo==null)
        return asset('images/default_user.png');
        return asset('images/users/'.$photo);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
