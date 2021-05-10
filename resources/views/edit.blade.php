@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <form method="POST" autocomplete="off" action="{{route('equipment.update', ['id'=>$equipment->id])}}">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Наименование</label>
                    <input value="{{$equipment->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="serial_number" class="col-form-label">Серийный номер</label>
                    <input value="{{$equipment->serial_number}}" type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" required>
                    @error('serial_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inventory_number" class="col-form-label">Инвентарный номер</label>
                    <input value="{{$equipment->inventory_number}}" type="text" class="form-control @error('inventory_number') is-invalid @enderror" id="inventory_number" name="inventory_number" required>
                    @error('inventory_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </form>
        </div>

    </div>
@endsection
