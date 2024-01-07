<?php 

class Appointment extends Model {
    protected $table = 'appointments';
    protected $allowedColumns = [
        'child_id',
        'staff_id',
        'date',
        'time',
        'reason'
    ];

    // Methods for validation, insertion, etc.
}