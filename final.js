//Coleman Alexander
//Date 11/30/2022

//TMDB API info
//https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
//https://www.themoviedb.org/settings/api
//example fetch
// fetch('https://api.themoviedb.org/3/movie/550?api_key=21787e2365fd54d004173f7a9ec640fa')
//   .then((response) => response.json())
//   .then((data) => console.log(data));

  // fetch('https://api.themoviedb.org/3/movie/550?api_key=21787e2365fd54d004173f7a9ec640fa')
  // .then((response) => response.json())
  // .then((data) => console.log(data));  
  // console.log
  document.getElementById("G60").addEventListener("click", insertX);
  document.getElementById("G60").innerHTML = "dfdfd"
  function insertX() {
    document.getElementById("G60").innerHTML = Date();
    // console.log("hi")
  }