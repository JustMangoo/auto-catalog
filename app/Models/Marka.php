<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marka extends Model
{
    use HasFactory;
    protected $table = 'marka';
    protected $primaryKey = 'marka_id';

    public function auto()
    {
        return $this->hasMany(Auto::class, 'auto_id');
    }
}
