<?php


namespace Anomaly\TodosModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Anomaly\TodosModule\Todo\TodoModel;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Database\Eloquent\Builder;

class AdminFilter
{
    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->where('created_by_id', $filter->getValue());
    }
}
