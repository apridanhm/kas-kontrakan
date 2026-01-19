<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kas Kontrakan</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

@include('layouts.navigation')

<main class="max-w-7xl mx-auto p-4">
    @yield('content')
</main>

</body>
</html>
