<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Categories</title>
    <!-- Dodajemo Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        /* Možete dodati svoje prilagođene stilove ovde */
    </style>
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h1 class="mt-5 mb-4 text-center">All Categories</h1>
    <div class="table-responsive rounded">
        <table class="table table-bordered table-success text-center mx-auto w-50">
            <thead>
            <tr>
                <th>Category Name</th>
                <th>Added By</th>
                {{--                <th>Role</th>--}}
{{--                <th>Added by</th>--}}
                <!-- Dodajte dodatne zaglavlja kolona prema potrebi -->
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->vehicle_cat }}</td>

                    <td>
                        @if($category->created_by)
                            {{ \App\Models\User::find($category->created_by)->name }}
                        @else
                        @endif
                    </td>

                    @can('manage-categories')
                        <td>
                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-light">
                                Update
                            </a>
                        </td>
                    @endcan
                    {{--                    <td>{{ $category->createdBy->name }}</td>--}}
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>

{{--<div class="text-center mt-4">--}}
{{--    <a href="/" class="btn btn-success">Back</a>--}}
{{--</div>--}}

<!-- Dodajemo Bootstrap JavaScript i jQuery (opciono) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
