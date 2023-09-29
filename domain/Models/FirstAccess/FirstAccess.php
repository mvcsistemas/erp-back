<?php

namespace MVC\Models\FirstAccess;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FirstAccess extends MVCModel {

    use HasFactory;

    protected $table      = 'first_access';
    protected $primaryKey = 'id';
    protected $fillable   = ['user_uuid', 'otp', 'expire_at'];

    public function filter($query, array $params = []): Builder
    {
        $user_uuid = (int)($params['user_uuid'] ?? '');

        if ($user_uuid) {
            $query->where('user_uuid', $user_uuid);
        }

        return $query;
    }
}
