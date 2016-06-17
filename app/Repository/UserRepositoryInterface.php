<?php namespace App\Repository;

interface UserRepositoryInterface
{
    public function paginate($perPage = 15, $columns = array('*'));
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function findAll($columns = array('*'));
    public function find($id, $columns = array('*'));
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}