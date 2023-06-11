@extends('layouts.layout')

@section('title')

@section('content')
    <ul class="container">
        <h2 class="title-section">{{ $games[0]->name }}</h2>
        @foreach ($games as $game)
            @livewire('games.game', ["game" => $game], key($game->id))
        @endforeach
    </ul>
@endsection



