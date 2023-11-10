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
                            <th>
                                Id
                            </th>
                            <th>
                                Nom
                            </th>
                            <th>
                                Nom d'utilisateur
                            </th>
                            <th>
                                Adresse mail
                            </th>
                            <th>
                                Manager
                            </th>
                            <th>
                                Matricule
                            </th>
                            <th>
                                Administrateur
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
                                        <a class="btn btn-light text-success btn-sm" data-toggle="modal"
                                            data-target="#modal-default-{{ $user->id }}-accepter"><i
                                                class="fas fa-user-check"></i></a>
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
