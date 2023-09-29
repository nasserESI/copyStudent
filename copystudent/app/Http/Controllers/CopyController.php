<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Copy;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CopyController extends Controller
{
    public function index()
    {

            return view('copies.index');


    }

    public function chargerFichier(Request $request)
    {
        // Génération de la clé
        $key = Str::random(32);

        // Valider le formulaire si nécessaire
        $request->validate([
             'name' => 'required|string',
             'student' => 'required|string',
             'file' => 'required|file|mimes:pdf,txt', // Exemple pour limiter aux fichiers PDF
         ]);


        if(Course::where('course',$request->input('name'))->exists() && User::where('name',$request->input('student'))->exists()){
            // Enregistrer le fichier dans le dossier de stockage
            $cheminVersFichier = $request->file('file')->store('mon_dossier');
            $cheminVersFichier = str_replace("/"," \ ",$cheminVersFichier);
            $cheminVersFichier = str_replace(" ","",$cheminVersFichier);
            $data = ['course'=>$request->input('name'),'teacher'=>auth()->user()->getName(),'student'=>$request->string('student'),
                'fileName'=>$cheminVersFichier];
            $encryptedData = Crypt::encrypt(json_encode($data),$key);

            // Chiffrement du contenu du fichier
            $fileContents = file_get_contents($request->file('file')->path()); // Assurez-vous que votre formulaire a un champ de type "file"
            $encryptedFileContents = Crypt::encrypt($fileContents, $key);

            // Enregistrer les autres informations dans la base de données si nécessaire
            $copie = Copy::create([
                'student'=>$request->string('student'),
                'teacher'=>auth()->user()->getName(),
                'course'=>$request->string('name'),
                'mark'=>null,
                'graded'=>false,
                'fileName'=>$cheminVersFichier,

            ]);

            $copie->save();
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['message' => 'Une erreur s\'est produite.']);
        }



    }
    public function studentWatching(){
        $copies = Copy::where('student','richard')->get();
        dd("$copies");
        return view('copystudent',['tests'=>$copies]);
    }
    public function telechargerFichier(Request $request)
    {

        $copi = new Copy();
        $copi = $copy = Copy::where('id', $request->id)->firstOrFail();

        $cheminVersFichier = storage_path($copi->fileName);
        $nomFichierTelecharge = $copi->fileName;

        $relativePath = "C:\laragon\www\copystudent\storage\app ".$copi->fileName;
        $relativePath = str_replace(" ","\ ",$relativePath);
        $relativePath = str_replace(" ","",$relativePath);
        return response()->download($relativePath);
        //  return Response::download($cheminVersFichier, $nomFichierTelecharge);
    }
    // Méthode pour enregistrer une nouvelle copie
    public function store(Request $request)
    {
        dd($request->all());
        $myFile = fopen($request->file,"r");
        dd(fread($request->file));

        return redirect()->back();
    }

    // Méthode pour afficher les détails d'une copie spécifique
    public function show($id)
    {
        $copy = Copy::find($id);
        return view('dashboard');
    }

    // Méthode pour afficher le formulaire d'édition d'une copie
    public function edit($id)
    {
        $copy = Copy::find($id);
        return view('copies.edit', compact('copy'));
    }

    // Méthode pour mettre à jour une copie spécifique
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
        ]);

        // Mettre à jour les informations de la copie dans la base de données
        $copy = Copy::find($id);
        $copy->update($validatedData);

        // Rediriger vers la liste des copies avec un message de succès
        return redirect()->route('copies.index')->with('success', 'La copie a été mise à jour avec succès.');
    }
    public function mark(Request $request){
        $copy = new Copy();
        $copy = Copy::where('id',$request->id)->first();
        $copy->update([
            'graded'=> 1,
            'mark' => $request->grade,
        ]);
        return redirect()->back();
    }
    // Méthode pour supprimer une copie spécifique
    public function destroy($id)
    {
        // Trouver la copie et la supprimer de la base de données
        $copy = Copy::find($id);
        $copy->delete();

        // Rediriger vers la liste des copies avec un message de succès
        return redirect()->back();
    }
}
