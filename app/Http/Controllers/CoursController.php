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
    public function index(Request $request)
    {
        $categorie = $request->query('categorie');

        if ($categorie) {
            $cours = Cours::where('categorie', $categorie)->paginate(6);
        } else {
            $cours = Cours::paginate(6);
        }
        $categories = Cours::select('categorie')->distinct()->get();

        return view('courses', compact('cours', 'categories', 'categorie'));
    }
    public function show($id)
    {
        $cours = Cours::with('enseignant')->findOrFail($id);
        return view('course_show', compact('cours'));
    }
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
            return $this->genererCertificat($id);
        }
        return redirect()->back()->with('error', 'Mauvaise réponse. Essayez encore.');
    }
    public function inscrire($id)
    {
        $user = Auth::user();
        if ($user->role !== 'etudiant') {
            return redirect()->back()->with('error', "Seuls les étudiants peuvent s'inscrire.");
        }
        $dejaInscrit = Inscription::where('utilisateur_id', $user->id)->where('cours_id', $id)->exists();
        if ($dejaInscrit) {
            return redirect()->back()->with('info', 'Vous êtes déjà inscrit à ce cours.');
        }
        Inscription::create([
            'utilisateur_id' => $user->id,
            'cours_id' => $id,
            'date_inscription' => now(),
        ]);
        return redirect()->route('cours.apprendre', $id)->with('success', 'Inscription réussie !');
    }
    public function genererCertificat($cours_id)
    {
        $utilisateur = auth()->user();
        $cours = Cours::findOrFail($cours_id);
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