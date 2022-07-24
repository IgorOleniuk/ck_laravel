<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task 1</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="antialiased">
<div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
        Back
    </a>
</div>
<div class="container bg-light p-3">
    <h1 class="mt-2 text-center">Task 1</h1>

    <form class="mt-5" method="get" action="{{ route('task1.data') }}">

        <div class="form-group row mb-3">
            <label for="search" class="col-sm-1 col-form-label">
               Search:
            </label>
            <div class="col-sm-11">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search books">
            </div>
        </div>

        <div class="form-group mb-3">
            <select name="category" id="category" class="form-control">
                <option value="">Choose category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->get('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="in_stock" name="in_stock" class="form-check-input">
            <label for="in_stock" class="form-check-label">
                In Stock
            </label>
        </div>

        <button type="button" class="btn btn-primary" id="filter_btn">Search</button>

    </form>

    <div class="table-responsive mt-5">
        <table class="table table-striped table-bordered" id="table" data-url="{{ route('task1.data') }}"  style="width: 100%">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>In stock</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // DataTable.init();
        var $tableElement = $('#table');

        var table = $tableElement.DataTable({
            ajax: {
                url: $tableElement.data('url'),
            },
            order: [[0, 'asc']],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title'},
                { data: 'category', name: 'category'},
                { data: 'in_stock', name: 'in_stock'},
            ],
            searching: false,
        });

        $(document).on('click', '#filter_btn', function() {
            $.ajax({
                url: $tableElement.data('url'),
                type: 'GET',
                data: {
                    'search': $('#search').val(),
                    'category': $('#category').val(),
                    'in_stock': $('#in_stock').is(":checked")
                },
                success: function(res) {
                    table.clear();
                    table.rows.add(res.data).draw();
                }
            });
        });
    });
</script>

</body>
</html>
