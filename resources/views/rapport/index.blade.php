@extends('layouts.app')
@section('title')
    Rapport des approbations
@endsection
@section('content')
    <section class="content">
        <div div class="card-body ">
            <form action="" method="GET">
                <div class="row">
                    <div class="form-group row">
                        <label for="start_date" class="col-sm-8 col-form-label">Date de début :</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="start_date"
                                placeholder="" name="start_date"
                                @required(true)>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_date" class="col-sm-8 col-form-label">Date de fin :</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="end_date" placeholder=""
                                name="end_date"  @required(true)>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Filtrer</button>
            </form>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="text-right mx-4">
                <a class="btn btn-success m-2" href="{{ url('/export-approving') }}">
                    <img src="https://cdn-icons-png.flaticon.com/128/732/732220.png"
                        data-src="https://cdn-icons-png.flaticon.com/128/732/732220.png" alt="Excel " title="Excel "
                        width="20" height="20" class="lzy lazyload--done"
                        srcset="https://cdn-icons-png.flaticon.com/128/732/732220.png 4x">
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 8%">
                                No de demande
                            </th>
                            <th style="width: 20%">
                                Nom demandeur
                            </th>
                            <th style="width: 20%">
                                Nom beneficiaire
                            </th>
                            <th style="width: 20%">
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
                        @foreach ($ApprovalProgress as $ApprovalProgress)
                            <tr>
                                <td>{{ $ApprovalProgress->badgeRequest->id }}</td>
                                <td>{{ $ApprovalProgress->badgeRequest->demandeur_nom }} {{ $ApprovalProgress->badgeRequest->demandeur_prenom }}</td>
                                <td>{{ $ApprovalProgress->badgeRequest->beneficiaire_nom }} {{ $ApprovalProgress->badgeRequest->beneficiaire_prenom }}</td>
                                <td>{{ $ApprovalProgress->badgeRequest->categorie }}</td>
                                <td>{{ $ApprovalProgress->created_at }}</td>
                                <td>
                                    @if ($ApprovalProgress->approved)
                                        <span class="badge  bg-success">Validé</span>
                                    @elseif($ApprovalProgress->motif != null)
                                        <span class="badge  bg-danger">Rejeté</span>
                                    @else
                                        <span class="badge  bg-secondary">En attente</span>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('rapport.show', $ApprovalProgress->badgeRequest->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
@endsection
