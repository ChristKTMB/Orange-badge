<?php

namespace App\Exports;

use App\Models\BadgeRequest;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApprovingExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

     public function title(): string
     {
         return 'Export de données';
     }
    
    public function headings(): array
    {
        return [
            'No de demande',
            'Status',
            'Categorie',
            'Demandeur nom','Demandeur Prénom','Demandeur Direction','Demandeur Fonction','Demandeur Téléphone','Demandeur Matricule',
            'Bénéficiaire Nom','Bénéficiaire Prénom','Bénéficiaire Direction','Bénéficiaire Fonction','Bénéficiaire Téléphone','Bénéficiaire Matricule',
            'Date de demande',
            
        ];
    }

    public function collection()
    {
        $badgeRequest = BadgeRequest::orderBy('created_at', 'desc')
            ->get();

        $exportData = $badgeRequest->map(function ($item) {
            $progress = ApprovalProgress::where('badge_request_id', $item->id)
                                        ->orderBy('id', 'desc')
                                        ->first();
            if ($progress->motif !== null) {
                $progress = 'Rejeté'; 
            } else {
                $progress = ($progress->approved == 0) ? 'En attente' : 'Validé';
            }
            return [

                'No de demande'=> $item->id,
                'Status'=> $progress,
                'Categorie'=> $item->categorie,
                'Demandeur nom'=> $item->demandeur_nom,'Demandeur Prénom'=> $item->demandeur_prenom,
                'Demandeur Direction'=> $item->demandeur_directeur,'Demandeur Fonction'=> $item->demandeur_fonction,
                'Demandeur Téléphone'=> $item->demandeur_telephone,'Demandeur Matricule'=> $item->demandeur_matricule,
                'Bénéficiaire Nom'=> $item->beneficiaire_nom,'Bénéficiaire Prénom'=> $item->beneficiaire_prenom,
                'Bénéficiaire Direction'=> $item->beneficiaire_direction,'Bénéficiaire Fonction'=> $item->beneficiaire_fonction,
                'Bénéficiaire Téléphone'=> $item->beneficiaire_telephone,'Bénéficiaire Matricule'=> $item->beneficiaire_matricule,
                'Date de demande'=> $item->created_at,
            ];
        });
        
        return $exportData;
    }

}
