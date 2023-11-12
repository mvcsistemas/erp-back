<?php

namespace MVC\Models\FluxoCaixaEntrada;

use MVC\Base\MVCRequest;

class FluxoCaixaEntradaRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'                      => '',
            'data_fluxo_caixa_entrada'  => 'required',
            'valor_fluxo_caixa_entrada' => 'required',
            'fk_uuid_tipo_entrada'      => 'required',
            'fk_uuid_fluxo_caixa'       => 'required',
            'fk_uuid_grupo_financeiro'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data_fluxo_caixa_entrada.required'  => 'O campo Data é obrigatório.',
            'valor_fluxo_caixa_entrada.required' => 'O campo Valor é obrigatório.',
            'fk_uuid_tipo_entrada.required'      => 'O campo Tipo entrada é obrigatório.',
            'fk_uuid_fluxo_caixa.required'       => 'O campo Fluxo é obrigatório.',
            'fk_uuid_grupo_financeiro.required'  => 'O campo Grupo Financeiro é obrigatório.'
        ];
    }
}
