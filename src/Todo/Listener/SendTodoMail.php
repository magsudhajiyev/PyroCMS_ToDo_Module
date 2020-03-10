<?php

namespace Anomaly\TodosModule\Todo\Listener;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\TodosModule\Todo\Events\NewTodo;
use Anomaly\TodosModule\Todo\Notification\SendNewTodoMail;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendTodoMail
{

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function handle(NewTodo $event)
    {
        $this->userRepo->find(Auth::id())->notify(new SendNewTodoMail($event->user, $event->todo));
    }
}
