@extends('master')

@section('title', 'Admin')

@section('content')
    <h3>Admin Home</h3>

    @include('partial.user')

    <ul>
        <li>
            <a href="{{ route('home') }}">Para a home</a>
        </li>
        <li>
            <a href="{{ route('dash') }}">Para a dash</a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
@endsection