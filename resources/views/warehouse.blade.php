@extends('layouts.app')
@include('partials.modal')
@section('content')
    <div class="container-fluid">
        <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-info">Перемещение оборудований</button>
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">Наименование</th>
                <th scope="col">Серийный номер</th>
                <th scope="col">Инвентарный номер</th>
            </tr>
            </thead>
            <tbody>
            @foreach($equipments as $equipment)
                <tr>
                    <td>{{$equipment->name}}</td>
                    <td>{{$equipment->serial_number}}</td>
                    <td>{{$equipment->inventory_number}}</td>
                    <td><a class="btn btn-outline-primary" href="{{route('equipment.show_edit',['id'=>$equipment->id])}}">Редактировать</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">{{ $equipments->links('partials.simple-bootstrap-4') }}</div>
        <div class="out">

        </div>
    </div>
@endsection
