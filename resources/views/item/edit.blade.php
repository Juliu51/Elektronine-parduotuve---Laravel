@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Redaguoti kategorijoje</div>
            <div class="card-body">
               <form method="POST" action="{{route('item.update', [$item])}}" enctype="multipart/form-data">
                  <div class="form-group">
                      <label>Prekes pavadinimas</label>
                      <input type="text" name="name"  class="form-control" value="{{$item->name}}">
                  </div>
                  <div class="form-group">
                      <label>Prekes gamintojas</label>
                      <input type="text" name="manufacturer"  class="form-control" placeholder="{{$item->manufacturer}}" value="{{$item->manufacturer}}">
                  </div>
                  <div class="form-group">
                      <label>Prekes Kaina</label>
                      <input type="number" name="price"  class="form-control" placeholder="Eur" value="{{$item->price}}">

                  </div>
                  <div class="form-group">
                      <label>Prekes aprasymas</label>
                      <textarea name="description"  class="form-control" placeholder="{{$item->description}}">{{$item->description}}</textarea>

                  </div>
                  <div class="form-group">
                      <label>Prekes kiekis</label>
                      <input type="number" name="quantity"  class="form-control" placeholder="Vnt." value="{{$item->quantity}}">
                  </div>
                  <div class="form-group">
                      <label>Prekes nuolaida</label>
                      <input type="number" name="discount"  class="form-control" placeholder="0%" value="{{$item->discount}}">
                  </div>
                  
                  
<input type="hidden" name="item_id" value="{{$item->id}}">
<input type="hidden" name="category_id" value="{{$category->id}}">   
            @foreach ($item->parameters as $param) 
                  <div class="form-group">
                      <label>{{$param->title}} {{$param->data_type}}</label>
                      <input type="text" name="{{$param->id}}"  class="form-control"  value="{{$param->pivot->data}}" placeholder="{{$param->data_type}}">
                      <small class="form-text text-muted"></small>
                  </div>
                  @endforeach
                  @csrf
                  <button class="btn btn-success" type="submit">Prideti</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
  
@endsection