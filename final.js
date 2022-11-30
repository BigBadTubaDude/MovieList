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
  // document.getElementById("G60").addEventListener("click", insertX());
  // document.getElementById("G60").innerHTML = "dfdfd"
  function insertX() {
    document.getElementById("G60").innerHTML = Date();
    console.log("hi")
  }
  let numberOfRows = 15;
  let noteList = [
    'Ab',
    'A',
    'Bb',
    'B',
    'C',
    'Db',
    'D',
    'Eb',
    'E',
    'F',
    'Gb',
    'G'
  ]
  let tempoList = [
    '60',
    '63',
    '66',
    '69',
    '72',
    '76',
    '80',
    '84',
    '88',
    '92',
    '96',
    '100',
    '104',
    '108',
    '112',
    '116',
    '120',
    '126',
    '132',
    '138',
    '144',
    '152',
    '160',
    '168'
  ]
  const chartTableBody = document.getElementById('scaleChartBody')
  console.log(chartTableBody) //table body element
  for (let i = 0; i < numberOfRows; i++) {
    let trTag = document.createElement("tr");
    trTag.setAttribute('id', `row${i + 1}`);
    chartTableBody.append(trTag);
    for (let n = 0; n <= noteList.length; n++) { // for every note,and a blank row on the left, add a td to this row
      let tdTag = document.createElement("td"); //create td
      if (n == 0) { // if leftmost column, add tempo 
        let tempoText = document.createTextNode(`${tempoList[i]}`); //create tempo text node
        tdTag.appendChild(tempoText); //add tempo to td
      }
      trTag.appendChild(tdTag); //add td to row
    }

  }

