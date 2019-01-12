var pElt = "";
var bodyElt = "";

bodyElt = document.getElementById('uniqueNews');
pElt = document.getElementById('message');

if (pElt.title === "no") {
  pElt.style.color = "red";
  pElt.style.fontSize = "2em";
  pElt.style.textAlign = "center";
} else if (pElt.title === "ok") { 
  pElt.style.color = "green";
  pElt.style.fontSize = "2em";
  pElt.style.textAlign = "center";
} else if (pElt.title === "valide") {
  pElt.style.color = "white";
  pElt.style.fontSize = "2em";
  pElt.style.textAlign = "center";
} else if (pElt.title === "info") {
  pElt.style.color = "white";
  pElt.style.fontSize = "1.2em";
  pElt.style.textAlign = "center";
} else if (pElt.title === "noConnect") {
  pElt.style.color = "red";
} else {
  console.log(pElt.title);
}


