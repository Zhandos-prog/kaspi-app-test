<?php

namespace App\Http\Controllers;


use App\Models\Equipment;
use App\Traits\HasWarehouseTrait;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    use HasWarehouseTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $equipment_count = Equipment::where('warehouse_id',$this->getCurrentWarehouse()->id)->count();
        $incoming_equipment_count = DB::table('equipment_movement_history')->where(['to_warehouse_id'=>$this->getCurrentWarehouse()->id,'status'=>0])->count();
        $send_equipment_count = DB::table('equipment_movement_history')->where(['from_warehouse_id'=>$this->getCurrentWarehouse()->id,'status'=>0])->count();
        return view('home', [
            'warehouse' => $this->getCurrentWarehouse(),
            'incoming_equipment_count'=>$incoming_equipment_count,
            'send_equipment_count'=>$send_equipment_count,
            'equipment_count'=>$equipment_count
        ]);
    }
}
