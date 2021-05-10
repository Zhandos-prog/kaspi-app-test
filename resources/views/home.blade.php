@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>{{$warehouse->name}}</h1>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Количество оборудований
                <span class="badge badge-primary badge-pill">{{$equipment_count}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Входящие оборудования
                <span class="badge badge-primary badge-pill">{{$incoming_equipment_count}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Отправленные оборудования
                <span class="badge badge-primary badge-pill">{{$send_equipment_count}}</span>
            </li>
        </ul>
    </div>
@endsection
