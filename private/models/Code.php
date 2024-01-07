<?php

class Code extends Model
{

    protected $table = 'codes';
    protected $allowedColumns = [
        'email',
        'code',
        'expire',

    ];
}
