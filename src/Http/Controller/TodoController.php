<?php namespace Anomaly\TodosModule\Http\Controller;

use Anomaly\TodosModule\Todo\Events\NewTodo;
use Anomaly\TodosModule\Todo\TodoModel;
use Anomaly\TodosModule\Todo\Form\TodoFormBuilder;
use Anomaly\TodosModule\Todo\Contract\TodoRepositoryInterface;
use Anomaly\TodosModule\Todo\Table\TodoTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Anomaly\Streams\Platform\Entry\EntryCriteria;
use App\Exports\TodosExport;
use App\Imports\TodosImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class TodoController extends AdminController
{
    protected $todo;

    public function __construct(UserRepositoryInterface $user)
    {
        parent::__construct();
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $this->user = $user;
    }

    public function checkTodoName($todoName)
    {
        return (DB::table('todos_todos')->where('name', '=', $todoName)->count());
    }

    public function index()
    {
        if (isset($_GET['paginate'])) {
            $paginate = $_GET['paginate'];
        } else {
            $paginate = 5;
        }

        $id = Auth::id();
        if ($this->request->action == "Search") {
            $searchValue = $this->request->get('keywords');
            $todos = DB::table('todos_todos')->where('name', 'like', '%' . $searchValue . '%')->where('deleted_at', NULL)->where('created_by_id', $id)->paginate($paginate);

            if (count($todos) == 0) {
                $message = "There is no any records based on your search criteria. Please try with different inputs.";
            }
            return $this->view->make('anomaly.module.todos::index', compact('user', 'todos', 'id', 'message'));
        }

        $todos = TodoModel::query()->where('created_by_id', $id)->where('deleted_at', NULL)->paginate($paginate);

        return $this->view->make('anomaly.module.todos::index', compact('user', 'todos', 'id'));
    }

    public function create()
    {
        return $this->view->make('anomaly.module.todos::create', compact('user', 'todos'));
    }

    public function ajaxCreate(Request $request)
    {
        $name = $request->name;
        $body = $request->body;

        if ($this->checkTodoName($name) > 0) {
            return response()->json(['message' => 'There is already a record with same name. Please change the name and try again.']);
        } else {
            $todo = new TodoModel;

            $todo->name = $name;
            $todo->body = $body;

            $todo->save();

            event(new NewTodo($todo));

            return response()->json(['message' => 'You have succesfully created new todo!']);
        }
    }

    public function edit(Request $request, $id)
    {
        $id = $request->route('id');
        $todoModel = new TodoModel();
        $todo = $todoModel->getTodoFirst($id);

        return $this->view->make('anomaly.module.todos::edit', compact('todo'));
    }

    public function ajaxUpdate(Request $request)
    {
        $todoModel = new TodoModel();

        $id = $request->id;
        $todo = $todoModel->getTodoFirst($id);

        if ($this->checkTodoName($request->name) > 0) {
            return response()->json(['message' => 'There is already a record with same name. Please change the name and try again.']);
        } else {
            DB::table('todos_todos')->where('id', $id)->update([
                'name' => $request->name,
                'body' => $request->body
            ]);

            return response()->json(['message' => 'You have succesfully updated this record']);
        }
    }

    public function ajaxDelete(Request $request)
    {
        $id = $request->id;

        $todoModel = new TodoModel();
        $todo = $todoModel->getTodoFirst($id);

        $todo->update([
            'todos_todos.deleted_at' => date('Y-m-d H:m:s')
        ]);
        return response()->json(['message' => 'You have succesfully deleted this record']);
    }

    public function export()
    {
        return Excel::download(new TodosExport, 'todos.xlsx');

        return back();
    }

    public function import()
    {
        Excel::import(new TodosImport,request()->file('file'));
        return $this->view->make('anomaly.module.todos::index');
    }

    public function algSearch()
    {
        $query = 'Todo'; // <-- Change the query for testing.

        $todos = TodoModel::search($query)->get();
        dd($todos);
        return $todos;
    }

}
