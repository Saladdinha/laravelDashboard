<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociativeClientEnrollment extends Model
{
    use HasFactory;

    protected $table = 'associative_clients_enrollments';
    protected $primary_key = 'id';
}
