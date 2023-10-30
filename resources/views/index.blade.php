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
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        h4 {
            background-color: #e8842b;
            color: #000000;
            padding: 5px;
            margin: 0;
        }

        * body {
            font-family: sans-serif;
            font-size: 13px;
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

        .mb-6 {
            margin-bottom: 15px;
        }

        #motivation {
            min-height: 500px !important;
            "

        }

        table th,
        table td {
            padding: 5px;
            width: 50px !important;
            border: 1px solid #000 !important;
        }

        table th {
            background-color: #F2F2F2;
            text-align: left;
        }

        table td {
            text-align: left;

        }

        p {
            margin: 0;
        }

        .text-right {
            text-align: right;
        }

        .bordure {
            border: 2 double rgb(255, 255, 255);
        }

        table {
            width: 100%;
            border-color: #000;
        }


        #footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;


        }
    </style>
</head>

<body>
    <div class="bordure">
        <a class="btn btn-success" href="{{ URL::to('/badgeRequest/pdf') }}">
            <i class="fas fa-file-pdf"></i></a>
        <div class="container">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDMwIDMwIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTk4IC0zMDEpIj48cmVjdCB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDE5OCAzMDEpIiBmaWxsPSIjZmY3OTAwIi8+PHJlY3Qgd2lkdGg9IjIxLjQ5NyIgaGVpZ2h0PSI0LjI5OSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjAyLjMgMzIyLjQwMSkiIGZpbGw9IiNmZmYiLz48L2c+PC9zdmc+"
                class="user-image img-circle elevation-2" alt="User Image" width="50px" height="50px" />

            <h2 class="text-center mb-3">FORMULAIRE DE DEMANDE DE BADGE</h2><br><hr style="background-color: #e8842b; height: 2px; border: none;">
            <br>
            
            <div>
                <table class="table form-table">
                    <tbody>
                        <tr>
                            <th>
                                <p><strong>Numéro de la demande</strong></p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->id }}</p>
                            </td>
                            <th>
                                <p><strong>Catégorie de la demande</strong></p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->categorie }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><br>
            <div class="mb-6">
                <h4>INFORMATION DU DEMANDEUR</h4>
                <table class="table form-table">
                    <tbody>
                        <tr>
                            <th>
                                <p>Nom et prenom</p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->demandeur_nom }} {{ $badgeRequest->demandeur_prenom }}</p>
                            </td>
                            <th>
                                <p>Téléphone </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->demandeur_telephone }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Fonction </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->demandeur_fonction }}</p>
                            </td>
                            <th>
                                <p>Matricule </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->demandeur_matricule }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Direction </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->demandeur_directeur }}</p>
                            </td>
                            <th>
                                <p>Date </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->date }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="mb-6">
                <h4>INFORMATION DU DEMANDEUR</h4>
                <table class="table form-table">
                    <tbody>
                        <tr>
                            <th>
                                <p>Nom et prenom</p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->beneficiaire_nom }} {{ $badgeRequest->beneficiaire_prenom }}</p>
                            </td>
                            <th>
                                <p>Téléphone </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->beneficiaire_telephone }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Fonction </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->beneficiaire_fonction }}</p>
                            </td>
                            <th>
                                <p>Matricule </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->beneficiaire_matricule }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Direction </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->beneficiaire_direction }}</p>
                            </td>
                            <th>
                                <p>Manager </p>
                            </th>
                            <td>
                                <p>{{ $badgeRequest->beneficiaire_employeur }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mb-6">
                <h4>CATEGORIE DU BADGE</h4>
                <table class="table form-table">
                    <thead>
                        <tr>
                            <th>Catégorie de badge</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $badgeRequest->categorie_badge }}</td>
                            <td>{{ $badgeRequest->date_debut }}</td>
                            <td>{{ $badgeRequest->date_fin }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mb-6">
                <h4>MOTIVATION</h4>
                <table class="table form-table">
                    <tbody>
                        <tr>
                            <td id="motivation">
                                <p style="height: 100px">{{ $badgeRequest->motivation }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="footer">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="height: 50px; 
                                text-align: center;">
                                Demandeur<br>(Date et signature)</th>
                            @foreach ($approvers as $approver)
                                <th style="height: 50px;
                            text-align: center;">
                                    {{ $approver['fonction'] }}<br>(Date et signature)</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 50px; text-align: center;">
                                <p>{{ $badgeRequest->demandeur_nom }} {{ $badgeRequest->demandeur_prenom }}</p>
                            </td>
                            @foreach ($approvers as $approver)
                                @php
                                    $progress = App\Models\ApprovalProgress::where('badge_request_id', $badgeRequest->id)
                                        ->where('approver_id', $approver['id'])
                                        ->first();
                                @endphp
                                @if ($progress)
                                    <td style="height: 50px; text-align: center;">
                                        <p>{{ $approver['name'] }}<br>{{ $progress->created_at }}</p>
                                        @if ($progress->approved === 1)
                                            <span style="background: rgb(0, 255, 98); padding: 5px;">Validé</span>
                                        @elseif($progress->motif != null)
                                            <span style="background: rgb(255, 42, 0); padding: 5px;">Rejeté</span>
                                        @else
                                            <span style="background: rgb(180, 180, 180); padding: 5px;">En
                                                attente</span>
                                        @endif
                                    </td>
                                @else
                                    <td style="background: rgb(63, 63, 63); padding: 5px;"></td>
                                @endif
                            @endforeach
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
