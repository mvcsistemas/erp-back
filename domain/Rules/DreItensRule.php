<?php

namespace MVC\Rules;

use Illuminate\Contracts\Validation\Rule;
use MVC\Models\DreItens\DreItens;

class DreItensRule implements Rule {

    public function passes($attribute, $value)
    {
        $request = [
            ['tabela' => 'dre', 'chave_atribuir' => 'fk_id_dre', 'campo_pesquisar' => 'id_dre', 'uuid' => request()->fk_uuid_dre]
        ];

        if(request()->tipo_item_model == 'CadTipoEntrada') {
            $request[] = ['tabela' => 'cad_tipo_entrada', 'chave_atribuir' => 'tipo_item_id', 'campo_pesquisar' => 'id_tipo_entrada', 'uuid' => request()->tipo_item_uuid];
        }

        if(request()->tipo_item_model == 'CadTipoSaida') {
            $request[] = ['tabela' => 'cad_tipo_saida', 'chave_atribuir' => 'tipo_item_id', 'campo_pesquisar' => 'id_tipo_saida', 'uuid' => request()->tipo_item_uuid];
        }

        $request = transformUuidToId(request()->all(), $request);

        $item = DreItens::where('fk_id_dre', $request['fk_id_dre'])
                        ->where('tipo_item_id', $request['tipo_item_id'])
                        ->where('tipo_item_model', $request['tipo_item_model'])
                        ->get();

        return $item->count() == 0;
    }

    public function message()
    {
        return 'Item já adicionado no DRE.';
    }
}
