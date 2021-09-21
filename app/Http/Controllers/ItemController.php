<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemParameter;
use App\Models\Category;
use App\Models\CategoryParameter;
use App\Models\Parameter;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category,  Parameter $parameter)
    {
        
        $parameters = CategoryParameter::where('category_id','=',$category->id)->get();
        $params = [];
            foreach($parameters as $parameter) {
            $params[] = $parameter = Parameter::where('id','=',$parameter->parameter_id)->get();
        }
        return view('item.create',['category' => $category, 'params' => $params]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
        public function store(Request $request, Category $category)
        {
            $item = new Item();
            $item->name = $request->name;
            $item->price = $request->price;
            $item->description = $request->description;
            $item->quantity = $request->quantity;
            $item->category_id = $request->category_id;
            $item->discount = $request->discount;
            $item->save();
            $category= Category::find($request->category_id);
            foreach ($category->parameters as $parameter) {
                $item->parameters()->attach($parameter,['data' => $request->input($parameter->id)]);
            }
            return redirect()->route('category.map',$request->category_id);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
      return view('item.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item, Category $category)
    {
        return view('item.edit',['item' => $item, 'category' => $category]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item, Category $category)
    {
        $item->id = $request->item_id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->discount = $request->discount;
        $item->save();
        foreach ($item->parameters as $parameter) {
            $iP =  ItemParameter::where('item_id','=', $item->id)
            ->where('parameter_id','=', $parameter->id)->first();
            $iP->data = $request->input($parameter->id);
            $iP->save();
        }
        

        $category = Category::find($request->category_id);
        return redirect()->route('category.map',[$category->id])->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
       $item->delete();
        return redirect()->route('category.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
