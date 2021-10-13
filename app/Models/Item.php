<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Item extends Model
{
    use HasFactory;
    public function parameters()
    {
        return $this->belongsToMany(Parameter::class, 'item_parameters')->withPivot('data');
    }
    public function photos()
    {
        
        return $this->hasMany(Photo::class);
        
    }


public function discountPrice() {
    return $this->round_up ($this->price -($this->price * ($this->discount / 100)), 2);
}

public function round_up ($value, $precision) {
    $pow = pow (10, $precision) ;
    return (ceil ($pow * $value) + ceil ($pow * $value - ceil ($pow * $value ))) / $pow;
}

public function cards() {
    $HTML = '';
    if(!Auth::user()->isAdmin()){
    if ($this->status == 0) {
    $HTML.= '<div class="disabled-none">';
     } else {
        $HTML.= '<div class="kortele  '.(($this->quantity == 0)?" disabled " :"").'">';
    }
 } else {
      if ($this->status == 0) {
        $HTML.= '<div class=" kortele disabled">';
        }  else {
            $HTML.= '<div class="kortele '.(($this->quantity == 0)?" disabled " : "").'">';
}
     }


        if(!Auth::user()->isAdmin()){
            $HTML.= '<a class="'.(($this->status == 0)?" avoid-cliks " : "").'" href="'.route('item.show',[$this->id*31, $this->category_id]).'">';
        }else{
            $HTML.= '<a href="'.route('item.show',[$this->id*31, $this->category_id]).'">';
        }

        $HTML.='   <div class="ispa '.(($this->quantity !== 0)?" disabled-none " : "").'"> IŠPARDUOTA</div>
            <div class="korteleHead">';
     if(count($this->photos) > 0){
        $HTML.= '<div class="imgHead">
         <img class="smallImg" src="'.asset("/images/items/small/".$this->photos[0]->name).'" alt=""></div> ';
     }else{
        $HTML.= '<div class="imgHead"> <img class="smallImg" src="'.asset("/images/icons/Default.jpg").'" alt=""> </div>';
      }
      $HTML.= '  <p class="d-flex justify-content-center">'.$this->name.'</p>
         <p class=" p1">Gamintojas: '.$this->manufacturer.'</p>
         <p class=" p1">Likutis: '.$this->quantity.' 🚚 ';
          if ($this->discount > 0) {
            $HTML.=  '<span class="floats">'.$this->discountPrice().' €</span>';
          }
          $HTML.= '</p>
        <p class="d-flex justify-content-center" style="color:white;">Kaina:   <span class=" '.(($this->discount > 0)?" akcija " : "").' "> '.$this->price.'</span> €</p>';
         if(!Auth::user()->isAdmin()){
            $HTML.= '<div class=" migtukai align-middle text-center">
         <a class="btn btn-danger '.(($this->quantity == 0)?" disabled-none " : "").'" href="">Pirkti</a>
         </div>';
         }
         if(Auth::user()->isAdmin()){
            $HTML.= '<div class=" migtukai align-middle text-center">
        <a class="btn btn-primary" href="'.route('item.edit', [$this, $this->category_id]).'">EDIT</a>
        <form style="display: inline-block" method="POST" action="'.route('item.destroy', [$this]).'">
            @csrf
            <button class="btn btn-danger" type="submit">DELETE</button>
          </form>
</div>';
         }
         $HTML.= '</div>
</a>
</div>';
return $HTML;
}
}