@extends('layouts.app')
@section('title')
    Formulaire de demande
@endsection
@section('content')
    <div class="container">
        <form id="formulaireDemandeBadge" action="{{ route('badge.store') }}" method="POST" onsubmit="return confirmerEnvoi()"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-10 container my-0">
                <div>
                    <div class="form-group row">
                        <label for="typeDemande" class="col-sm-4 col-form-label">Catégorie <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="radio" id="nouvelEmploye" name="typeDemande" value="Nouveau" checked>
                            Nouveau
                            <input type="radio" id="badgePerdu" name="typeDemande" value="Badge perdu"> Badge perdu
                        </div>
                    </div>
                    <input type="hidden" name="categorie" id="categorie" value="">
                    
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab"
                                            aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Bénéficiaire</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab"
                                            aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Catégorie et motivation</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <div id="logins-part" class="content" role="tabpanel"
                                        aria-labelledby="logins-part-trigger">
                                        <div style="display: none">
                                            <div class="form-group row">
                                                <label for="demandeur_nom" class="col-sm-4 col-form-label">Nom <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="demandeur_nom"
                                                        placeholder="" name="demandeur_nom" value="{{ $user->name }}"
                                                        @readonly(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="demandeur_prenom" class="col-sm-4 col-form-label">Prénom <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="demandeur_prenom"
                                                        placeholder="" name="demandeur_prenom"
                                                        value="{{ $user->first_name }}" @readonly(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="demandeur_directeur" class="col-sm-4 col-form-label">Direction
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="demandeur_directeur"
                                                        placeholder="" name="demandeur_directeur"
                                                        value="{{ $user->direction->nom }}" @readonly(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="demandeur_fonction" class="col-sm-4 col-form-label">Fonction
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="demandeur_fonction"
                                                        placeholder="" name="demandeur_fonction"
                                                        value="{{ $user->fonction }}" @readonly(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="demandeur_telephone" class="col-sm-4 col-form-label">Numero
                                                    téléphone <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="demandeur_telephone"
                                                        placeholder="" name="demandeur_telephone"
                                                        value="{{ $user->phone }}" @readonly(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="demandeur_matricule" class="col-sm-4 col-form-label">Matricule
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="demandeur_matricule"
                                                        placeholder="" name="demandeur_matricule"
                                                        value="{{ $user->matricule }}" @readonly(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-4 col-form-label">Date <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="date"
                                                        placeholder="" name="date"
                                                        value="{{ now()->format('Y-m-d') }}" @readonly(true)>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <label for="beneficiaire_nom" class="col-sm-4 col-form-label">Nom
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="beneficiaire_nom"
                                                        placeholder="" name="beneficiaire_nom" @required(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_prenom" class="col-sm-4 col-form-label">Prénom
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="beneficiaire_prenom"
                                                        placeholder="" name="beneficiaire_prenom" @required(true)>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label for="beneficiaire_direction"
                                                        class="col-sm-4 col-form-label">Direction <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <select name="beneficiaire_direction" id="beneficiaire_direction"
                                                            class="form-control">
                                                            <option value="">Choisir une direction</option>
                                                            @foreach ($directions as $direction)
                                                                <option value="{{ $direction->nom }}">
                                                                    {{ $direction->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_fonction"
                                                    class="col-sm-4 col-form-label">Fonction <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="beneficiaire_fonction"
                                                        placeholder="" name="beneficiaire_fonction" @required(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_telephone" class="col-sm-4 col-form-label">Numero
                                                    téléphone <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        id="beneficiaire_telephone" placeholder=""
                                                        name="beneficiaire_telephone" @required(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_employeur"
                                                    class="col-sm-4 col-form-label">Employeur <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        id="beneficiaire_employeur" placeholder=""
                                                        name="beneficiaire_employeur" @required(true)>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_matricule"
                                                    class="col-sm-4 col-form-label">Matricule <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        id="beneficiaire_matricule" placeholder=""
                                                        name="beneficiaire_matricule" @required(true)>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>
                                    </div>
                                    {{-- fin de la partie 1 --}}
                                    <div id="information-part" class="content" role="tabpanel"
                                        aria-labelledby="information-part-trigger">
                                        <div class="form-group row">
                                            <label for="categorie_badge" class="col-sm-4 col-form-label">Contrat <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <select id="categorie_badge" name="categorie_badge" class="form-control"
                                                    @required(true)>
                                                    <option value=""></option>
                                                    <option value="Permanent staff">Permanent staff</option>
                                                    <option value="Consultant">Consultant</option>
                                                    <option value="Temporaire">Temporaire</option>
                                                    <option value="Stagiaire">Stagiaire</option>
                                                    <option value="Visiteur">Visiteur</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date_debut" class="col-sm-4 col-form-label">Date début <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="date_debut"
                                                    placeholder="" name="date_debut" min="{{ date('Y-m-d') }}"
                                                    @required(true)>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date_fin" class="col-sm-4 col-form-label">Date fin <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="date_fin" placeholder=""
                                                    name="date_fin" min="{{ date('Y-m-d') }}" @required(true)>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="motivation" class="col-sm-4 col-form-label">Motivation</label>
                                            <div class="col-sm-8">
                                                <textarea id="motivation" name="motivation" class="form-control" rows="4" placeholder="Votre motivation ..."
                                                    maxlength="400" @required(true)></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="approvers" class="col-sm-4 col-form-label">Les
                                                approbateurs</label>
                                                <div class="col-sm-8">
                                                    @foreach ($approvers as $approver)
                                                        <span class="badge  badge-info">Nom : {{ $approver['name'] }},
                                                            Fonction : {{ $approver['fonction'] }}, Email : {{ $approver['email'] }}</span><br>
                                                    @endforeach
                                                </div>
                                        </div>
                                        <div id="sectionBadgePerdu" style="display: none">
                                            <div class="form-group row">
                                                <label for="approvers" class="col-sm-4 col-form-label">Telecharger un
                                                    document</label>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control" id="upload"
                                                        placeholder="" name="upload" >
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                        <button class="btn btn-success" id="test" type="submit">Envoyer</button>
                                    </div>
                                    {{-- fin de la partie 2 --}}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
        const caseNouvelEmploye = document.getElementById("nouvelEmploye");
        const caseBadgePerdu = document.getElementById("badgePerdu");
        //const sectionNouvelEmploye = document.getElementById("sectionNouvelEmploye");
        const sectionBadgePerdu = document.getElementById("sectionBadgePerdu");
        caseNouvelEmploye.addEventListener("change", function() {
            if (caseNouvelEmploye.checked) {
                //sectionNouvelEmploye.style.display = "block";
                sectionBadgePerdu.style.display = "none";
            } else {
                sectionNouvelEmploye.style.display = "none";
            }
        });
        caseBadgePerdu.addEventListener("change", function() {
            if (caseBadgePerdu.checked) {
                sectionBadgePerdu.style.display = "block";
                sectionNouvelEmploye.style.display = "none";
            } else {
                sectionBadgePerdu.style.display = "none";
            }
        });



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

        // Fonction qui affiche un pop up pour confirmer
        function confirmerEnvoi() {
            return confirm("Êtes-vous sûr de vouloir envoyer le formulaire ?");
        }



        var form = document.querySelector('#formulaireDemandeBadge');


    </script>
@endsection