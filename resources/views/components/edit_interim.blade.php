<div class="modal fade" id="edit_interim">
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
                        <h3 class="card-title">Modifier le status</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status">
                            <div class="row">
                                <div class="col">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <h5>Voulez-vous vraiment modifier le statut?</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary float-right ">Continuer</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
