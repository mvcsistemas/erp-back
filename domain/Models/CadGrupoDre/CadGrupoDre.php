<?php

namespace MVC\Models\CadGrupoDre;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadGrupoDre extends MVCModel {

    use HasUuid, HasFactory;

    protected $table      = 'cad_grupo_dre';
    protected $primaryKey = 'id_grupo_dre';
    protected $guarded    = ['id_grupo_dre'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $dsc_grupo_dre   = (string)($params['dsc_grupo_dre'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('cad_grupo_dre.uuid', $uuid);
            })
            ->when($dsc_grupo_dre, function ($query) use ($dsc_grupo_dre) {
                $query->where('cad_grupo_dre.dsc_grupo_dre', 'like', "%$dsc_grupo_dre%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('cad_grupo_dre.dsc_grupo_dre');
            });
    }
}
