<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;
    protected $table = 'auto';
    protected $primaryKey = 'auto_id';
    protected $fillable = ['autonr', 'autogads', 'marka_id', 'motors_id', 'motoratilpums', 'pilnamasa', 'pasmasa', 'piedzina_id'];

    public function marka()
    {
        return $this->belongsTo(Marka::class, 'marka_id');
    }

    public function motors()
    {
        return $this->belongsTo(Motors::class, 'motors_id');
    }

    public function piedzina()
    {
        return $this->belongsTo(Piedzina::class, 'piedzina_id');
    }
}
