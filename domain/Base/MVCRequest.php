<?php

namespace MVC\Base;

use Illuminate\Foundation\Http\FormRequest;

class MVCRequest extends FormRequest {

    public function authorize()
    {
        return true;
    }
}
