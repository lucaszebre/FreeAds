<?php

namespace App\Http\Controllers;


use App\Models\AnnonceModel;
use Illuminate\Http\Request;

class Annonce extends Controller
{
    public function index()
    {
        $items = AnnonceModel::all();

        return view('annonce',['items' => $items]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:80',
            'description' => 'required|string',
            'photographie.*' => 'required|image|mimes:jpg,png|max:2048', 
            'prix' => 'required'
        ]);

        $annonceModel = new AnnonceModel();
        $annonceModel->title = $request->input('title');
        $annonceModel->description = $request->input('description');
        $annonceModel->prix = $request->input('prix');
        $arr=[];
        foreach ($request->file('photographie') as $file) {
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('public/uploads/', $fileName);
            array_push($arr,$fileName);
        }
        $annonceModel->photographie = json_encode($arr);;
        $annonceModel->save();

        return redirect()->back()->with('success', 'Annonces stored !');
    }

    public function see($id)
    {
        $items = AnnonceModel::where("id", $id)->get();

        return view('annonceEdit',['items' => $items]);
    }
    public function edit(Request $request, $id)
{
    $request->validate([
        'title' => 'required|max:80',
        'description' => 'required|string',
        'prix' => 'required'
    ]);

    $annonceModel = AnnonceModel::find($id);

    

    $annonceModel->title = $request->input('title');
    $annonceModel->description = $request->input('description');
    $annonceModel->prix = $request->input('prix');
    $arr=[];
    foreach ($request->file('photographie') as $file) {
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('public/uploads/', $fileName);
        array_push($arr,$fileName);
    }
    $annonceModel->photographie = json_encode($arr);;
    $annonceModel->save();

    return redirect('/annonce')->with('success');
}
   


    public function search(Request $request){
        $name = $request->input('name');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $preferences = $request->input('preferences');
        $color = $request->input('color');
    
        $query = AnnonceModel::query();
    
        if ($name) {
            $query->where('title', 'LIKE', "%{$name}%");
        }
    
        if ($minPrice) {
            $query->where('prix', '>=', $minPrice);
        }
    
        if ($maxPrice) {
            $query->where('prix', '<=', $maxPrice);
        }
    
        if ($preferences) {
            $query->where('description', 'LIKE', "%{$preferences}%");
        }
    
        if ($color) {
            $query->where('description', 'LIKE', "%{$color}%");
        }
    
        $posts = $query->get();
    
        return view('/annoncesearch',['items' => $posts]);
    }
    
    
    public function delete(Request $request,$id)
    {
       
        $annonceModel = AnnonceModel::find($id);

        $annonceModel->delete();

        return redirect('/annonce')->with('success deleted');

    }
}
