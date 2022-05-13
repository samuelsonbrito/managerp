<?php
/**
 * Created by PhpStorm.
 * User: messias
 * Date: 04/02/19
 * Time: 23:19
 */

namespace App\Services;

use App\Repositories\Departamento\DepartamentoRepositoryEloquent as DepartamentoRepository;

class DepartamentoServices
{

    private $departamentoRepository;


    function __construct(DepartamentoRepository $departamentoRepository) {

        $this->departamentoRepository = $departamentoRepository;
    }


    public function getDepartamentos() {
      return  $this->departamentoRepository->all();
    }
}