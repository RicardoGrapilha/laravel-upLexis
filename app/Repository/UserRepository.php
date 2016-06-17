<?php namespace App\Repository;

use App\Repository\AbstractRepository;
use App\Repository\UserRepositoryInterface;

use App\Models\Usuario;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(Usuario $model)
    {
        $this->model = $model;
    }
}
