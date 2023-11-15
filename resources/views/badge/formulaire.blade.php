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
                                        <input type="hidden" class="form-control" id="demandeur_directeur" placeholder=""
                                            name="demandeur_directeur" value="{{ $user->direction->nom }}"
                                            @readonly(true)>
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
                                                <label for="beneficiaire_fonction" class="col-sm-4 col-form-label">Fonction
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="beneficiaire_fonction"
                                                        placeholder="" name="beneficiaire_fonction">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_telephone" class="col-sm-4 col-form-label">Numero
                                                    téléphone <span class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control"
                                                        id="beneficiaire_telephone" placeholder=""
                                                        name="beneficiaire_telephone" pattern="[0-9]+"
                                                        title="Veuillez saisir uniquement des chiffres" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_employeur"
                                                    class="col-sm-4 col-form-label">Employeur <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        id="beneficiaire_employeur" placeholder=""
                                                        name="beneficiaire_employeur">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="beneficiaire_matricule"
                                                    class="col-sm-4 col-form-label">Matricule <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        id="beneficiaire_matricule" placeholder=""
                                                        name="beneficiaire_matricule">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <a class="btn btn-primary" onclick="stepper.next()">Suivant</a> --}}
                                        <a class="btn btn-primary" onclick="validateAndNext()">Suivant</a>
                                    </div>
                                    {{-- fin de la partie 1 --}}
                                    <div id="information-part" class="content" role="tabpanel"
                                        aria-labelledby="information-part-trigger">
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <label for="beneficiaire_direction"
                                                    class="col-sm-4 col-form-label">Contrat <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-8">
                                                    <select name="categorie_badge" id="categorie_badge"
                                                        class="form-control" @required(true)>
                                                        <option value="">Choisir un contrat</option>
                                                        @foreach ($categories as $categorie)
                                                            <option value="{{ $categorie->nom }}">
                                                                {{ $categorie->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                                    maxlength="300"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="approvers" class="col-sm-4 col-form-label">Les
                                                approbateurs</label>
                                            <div class="col-sm-8">
                                                @foreach ($approvers as $approver)
                                                    <span class="badge  badge-info">Nom : {{ $approver['name'] }},
                                                        Fonction : {{ $approver['fonction'] }}, Email :
                                                        {{ $approver['email'] }}</span><br>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div id="sectionBadgePerdu" style="display: none">
                                            <div class="form-group row">
                                                <label for="approvers" class="col-sm-4 col-form-label">Telecharger un
                                                    document</label>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control" id="upload"
                                                        placeholder="" name="upload">
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                        <button class="btn btn-success" id="test" type="submit"
                                            >Envoyer</button>
                                    </div>
                                    {{-- fin de la partie 2 --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><strong><span class="text-danger">* </span></strong> Merci de remplir ce champ</p>
                </div>
            </div>
        </form>
        <x-confirm_demande />
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

        // Fonction qui affiche un pop up pour confirmer
        function confirmerEnvoi() {
            // Afficher votre modal personnalisé
            document.getElementById("confirmationModal").style.display = "block";
            return false; // Pour empêcher la soumission du formulaire
        }

        function submitForm() {
            document.getElementById("formulaireDemandeBadge").submit();
        }

        function closeModal() {
            document.getElementById("confirmationModal").style.display = "none";
        }

        var form = document.querySelector('#formulaireDemandeBadge');
    </script>
    <script>
        function validateAndNext() {
            // Validez la première partie du formulaire
            if (!validateLoginsPart()) {
                return;
            }
            stepper.next();
        }

        function validateLoginsPart() {
            var nom = document.getElementById('beneficiaire_nom');
            var prenom = document.getElementById('beneficiaire_prenom');
            var phone = document.getElementById('beneficiaire_telephone');

            if (nom.value.trim() === '' || prenom.value.trim() === '' || phone.value.trim() === '') {
                // Ajoutez ici des messages ou des styles pour indiquer qu'un champ obligatoire est manquant
                if (nom.value.trim() === '') {
                    nom.classList.add('is-invalid');
                }

                if (prenom.value.trim() === '') {
                    prenom.classList.add('is-invalid');
                }

                if (phone.value.trim() === '') {
                    phone.classList.add('is-invalid');
                }

                return false;
            }

            return true;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#date_debut').change(function () {
                var startDate = $(this).val();
                $('#date_fin').attr('min', startDate);
            });
        });
    </script>
@endsection