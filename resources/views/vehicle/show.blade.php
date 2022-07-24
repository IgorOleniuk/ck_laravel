@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       <a href="{{ route('vehicle.index') }}" class="text-decoration-none ">Back to List</a>
                    </div>
                    <div class="card-body">
                        Vehicle type: <span class="text-warning">{{ $vehicle->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
