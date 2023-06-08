<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'class_id',
        'level',
        'parent_phone_number'
    ];

    public function classes(){
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
}
