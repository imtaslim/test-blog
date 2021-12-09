<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            @if (session('SUCCESS'))
                <div class="m-4 px-4 py-2 text-center border border-green-600 bg-green-200 text-green-800">
                    {{ session('SUCCESS') }}
                </div>
            @endif

            @if (session('ERROR'))
                <div class="m-4 px-4 py-2 text-center border border-red-600 bg-red-200 text-red-800">
                    {{ session('ERROR') }}
                </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <form id="delete-from" action="" method="post">
                @csrf
                <input type="hidden" id="method" name="_method" value="DELETE">
            </form>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script>
                $(document).on('click','.delete-row',function (e){
                e.preventDefault();
                let confrimStr = "Are you sure?"
                if($(this).attr("data-confirm")){
                    confirmStr = $(this).attr("data-confirm");
                    }
                    if(confirm(confirmStr)) {
                        let href = $(this).attr("href");
               $("#delete-from").attr("action",href);
               $("#delete-from").submit();
               }
            })
            $(document).on('click','.complete-todo',function (e){
                e.preventDefault();
                let confrimStr = "Are you sure?"
                if($(this).attr("data-confirm")){
                    confirmStr = $(this).attr("data-confirm");
                    }
                if(confirm(confirmStr)) {
                    let href = $(this).attr("href");
                    $("#method").attr("value", "PUT");
               $("#delete-from").attr("action",href);
               $("#delete-from").submit();
               }
            })
            </script>
        </div>
    </body>
</html>
