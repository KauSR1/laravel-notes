<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel-Notes</title>

    {{-- CSS do Bootstrap e FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    {{-- Ícone da aba (Favicon) --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
</head>
<body>

{{-- Onde o conteúdo das outras views será renderizado --}}
@yield('content')

{{-- JS do Bootstrap --}}
<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
