<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Перемещение оборудований</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <input id="myInput" class="form-control mb-2" type="text" placeholder="Поиск...">
                <form action="{{route('equipment.moved')}}" method="POST">
                   @csrf
                    <input type="hidden" value="{{$from_warehouse_id}}" name="founder_warehouse_id">
                    <input type="hidden" value="{{$from_warehouse_id}}" name="from_warehouse_id">
                    <input type="hidden" value="{{$to_warehouse_id}}" name="to_warehouse_id">
                    <input type="hidden" value="{{date('Y.m.d')}}" name="date_send">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Серийный номер</th>
                            <th scope="col">Инвентарный номер</th>
                        </tr>
                        </thead>
                        <tbody id="equipment">
                        @foreach($equipments as $equipment)
                            <tr>
                                <th scope="row"><input value="{{$equipment->id}}" type="checkbox" name="equipments[]" class="form-check-input custom-checkbox"></th>
                                <td>{{$equipment->name}}</td>
                                <td>{{$equipment->serial_number}}</td>
                                <td>{{$equipment->inventory_number}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
