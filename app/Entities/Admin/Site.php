<?php
namespace App\Entities\Admin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
class Site extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = [   'instgram' ,    'phone2','address','phone1','logo','name','facebook','email','youtube'	];

    public function getLogoAttribute($logo){
        return $logo? asset('images/site/'.$logo):null;
    }
}
