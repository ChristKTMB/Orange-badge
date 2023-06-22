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
</style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">FORMULAIRE DE DEMANDE DE BADGE</h2>
        <div class="d-flex justify-content-end mb-4">
        
        </div>
      
        <div class="mb-5">
            <h3>1. Information du demandeur</h3> 
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 100px;"><p>Nom :</p></td>
                        <td style="width: calc(100% - 200px);"><p>{{ $badgeRequest[0]['demandeur_nom'] }}</p></td>
                        <td style="width: 100px;"><p>Téléphone :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['demandeur_telephone'] }}</p></td>
                    </tr>
                    <tr>
                        <td style="width: 100px;"><p >Prenom :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['demandeur_prenom'] }}</p></td>
                        <td style="width: 100px;"><p>Matricule :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['demandeur_matricule'] }}</p></td>
                    </tr>
                    <tr>
                        <td style="width: 100px;"><p >Directeur :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['demandeur_directeur'] }}</p></td>
                        <td style="width: 100px;"><p >Date :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['date'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p >Fonction :</p></td>
                        <td colspan="3"><p>{{ $badgeRequest[0]['demandeur_fonction'] }}</p></td>
                    </tr>
                </tbody>
            </table>
         
        </div>
        
        <div class="mb-5">
            <h3>2. Information du bénéficiaire</h3>
            <table >
                <tbody class="table ">
                    <tr>
                        <td style="width: 100px;"><p >Nom :</p></td>
                        <td style="width: calc(100% - 200px);"><p>{{ $badgeRequest[0]['beneficiaire_nom'] }}</p></td>
                        <td style="width: 100px;"><p >Téléphone :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['beneficiaire_telephone'] }}</p></td>
                    </tr>
                    <tr>
                        <td style="width: 100px;"><p >Prenom :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['beneficiaire_prenom'] }}</p></td>
                        <td style="width: 100px;"><p >Matricule :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['beneficiaire_matricule'] }}</p></td>
                    </tr>
                    <tr>
                    <td style="width: 100px;"><p >Direction :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['beneficiaire_direction'] }}</p></td>
                        <td><p style="width: 100px;">Employeur :</p></td>
                        <td><p style="width: 200px;">{{ $badgeRequest[0]['beneficiaire_employeur'] }}</p></td>
                    </tr>
                    <tr>
                        <td><p >Fonction :</p></td>
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
                        <th style="width: 150px;"></th>
                        <th>Date début</th>
                        <th style="width: 150px;"></th>
                        <th>Date fin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $badgeRequest[0]['categorie_badge'] }}</td>
                        <td style="height: 50px;"></td>
                        <td>{{ $badgeRequest[0]['date_debut'] }}</td>
                        <td style="height: 50px;"></td>
                        <td>{{ $badgeRequest[0]['date_fin'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mb-5">
            <h3>4. Motivation</h3>
            <table>
                <tbody>
                <tr>
                    <td><p>{{ $badgeRequest[0]['motivation'] }}</p></td>
                </tr>
                </tbody>                
            </table>
         </div>
         <div class="mb-5"><br>            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Demandeur <br> (Date et signature) </th>
                        <th style="width: 150px;"></th>
                        <th>Responsable humain <br> (Date et signature)</th>
                        <th style="width: 150px;"></th>
                        <th>Resp. Sec Physique <br> (Date et signature)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td style="height: 50px;"></td>
                          <td></td>    
                        <td style="height: 50px;"></td>
                          <td></td>  
                        <td style="height: 50px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
