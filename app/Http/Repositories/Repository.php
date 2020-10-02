<?php


namespace App\Http\Repositories;
use App\Http\interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
         $this->model = $model;
    }

    public function all()
    {
        // TODO: Implement all() method.
       return $this->model->all();

    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
        $record =  $this->find($id);
       return $record->update($data);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        return $this->model->findOrFail($id);
    }

    /*Get associated model*/
    public  function getModel(){
        return$this->model;
    }

    /*Set associated model*/
    public  function SetModel($model){
        return $this->model = $model;
    }

    /*Eager  load database*/
    public function with($relation){
        return $this->model->with($relation);

    }
}
