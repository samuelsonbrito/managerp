<?php

use \Carbon\Carbon;
use App\Services\PaisEstadoCidadeService;
use function GuzzleHttp\Psr7\str;

function dataBrParaOBanco($data)
{
    if (!is_null($data) && $data !== "") {
        return Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d');
    } else {
        return null;
    }
}

function createdbdToBr($data)
{
    if (!is_null($data) && $data !== "") {
        return Carbon::createFromFormat('Y-m-d H:i:s', $data)->format('d/m/Y');
    } else {
        return null;
    }

}

function bdToBr($data)
{
    if (!is_null($data) && $data !== "") {
        return Carbon::createFromFormat('Y-m-d', $data)->format('d/m/Y');
    } else {
        return null;
    }
}

function limpaCPF($valor)
{
    $valor = preg_replace('#[^0-9]#', '', $valor);
    return $valor;
}

function limpaTelefone($valor)
{
    $valor_sem_ponto = str_replace("-", "", $valor);
    $valor_double = str_replace("(", "", $valor_sem_ponto);
    $valor_double = str_replace(")", "", $valor_double);

    return $valor_double;
}


function nacionalidade($key)
{
    $pais = PaisEstadoCidadeService::getPaises();
    return $pais[$key];
}

function nacionalidadeNome($nome)
{
    $pais = PaisEstadoCidadeService::getPaises();
    foreach ($pais as $key => $value) {
        if ($value == $nome) {
            return $key;
        }
    }
}

function realProBD($valor)
{
    $valor_sem_ponto = str_replace(".", "", $valor);
    $valor_double = str_replace(",", ".", $valor_sem_ponto);

    return $valor_double;
}

function formatarCnpjCpf($cnpj_cpf)
{
    if (strlen(preg_replace("/\D/", '', $cnpj_cpf)) === 11) {
        $response = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
    } else {
        $response = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    return $response;
}

function allUpper($data)
{
    $data = collect($data)->map(function ($value) {
        $value = mb_strtoupper($value);
        if ($value == "") {
            $value = null;
        }

        return $value;
    });

    return $data;
}