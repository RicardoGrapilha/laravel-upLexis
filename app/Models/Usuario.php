<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'usuario';

    protected $primaryKey = 'id';

    protected $fillable = ['usuario', 'senha'];

    public $timestamps = false;

    public function setSenhaAttribute($value)
    {
        return $this->attributes['senha'] = bcrypt($value);
    }

    public function setUsuarioAttribute($value)
    {
        return $this->attributes['usuario'] = strtolower($value);
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {

    }

    public function getRememberTokenName()
    {
        return null;
    }

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

    public function sintegra()
    {
        return $this->hasMany('App\Models\Sintegra', 'idusuario');
    }
}
