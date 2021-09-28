@extends('layouts.app')

@section('content')
<div class="container">
    <input type="hidden" name="item_id" value="{{$item->id}}">
<input type="hidden" name="category_id" value="{{$category->id}}">  
<a href="{{route('category.map',$category)}}" class="text-sm text-gray-700 dark:text-gray-500 underline">Gryzti į sąrašą</a>
<p class="d-flex justify-content-center text-white">Prekes Pavadinimas: {{$item->name}}</p>
<p class="d-flex justify-content-center text-white">Gamintojas: {{$item->manafacturer}}</p>
<p class="d-flex justify-content-center text-white">Aprasymas: {{$item->description}}</p>
<p class="d-flex justify-content-center text-white">Kiekis: {{$item->quantity}}</p>
<p class="d-flex justify-content-center text-white">Kaina: {{$item->price}}</p>

@foreach ($item->parameters as $param)

<p class="d-flex justify-content-center text-white">{{$param->title}}: {{$param->pivot->data}} {{$param->data_type}}</p>

@endforeach
</div>
@endsection