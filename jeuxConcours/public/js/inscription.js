const form = document.querySelector('form');
const emailInput = document.querySelector('[name="email"]');
const emailLabel = document.getElementById("emailLabel");
const divFormulaire = document.getElementById('formulaire');
const allConfirmation = document.querySelectorAll('.confirmation');
const listeAdresse = document.getElementById("listeAdresse");
const adresse = document.querySelector('[name="adresse"]');
const ville = document.querySelector('[name="ville"]');
const code_postal = document.querySelector('[name="code_postal"]');
const valider = document.getElementById("valider");
const modifier = document.getElementById("modifier");
var confirmation = false
var timeout = null;


function check() {
    form.reportValidity();
    emailInput.setCustomValidity("");
    if (form.checkValidity()) {
        request(`${href}?checkMail=${emailInput.value}`).then((response) => {
            console.log(response);
            response = JSON.parse(response);
            if (response) {
                emailInput.setCustomValidity("cette adresse email est déja enregistré. Veuillez en saisir une nouvelle");
                emailLabel.removeAttribute("hidden");
            } else {
                emailLabel.setAttribute("hidden", "");
            }
            form.reportValidity();
            if (form.checkValidity()) {
                show();
            }
        })
    }

}

function show() {
    if (!confirmation) {
        let formData = Object.fromEntries(new FormData(form));
        for (const [key, value] of Object.entries(formData)) {
            if (value)
                document.getElementById(key).innerHTML = value;
        }
    }
    allConfirmation.forEach(element => {
        element.style.display = confirmation ? "none" : "block";
    });
    divFormulaire.style.display = confirmation ? "block" : "none";
    confirmation = !confirmation;
}

function searchAdresse() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const url = `https://api-adresse.data.gouv.fr/search/?q=${adresse.value}&limit=5&autocomplete=1`;
        request(url).then((response) => {
            listeAdresse.innerHTML = "";
            JSON.parse(response).features.forEach(element => {
                element = element.properties;
                listeAdresse.innerHTML += `<p class="marginLeft" onclick="complete(this)" adresse="${element.name}" ville="${element.city}" code="${element.postcode}">${element.label}</p>`
            });
        })
    }, 500);
}

function complete(element) {
    adresse.value = element.getAttribute("adresse")
    ville.value = element.getAttribute("ville")
    code_postal.value = element.getAttribute("code")
    listeAdresse.style.display = "none";
}

function hiddenListe() {
    setTimeout(() => {
        listeAdresse.style.display = "none";
    }, 100)
}

function showListe() {
    listeAdresse.style.display = "block";
}

valider.addEventListener('click', check);
modifier.addEventListener('click', show);
adresse.addEventListener('input', searchAdresse);
adresse.addEventListener('blur', hiddenListe);
adresse.addEventListener('focus', showListe);