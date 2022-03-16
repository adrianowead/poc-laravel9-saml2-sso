@extends('master')

@section('title', 'Dashboard')

@section('content')
    <h3>Dashboard Page</h3>

    @include('partial.user')

    <ul>
        <li>
            <a href="{{ route('home') }}">Para a home</a>
        </li>
        <li>
            <a href="{{ route('logado') }}">Para o admin</a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
@endsection