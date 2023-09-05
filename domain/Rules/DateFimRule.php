<?php

namespace MVC\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DateFimRule implements Rule {

    public function passes($attribute, $value)
    {
        $data_inicio = Carbon::createFromFormat('d/m/Y', request()->data_inicio);
        $data_fim    = Carbon::createFromFormat('d/m/Y', $value);

        return $data_fim->greaterThan($data_inicio);
    }

    public function message()
    {
        return 'A Data Fim deve ser maior que a Data Início';
    }
}
