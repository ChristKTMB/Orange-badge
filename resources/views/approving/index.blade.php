@extends('layouts.app')
@section('title')
    Les approbateurs
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
            </div>
            @if ($results->isEmpty())
                <div class="text-right mx-4 mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                        +
                    </button>
                    <div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Les approbateurs</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <form action="{{ route('approving.store') }}" method="POST">
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger" role="alert">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (Session::has('success'))
                                                <div class="alert alert-success text-center">
                                                    <p>{{ Session::get('success') }}</p>
                                                </div>
                                            @endif
                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Fonction</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="data[0][name]" placeholder="Enter name" class="form-control" />
                                                    </td>
                                                    <td><input type="text" name="data[0][function]"
                                                            placeholder="Fonction" class="form-control" />
                                                    </td>
                                                    <td><input type="email" name="data[0][email]"
                                                            placeholder="Adresse mail" class="form-control" />
                                                    </td>
                                                    <td><button type="button" name="add" id="dynamic-ar"
                                                            class="btn btn-outline-primary"><i
                                                                class="fas fa-solid fa-plus"></i></button></td>
                                                </tr>
                                            </table>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Annulé</button>
                                                <button type="submit" class="btn btn-success "><i
                                                        class="fas fa-save"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-right mx-4 mb-3">
                    <a class="btn btn-outline-danger" href="{{ route('approving.confirmDelete') }}"><i
                            class="fas fa-trash"></i></a>
                </div>
            @endif
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Function</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $approving)
            {{$i = 1}}
            {{$i ++}}
                <tr>
                    <td>{{ $approving->i }}</td>
                    <td>{{ $approving->name }}</td>
                    <td>{{ $approving->fonction }}</td>
                    <td>{{ $approving->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
<!-- Modal -->
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td><input type="text" name="data[i][name]" placeholder="Enter name" class="form-control" /></td><td><input type="text" name="data[i][function]" placeholder="Enter function" class="form-control" /></td><td><input type="email" name="data[i][email]" placeholder="Enter email" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
            });
</script>
