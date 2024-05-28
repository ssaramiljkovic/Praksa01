<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <!-- Dodajemo Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        /* Možete dodati svoje prilagođene stilove ovde */
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4 text-center">All Users</h1>
    <div class="table-responsive rounded">
        <table class="table table-bordered table-success text-center mx-auto w-50">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <!-- Dodajte dodatne zaglavlja kolona prema potrebi -->
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @if (Bouncer::can('edit-users'))
                    <td>
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-light">
                            Update
                        </a>
                    </td>
                    @endif
                    <!-- Dodajte dodatne kolone prema potrebi -->
{{--                    <td>--}}
{{--                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-light">--}}
{{--                            Update--}}
{{--                        </a>--}}

{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="text-center mt-4">
    <a href="/" class="btn btn-success">Back</a>
</div>

<!-- Dodajemo Bootstrap JavaScript i jQuery (opciono) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


