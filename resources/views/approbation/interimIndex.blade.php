@extends('layouts.app')
@section('title')
Approbations de {{$checkApprover->username}}
@endsection
@section('content')
    <br>
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
                        @foreach ($approvalForms as $approvalForm)
                            <tr>
                                <td>{{ $approvalForm->badgeRequest->id }}</td>
                                <td>{{ $approvalForm->badgeRequest->demandeur_nom }}</td>
                                <td>{{ $approvalForm->badgeRequest->beneficiaire_nom }}</td>
                                <td>{{ $approvalForm->badgeRequest->categorie }}</td>
                                <td>{{ $approvalForm->badgeRequest->created_at }}</td>
                                <td>
                                    @if ($approvalForm->approved)
                                    <span class="badge  bg-success">Validé</span>
                                    @elseif($approvalForm->motif!=null)
                                    <span class="badge  bg-danger">Rejeté</span>
                                    @else
                                        <span class="badge  bg-secondary">En attente</span>
                                    @endif
                                    
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('approbation.single', $approvalForm->badgeRequest->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
    <div class="d-flex justify-content-center">
        {{ $approvalForms->links('pagination') }}
    </div>
@endsection
