<?php

namespace MVC\Models\FluxoCaixaSaida;

use MVC\Base\MVCRequest;

class FluxoCaixaSaidaRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                    => '',
            'data_fluxo_caixa_saida'  => 'required',
            'valor_fluxo_caixa_saida' => 'required',
            'fk_id_tipo_saida'        => 'required',
            'fk_id_fluxo_caixa'       => 'required',
            'fk_id_grupo_financeiro'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data_fluxo_caixa_saida.required'  => 'O campo Data é obrigatório.',
            'valor_fluxo_caixa_saida.required' => 'O campo Valor é obrigatório.',
            'fk_id_tipo_saida.required'        => 'O campo Tipo saída é obrigatório.',
            'fk_id_fluxo_caixa.required'       => 'O campo Fluxo é obrigatório.',
            'fk_id_grupo_financeiro.required'  => 'O campo Grupo Financeiro é obrigatório.'
        ];
    }
}
