<?php

namespace MVC\Models\User;

use MVC\Base\MVCModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use YourAppRocks\EloquentUuid\Traits\HasUuid;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;

class User extends MVCModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable, Authorizable, HasApiTokens, HasFactory, HasUuid, CanResetPassword, Notifiable;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    protected $hidden     = ['password', 'remember_token'];
    protected $casts      = ['email_verified_at' => 'datetime'];
    public    $timestamps = true;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->password = $model->password ? Hash::make($model->password) : '';
        });
    }

    public function filter($query, array $params = []): Builder
    {
        $email = (string)($params['email'] ?? '');

        if ($email) {
            $query->where('email', 'LIKE', "%$email%");
        }

        return $query;
    }

    public function sendPasswordResetNotification($token)
    {
        $url = config('erp.front_url') . '/reset-password/' . $token . '?email=' . $this->email;

        $this->notify(new ResetPasswordNotification($url));
    }
}
