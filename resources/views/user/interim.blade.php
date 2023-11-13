@extends('layouts.app')
@section('title')
Gestion des Intérimaires
@endsection
@push('page_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single{
        height: 40px;
    }
    .select2-container {
        width: 100% !important;
    }
</style>
@endpush
@section('content')
    <br>
    <section class="content">
        <div class="col-lg-12 margin-tb">
            <div class="text-right mx-4">
                <a class="btn btn-primary m-2" href="" data-toggle="modal" data-target="#add_interim"><b></b>+</a>
            </div>
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
                                Nom
                            </th>
                            <th style="width: 17%">
                                Adresse mail
                            </th>
                            <th>
                                Matricule
                            </th>
                            <th style=>
                                Status
                            </th>
                            <th style=>
                                Début
                            </th>
                            <th style=>
                                Fin
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
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->matricule }}</td>

                                <td>
                                    @if ($user->pivot->status == 1)
                                        <span class="badge  bg-success">Activé</span>
                                    @else
                                        <span class="badge  bg-danger">Désactivé</span>
                                    @endif

                                </td>
                                <td>{{ $user->pivot->created_at }}</td>
                                <td>{{ $user->pivot->date_fin }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        onclick="edit(event, {{ $user->pivot->status }}, '{{ route('edit_status', ['userId' => $user->pivot->user_id, 'delegue' => $user->pivot->delegue]) }}')"
                                        href="{{ route('edit_status', ['userId' => $user->pivot->user_id, 'delegue' => $user->pivot->delegue]) }}"
                                        data-toggle="modal" data-target="#edit_interim">
                                        <i onclick="edit(event, {{ $user->pivot->status }}, '{{ route('edit_status', ['userId' => $user->pivot->user_id, 'delegue' => $user->pivot->delegue]) }}')"
                                            class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-edit_interim />
                <x-add_interim :userAll="$userAll" />
    </section>
@endsection
@push('page_scripts')
    <script>
        function edit(event, status, route) {
            //var route = event.target.closest("a").getAttribute("href")
            var form = document.querySelector("#edit_interim form")
            form.setAttribute("action", route)
            form.status.value = status
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user').select2();
        })
    </script>
@endpush
