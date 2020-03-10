<?php namespace Anomaly\TodosModule\Todo\Events;

use Illuminate\Support\Facades\Auth;

class NewTodo
{

    public $todo;

    public function __construct($todo)
    {
        $this->todo = $todo;
        $this->user = Auth::user();
    }

}
