@extends('layouts.master')


@section('title', ' | Home')



@section('content')
    <h3>Here are the Users: </h3>
    <br/><br/>
    @foreach ($users as $user)
        <p>Name: {{$user->name}}</p>
        <p>Email: {{$user->email}} </p>
        <br/>
    @endforeach
@endsection