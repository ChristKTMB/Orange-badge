@extends('layouts.app')
@section('title')
Formulaire de demande
@endsection
@section('content')
<div class="container">
    <form action="{{ route('badge.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-10 container my-0">
            <div class="card card-default">
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
                                            <label for="demandeur_nom">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="demandeur_nom"
                                                placeholder="" name="demandeur_nom" value="{{ $user->name }}" @readonly(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_prenom">Prénom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="demandeur_prenom"
                                                placeholder="" name="demandeur_prenom" value="{{ $user->first_name }}" @readonly(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_directeur">Direction <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="demandeur_directeur"
                                                placeholder="" name="demandeur_directeur" value="{{ $user->direction }}" @readonly(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_fonction">Fonction <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="demandeur_fonction"
                                                placeholder="" name="demandeur_fonction" value="{{ $user->fonction }}" @readonly(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_telephone">Numero téléphone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="demandeur_telephone"
                                                placeholder="" name="demandeur_telephone" value="{{ $user->phone }}" @readonly(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="demandeur_matricule">Matricule <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="demandeur_matricule"
                                                placeholder="" name="demandeur_matricule" value="{{ $user->matricule }}" @readonly(true)>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="date"
                                                placeholder="" name="date" value="{{ now()->format('Y-m-d') }}" @readonly(true)>
                                        </div>
                                        
                                        <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>
                                    </div>
                                    {{-- fin de la partie 1 --}}
        
                                    <div id="information-part" class="content" role="tabpanel"
                                        aria-labelledby="information-part-trigger">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="beneficiaire_nom">Nom <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="beneficiaire_nom"
                                                    placeholder="" name="beneficiaire_nom" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_prenom">Prénom <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="beneficiaire_prenom"
                                                    placeholder="" name="beneficiaire_prenom" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="beneficiaire_direction">Direction </label>
                                                    <select name="beneficiaire_direction" id="beneficiaire_direction" class="form-control">
                                                        <option value="">Choisir une direction</option>
                                                        @foreach ($directions as $direction)
                                                            <option value="{{ $direction->nom }}">
                                                                {{ $direction->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_fonction">Fonction <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="beneficiaire_fonction"
                                                    placeholder="" name="beneficiaire_fonction" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_telephone">Numero téléphone <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="beneficiaire_telephone"
                                                    placeholder="" name="beneficiaire_telephone" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_employeur">Employeur <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="beneficiaire_employeur"
                                                    placeholder="" name="beneficiaire_employeur" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <label for="beneficiaire_matricule">Matricule <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="beneficiaire_matricule"
                                                    placeholder="" name="beneficiaire_matricule" @required(true)>
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
                                                    <label for="categorie_badge">Catégorie de Badge <span class="text-danger">*</span></label>
                                                    <select id="categorie_badge" name="categorie_badge" class="form-control" @required(true)>
                                                    <option value=""></option>
                                                    <option value="Permanent staff">Permanent staff</option>
                                                    <option value="Consultant">Consultant</option>
                                                    <option value="Temporaire">Temporaire</option>
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date_debut">Date début <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="date_debut"
                                                    placeholder="" name="date_debut" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <label for="date_fin">Date fin <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="date_fin"
                                                    placeholder="" name="date_fin" @required(true)>
                                            </div>
                                            <div class="form-group">
                                                <label for="motivation">Motivation</label>
                                                <textarea id="motivation" name="motivation" class="form-control" rows="4" placeholder="Votre motivation ..." @required(true)></textarea>
                                            </div>
                                       
                                        <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                        <button class="btn btn-primary" id="test" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- /.card-body -->
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