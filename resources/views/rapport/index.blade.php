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
                            <th style="width: 18%">
                                Nom demandeur
                            </th>
                            <th style="width: 18%">
                                Nom beneficiaire
                            </th>
                            <th style="width: 15%">
                                Catégorie
                            </th>
                            <th style="width: 17%">
                                Date de démande
                            </th>
                            <th style="width: 13%">
                                Status
                            </th>
                            <th style="width: 23%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($badgeRequest as $badgeRequest)
                            <tr>
                                <td>{{ $badgeRequest->id }}</td>
                                <td>{{ $badgeRequest->demandeur_nom }} {{ $badgeRequest->demandeur_prenom }}</td>
                                <td>{{ $badgeRequest->beneficiaire_nom }} {{ $badgeRequest->beneficiaire_prenom }}</td>
                                <td>{{ $badgeRequest->categorie }}</td>
                                <td>{{ $badgeRequest->created_at }}</td>
                                @php
                                    $progress = App\Models\ApprovalProgress::where('badge_request_id', $badgeRequest->id)
                                        ->orderBy('id', 'desc')
                                        ->first();
                                @endphp
                                <td>
                                    @if ($progress)
                                        @if ($progress->approved === true)
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
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('rapport.show', $badgeRequest->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
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
@endsection
