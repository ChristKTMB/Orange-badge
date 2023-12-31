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
                            <th>
                                No demande
                            </th>
                            <th>
                                Nom demandeur
                            </th>
                            <th>
                                Nom beneficiaire
                            </th>
                            <th>
                                Catégorie
                            </th>
                            <th>
                                Date de démande
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($badgeRequests as $badgeRequest)
                            <tr>
                                <td>{{ $badgeRequest->id }}</td>
                                <td>{{ $badgeRequest->demandeur_nom }}
                                    {{ $badgeRequest->demandeur_prenom }} </td>
                                <td>{{ $badgeRequest->beneficiaire_nom }}
                                    {{ $badgeRequest->beneficiaire_prenom }}</td>
                                <td>{{ $badgeRequest->categorie }}</td>
                                <td>{{ $badgeRequest->created_at }}</td>
                                @php
                                    $progress = App\Models\ApprovalProgress::where('badge_request_id', $badgeRequest->id)
                                        ->orderBy('id', 'desc')
                                        ->first();
                                @endphp
                                <td>
                                    @if ($progress)
                                        @if ($progress->approved === 1)
                                            <span class="badge  bg-success">Validé</span>
                                        @elseif($progress->motif != null)
                                            <span class="badge  bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge  bg-secondary">En attente</span>
                                        @endif
                                    @else
                                        <span class="badge  bg-secondary">En attente</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('badge.show', $badgeRequest->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('badge.showBadgePDF', $badgeRequest->id) }}">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
    <div class="d-flex justify-content-center">
        {{ $badgeRequests->links('pagination') }}
    </div>
@endsection
