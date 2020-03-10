<?php namespace Anomaly\TodosModule\Todo\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\TodosModule\Todo\Events\NewTodo;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Composer\EventDispatcher\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class SendNewTodoMail extends Notification implements ShouldQueue
{

    use Queueable;

    public $todo;
    public $user;

    public function __construct($user, $todo)
    {
        $this->todo = $todo;
        $this->user = $user;
    }

    public function via()
    {
        return ['mail'];
    }


    public function toMail()
    {
        return (new MailMessage())
            ->subject($this->todo->name)
            ->line($this->todo->name);

    }
}
