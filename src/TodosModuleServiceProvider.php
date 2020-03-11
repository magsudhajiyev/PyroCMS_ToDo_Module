<?php namespace Anomaly\TodosModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\TodosModule\Todo\Contract\TodoRepositoryInterface;

use Anomaly\TodosModule\Todo\Events\NewTodo;
use Anomaly\NotificationModule\Notify\Listener\SendMail;

use Anomaly\TodosModule\Todo\TodoRepository;
use Anomaly\TodosModule\Todo\Form\TodoFormBuilder;
use Anomaly\Streams\Platform\Model\Todos\TodosTodosEntryModel;
use Anomaly\TodosModule\Todo\TodoModel;
use Illuminate\Routing\Router;

class TodosModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        '/todo' => [
            'as' => 'anomaly.module.todos::index',
            'uses' => 'Anomaly\TodosModule\Http\Controller\TodoController@index'
        ],

        'todo/export' => [
            'as' => 'anomaly.module.todos::export',
            'uses' => 'Anomaly\TodosModule\Http\Controller\TodoController@export'
        ],

        'todo/import' => [
            'as' => 'anomaly.module.todos::import',
            'uses' => 'Anomaly\TodosModule\Http\Controller\TodoController@import'
        ],

        'todo/create' => [
            'as' => 'anomaly.module.todos::create',
            'uses' => 'Anomaly\TodosModule\Http\Controller\TodoController@create',
        ],

        'todo/edit/{id}' => [
            'as' => 'anomaly.module.todos::edit',
            'uses' => 'Anomaly\TodosModule\Http\Controller\TodoController@edit',
        ],

        'todo/delete/{id}' => [
            'as' => 'anomaly.module.todos::delete',
            'uses' => 'Anomaly\TodosModule\Http\Controller\TodoController@delete',
        ],

        'todo/ajaxCreate' => 'Anomaly\TodosModule\Http\Controller\TodoController@ajaxCreate',
        'todo/ajaxDelete/{id}' => 'Anomaly\TodosModule\Http\Controller\TodoController@ajaxDelete',
        'todo/ajaxUpdate/{id}' => 'Anomaly\TodosModule\Http\Controller\TodoController@ajaxUpdate',

        'admin/todos' => 'Anomaly\TodosModule\Http\Controller\Admin\TodosController@index',
        'admin/todos/create' => 'Anomaly\TodosModule\Http\Controller\Admin\TodosController@create',
        'admin/todos/edit/{id}' => 'Anomaly\TodosModule\Http\Controller\Admin\TodosController@edit',
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Anomaly\TodosModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Anomaly\TodosModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        NewTodo::class => [
            SendMail::class,
        ],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Anomaly\TodosModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        'todo' => TodoFormBuilder::class,
        TodosTodosEntryModel::class => TodoModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        TodoRepositoryInterface::class => TodoRepository::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
    }

}
