<?php
namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Inscription;
use App\Models\Quiz;
use App\Models\Contenu;
use App\Models\Question;
use App\Models\Certificat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class CoursController extends Controller
{
    // Affiche tous les cours avec pagination
    public function index(Request $request)
    {
        $categorie = $request->query('categorie');

        if ($categorie) {
            $cours = Cours::where('categorie', $categorie)->paginate(6);
        } else {
            $cours = Cours::paginate(6);
        }

        // Pour récupérer toutes les catégories distinctes (optionnel pour le menu)
        $categories = Cours::select('categorie')->distinct()->get();

        return view('courses', compact('cours', 'categories', 'categorie'));
    }

    // Affiche les détails d’un cours
    public function show($id)
    {
        $cours = Cours::with('enseignant')->findOrFail($id);
        return view('course_show', compact('cours'));
    }
    
    // Filtre les cours par catégorie
    public function filter(Request $request)
    {
        $categorie = $request->input('categorie');
        $cours = Cours::where('categorie', $categorie)->paginate(2);
        return view('courses', compact('cours'));
    }
    
    public function apprendre($id)
    {
        $cours = Cours::findOrFail($id);
        $contenu = Contenu::where('cours_id', $id)->first();
        $quiz = Quiz::where('cours_id', $id)->first();
        $question = $quiz ? $quiz->questions()->first() : null;
        return view('cours', compact('cours', 'contenu', 'quiz', 'question'));
    }

    public function validerQuiz(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.show')->with('error', 'Vous devez être connecté pour valider le quiz.');
        }

        $question = Question::findOrFail($request->question_id);
        $userId = auth()->id();

        if ($request->reponse == $question->bonne_reponse) {
            // Rediriger vers génération certificat
            return $this->genererCertificat($id);
        }

        return redirect()->back()->with('error', 'Mauvaise réponse. Essayez encore.');
    }

    public function inscrire($id)
    {
        $user = Auth::user();

        // Vérifie si l'utilisateur est étudiant
        if ($user->role !== 'etudiant') {
            return redirect()->back()->with('error', "Seuls les étudiants peuvent s'inscrire.");
        }

        // Vérifie s'il est déjà inscrit
        $dejaInscrit = Inscription::where('utilisateur_id', $user->id)
            ->where('cours_id', $id)
            ->exists();

        if ($dejaInscrit) {
            return redirect()->back()->with('info', 'Vous êtes déjà inscrit à ce cours.');
        }

        // Crée l'inscription
        Inscription::create([
            'utilisateur_id' => $user->id,
            'cours_id' => $id,
            'date_inscription' => now(),
        ]);

        return redirect()->route('cours.apprendre', $id)->with('success', 'Inscription réussie !');
    }

    // public function genererCertificat($cours_id)
    // {
    //     $utilisateur = auth()->user();
    //     $cours = Cours::findOrFail($cours_id);

    //     $data = [
    //         'nom' => $utilisateur->nom,
    //         'cours' => $cours->titre,
    //         'date' => now()->format('d/m/Y')
    //     ];

    //     $pdf = Pdf::loadView('certificat.template', $data);
    //     $fileName = 'certificat_' . $utilisateur->id . '_' . $cours->id . '.pdf';

    //     // Sauvegarde dans storage/public/certificats
    //     $pdf->save(storage_path('app/public/' . $fileName));

    //     // Mise à jour ou création en DB
    //     Certificat::updateOrCreate([
    //         'utilisateur_id' => $utilisateur->id,
    //         'cours_id' => $cours_id
    //     ], [
    //         'date_obtention' => now(),
    //         'image_path' => 'storage/certificats/' . $fileName
    //     ]);

    //     return back()->with('success', 'Certificat généré avec succès !');
    // }
    public function genererCertificat($cours_id)
{
    $utilisateur = auth()->user();
    $cours = Cours::findOrFail($cours_id);

    // ✅ Créer le dossier s’il n’existe pas
    $directory = storage_path('app/public/certificats');
    if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true);
    }

    $data = [
        'nom' => $utilisateur->nom,
        'cours' => $cours->titre,
        'date' => now()->format('d/m/Y')
    ];

    $pdf = Pdf::loadView('certificat.template', $data);
    $fileName = 'certificat_' . $utilisateur->id . '_' . $cours->id . '.pdf';

    $pdf->save($directory . '/' . $fileName);

    Certificat::updateOrCreate([
        'utilisateur_id' => $utilisateur->id,
        'cours_id' => $cours_id
    ], [
        'date_obtention' => now(),
        'image_path' => 'storage/certificats/' . $fileName
    ]);

    return back()->with('success', 'Certificat généré avec succès !');
}
}