<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentMevementHistory;
use App\Traits\HasWarehouseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentController extends BaseController
{
    use HasWarehouseTrait;

    private $data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    // создаем оборудование
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'serial_number' => 'required|max:100',
            'inventory_number'=>'required|max:100'
        ]);
        $this->data = $request->request->all();
        $result = Equipment::create($this->data);
        if($result) {
            return redirect()->back()->with('success', 'Оборудование создано успешно!');
        }else {
            return redirect()->back()->with('unsuccessfully', 'Что-то пошло не так! Попробуйте еще раз!');
        }
    }

    // апдейтим оборудование
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'serial_number' => 'required|max:100',
            'inventory_number'=>'required|max:100'
        ]);
        $this->data = $request->request->all();
        Equipment::where('id', $id)
            ->update(['name'=>$this->data['name'],'serial_number'=>$this->data['serial_number'],'inventory_number'=>$this->data['inventory_number']]);
        return redirect()->route('equipment.show_warehouse')->with('success','Данные успешно обновлены');
    }

    // перемещаем оборудование
    public function moved(Request $request)
    {
        if(!$request->equipments) return redirect()->back()->with('unsuccessfully', 'Не выбрано ни одно оборудование!');
        $this->data = $request->request->all();
        $result = $this->createMoved($this->data);
        if($result) {
            return redirect()->route('equipment.show_warehouse')->with('success','Оборудование(-я) успешно перемещено(-ы)');
        }else {
            return redirect()->route('equipment.show_warehouse')->with('unsuccessfully', 'Что-то пошло не так! Попробуйте еще раз!');
        }
    }

    // рендерим форму для редактирования конкретного оборудования
    public function showEdit($id)
    {
        $equipment = DB::table('equipments')->find($id);
        return view('edit',
            [
                'equipment'=>$equipment
            ]
        );
    }

    // рендерим форму для добавления оборудования
    public function showAdd()
    {
        return view('add',['warehouse'=>$this->getCurrentWarehouse()]);
    }

    // рендерим форму склада
    public function showWarehouse()
    {
        $equipments = DB::table('equipments')->where('warehouse_id','=',$this->getCurrentWarehouse()->id)->simplePaginate(15);
        return view('warehouse',
        [
            'equipments'=>$equipments,
            'to_warehouse_id'=>$this->getWarehouse()->id,
            'from_warehouse_id'=>$this->getCurrentWarehouse()->id
        ]);
    }

    // рендерим форму отправленных оборудований с другого склада
    public function showIncoming()
    {
        $incoming_equipments = DB::table('equipment_movement_history')
            ->leftJoin('equipments', 'equipment_movement_history.equipment_id','=','equipments.id')
            ->where('equipment_movement_history.to_warehouse_id','=',$this->getCurrentWarehouse()->id)
            ->where('equipment_movement_history.status','=',0)
            ->get();
        return view('incoming_equipment',
            [
                'equipments'=>$incoming_equipments
            ]
        );
    }

    // создаем перемещение и передаем id оборудований/оборудования для установки типа null
    private function createMoved($data) : bool
    {

        foreach ($data['equipments'] as $equipment) {
            $model = new EquipmentMevementHistory;
            $model->equipment_id = $equipment;
            $model->date_send = $data['date_send'];
            $model->from_warehouse_id = $data['from_warehouse_id'];
            $model->to_warehouse_id = $data['to_warehouse_id'];
            $model->founder_warehouse_id = $data['founder_warehouse_id'];
            $model->status = 0;
            $saved = $model->save();
        }
       if($saved) {
           return $this->resetWarehouseIdInEquipment($data['equipments']);
       }else {
           abort(505);
       }
    }

    // обнуляем warehouse_id, так как после перемещения, оборудование никому не должно принадлежать
    private function resetWarehouseIdInEquipment($ids)
    {
        foreach($ids as $id) {
            $reset = Equipment::where('id',$id)->update(['warehouse_id'=>null]);
        }
        return $reset;
    }

    // принимаем оборудование на склад и вызываем метод для обновления не принятых оборудований
    public function equipmentAccept(Request $request)
    {
        if(!$request->equipments) return redirect()->back()->with('unsuccessfully', 'Не выбрано ни одно оборудование!');
        $this->data = $request->request->all();
        foreach ($this->data['equipments'] as $equipment) {
            Equipment::where('id',$equipment)->update(['warehouse_id'=>$this->getCurrentWarehouse()->id]);
        }
        $result = $this->updateMoved($this->data['equipments'], $this->data['date_accept']);
        if($result) {
            return redirect()->route('equipment.show_warehouse')->with('success','Оборудование(-я) успешно принято(-ы)');
        }else {
            return redirect()->route('equipment.show_warehouse')->with('unsuccessfully', 'Что-то пошло не так! Попробуйте еще раз!');
        }
    }

    // обновляем данные не принятого оборудования
    private function updateMoved($ids, $date_accept) : bool
    {
        foreach ($ids as $id) {
            $update = EquipmentMevementHistory::where(['equipment_id'=>$id,'status'=>0])->update(['date_accept'=>$date_accept,'status'=>1]);
        }
        return $update;
    }

}
