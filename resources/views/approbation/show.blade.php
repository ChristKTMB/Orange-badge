@extends('layouts.app')
@section('title')
    Detail du formulaire
@endsection
@section('content')
    <div class="card card-warning container">
        <div class="card-body">
            <form>
                @if ($approved)
                        <div class="alert alert-success">
                            Le formulaire a été validé!
                        </div>
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-header">
                            <h4 class="card-title">DEMANDEUR</h4>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nom</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->demandeur_nom}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Prenom</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->demandeur_prenom}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Direction</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->demandeur_directeur}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Fonction</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->demandeur_fonction}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Numero telephone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->demandeur_telephone}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Matricule</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->demandeur_matricule}}" placeholder="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-header">
                            <h4 class="card-title">BENEFICIAIRE</h4>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nom</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_nom}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Prenom</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_prenom}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Direction</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_direction}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Fonction</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_fonction}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Numero telephone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_telephone}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Employeur</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_employeur}}" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Matricule</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{$badgeRequest->beneficiaire_matricule}}" placeholder="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                        <label for="categorie_badge" class="col-sm-2 col-form-label">Catégorie de Badge </label>
                        <div class="col-sm-10">
                            <select id="categorie_badge" name="categorie_badge" class="form-control" readonly>
                                <option value=""></option>
                                <option value="Permanent staff" {{$badgeRequest->categorie_badge == 'Permanent staff' ? 'selected' : ''}}> Permanent staff</option>
                                <option value="Consultant" {{$badgeRequest->categorie_badge == 'Consultant' ? 'selected' : ''}}> Consultant</option>
                                <option value="Temporaire" {{$badgeRequest->categorie_badge == 'Temporaire' ? 'selected' : ''}}> Temporaire</option>
                            </select>
                        </div>       
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date_debut" class="col-sm-4 col-form-label">Date début </label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date_debut"
                                placeholder="" value="{{$badgeRequest->date_debut}}" name="date_debut" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date_debut" class="col-sm-4 col-form-label">Date fin </label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date_debut"
                                placeholder="" value="{{$badgeRequest->date_fin}}" name="date_debut" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="motivation" class="col-sm-2 col-form-label">Motivation</label>
                    <div class="col-sm-10">
                        <textarea id="motivation" name="motivation" class="form-control" rows="4" placeholder="Votre motivation ..." readonly>{{$badgeRequest->motivation}}</textarea>
                    </div>
                </div>
                    @if (!$approved)
                        <a class="btn btn-success" href="{{ route('badge-request.approve', $badgeRequest->id) }}">Validé</a>
                    @endif
            </form>
        </div>
    </div><br>
@endsection

@section('scripts')
    @vite('node_modules/bs-stepper/dist/js/bs-stepper.min.js');
    @vite('node_modules/bs-stepper/dist/css/bs-stepper.min.css');
    <script>
        document.querySelector('#test').addEventListener('click', (e) => {
            console.log(e);
        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function(e) {
            e.preventDefault();
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)
        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })
        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })
        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })
        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })
        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })
        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
    </script>
@endsection
