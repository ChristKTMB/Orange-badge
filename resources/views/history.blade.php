@extends('layouts.app')
@section('title')
Historic
@endsection
@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right mx-4">
                <a class="btn btn-primary m-2" href="{{route('formulaire.index')}}"><b></b>+</a>
            </div>
        </div>
     </div>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                id
                            </th>
                            <th style="width: 30%">
                                Nom demandeur
                            </th>
                            <th style="width: 40%">
                                Date de démande
                            </th>
                            <th style="width: 30%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($badgeRequest as $badgeRequest)
                            <tr>
                                <td>{{ $badgeRequest->id }}</td>
                                <td>{{ $badgeRequest->demandeur_nom }}</td>
                                <td>{{ $badgeRequest->date }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('badge.show', $badgeRequest->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-success" href="{{ URL::to('/badgeRequest/pdf') }}">
                                    <i class="fas fa-file-pdf"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
@endsection
