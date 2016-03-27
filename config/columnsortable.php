<?php

return [

    /*
    Spec columns
    */
    'columns' => [
        'numeric_columns'  => [
            'rows' => ['created_at', 'updated_at', 'level', 'id'],
            'class' => 'fa fa-sort-numeric'
        ],
        'amount_columns'   => [
            'rows' => ['price'],
            'class' => 'fa fa-sort-amount'
        ],
        'alpha_columns'    => [
            'rows' => ['name', 'description', 'title', 'email', 'slug'],
            'class' => 'fa fa-sort-alpha',
        ],
    ],

    /*
    Defines icon set to use when sorted data is none above.
    */
    'default_icon_set' => 'fa fa-sort',

    /*
    Icon that shows when generating sortable link while column is not sorted.
    */
    'sortable_icon'    => 'fa fa-sort',

    /*
    suffix class that is appended when ascending order is applied
    */
    'asc_suffix'        => '-asc',
    /*
    suffix class that is appended when descending order is applied
    */
    'desc_suffix'       => '-desc',
    /*
    default anchor class, if value is null none is added
    */
    'anchor_class'      => null,
    /*
    relation - column separator. ex: detail.phone_number means relation "detail" and column "phone_number"
     */
    'uri_relation_column_separator' => '.'

];
