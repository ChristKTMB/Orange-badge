<style>
    #confirmationModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-dialog {
        max-width: 600px;
    }

    .modal-content {
        width: 100%;
    }
</style>
<!-- Le modal -->
<div id="confirmationModal" class="modal" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="close" onclick="closeModal()">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="form-group text-center"> <!-- Ajout de la classe text-center -->
                    <h5>Voulez-vous vraiment envoyer le formulaire ?</h5>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <button class="btn btn-success" onclick="submitForm()">Oui, Envoyer</button>
            </div>
        </div>
    </div>
</div>
