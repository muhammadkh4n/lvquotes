@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
  <ul>
    @foreach ($authors as $author)
      <li>{{ $author->name }} - <span>{{ $author->email }}</span></li>
    @endforeach
  </ul>
@endsection