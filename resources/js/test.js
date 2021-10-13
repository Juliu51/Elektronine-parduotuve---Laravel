console.log("sveiki");// if (document.getElementById("showItem")) {
    //     console.log("sveiki");
    // }
function searchas() {
    let HTML = "";
    let searchas = document.querySelector(".searchas");
    
     HTML = `<div class="dropdown">
     <div id="myDropdown" class="dropdown-content show">
     <input type="text" class="paieska" name="serach" placeholder="Pavadinimas.." id="searchBar" autocomplete="off">
     <div" class="line" id="lines"></div>
     <div class="prekiuPaieska">← Prekių paieška</div>
            </div>
          </div>`;
    return searchas.innerHTML = HTML;
}
searchas();

    const { default: axios } = require("axios");
    let drpDwn = document.getElementById("lines");
    let searchBar = document.getElementById("searchBar");

    if (searchBar) {
        
        searchBar.addEventListener('keyup', function (e) {
            let timeout = null;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                let txt = searchBar.value;
                axios.post(urlSearchBar,{
                    searchBar : searchBar.value
                })
                .then(function(response){
                   
                    let HTML ='';
                    response.data.items.forEach(item => {
                        HTML += '<a href="'+itemShow.substring(0, itemShow.length - 7)+ +item['id']*31+ "&" +item['category_id']+'">'+item["name"]+'</a>';
                    });
                    drpDwn.innerHTML = HTML;                    
                });
            }, 700);
        });
    }
 
$('.carousel').carousel()
