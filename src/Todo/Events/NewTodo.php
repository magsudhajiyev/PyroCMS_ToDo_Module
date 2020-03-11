<?php namespace Anomaly\TodosModule\Todo\Events;

use Illuminate\Support\Facades\Auth;

class NewTodo
{

    public $todo;
    public $user;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    

    public function __construct($todo)
    {
        $this->todo = $todo;
        $this->user = Auth::user();
    }

}
