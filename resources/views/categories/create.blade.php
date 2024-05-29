

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add Category</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Centriranje forme */
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Širina forme */
        .custom-form {
            width: 50%;
        }
    </style>

</head>

<body>

@if(session()->has('success'))
    <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
@endif

<h2 class="text-center mt-4">Add Category</h2>
<div class="center-form">
    <form method="POST" action="{{ route('categories.store') }}" class="custom-form border p-4">
        @csrf

        <div class="form-group mb-3">
            <label for="vehicle_cat" class="form-label">Name:</label>
            <input type="text" name="vehicle_cat" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>

<div class="text-center mt-3">
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html><html>
