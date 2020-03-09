<?php namespace Anomaly\TodosModule\Http\Controller\Admin;

use Anomaly\TodosModule\Todo\Form\TodoFormBuilder;
use Anomaly\TodosModule\Todo\Table\TodoFilter;
use Anomaly\TodosModule\Todo\Table\TodoTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Builder;
use DB;


class TodosController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param TodoTableBuilder $table
     * @param Builder $query
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TodoTableBuilder $table, Builder $query)
    {
        $table->setFilters([
            'Todo' => [
                'filter' => 'select',
                'placeholder' => 'Username',
                'query'       => AdminFilter::class,
                'options' => function () {
                    return UserModel::query()->get()->pluck('display_name','id')->all();
                },
            ],

            'Search' => [
                'filter' => 'input',
                'placeholder' => 'Todo Info',
                'query' => Inputfilter::class,
            ],
        ]);
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param TodoFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TodoFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param TodoFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TodoFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
