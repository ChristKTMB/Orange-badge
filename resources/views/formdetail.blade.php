@extends('layouts.app')

@section('content')
<div class="container">
    <form action="" method="" enctype="multipart/form-data">
        @csrf
        <div class="col-md-10 container my-5">
            <div class="card card-default">
                <div class="card-header">
                </div>
                    <div class="card-body p-0">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                            id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Demandeur</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
        
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                            id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Bénéficiaire</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
        
                                    <div class="step" data-target="#complexity-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="complexity-part"
                                            id="complexity-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Catégorie et motivation</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                        <div class="form-group">
                                            <label for="demandeur_nom">Nom </label>
                                            <input type="text" class="form-control" id="demandeur_nom"
                                                placeholder="" value="{{$badgeRequest->demandeur_nom}}" name="demandeur_nom" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_prenom">Prénom </label>
                                            <input type="text" class="form-control" id="demandeur_prenom"
                                                placeholder="" value="{{$badgeRequest->demandeur_prenom}}" name="demandeur_prenom" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_directeur">Direction </label>
                                            <input type="text" class="form-control" id="demandeur_directeur"
                                                placeholder="" value="{{$badgeRequest->demandeur_directeur}}" name="demandeur_directeur" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_fonction">Fonction </label>
                                            <input type="text" class="form-control" id="demandeur_fonction"
                                                placeholder=""  value="{{$badgeRequest->demandeur_fonction}}" name="demandeur_fonction" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_telephone">Numero téléphone </label>
                                            <input type="text" class="form-control" id="demandeur_telephone"
                                                placeholder="" value="{{$badgeRequest->demandeur_telephone}}" name="demandeur_telephone" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_matricule">Matricule </label>
                                            <input type="text" class="form-control" id="demandeur_matricule"
                                                placeholder="" value="{{$badgeRequest->demandeur_matricule}}" name="demandeur_matricule" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date </label>
                                            <input type="date" class="form-control" id="date"
                                                placeholder="" value="{{$badgeRequest->date}}" name="date" readonly>
                                        </div>
                                        
                                        <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>
                                    </div>
                                    {{-- fin de la partie 1 --}}
        
                                    <div id="information-part" class="content" role="tabpanel"
                                        aria-labelledby="information-part-trigger">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="beneficiaire_nom">Nom </label>
                                                <input type="text" class="form-control" id="beneficiaire_nom"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_nom}}" name="beneficiaire_nom" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_prenom">Prénom </label>
                                                <input type="text" class="form-control" id="beneficiaire_prenom"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_prenom}}" name="beneficiaire_prenom" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_direction">Direction </label>
                                                <input type="text" class="form-control" id="beneficiaire_direction"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_direction}}" name="beneficiaire_direction" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_fonction">Fonction </label>
                                                <input type="text" class="form-control" id="beneficiaire_fonction"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_fonction}}" name="beneficiaire_fonction" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_telephone">Numero téléphone </label>
                                                <input type="text" class="form-control" id="beneficiaire_telephone"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_telephone}}" name="beneficiaire_telephone" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_employeur">Employeur </label>
                                                <input type="text" class="form-control" id="beneficiaire_employeur"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_employeur}}" name="beneficiaire_employeur" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_matricule">Matricule </label>
                                                <input type="text" class="form-control" id="beneficiaire_matricule"
                                                    placeholder="" value="{{$badgeRequest->beneficiaire_matricule}}" name="beneficiaire_matricule" readonly>
                                            </div>
                                            
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                        <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>
        
                                    </div>
                                    {{-- fin de la partie 2 --}}
                                    
                                    <div id="complexity-part" class="content" role="tabpanel"
                                        aria-labelledby="complexity-part-trigger">
                                        
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="categorie_badge">Catégorie de Badge </label>
                                                    <select id="categorie_badge" name="categorie_badge" class="form-control" readonly>
                                                    <option value=""></option>
                                                    <option value="Permanent staff" {{$badgeRequest->categorie_badge == 'Permanent staff' ? 'selected' : ''}}> Permanent staff</option>
                                                    <option value="Consultant" {{$badgeRequest->categorie_badge == 'Consultant' ? 'selected' : ''}}> Consultant</option>
                                                    <option value="Temporaire" {{$badgeRequest->categorie_badge == 'Temporaire' ? 'selected' : ''}}> Temporaire</option>
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date_debut">Date début </label>
                                                <input type="date" class="form-control" id="date_debut"
                                                    placeholder="" value="{{$badgeRequest->date_debut}}" name="date_debut" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="date_fin">Date fin </label>
                                                <input type="date" class="form-control" id="date_fin"
                                                    placeholder="" value="{{$badgeRequest->date_fin}}" name="date_fin" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="motivation">Motivation</label>
                                                <textarea id="motivation" name="motivation" class="form-control" rows="4" placeholder="Votre motivation ..." readonly>{{$badgeRequest->motivation}}</textarea>
                                            </div>
                                       
                                        <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                        <a class="btn btn-primary" href="{{ route('badge.index')}}">Retourné vers l'historique</a>
                                        <button class="btn btn-light disable" style="display: none" id="test" type=""></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- /.card-body -->
                <div class="card-footer text-black">
                    Orange Digital Center
                </div>
            </div>
            <!-- /.card -->
        </div>
    </form>
</div>

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