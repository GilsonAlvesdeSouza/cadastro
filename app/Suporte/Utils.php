<?php


namespace App\Suporte;


class Utils
{
    /**
     * converte data da base de dados para o formato PT-br
     * @param string|null $param
     * @return false|string|null
     */
    public static function convertDateToString(?string $param)
    {
        if (empty($param)){
            return null;
        }
        return date("d/m/Y", strtotime($param));
    }

}
