<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait HasWarehouseTrait
{
    // получаем текущий склад
    public function getCurrentWarehouse()
    {
        $warehouse = DB::table('warehouse')->where('user_id','=',auth()->user()->id)->first();
        return $warehouse;
    }

    // получаем склад, если будет больше складов, то нужно вернуть all
    public function getWarehouse()
    {
        $warehouse = DB::table('warehouse')->where('user_id','!=',auth()->user()->id)->first();
        return $warehouse;
    }
}
