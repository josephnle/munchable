@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Find a place to eat with your friends</h2>
        <hr />

        @foreach($places as $place)
            {{ $place->venue_id }}
        @endforeach
    </div>
@endsection