//Coleman Alexander
//Date 11/30/2022


  function makeScaleChart(scaleType) { //scaleType should be minor or major
  const chartTableBody = document.getElementById('scaleChartBody')
  // console.log(chartTableBody) //table body element
  for (let r = 0; r < numberOfRows; r++) {
    let trTag = document.createElement("tr");
    trTag.setAttribute('id', `row${r + 1}`);
    chartTableBody.append(trTag);
    for (let n = 0; n <= noteList.length; n++) { // for every note,and a blank row on the left, add a td to this row
      let tdTag = document.createElement("td"); //create td
      if (n == 0) { // if leftmost column, add tempo 
        let tempoText = document.createTextNode(`${tempoList[r]}`); //create tempo text node
        tdTag.appendChild(tempoText); //add tempo to td
      } else {
        let checkText = document.createTextNode(`${currentScaleType == 'major'
          ? userMajorScaleArray[noteList[n - 1]][n - 1]
          : userMinorScaleArray[noteList[n - 1]][n - 1]}`); //create check text node
          // console.log(userMajorScaleArray[noteList[n - 1]][n - 1]);
        tdTag.appendChild(checkText); //add X or blank to td depending on if user has checked it
        let cellID = `${tempoList[r]}-${r}-${noteList[n - 1]}`;

          
        tdTag.setAttribute('id',`${cellID}`)
        tdTag.setAttribute('onclick', `insertX('${cellID}')`)
        //php will have IF statement. if this part of global 2D array is set to true, echo an X
        tdTag.setAttribute('class', 'tg-0lax')
      }
      trTag.appendChild(tdTag); //add td to row
    }
  }
}

  makeScaleChart(currentScaleType);
  //Click changes boxes
  // document.getElementById("66-F").addEventListener("click", insertX);
  // document.getElementById("60-G").innerHTML = "dfdfd";
  function insertX(id) {
    //change userscale arrays based on click
    let tdCell = document.getElementById(id);
    let note = id.substring(id.indexOf('-', id.indexOf('-') + 1) + 1);
    let index = id.substring(id.indexOf('-') + 1, id.indexOf('-', id.indexOf('-',id.indexOf('-') + 1)));
    let tempo = id.substring(0, id.indexOf('-'));
    let available = 
    index == 0 
    || 
    userMajorScaleArray[note][index - 1] == 'X';

    if (tdCell.textContent.includes(' ')) {
      if (available) {
        tdCell.innerHTML = 'X';
        userMajorScaleArray[note][index] = 'X';
      }
    }
    else {
      tdCell.innerHTML = ' ';
      userMajorScaleArray[note][index] = ' ';
    }
    console.log(userMajorScaleArray);
  }
  

  