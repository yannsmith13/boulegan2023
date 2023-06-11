@extends('layouts.layout')

@section('title', "Classement")

@section('content')

    <div class="container">
        <h1 class="title-section">Classement phase éliminatoires</h1>

        <table class="ranking">
            <thead>
                <tr>
                    <th class="text-left">Joueur</th>
                    <th class="text-center">Victoires</th>
                    <th class="text-center">Diff.</th>
                    <th class="text-center">Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $key=>$player)
                    <tr @if ($qualifiedPlayers->contains($player))
                        style="background: rgba(0, 128, 0, 0.2)"
                    @endif>
                        <td class="text-left"><span class="text-bold">{{$key + 1}}</span> - {{ strtoupper($player->name) }}</td>
                        <td class="text-center">{{ $player->win }}</td>
                        <td class="text-center">{{ $player->diff > 0 ? "+".$player->diff : $player->diff }}</td>
                        <td class="text-center">{{ $player->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($qualificationsAreClosed && !$semiFinalsAreOpen)
            <div style="display: flex; margin-top: 0.75rem">
                <a href="{{route('teams.generateSemiFinals')}}" class="btn">Direction les 1/2 finales</a>
            </div>
        @endif
        
    </div>

    
    
@endsection