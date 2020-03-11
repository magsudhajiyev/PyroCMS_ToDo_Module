<?php namespace Anomaly\TodosModule\Todo;

use Anomaly\TodosModule\Todo\Contract\TodoInterface;
use Anomaly\Streams\Platform\Model\Todos\TodosTodosEntryModel;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class TodoModel extends TodosTodosEntryModel implements TodoInterface
{
    use Searchable;
    
    public function getTodo($id = null) {
        if($id == null)
        {
            return TodoModel::query();
        }
        return TodoModel::query()->where('todos_todos.id',$id);
    }

    public function getTodoFirst($id) {
        return $this->getTodo($id)->first();
    }

}
