const [ADDBUTTON, LOGO_INPUT, FILE, CLOSEMODAL, SAVE_OP, FORM_OP, INSCRIPTION, TITREVISUEL, DESCVISUEL, MODAL, NOM, DATE_DEBUT, DATE_FIN, DATE_TIRAGE, KEY] = getElId(document, "add", "logo_input", "file", "closeModal", "enregOperation", "formOperation", "inscription", "titre", "description", "modal", "nom", "date_debut", "date_fin", "date_tirage", "key");
const [INPUTDATE, EDITVISUEL] = getElSelectAll(document, "input[type='date']", ".edit");
const [fileImg, FILE_LABEL, FILEINPUT] = getElSelect(document, ".file img", ".file label", ".file input");


//Request

async function getInscription() {
    const req = new Request("http://localhost:8002?formOnly=true");
    return await req.get();
}



//general

function clearInscription() {
    clearValue(NOM, DATE_DEBUT, DATE_FIN, DATE_TIRAGE, TITREVISUEL, DESCVISUEL)
    changeType("text", DATE_DEBUT, DATE_FIN, DATE_TIRAGE)
    fileImg.src = "";
    INSCRIPTION.querySelector(".logo img").src = "";
    INSCRIPTION.querySelector(".logo img").alt = "Image/Logo : A personnaliser";
    INSCRIPTION.querySelector('.logo p').innerHTML = "Titre : A personnaliser";
    INSCRIPTION.querySelector('.fc3').innerHTML = "Description : A personnaliser";
    FILE_LABEL.classList.add("label_Image");
    KEY.value = "";
}

function showModal() {
    show(MODAL);
}

function closeModal() {
    close(MODAL);
}


// Action of Event

function editerVisuelConcours(target) {
    clearInscription()
    const [LOGO_NAME, LOGO, TITRE, DESC, KEY_VALUE] = getAttr(target, "logo_name", "logo", "titre", "description", "key")

    const TR = target.parentElement.parentElement;

    NOM.value = TR.querySelector(".tdnom").innerHTML
    DATE_DEBUT.value = convertDate(TR.querySelector(".tddate_debut").innerHTML)
    DATE_FIN.value = convertDate(TR.querySelector(".tddate_fin").innerHTML)
    DATE_TIRAGE.value = convertDate(TR.querySelector(".tddate_tirage").innerHTML)



    changeType("date", DATE_DEBUT, DATE_FIN, DATE_TIRAGE)

    FILE_LABEL.classList.remove("label_Image");

    LOGO_INPUT.value = LOGO_NAME;
    fileImg.src = LOGO;
    TITREVISUEL.value = TITRE;
    DESCVISUEL.value = DESC;
    KEY.value = KEY_VALUE;

    INSCRIPTION.querySelector(".logo img").src = LOGO;
    INSCRIPTION.querySelector('.logo p').innerHTML = TITRE;
    INSCRIPTION.querySelector('.fc3').innerHTML = DESC;
    showModal();
}

function addOperation() {
    clearInscription()
    showModal()
}

function editTitle(value) {
    INSCRIPTION.querySelector('.logo p').innerHTML = value
}

function editDescription(value) {
    INSCRIPTION.querySelector('.fc3').innerHTML = value
}

function image_active() {
    changeClass(FILE_LABEL, "label_Image", "label_Image_active");
    fileImg.classList.add("image_active");
}

function image_unactive() {
    if (fileImg.src === href) {
        FILE_LABEL.classList.add("label_Image");
    }
    FILE_LABEL.classList.remove("label_Image_active");
    fileImg.classList.remove("image_active");
}

function unfocusFileSelect() {
    setTimeout(function() {
        image_unactive();
        document.body.onfocus = null
    }, 200)
}

function ChangeFIle() {
    let file = FILEINPUT.files[0];
    if (file) {
        var fReader = new FileReader();
        fReader.readAsDataURL(file);
        fReader.onloadend = function(event) {
            fileImg.src = event.target.result;
            INSCRIPTION.querySelector(".logo img").src = event.target.result;
            FILE_LABEL.classList.remove("label_Image", "label_Image_active");
            fileImg.classList.remove("image_active");
        }
    }
}

function SelectFile() {
    image_active();
    FILEINPUT.click()
    document.body.onfocus = unfocusFileSelect
}

function Drop(event) {
    preventDefault(event);
    FILEINPUT.files = event.dataTransfer.files
    ChangeFIle();
}

function DragOver(event) {
    preventDefault(event);
    image_active();
}

function DragLeave(event) {
    preventDefault(event);
    image_unactive();

}

//Event / Command

ADDBUTTON.onclick = () => { addOperation() }

EDITVISUEL.forEach(element => {
    element.onclick = (event) => { editerVisuelConcours(event.target); }
})

INPUTDATE.forEach(element => {
    element.type = "text"
    element.onfocus = (event) => {
        event.target.type = "date"
    }
    element.onblur = (event) => {
        if (!event.target.value) {
            event.target.type = 'text'

        }
    }
})

//Set button editVisuel on row and Set command on Modal Window for visuel


TITREVISUEL.oninput = (event) => { editTitle(event.target.value) }

DESCVISUEL.oninput = (event) => { editDescription(event.target.value) }

FILE.onclick = (event) => {
    if (event.target !== this)
        SelectFile()
}
FILE.ondrop = (event) => { Drop(event) };
FILE.ondragover = (event) => { DragOver(event) }
FILE.ondragleave = (event) => { DragLeave(event) }


FILEINPUT.onchange = (event) => { ChangeFIle() }


CLOSEMODAL.onclick = () => { closeModal(); }


// SAVE_OP.onclick = async(e) => {
//     e.preventDefault();
//     var formData = new FormData(FORM_OP);
//     console.log(await sendOperation(formData));
// }

getInscription().then((result) => INSCRIPTION.innerHTML = result)