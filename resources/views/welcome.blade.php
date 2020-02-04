<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('bootstrap/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">

                    </div>
                    <div class="col-lg-4">
                        <a href="{{route('Workers')}}" class="btn btn-primary">
                            Сотрудники
                        </a>

                        <a href="{{route('Departments')}}" class="btn btn-primary">
                            Отделы
                        </a>

                        <a href="{{route('home')}}" class="btn btn-primary">
                            Главная страница
                        </a>

                    </div>
                </div>
            </div>
        </header>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @yield('content')
    </body>
    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    <script src="{{asset('bootstrap/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
    <script src="{{asset('bootstrap/bootstrap-select.js')}}"></script>

</html>
