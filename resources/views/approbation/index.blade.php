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
                        @foreach ($approvalForms as $approvalForm)
                            <tr>
                                <td>{{ $approvalForm->badgeRequest->id }}</td>
                                <td>{{ $approvalForm->badgeRequest->demandeur_nom }}</td>
                                <td>{{ $approvalForm->badgeRequest->date }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('approbation.show', $approvalForm->badgeRequest->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
@endsection
