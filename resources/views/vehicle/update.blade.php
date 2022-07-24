@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Update vehicle') }}
                        <a href="{{ route('vehicle.index') }}" class="text-decoration-none ">Back to List</a>
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('vehicle.update', ['vehicle' => $vehicle]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="search" class="form-label">
                                    Vehicle Type Name:
                                </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="New Vehicle" required value="{{ $vehicle->name ?? null }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
