@extends('layouts.app')
@section('title')
Mes Approbations
@endsection
@section('content')
    <br>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                id
                            </th>
                            <th style="width: 20%">
                                Nom demandeur
                            </th>
                            <th style="width: 28%">
                                Nom beneficiaire
                            </th>
                            <th style="width: 20%">
                                Date de démande
                            </th>
                            <th style="width: 30%">
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
                                <td>{{ $approvalForm->badgeRequest->date }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('approbation.show', $approvalForm->badgeRequest->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                        View
                                    </a>
                                    @if ($approvalForm->approved)
                                        <a class="btn btn-success btn-sm">
                                            Validé
                                        </a>
                                    @else
                                        <a class="btn btn-secondary btn-sm">
                                            En attente
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
@endsection
