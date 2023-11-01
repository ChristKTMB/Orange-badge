@extends('layouts.app')
@section('title')
    Gestion des utilisateurs
@endsection
@section('content')
    <br>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 8%">
                                Id
                            </th>
                            <th style="width: 13%">
                                Nom
                            </th>
                            <th style="width: 16%">
                                Nom d'utilisateur
                            </th>
                            <th style="width: 17%">
                                Adresse mail
                            </th>
                            <th style="width: 16%">
                                Manager
                            </th>
                            <th style="width: 11%">
                                Matricule
                            </th>
                            <th style="width: 13%">
                                Administrateur
                            </th>
                            <th style="width: 17%">
                                Status
                            </th>
                            <th style="width: 30%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->manager }}</td>
                                <td>{{ $user->matricule }}</td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <input type="checkbox" checked 
                                            style="width: 18px; height: 18px; border: 2px solid #007BFF; border-radius: 4px; display: inline-block; vertical-align: middle; cursor: not-allowed; background-color: #007BFF;">
                                    @else
                                        <input type="checkbox" 
                                            style="width: 18px; height: 18px; border: 2px solid #007BFF; border-radius: 4px; display: inline-block; vertical-align: middle; cursor: not-allowed; background-color: #007BFF;">
                                    @endif
                                </td>
                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge  bg-success">Activé</span>
                                    @else
                                        <span class="badge  bg-danger">Désactivé</span>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('profile.edit', $user->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </section>
    <div class="d-flex justify-content-center">
        {{ $users->links('pagination') }}
    </div>
@endsection
