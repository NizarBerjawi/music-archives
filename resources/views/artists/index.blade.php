@extends('layouts.app')

@section('content')
    @foreach($artists as $artist)
        <p>{{ $artist }}</p>
    @endforeach
@endsection
