@extends('layouts.app')

@section('content')
<div class="container">
    <input type="hidden" name="item_id" value="{{$item->id}}">
<input type="hidden" name="category_id" value="{{$category->id}}">  
<a href="{{route('category.map',$category)}}" class="text-sm text-gray-700 dark:text-gray-500 underline">Gryzti į sąrašą</a>
<div class="PrekeContainer">
    <div class="photo">
    @if(count($item->photos) > 0)
               <div class="imgHead">
                 <img class="bigImg" src="{{asset("/images/items/big/".$item->photos[0]->name)}}" alt=""></div>
                 @else
                 <div class="imgHead"> <img class="bigImg" src="{{asset("/images/icons/Default.jpg")}}" alt=""> </div>
                 @endif
                 
    </div>
    
    <div class="info">
    <p class="pName  text-white">{{$item->name}}</p>
<p class="justify-content-right text-white">Gamintojas: <span style="color:red;">{{$item->manufacturer}}</span></p>
<div class="veiksmai">
<p class="justify-content-center text-white">Likutis: {{$item->quantity}} 🚚</p>
<p class="justify-content-center text-white">Kaina: {{$item->price}} €</p>
<a class="btn btn-danger"href="">Pirkti</a>
    </div>
    </div>
</div>

<div class="Aprasymas">
    <p class=" app text-white">Aprasymas</p>
    <p class="text-white" style="font-size:16px;"><span style="font-weight: 900;">{{$item->name}}</span> - {{$item->description}}</p>
    <p class=" para text-white">Parametrai</p>
    <div class="parametrai">
    @foreach ($item->parameters as $param)
    <div class="parametrai1  text-white"><p>{{$param->title}}:</p></div>
    <div class="parametrai2  text-white"><p>{{$param->pivot->data}} {{$param->data_type}}</p></div>
   
@endforeach

</div>
</div>
</div>
@endsection