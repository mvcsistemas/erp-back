<?php

function setData($value)
{
    if (trim($value) == '') {
        return null;
    }

    return \DateTime::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
}

function convertTime($value, $format = 'H:i')
{
    if (trim($value) == '') {
        return '';
    }

    return date($format, strtotime($value));
}

function convertDateTime($value, $format = 'Y-m-d H:i:s')
{
    if (trim($value) == '') {
        return '';
    }

    return date($format, strtotime($value));
}

function setDataFormatoBr($data)
{
    return date("d/m/Y", strtotime($data));
}

function setDateTimeFormatoBr($data)
{
    return date("d/m/Y H:i", strtotime($data));
}

function setTimeHoursMinutes($time)
{
    return date('H:i', strtotime($time));
}

function transformUuidToId(array $request, array $data)
{
    foreach ($data as $item) {
        $campo_pesquisar = $item['campo_pesquisar'];

        $request[$item['chave_atribuir']] = \DB::table($item['tabela'])
                                               ->where('uuid', $item['uuid'])
                                               ->first()->$campo_pesquisar;
    }

    return $request;
}
