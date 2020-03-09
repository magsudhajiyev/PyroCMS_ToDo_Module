<?php namespace Anomaly\TodosModule\Todo;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Support\Str;
use Anomaly\TodosModule\Todo\Contract\TodoRepositoryInterface;

class TodoSeeder extends Seeder
{
    protected $widgets;

    public function __construct(TodoRepositoryInterface $todos)
    {
        $this->todos = $todos;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
       $this->todos->turnucate();

       for($i = 0; $i < 3; $i++)
       {
        $this->todos->create(
            [
                'name' => 'Example Todo '.rand(1,99),
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'slug' => Str::random(10),
                'created_by_id' => rand(1, 2),
            ]
        );
       }

    }
}
