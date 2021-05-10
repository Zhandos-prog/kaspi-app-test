<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentMevementHistory extends Model
{
    use HasFactory;

    protected $table = 'equipment_movement_history';

    public $timestamps = false;
}
