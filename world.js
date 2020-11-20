window.onload = function (){
    const lookup = document.getElementById('lookup');
    const city = document.getElementById('city-lookup')
    const searchBar = document.getElementById('country');
    const result= document.getElementById('result');
    // Do City search
    city.addEventListener('click', function(){
            countrySearch(true, searchBar, result);
    });
    // Do normal search
    lookup.addEventListener('click', function(){
        countrySearch(false, searchBar, result);
    });
}

async function countrySearch(cityBool, searchBar, result){
    let data = await fetchData(searchBar.value, cityBool);
    result.innerHTML = data;
}

function getURL(data, cityBool){
    let url = ''
    if (cityBool === false){
        url = 'world.php?country=' + data + '&context=';
    }else{
        url = 'world.php?country=' + data + '&context=cities';
    }
    return url;
}
async function fetchData(data, cityBool){
    const url = await getURL(data, cityBool);
    const response = await fetch(url);
    return response.text();
}  