@extends('layouts.app')
@section('content')
    <h1>Historique</h1>

    @foreach ($badgeRequest as $badgeRequest)
        <a href="{{ route('badge.show',$badgeRequest->id) }}"><p>Date de demande: {{$badgeRequest->date}}</p></a>
    @endforeach

@endsection