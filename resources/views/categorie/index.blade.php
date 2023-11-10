@extends('layouts.app')
@section('title')
Directions
@endsection
@section('content')
<section class="content">
    @if ($errors)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            </div>
        @endforeach
    @endif
    <div class="text-right mb-2">
        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal-default">
            <i class="btn btn-primary m-2">+</i>
        </button>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Nom categorie
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                        <tr>
                            <td>{{ $categorie->id }}</td>
                            <td>{{ $categorie->nom }}</td>
                            <td>
                                <a class="btn btn-info btn-sm edit-btn" href="#" data-toggle="modal" data-target="#edit-{{ $categorie->id }}" form="edit-{{ $categorie->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @foreach ($categories as $categorie)
            <div class="modal fade edit-form" id="edit-{{ $categorie->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-light">
                                <div class="card-header">
                                    <h3 class="card-title">Modification de la categorie</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('categorie.update', $categorie->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label> Nom <span class="text-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $categorie->nom }}" name="nom">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-secondary float-right text-white">Modifier</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-{{ $categorie->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Suppression</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('categorie.destroy', $categorie->id) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="row">
                                            Voulez vraiment supprimer la categorie : {{ $categorie->nom }}
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-danger float-right ">Supprimer</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Categorie</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('categorie.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Nom <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" placeholder=""
                                            name="nom" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary float-right ">Ajouter</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    {{ $categories->links('pagination') }}
</div>
@endsection