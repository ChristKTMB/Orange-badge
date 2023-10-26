@extends('layouts.app')
@section('title')
    Profil utilisateur
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card card-primary col-lg-8 mx-auto">
        <form method="POST" action="{{ route('profile.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nom </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        readonly>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="direction">Direction </label>
                        @if (auth()->user()->id !== $user->id)
                            <div class="form-group">
                                <input type="text" class="form-control" id="direction" name="direction"
                                    value="{{ $user->direction }}" readonly>
                            </div>
                        @else
                            <select name="direction" id="direction" class="form-control">
                                <option value="{{ $user->direction }}">{{ $user->direction }}</option>
                                @foreach ($directions as $direction)
                                    <option value="{{ $direction->nom }}">
                                        {{ $direction->nom }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="fonction">Fonction</label>
                    <input type="text" class="form-control" id="fonction" name="fonction" value="{{ $user->fonction }}"
                        @if (auth()->user()->id !== $user->id) readonly @endif>
                </div>
                <div class="form-group">
                    <label for="matricule">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule"
                        value="{{ $user->matricule }}" @if (auth()->user()->id !== $user->id) readonly @endif>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="manager">Manager </label>
                        <select name="manager" id="manager" class="form-control">
                            <option value="{{ $user->manager }}">{{ $user->manager }}</option>
                            @foreach ($managers->users as $manager)
                                <option value="{{ $manager->email }}">
                                    {{ $manager->first_name }} {{ $manager->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="role">Rôle de l'utilisateur </label>
                        @if (auth()->user()->id === $user->id)
                            <div class="form-group">
                                @if ($user->role == 'user')
                                    <p class="form-control" readonly>Utilisateur simple</p>
                                    <input type="hidden" class="form-control" id="role" name="role" value="user"
                                        readonly>
                                @else
                                    <p class="form-control" readonly>Administrateur</p>
                                    <input type="hidden" class="form-control" id="role" name="role" value="admin"
                                        readonly>
                                @endif
                            </div>
                        @else
                            <select name="role" id="role" class="form-control">
                                <option value="user" @if ($user->role === 'user') selected @endif>Utilisateur simple
                                </option>
                                <option value="admin" @if ($user->role === 'admin') selected @endif>Administrateur
                                </option>
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        @if (auth()->user()->id !== $user->id)
                            <label for="status">Status </label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" @if ($user->status === 1) selected @endif>Activé
                                </option>
                                <option value="0" @if ($user->status === 0) selected @endif>Désactivé
                                </option>
                            </select>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>
@endsection
