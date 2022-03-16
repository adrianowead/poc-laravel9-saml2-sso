<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <a href="/admin">Ir para área restrita</a>
</body>
</html>

@extends('master')

@section('title', 'Home')

@section('content')
    <h3>Home comum, logado e deslogado</h3>

    @include('partial.user')

    <ul>
        <li>
            <a href="{{ route('dash') }}">Para a admin</a>
        </li>
    </ul>
@endsection