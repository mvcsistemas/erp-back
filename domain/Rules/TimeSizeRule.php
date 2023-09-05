<?php

namespace MVC\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeSizeRule implements Rule {

    public function passes($attribute, $value)
    {
        $hora_inicio = request()->hora_inicio;

        return $value > $hora_inicio;
    }

    public function message()
    {
        return 'O Fim deve ser maior que o Início';
    }
}
