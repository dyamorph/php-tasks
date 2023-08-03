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

    public function withLimit($page, $limit)
    {
        return $this->dataProvider->withLimit($page, $limit);
    }

    public function create($data)
    {
        return $this->dataProvider->create($data);
    }

    public function update($data, $id)
    {
        return $this->dataProvider->update($data, $id);
    }

    public function delete($id)
    {
        return $this->dataProvider->delete($id);
    }
}
