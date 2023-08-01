<?php

namespace app\interfaces;

interface IDataProvider
{
    public function first($id);

    public function all();

    public function withLimit($limit, $offset, $page);

    public function create($fields, $values, $data);

    public function update($fields, $values, $where, $whereData, $data, $id);

    public function delete($id);
}
