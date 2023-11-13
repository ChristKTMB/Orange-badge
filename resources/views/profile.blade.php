@extends('layouts.app')
@section('title')
    Profil utilisateur
@endsection
@push('page_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 40px;
        }
    </style>
@endpush
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card card-primary col-lg-8 mx-auto">
        <form method="POST" action="{{ route('profile.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur </label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ $user->username }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="email">Adresse e-mail </label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="direction_id">Direction <span class="text-danger">*</span></label>
                            <select name="direction_id" id="direction_id" class="form-control" required
                                @if (auth()->user()->id !== $user->id) readonly @endif>
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction->id }}" @if ($direction->id == $direction->nom) selected @endif>
                                        {{ $direction->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="fonction">Fonction <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fonction" name="fonction"
                                value="{{ $user->fonction }}" @if (auth()->user()->id !== $user->id) readonly @endif required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="matricule">Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule"
                                value="{{ $user->matricule }}" @if (auth()->user()->id !== $user->id) readonly @endif>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="manager">Manager <span class="text-danger">*</span></label>
                            <select name="manager" id="manager" class="form-control">
                                {{-- <option value="{{ $user->manager }}">{{ $user->manager }}</option> --}}
                                @foreach ($managers->users as $manager)
                                    <option value="{{ $manager->email }}" @if ($user->manager == $manager->email) selected @endif
                                        @required(true)>
                                        {{ $manager->first_name }} {{ $manager->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="role">Rôle de l'utilisateur </label>
                            @if (auth()->user()->id === $user->id)
                                <div class="form-group">
                                    @if ($user->role == 'user')
                                        <p class="form-control" readonly>Utilisateur simple</p>
                                        <input type="hidden" class="form-control" id="role" name="role"
                                            value="user" readonly>
                                    @else
                                        <p class="form-control" readonly>Administrateur</p>
                                        <input type="hidden" class="form-control" id="role" name="role"
                                            value="admin" readonly>
                                    @endif
                                </div>
                            @else
                                <select name="role" id="role" class="form-control">
                                    <option value="user" @if ($user->role === 'user') selected @endif>Utilisateur
                                        simple
                                    </option>
                                    <option value="admin" @if ($user->role === 'admin') selected @endif>Administrateur
                                    </option>
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            @if (auth()->user()->id !== $user->id)
                                <label for="status">Status </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" @if ($user->status === 1) selected @endif>Activé
                                    </option>
                                    <option value="0" @if ($user->status === 0) selected @endif>Désactivé
                                    </option>
                                </select>
                            @else
                                <input type="hidden" class="form-control" id="status" name="status"
                                    value="{{ $user->status }}" readonly>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#manager').select2();
        })
    </script>
@endsection