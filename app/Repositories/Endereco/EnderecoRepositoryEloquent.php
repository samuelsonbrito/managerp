<?php

namespace App\Repositories\Endereco;

use App\Models\Endereco;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class EnderecoRepositoryEloquent extends BaseRepository implements EnderecoRepository
{
    public function model()
    {
        return Endereco::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $data)
    {

        $data = collect($data)->map(function ($value) {
            $value = mb_strtoupper($value);
            if ($value == "") {
                $value = null;
            }

            return $value;
        });

        $data = $data->toArray();
        $endereco = $this->makeModel()->create($data);

        return $endereco;
    }
    
}
