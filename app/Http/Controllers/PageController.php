<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class PageController extends Controller
{
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

        return view('index', compact('cours', 'categories', 'categorie'));
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function show404()
    {
        return view('404');
    }
    public function showTeam()
    {
        return view('team');
    }
    public function showTestimonial()
    {
        return view('testimonial');
    }
}
