<?php

namespace App\Modules\DataModel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sysuser extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $table = 'sysuser';

    protected $primaryKey = 'Id';

	public $timestamps = false;

    protected $fillable = [
        'UserName',
        'Password',
        'Role',
        'Status',
        'isDelete'
    ];

    protected $hidden= ['remember_token'];
    protected $guarded = [];

    public function getAuthPassword(){
        return $this->Password;
    }

    public function setPasswordAttribute($password)
    {
        if (\Hash::needsRehash($password)) {
            $this->attributes['Password'] = bcrypt($password);
        }else{
           $this->attributes['Password'] = $password;
        }
    }
}