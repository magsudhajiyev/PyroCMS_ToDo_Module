<?php namespace Anomaly\TodosModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\TodosModule\Todo\TodoSeeder;

/**
 * Class PagesModuleSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TodosModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(TodoSeeder::class);
    }
}
