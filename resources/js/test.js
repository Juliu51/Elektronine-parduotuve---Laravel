console.log("sveiki");

function searchas() {
    let HTML = "";
    let searchas = document.querySelector(".searchas");
    
     HTML = `<div class="dropdown" id="searchDropdown">
     <div id="myDropdown" class="dropdown-content show">
     <input type="text" class="paieska" name="serach" placeholder="Pavadinimas.." id="searchBar" autocomplete="off">
     <div" class="line" id="lines"></div>
     <div class="prekiuPaieska">← Prekių paieška</div>
            </div>
          </div>`;
    if (searchas != null) {
        return searchas.innerHTML = HTML;
    } else {
        return "";
    }
}
searchas();

const { default: axios } = require("axios");
let searchDrp = document.getElementById("searchDropdown");
let drpDwn = document.getElementById("lines");
let searchBar = document.getElementById("searchBar");
let houseOfCards = document.getElementById("houseOfCards");

    if (searchBar) {
      
        searchBar.addEventListener('keyup', function (e) {
            let timeout = null;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                axios.post(urlSearchBar,{
                    searchBar : searchBar.value
                })
                .then(function(response){
                    let HTML = '';
                    let counter = 0;
                    for (let i = 0; i < response.data.items.length; i++) {
                        const item = response.data.items[i];
                        HTML += '<a href="' + itemShow.substring(0, itemShow.length - 7) + +item['id'] * 31 + "&" + item['category_id'] + '">'+item["name"]+'</a>';
                        if(++counter == 10){
                            drpDwn.innerHTML = HTML;
                            return;
                        }
                    };
                    drpDwn.innerHTML = HTML;
                });
            }, 700);
        });    
    }
    searchBar.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
         console.log("enterinau");
         axios.post(urlSearchBar,{
            searchBar : searchBar.value
        })
        .then(function(response){
            let HTMLCards ='';
            response.data.items.forEach(item => {
              
                HTMLCards += generateCard(item);
                
            });
            console.log(HTMLCards);
           return houseOfCards.innerHTML = HTMLCards;
        });
        }
    });
document.addEventListener('click', function(event) {
  var isClickInside = searchDrp.contains(event.target);
  drpDwn.classList.remove("dingau");
  if (!isClickInside) {
    drpDwn.classList.add("dingau");
  }
});


function generateCard(item) {
        
    HTML = ``;
           HTML += '<div class="kortele">';
            HTML += ' <a href="'+itemShow.substring(0, itemShow.length - 7)+ +item['id']*31+ "&" +item['category_id']+' ">';
HTML += `   <div class="ispa `;
    if (item['quantity'] !== 0) {
        HTML += `disabled-none "`;
    } else {
        HTML += `"`;
    }
  HTML+=`  > IŠPARDUOTA</div >
            <div class="korteleHead">`;
     if(item['photos'].length > 0){
        HTML+= '<div class="imgHead">         <img class="smallImg" src="' + url + '/items/small/' + item['photos'][0]['name'] + '"> </div>';
     }else{
        HTML += '<div class="imgHead"> <img class="smallImg" src="' + url + '/images/icons/Default.jpg"."> </div>';
      }
    HTML +=   '<p class="d-flex justify-content-center"> ' + item['name']+' </p>';
    HTML += '<p class=" p1">Gamintojas: '+ item['manufacturer']+' </p>';
    HTML +=  '<p class=" p1">Likutis: '+ item['quantity']+' 🚚 ';
          if (item['discount'] > 0) {
            HTML+= ' <span class="floats"> '+ discountPrice(item)+'  €</span>';
          }
    HTML += '</p><p class="d-flex justify-content-center" style="color:white;">Kaina:   <span class=" ';
    if (item['discount'] > 0) {
        HTML += ' akcija "';
    } else {
        HTML += '"';
    }
       HTML += '> '+ item['price']+' </span> €</p>';
        HTML += '<div class=" migtukai align-middle text-center"> <a class="btn btn-danger"';
            HTML += 'href = "" > Pirkti </a> </div>';
        // }
        HTML += '</div>  </a> </div>';
        return HTML;
    }


    function discountPrice(item){
        return round_up(  item['price'] - (item['price'] *  (item['discount'] / 100) ),2  );
    }
     function round_up ( value, precision ) { 
        return 1;
    } 
    
   












    $('.carousel').carousel();
