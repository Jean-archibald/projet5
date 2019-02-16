var bodyElt = "";

bodyElt = document.getElementById('uniqueNews');

if (bodyElt.title === "medecinegenerale") {
  bodyElt.style.backgroundColor = "#007bff";
} else if (bodyElt.title === "nutrition") {
  bodyElt.style.backgroundColor = "#ffc107";
} else if (bodyElt.title === "allergologie") {
  bodyElt.style.backgroundColor = "#28a745";
} else if (bodyElt.title === "divers") {
  bodyElt.style.backgroundColor = "#dc3545";
} 