@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('vehicle.create') }}" class="btn btn-warning">Create</a>
                    </div>

                    <div class="card-body py-3">
                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-bordered" id="table" data-url="{{ route('task2.list') }}"  style="width: 100%">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        var DataTable = function () {
            var initTable = function () {
                var $tableElement = $('#table');

                var table = $tableElement.DataTable({
                    searching: false,
                    lengthChange: false,
                    ajax: {
                        url: $tableElement.data('url'),
                    },
                    order: [[0, 'asc']],
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name'},
                        { data: 'actions', name: 'actions', orderable: false},
                    ],
                });
            };

            return {
                init: function () {
                    initTable();
                }
            };
        }();

        $(document).ready(function() {
            DataTable.init();
        });
    </script>
@endpush
