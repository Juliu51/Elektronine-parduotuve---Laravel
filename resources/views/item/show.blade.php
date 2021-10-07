@extends('layouts.app')

@section('content')
<div class="container">
    <input type="hidden" name="item_id" value="{{$item->id}}">
<input type="hidden" name="category_id" value="{{$category->id}}"> 
@foreach ($categories as $cat)

<a href="{{route('category.map',$cat)}}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{$cat->name}} ></a>
@endforeach
<a href="{{route('category.map',$category)}}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{$category->name}}</a>
<div class="PrekeContainer">
    <div class="photo">
    @if(count($item->photos) > 0)
               <div class="imgHead">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block bigImg" src="{{asset("/images/items/big/".$item->photos[0]->name)}}" alt="First slide">
                      </div>
                      @foreach ($item->photos as $photo)
                      <div class="carousel-item">
                        <img class="d-block bigImg" src="{{asset("/images/items/big/".$photo->name)}}" alt="Second slide">
                      </div>
@endforeach
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div></div></div>
                 @else
                 <div class="imgHead"> <img class="bigImg" src="{{asset("/images/icons/Default.jpg")}}" alt=""> </div>
                 @endif
                
            </div>
    <div class="info">
    <p class="pName  text-white">{{$item->name}}</p>
<p class="justify-content-right text-white">Gamintojas: <span style="color:red;">{{$item->manufacturer}}</span></p>
<div class="veiksmai">
<p class="justify-content-center text-white">Likutis: {{$item->quantity}} 🚚</p>
@if ($item->discount > 0)
<p class="justify-content-center text-white">Kaina:   <span class="akcija"> {{$item->price}}€</span>   <span style="font-size:30px;">{{$item->discountPrice()}} €<span></p>
@else
<p class="justify-content-center text-white">Kaina: {{$item->price}} €</p>
@endif
<a class="btn btn-danger {{($item->quantity == 0) ? "disabled-none" : ""}}" href="">Pirkti</a>
<p class='justify-content-center text-white'>{{($item->quantity == 0) ? "Atsiprasome šios prekes nebeturime 🚚" : ""}}</p>
@if(Auth::user()->isAdmin())
<p>
<form action="{{route('item.softDelete', $item)}}" method="post">
  @csrf
  @if ($item->status == 10)
  <button class="btn btn-secondary" type="submit" name="softDelete" value="1">Nerodyti Prekes</button>
  @else 
  <button class="btn btn-warning" type="submit" name="softDelete" value="0">Rodyti Preke</button>
@endif
</form>
</p>
@endif
    </div>
    </div>
</div>
<div class="Aprasymas">
    <p class=" app text-white justify-content-center">Aprasymas</p>
    <p class="text-white" style="font-size:16px;"><span style="font-weight: 900;">{{$item->name}}</span> - {{$item->description}}</p>
    <p class=" para text-white justify-content-center">Parametrai</p>
    <div class="parametrai">
    @foreach ($item->parameters as $param)
    <div class="parametrai1  text-white"><p>{{$param->title}}:</p></div>
    <div class="parametrai2  text-white"><p>{{$param->pivot->data}} {{$param->data_type}}</p></div>
   
@endforeach

</div>
</div>
</div>

@endsection