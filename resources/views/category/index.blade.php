@extends('layouts.app')
@section('content')
<div class="container">
<div class="row w-100">
<div class="col-12 col-lg-3">
@if(Auth::user()->isAdmin())
<div class="panel">
        <div class="">
            <div class="card-header admin_head shadow bg-body ">
                Admino panelė
            </div>
            <div class="card-body admin_body">
                @if ((count($chain) > 0))
                <div class="kategorija">
                <a  class="kategorija" href="{{route('item.create',[ $chain[count($chain)-1] ] )}}">Įdėti prekę į "{{$chain[count($chain)-1]->name}}" kategoriją</a>
                </div>
                <?php $category = $chain[count($chain) - 1]?>
               @else
               <?php $category = 0?>
                @endif
                <div class="kategorija">
                <a class="kategorija" href="{{route('category.create',[$category] )}}">Sukurti kategorija siame gylije</a>
             </div>
             </div>
         </div>
</div>
@endif
      <div class="findCategory">
        <table class="table table-striped">
            <tbody>
              <td class="CategoryAll"><a class="CategoryAlltext" href="{{route('category.index')}}">Visos Kategorijos</a></td>
            @foreach ($categories as $category)
            <tr class="CategoryNameH">
              <td > <a class="CategoryName" href="{{route('category.map',$category)}}"> {{$category->name}}</a></td>
              @if(Auth::user()->isAdmin())
              <td class="align-middle text-center">
                <a class="btn btn-primary" href="{{route('category.edit',[$category])}}">EDIT</a>
                <form style="display: inline-block" method="POST" action="{{route('category.destroy', $category)}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">DELETE</button>
                  </form>
              </td>
              @endif
            </tr>
            @endforeach
            </tbody>
          </table> 
    </div>
  </div>
<div class="col-12 col-lg-9">
@if (count($chain)== 0)
<div class="Perkamiausios">
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="../public/images/front/n1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../public/images/front/n2.jpg." alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../public/images/front/n3.jpg" alt="Third slide">
      </div>
    </div>
  </div>
</div>
@else
<div class="Perkamiausios">
  <div class="headas">
            <h1 class="CatUniqName">{{(count($chain) > 0)?$chain[count($chain)-1]->name :""}}</h1>
        </div>
        <div class="chainHead">
            @if (count($chain)== 0)
                Prekės
            @endif
             @foreach ($chain as $item)
             @if(next($chain))
                  <a class="chain" href="{{route('category.map',$item)}}"> {{$item->name}} ></a>
                 @else
                  <a class="chain chain-last" href="{{route('category.map',$item)}}"> {{$item->name}} </a>
                 @endif
             @endforeach
         </div>
<div class="korteles">
  @if (isset($item))
  @foreach ($items as $item)
            @if(!Auth::user()->isAdmin())
            <div  @if ($item->status == 0) 
              class="disabled-none">
              @else
              class="kortele {{($item->quantity == 0) ? " disabled" : ""}}">
              @endif
              @else
              <div  @if ($item->status == 0) 
                class=" kortele disabled">
                @else
                class="kortele {{($item->quantity == 0) ? " disabled" : ""}}">
                @endif
                @endif
                @if(!Auth::user()->isAdmin())
                <a class="{{($item->status == 0) ? "avoid-cliks" : ""}}" href="{{route('item.show',[$item->id*31, $chain[count($chain)-1]])}}">
                  @else
                  <a href="{{route('item.show',[$item->id*31, $chain[count($chain)-1]])}}"> 
                    @endif
                    <div class="ispa {{($item->quantity !== 0) ? " disabled-none" : ""}}"> IŠPARDUOTA</div>
                    <div class="korteleHead">
             @if(count($item->photos) > 0)
               <div class="imgHead">
                 <img class="smallImg" src="{{asset("/images/items/small/".$item->photos[0]->name)}}" alt=""></div>
                 @else
                 <div class="imgHead"> <img class="smallImg" src="{{asset("/images/icons/Default.jpg")}}" alt=""> </div>
                 @endif
                 <p class="d-flex justify-content-center">{{$item->name}}</p>
                 <p class=" p1">Gamintojas: {{$item->manufacturer}}</p>
                 <p class=" p1">Likutis: {{$item->quantity}} 🚚 
                  @if ($item->discount > 0) 
                  <span class="floats">{{$item->discountPrice()}} €</span>
                @endif
              </p>
                <p class="d-flex justify-content-center" style="color:white;">Kaina:   <span class=" {{($item->discount > 0) ? " akcija" : ""}} "> {{$item->price}}</span> €</p>
                 @if(!Auth::user()->isAdmin())
                 <div class=" migtukai align-middle text-center">
                 <a class="btn btn-danger {{($item->quantity == 0) ? "disabled-none" : ""}}" href="">Pirkti</a>
                 </div>
                 @endif
                 @if(Auth::user()->isAdmin())
              <div class=" migtukai align-middle text-center">
                <a class="btn btn-primary" href="{{route('item.edit',[$item,$chain[count($chain)-1]])}}">EDIT</a>
                <form style="display: inline-block" method="POST" action="{{route('item.destroy', [$item])}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">DELETE</button>
                  </form>
      </div>
          @endif

          </div>
</div>
            @endforeach
</div>
</div>

        @endif
        @endif
       
</div>
</a>
</div>
@endsection