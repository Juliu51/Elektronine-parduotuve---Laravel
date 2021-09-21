@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Sukurti {{$category->name}} kategorijoje</div>

            <div class="card-body">
               <form method="POST" action="{{route('item.store')}}" >
                  <div class="form-group">
                      <label>Prekes pavadinimas</label>
                      <input type="text" name="name"  class="form-control">
                  </div>
                  <div class="form-group">
                      <label>Prekes Kaina</label>
                      <input type="number" name="price"  class="form-control" placeholder="Eur">

                  </div>
                  <div class="form-group">
                      <label>Prekes aprasymas</label>
                      <textarea name="description"  class="form-control" placeholder="Info"></textarea>

                  </div>
                  <div class="form-group">
                      <label>Prekes kiekis</label>
                      <input type="number" name="quantity"  class="form-control" placeholder="Vnt.">
                  </div>
                  <div class="form-group">
                      <label>Prekes nuolaida</label>
                      <input type="number" name="discount"  class="form-control" placeholder="0%">
                  </div>
<input type="hidden" name="category_id" value="{{$category->id}}">
                 
            @foreach ($category->parameters as $param) 
                 
                  <div class="form-group">
                      <label>{{$param->title}}</label>
                      <input type="text" name="{{$param->id}}"  class="form-control" placeholder="{{$param->data_type}}">
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