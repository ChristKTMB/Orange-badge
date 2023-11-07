<div class="modal fade" id="add_interim">
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
                        <h3 class="card-title">Ajouter un interimaire</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{route('add_interim')}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="">Interimaire </label>
                                        <select name="delegue" id="user" class="form-control ">
                                            <option value=""></option>
                                            @foreach ($userAll as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary float-right text-white"><i class="fas fa-save"></i></button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

