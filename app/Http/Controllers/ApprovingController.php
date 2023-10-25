<?php
namespace App\Http\Controllers;
use App\Models\Approving;
use Illuminate\Http\Request;

class ApprovingController extends Controller
{
    public function index()
    {
        $results = Approving::where('etat', 1)->get(); // Récupère toutes les approbations dans la base de données
        return view('approving.index', compact('results')); // Affiche la vue index avec les données récupérées
    }

    public function create()
    {
        return view('approving.create'); // Affiche la vue create pour permettre à l'utilisateur de soumettre les données d'approbation
    }

    public function store(Request $request)
    {
        // Itère sur les données soumises et les enregistre dans la base de données
        foreach ($request->data as $key => $value) {
        $approving = new Approving; // Crée une nouvelle instance de l'objet Approving
        $approving->name = $value ['name']; // Enregistre le nom de l'approbateur
        $approving->fonction = $value ['function']; // Enregistre la fonction de l'approbateur
        $approving->email = $value ['email']; // Enregistre l'email de l'approbateur
        $approving->save(); // Enregistre l'approbateur dans la base de données
        }
        return redirect('/approving')
        ->with('success', 'Les approbations ont été enregistrées avec succès.'); // Redirige l'utilisateur vers la page précédente avec un message de succès
        
    }

    public function confirmDelete()
    {
    return view('approving.confirm-delete');
    }

    public function delete()
    {
        $result = Approving::where('etat', 1)->update(['etat'=>0]);
        //$result = Approving::truncate(); // Supprime toutes les données de la table
        if ($result) {
            return redirect()->route('approving.index')->with('success', 'Toutes les données ont été supprimées avec succès.');
        } else {
            return redirect()->route('approving.index')->with('error', 'Une erreur est survenue lors de la suppression des données.');
        }
    }
}