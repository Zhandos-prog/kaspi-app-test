@extends('layouts.app')

@section('content')
    <div class="container-fluid">
            <form action="{{route('equipment.equipment-accept')}}" method="POST">
                @csrf
                <input type="hidden" name="date_accept" value="{{date('Y.m.d')}}">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Серийный номер</th>
                        <th scope="col">Инвентарный номер</th>
                        <th scope="col">Дата отправки</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($equipments as $equipment)
                        <tr>
                            <th scope="row"><input value="{{$equipment->id}}" type="checkbox" name="equipments[]" class="form-check-input custom-checkbox"></th>
                            <td>{{$equipment->name}}</td>
                            <td>{{$equipment->serial_number}}</td>
                            <td>{{$equipment->inventory_number}}</td>
                            <td>{{$equipment->date_send}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-info all-checked">Отметить все</button>
                <button type="submit" class="btn btn-success">Принять</button>
            </form>
    </div>
@endsection
