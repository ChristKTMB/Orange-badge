<?php

namespace App\Exports;

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
            'Categorie',
            'Status',
            'Demandeur nom','Demandeur Prénom','Demandeur Direction','Demandeur Fonction','Demandeur Téléphone','Demandeur Matricule',
            'Bénéficiaire Nom','Bénéficiaire Prénom','Bénéficiaire Direction','Bénéficiaire Fonction','Bénéficiaire Téléphone','Bénéficiaire Matricule',
            'Date de demande',
            
        ];
    }

    public function collection()
    {
        $approvalProgress = ApprovalProgress::select('approvals_progress.*')
            ->join(DB::raw("(SELECT badge_request_id, MAX(id) as max_id FROM approvals_progress GROUP BY badge_request_id) latest_approvals"), function ($join) {
                $join->on('approvals_progress.id', '=', 'latest_approvals.max_id');
            })->with('badgeRequest')->get();

        // Créez une collection pour les données exportées en ajoutant le nom du badge pour chaque ligne
        $exportData = $approvalProgress->map(function ($item) {

            if ($item->motif !== null) {
                $etat = 'Rejeté'; // Si 'motif' n'est pas null, alors c'est rejeté
            } else {
                // Utilisez une condition pour déterminer la valeur de 'État' si 'motif' est null
                $etat = ($item->approved == 0) ? 'En attente' : 'Validé';
            }
            return [

                'No de demande'=> $item->badgeRequest->id,
                'Categorie'=> $item->badgeRequest->categorie,
                'Status'=> $etat,
                'Demandeur nom'=> $item->badgeRequest->demandeur_nom,'Demandeur Prénom'=> $item->badgeRequest->demandeur_prenom,
                'Demandeur Direction'=> $item->badgeRequest->demandeur_directeur,'Demandeur Fonction'=> $item->badgeRequest->demandeur_fonction,
                'Demandeur Téléphone'=> $item->badgeRequest->demandeur_telephone,'Demandeur Matricule'=> $item->badgeRequest->demandeur_matricule,
                'Bénéficiaire Nom'=> $item->badgeRequest->beneficiaire_nom,'Bénéficiaire Prénom'=> $item->badgeRequest->beneficiaire_prenom,
                'Bénéficiaire Direction'=> $item->badgeRequest->beneficiaire_direction,'Bénéficiaire Fonction'=> $item->badgeRequest->beneficiaire_fonction,
                'Bénéficiaire Téléphone'=> $item->badgeRequest->beneficiaire_telephone,'Bénéficiaire Matricule'=> $item->badgeRequest->beneficiaire_matricule,
                'Date de demande'=> $item->badgeRequest->created_at,
                // Ajoutez d'autres colonnes ici si nécessaire
            ];
        });
        
        return $exportData;
    }

    // public function styles(Worksheet $sheet)
    // {
    //     // Ajoutez des styles pour les lignes de séparation
    //     $cellRange = 'A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow();
    //     $styleArray = [
    //         'borders' => [
    //             'outline' => [
    //                 'borderStyle' => Border::BORDER_THIN,
    //             ],
    //         ],
    //     ];
    //     $sheet->getStyle($cellRange)->applyFromArray($styleArray);
    // }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:Q1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A1:Q1')->getFill()->getStartColor()->setARGB('FF87CEEB'); // Couleur de remplissage
        $sheet->getStyle('A1:Q1')->getFont()->getColor()->setRGB('000000'); // Couleur du texte
    }

}
