<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('css/base.css') }}">
    <!-- Scripts -->
    <script src='{{ URL::asset('js/jquery.min.js') }}'></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if(Route::current()->getName() == 'dashboard' || Route::current()->getName() == 'csv')
    <script>
        const ajax = {
            "makeCsv": "{{ route('makeCsv') }}",
            "bulkMakeCsv": "{{ route('bulkMakeCsv') }}",
            "updateClient": "{{ route('updateClient') }}",
            "bulkUpdateClient": "{{ route('bulkUpdateClient') }}",
            "deleteClient": "{{ route('deleteClient') }}",
            "bulkDeleteClient": "{{ route('bulkDeleteClient') }}",
            "token": "{{ csrf_token() }}"
        }
    </script>
    <script src='{{ URL::asset('js/table.js') }}'></script>
    @endif
    @if(Route::current()->getName() == 'dashboard')
    <script src='{{ URL::asset('js/dashboard.js') }}'></script>
    @endif
    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
</head>

<body class="font-sans antialiased">
    <div class='alert'>

    </div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>