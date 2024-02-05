<?php

namespace MVC\Models\FluxoCaixaEntrada;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MVC\Base\MVCModel;
use MVC\Models\FluxoCaixa\FluxoCaixa;
use MVC\Services\UpdateValuesDre;
use MVC\Services\UpdateValuesFluxoCaixa;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FluxoCaixaEntrada extends MVCModel {

    use HasUuid;

    protected $table      = 'fluxo_caixa_entrada';
    protected $primaryKey = 'id_fluxo_caixa_entrada';
    protected $guarded    = ['id_fluxo_caixa_entrada'];
    public    $timestamps = true;

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->updateSaldoFluxoCaixa($model->fk_id_fluxo_caixa);
            $model->updateSaldoDreFluxoCaixaEntrada($model);
        });

        self::updated(function ($model) {
            $model->updateSaldoFluxoCaixa($model->fk_id_fluxo_caixa);
            $model->updateSaldoDreFluxoCaixaEntrada($model);
        });

        self::deleted(function ($model) {
            $model->updateSaldoFluxoCaixa($model->fk_id_fluxo_caixa);
            $model->updateSaldoDreFluxoCaixaEntrada($model);
        });
    }

    public function index(): Builder
    {
        return $this->select('fluxo_caixa_entrada.uuid',
            'fluxo_caixa_entrada.data_fluxo_caixa_entrada',
            'fluxo_caixa_entrada.valor_fluxo_caixa_entrada',
            'cad_tipo_entrada.uuid as fk_uuid_tipo_entrada',
            'cad_tipo_entrada.dsc_tipo_entrada as dsc_tipo_entrada',
            'fluxo_caixa.uuid as fk_uuid_fluxo_caixa',
            'cad_grupo_financeiro.uuid as fk_uuid_grupo_financeiro',
            'cad_grupo_financeiro.dsc_grupo_financeiro as dsc_grupo_financeiro')
                    ->join('cad_tipo_entrada', 'cad_tipo_entrada.id_tipo_entrada', 'fluxo_caixa_entrada.fk_id_tipo_entrada')
                    ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_entrada.fk_id_fluxo_caixa')
                    ->join('cad_grupo_financeiro', 'cad_grupo_financeiro.id_grupo_financeiro', 'fluxo_caixa_entrada.fk_id_grupo_financeiro');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                      = (string)($params['uuid'] ?? '');
        $fk_uuid_fluxo_caixa       = (string)($params['fk_uuid_fluxo_caixa'] ?? '');
        $data_fluxo_caixa_entrada  = (string)($params['data_fluxo_caixa_entrada'] ?? '');
        $valor_fluxo_caixa_entrada = (float)($params['valor_fluxo_caixa_entrada'] ?? 0);
        $dsc_tipo_entrada          = (string)($params['dsc_tipo_entrada'] ?? '');
        $dsc_grupo_financeiro      = (string)($params['dsc_grupo_financeiro'] ?? '');
        $tipo_ordenacao            = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao           = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('fluxo_caixa_entrada.uuid', $uuid);
            })
            ->when($fk_uuid_fluxo_caixa, function ($query) use ($fk_uuid_fluxo_caixa) {
                $query->where('fluxo_caixa.uuid', $fk_uuid_fluxo_caixa);
            })
            ->when($data_fluxo_caixa_entrada, function ($query) use ($data_fluxo_caixa_entrada) {
                $query->whereDate('fluxo_caixa_entrada.data_fluxo_caixa_entrada', $data_fluxo_caixa_entrada);
            })
            ->when($dsc_tipo_entrada, function ($query) use ($dsc_tipo_entrada) {
                $query->where('cad_tipo_entrada.dsc_tipo_entrada', 'like', "%$dsc_tipo_entrada%");
            })
            ->when($valor_fluxo_caixa_entrada, function ($query) use ($valor_fluxo_caixa_entrada) {
                $query->where('fluxo_caixa_entrada.valor_fluxo_caixa_entrada', $valor_fluxo_caixa_entrada);
            })
            ->when($dsc_grupo_financeiro, function ($query) use ($dsc_grupo_financeiro) {
                $query->where('cad_grupo_financeiro.dsc_grupo_financeiro', 'like', "%$dsc_grupo_financeiro%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('fluxo_caixa_entrada.data_fluxo_caixa_entrada');
            });
    }

    public function fluxoCaixa(): BelongsTo
    {
        return $this->belongsTo(FluxoCaixa::class, 'fk_id_fluxo_caixa', 'id_fluxo_caixa');
    }

    public function updateSaldoFluxoCaixa(int $fk_id_fluxo_caixa)
    {
        $service = app()->make(UpdateValuesFluxoCaixa::class);
        $service->updateSaldoFluxoCaixa($fk_id_fluxo_caixa);
    }

    public function updateSaldoDreFluxoCaixaEntrada(FluxoCaixaEntrada $model)
    {
        $service = app()->make(UpdateValuesDre::class);
        $service->updateSaldoDreFluxoCaixaEntrada($model);
    }
}
