<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryParameter;
use App\Models\Item;
use App\Models\Parameter;
use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_SESSION['chain'] = [];
        $categories = Category::whereNull('category_id')->get();
        $chain = [];
        $chain[] = $categories;
       
        $Allitems = Item::all();
        for ($i=rand(0,(count($Allitems)-7)); $i < 6; $i++) { 
            $tmp[] = $Allitems[$i];
            shuffle($tmp);
            }
        $Allitems = $tmp;

        return view('category.index', ['categories' => $categories, 'chain' => $_SESSION['chain'], 'Allitems' => $Allitems]);
    }

    public function map(Category $category)
    {$_SESSION['chain'][] = $category;
        $tmpSs = [];
        foreach ($_SESSION['chain'] as $ssCat) {
            $tmpSs[] = $ssCat;
            if ($ssCat->id == $category->id) {
                break;
            }
        }
        $_SESSION['chain'] = $tmpSs;
        $categories = Category::where('category_id', '=', $category->id)->get();
        $parameters = Parameter::all();
        $items = Item::where('category_id', '=', $category->id)->get();
        $zz = [];
        $ss = Category::where('category_id', '=', $category->id)->get();
        foreach ($ss as $s){
            $zz[] = Item::where('category_id', '=', $s->id)->get();
        }
       
       
        return view('category.index', ['chain' => $_SESSION['chain'], 'categories' => $categories, 'parameters' => $parameters, 'items' => $items, 'zz' => $zz]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoryId)
    {

        $parameters = Parameter::all();
        return view('category.create', ['categoryId' => $categoryId, 'parameters' => $parameters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        if ($request->category_id != 0) {
            $category->category_id = $request->category_id;
        }
        $category->save();
        foreach ($request->parameters as $parameter) {
            $category->parameters()->attach($parameter);
        }
        if ($request->category_id == 0) {
            return redirect()->route('category.index');
        }
        return redirect()->route('category.map', $request->category_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parameters = Parameter::all();
        $categories = Category::where('id', '!=', $category->id)->get();
        $categoryParameters = CategoryParameter::where('category_id', '=', $category->id)->get();
        $ctParams = [];

        foreach ($categoryParameters as $ctParam) {
            $ctParams[] = $ctParam->parameter_id;
        }
        $catIds = array_map( function($o) { return $o['id'];}, $category->parameters->toArray() );
        return view('category.edit', ['category' => $category, 'parameters' => $parameters, 'categories' => $categories, 'ctParams' => $ctParams, 'catIds'=> $catIds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->save();
        foreach ($category->parameters as $parameter) {
            $iP = CategoryParameter::where('category_id', '=', $category->id)
                ->where("parameter_id", '=', $parameter->id)->first();
            $iP->delete();
        }
        if ($request->filled('parameters')) {
            foreach ($request->parameters as $parameter) {
                $category->parameters()->attach($parameter);
            }
        }
        return redirect()->route('category.index')->with('success_message', 'Kategorija sėkmingai atnaujinta.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {

        $categoryParameters = CategoryParameter::where('category_id', '=', $category->id)->get();

        // $categoryParameters[0]->delete();

        foreach ($category->parameters as $parameter) {
            $iP = CategoryParameter::where('category_id', '=', $category->id)
                ->where("parameter_id", '=', $parameter->id)->first();
            // $iP->data = $request->input($parameter->id);
            $iP->delete();
        }

        $category->delete();
        
        return redirect()->back()->with('success_message', 'Kategorija sėkmingai pašalinta.');
    }
}
