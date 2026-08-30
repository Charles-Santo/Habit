<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo', 'Imobiliária')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}" type="image/png" sizes="32x32">
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}" type="image/png">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icon.png') }}?v=1">
</head>

<body>
    <main>
        @yield('conteudo')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>