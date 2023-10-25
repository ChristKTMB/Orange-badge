@extends('layouts.app')
@section('title')
    Mes demandes
@endsection
@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right mx-4">
                <a class="btn btn-primary m-2" href="{{ route('formulaire.index') }}"><b></b>+</a>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 8%">
                                No demande
                            </th>
                            <th style="width: 15%">
                                Nom demandeur
                            </th>
                            <th style="width: 15%">
                                Nom beneficiaire
                            </th>
                            <th style="width: 15%">
                                Catégorie
                            </th>
                            <th style="width: 20%">
                                Date de démande
                            </th>
                            <th style="width: 20%">
                                Status
                            </th>
                            <th style="width: 30%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($badgeRequests as $badgeRequest)
                            <tr>
                                <td>{{ $badgeRequest->id }}</td>
                                <td>{{ $badgeRequest->badgeRequest->demandeur_nom }}
                                    {{ $badgeRequest->badgeRequest->demandeur_prenom }} </td>
                                <td>{{ $badgeRequest->badgeRequest->beneficiaire_nom }}
                                    {{ $badgeRequest->badgeRequest->beneficiaire_prenom }}</td>
                                <td>{{ $badgeRequest->badgeRequest->categorie }}</td>
                                <td>{{ $badgeRequest->created_at }}</td>
                                <td>
                                    @if ($badgeRequest->isApproved)
                                        <span class="badge  bg-success">Validé</span>
                                    @elseif($badgeRequest->motif != null)
                                        <span class="badge  bg-danger">Rejeté</span>
                                    @else
                                        <span class="badge  bg-secondary">En attente</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('badge.show', $badgeRequest->badge_request_id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('/badgeRequest/pdf') }}">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
@endsection
