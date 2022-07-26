<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($data) {

        if (get_class($data) == get_class($this->model)) {
            return $data->save();
        }

        throw new \InvalidArgumentException("Argument must be of type ".get_class($this->model));
    }

    public function update($data, $id = 0, $attribute="id") {
        if ($data instanceof Model) {
            return $data->save();
        }
        if (is_array($data)) {
            return $this->model->where($attribute, '=', $id)->update($data);
        }

        throw new \InvalidArgumentException("Arguments must be a model or an array with an ID");
    }

    public function delete($ids) {
        return $this->model->destroy($ids);
    }
}
