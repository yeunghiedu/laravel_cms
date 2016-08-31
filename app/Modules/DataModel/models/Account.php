<?php

namespace App\Modules\DataModel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $table = 'account';

    protected $primaryKey = 'Id';

	public $timestamps = false;

    protected $fillable = [
        'Account',
        'Password',
        'AccountType',
        'AccountStatus',
        'Email',
        'Address',
        'Name',
        'Phone',
    ];

    protected $hidden= ['remember_token'];
    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::creating(function($model){
            foreach ($model->attributes as $key => $value) {
                if($value != '0') {
                    $model->{$key} = empty($value) ? null : $value;
                }
            }
        });

        static::updating(function($model){
            foreach ($model->attributes as $key => $value) {
                if($value != '0') {
                    $model->{$key} = empty($value) ? null : $value;
                }
            }
        });

    }

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