<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BadgeRequest PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
* 
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
        
        table th,
        table td {
            padding: 10px;
            border: 1px solid #000 !important;
        }
        table th {
            background-color: #F2F2F2;
            text-align: left;
        }
        table td {
            text-align: center;
        }
        p {
            margin: 0;
        }
        .text-right {
            text-align: right;
        }
        .bordure{
            border: 2 double black;
        }
        table{
            width: 100%;
            border-color:  #000;
        }
</style>
</head>
<body>
    <div class="bordure">
        <a class="btn btn-success" href="{{ URL::to('/badgeRequest/pdf') }}">
            <i class="fas fa-file-pdf"></i></a>
    <div class="container">
        <h2 class="text-center mb-3">FORMULAIRE DE DEMANDE DE BADGE</h2><hr>
        <div class="mb-5">
            <h3>1. Information du demandeur</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><p>Nom :</p></td>
                        <td><p>{{ $badgeRequest[0]['demandeur_nom'] }}</p></td>
                        <td><p>Téléphone :</p></td>
                        <td><p>{{ $badgeRequest[0]['demandeur_telephone'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Prenom :</p></td>
                        <td><p>{{ $badgeRequest[0]['demandeur_prenom'] }}</p></td>
                        <td><p>Matricule :</p></td>
                        <td><p>{{ $badgeRequest[0]['demandeur_matricule'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Directeur :</p></td>
                        <td><p>{{ $badgeRequest[0]['demandeur_directeur'] }}</p></td>
                        <td><p>Date :</p></td>
                        <td><p>{{ $badgeRequest[0]['date'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Fonction :</p></td>
                        <td colspan="3"><p>{{ $badgeRequest[0]['demandeur_fonction'] }}</p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mb-5">
            <h3>2. Information du bénéficiaire</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><p>Nom :</p></td>
                        <td><p>{{ $badgeRequest[0]['beneficiaire_nom'] }}</p></td>
                        <td><p>Téléphone :</p></td>
                        <td><p>{{ $badgeRequest[0]['beneficiaire_telephone'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Prenom :</p></td>
                        <td><p>{{ $badgeRequest[0]['beneficiaire_prenom'] }}</p></td>
                        <td><p>Matricule :</p></td>
                        <td><p>{{ $badgeRequest[0]['beneficiaire_matricule'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Direction :</p></td>
                        <td><p>{{ $badgeRequest[0]['beneficiaire_direction'] }}</p></td>
                        <td><p>Employeur :</p></td>
                        <td><p>{{ $badgeRequest[0]['beneficiaire_employeur'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p>Fonction :</p></td>
                        <td colspan="3"><p>{{ $badgeRequest[0]['beneficiaire_fonction'] }}</p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mb-5">
            <h3>3. Catégorie de badge</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Catégorie de badge</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $badgeRequest[0]['categorie_badge'] }}</td>
                        <td>{{ $badgeRequest[0]['date_debut'] }}</td>
                        <td>{{ $badgeRequest[0]['date_fin'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mb-5">
            <h3>4. Motivation</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <td><p>{{ $badgeRequest[0]['motivation'] }}</p></td>
                    </tr>
                </tbody>
            </table>
        </div><br>
        
        <div class="mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="height: 50px;">Demandeur<br>(Date et signature)</th>
                        <th  style="height: 50px;">Responsable humain<br>(Date et signature)</th>
                        <th>Responsable sécurité<br>(Date et signature)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 50px;"></td>
                        <td style="height: 50px;"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    </div>

</body>
</html>