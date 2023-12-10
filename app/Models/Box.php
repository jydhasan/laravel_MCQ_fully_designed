<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'quiz_table_name',
        'quiz_result_table_name',
        'quiz_time',
        'quiz_title',
        'quiz_description',
        'quiz_notice',
        'quiz_subject',
        'quiz_live_status',
        'file_type',
    ];
}
