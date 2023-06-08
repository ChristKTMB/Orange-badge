@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card card-primary col-lg-8 mx-auto">
        <div class="card-header">
            <h3 class="card-title">Modifier votre profile</h3>
        </div>
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
                    <label for="direction">Direction</label>
                    <input type="text" class="form-control" id="direction" name="direction"
                        value="{{ $user->direction }}">
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
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}"
                                    {{ $manager->id === $user->manager_id ? 'selected' : '' }}>
                                    {{ $manager->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary ml-auto">Submit</button>
            </div>
        </form>
    </div>
@endsection
