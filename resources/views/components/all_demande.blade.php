    <div>
        <div class="d-flex justify-content-between">
            <div class="card-body">
                <form action="" method="GET" class="form-inline">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Début :</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="date" class="form-control" id="start_date" placeholder="Début"
                                    name="start_date" required value="{{ old('start_date') }}"
                                    max="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <label class="col-sm-2 col-form-label">Fin :</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="date" class="form-control" id="end_date" placeholder="Fin"
                                    name="end_date" required value="{{ old('end_date') }}"
                                    max="{{ now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit">Filtrer</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 margin-tb">
                <div class="text-right mx-4">
                    <a class="btn btn-success m-2" href="{{ url('/export-approving') }}">Tout telecharger
                        <img src="https://cdn-icons-png.flaticon.com/128/732/732220.png"
                            data-src="https://cdn-icons-png.flaticon.com/128/732/732220.png" alt="Excel "
                            title="Excel " width="20" height="20" class="lzy lazyload--done"
                            srcset="https://cdn-icons-png.flaticon.com/128/732/732220.png 4x">
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                No de demande
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
                        @foreach ($badgeRequest as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->demandeur_nom }} {{ $request->demandeur_prenom }}</td>
                                <td>{{ $request->beneficiaire_nom }} {{ $request->beneficiaire_prenom }}</td>
                                <td>{{ $request->categorie }}</td>
                                <td>{{ $request->created_at }}</td>
                                @php
                                    $progress = App\Models\ApprovalProgress::where('badge_request_id', $request->id)
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
                                    <a class="btn btn-primary btn-sm" href="{{ route('badge.show', $request->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('badge.showBadgePDF', $request->id) }}">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $badgeRequest->links('pagination') }}
        </div>
    </div>
