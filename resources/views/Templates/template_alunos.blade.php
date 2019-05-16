<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    

</head>
<body>
    @include('Menu.menu')

    @yield('content')


   
    @stack('scripts')
</body>
</html>
