console.log("sveiki");
// }

const { default: axios } = require("axios");

// console.log(window.location.href.includes("map")," vaikstau po kategorijas");
// console.log(window.location.href.includes("show")," esu prekeje");

if(document.getElementById("searchBar")){

    searchBar.addEventListener('keyup',sbr );

}
function sbr() {


    let input = document.getElementById('searchBar');
    let timeout = null;

    searchBar.addEventListener('keyup', function (e) {

        clearTimeout(timeout);
        timeout = setTimeout(function () {
            console.log('Value:', searchBar.value);
            let txt = searchBar.value;
            axios.post(urlSearchBar,{
                searchBar : searchBar.value
            })
            .then(function(response){
                console.log(response.data.items);
                let drpDwn = document.getElementById("myDropdown");
                let HTML ='<input type="text" placeholder="Search.." id="searchBar">';
                response.data.items.forEach(item => {
                    HTML += ' <a href="#">'+item["name"]+'</a>';
                });
                drpDwn.innerHTML = HTML;
                document.getElementById('searchBar').value = txt;
                document.getElementById('searchBar').focus();
                sbr();
            });

            // console.log('Value:', searchBar.value);
        }, 700);
    });
}


document.getElementById('myDropdown').addEventListener('focusout',function(){
    document.getElementById("myDropdown").innerHTML = '<input type="text" placeholder="Search.." id="searchBar">';
});

document.getElementById('myDropdown').addEventListener('mouseout',function(){
    document.getElementById("myDropdown").innerHTML = '<input type="text" placeholder="Search.." id="searchBar">';
    //jeigu pele x/y ne ant inputo IR ne ant kazkurio childElement, tik tada isvalyti
});

$('.carousel').carousel()