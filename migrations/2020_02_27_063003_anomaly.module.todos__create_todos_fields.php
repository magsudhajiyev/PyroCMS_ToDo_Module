<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleTodosCreateTodosFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'body' => 'anomaly.field_type.textarea',
        'deleted_at' => 'anomaly.field_type.datetime',
        'slug' => [
            'type' => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type' => '_'
            ],
        ],
    ];

}
