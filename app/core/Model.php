<?php

declare(strict_types=1);

namespace app\core;

use app\interfaces\IDataProvider;

class Model
{
    public Request $request;
    public IDataProvider $dataProvider;

    public function __construct(IDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
        $this->request = new Request();
    }

    public function all()
    {
        return $this->dataProvider->all();
    }

    public function first($id)
    {
        return $this->dataProvider->first($id);
    }

    public function withLimit($limit, $offset, $page)
    {
        return $this->dataProvider->withLimit($limit, $offset, $page);
    }

    public function create($fields, $values, $data)
    {
        return $this->dataProvider->create($fields, $values, $data);
    }

    public function update($fields, $values, $where, $whereData, $data, $id)
    {
        return $this->dataProvider->update($fields, $values, $where, $whereData, $data, $id);
    }

    public function delete($id)
    {
        return $this->dataProvider->delete($id);
    }
}
