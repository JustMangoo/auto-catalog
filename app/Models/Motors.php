<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motors extends Model
{
    use HasFactory;
    protected $table = 'motors';
    protected $primaryKey = 'motors_id';

    public function auto()
    {
        return $this->hasMany(Auto::class, 'auto_id');
    }
}
