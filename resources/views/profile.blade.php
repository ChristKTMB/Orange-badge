@extends('layouts.app')
@section('title')
Profil utilisateur
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card card-primary col-lg-8 mx-auto">
        <form method="POST" action="{{ route('profile.update', ['profile' => $user->id]) }}">
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
                        <select name="direction" id="direction" class="form-control">
                            <option value="{{ $user->direction }}">Choisir une direction</option>
                            @foreach ($directions as $direction)
                                <option value="{{ $direction->nom }}">
                                    {{ $direction->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fonction">Fonction</label>
                    <input type="text" class="form-control" id="fonction" name="fonction" value="{{ $user->fonction }}">
                </div>
                <div class="form-group">
                    <label for="matricule">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule"
                        value="{{ $user->matricule }}">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="manager">Manager </label>
                        <select name="manager" id="manager" class="form-control">
                            <option value="">Choisir un manager</option>
                            @foreach ($managers->users as $manager)
                                <option value="{{ $manager->email }}">
                                    {{ $manager->first_name }} {{ $manager->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>
@endsection