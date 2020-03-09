<?php


namespace Anomaly\TodosModule\Todo\Table;


use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class TodoFilter
{
    public function handle(Builder $query, FilterInterface $filter)
    {
         $query->where('name', 'LIKE', "%{$filter->getValue()}%");
    }
}
