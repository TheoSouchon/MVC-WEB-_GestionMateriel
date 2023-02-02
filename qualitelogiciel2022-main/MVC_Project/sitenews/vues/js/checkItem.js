
let name;
let version;
let reference;
let brand;
let type;
let phoneNumber;

window.addEventListener('load', () => {
    name = document.getElementById("name");
    version = document.getElementById("version");
    reference = document.getElementById("ref");
    brand = document.getElementById("brand");
    type = document.getElementById("type");
    phoneNumber = document.getElementById("phoneNumber");
});
function check() {

    if (name.value != "" &&
        version.value != "" &&
        reference.value != "" &&
        brand.value != "" &&
        type.value != "") {

        var reg=/^[a-zàäâéèêëïîöôùüû\s]*$/i

        // le nom contient des caractères spéciaux
        if (!reg.test(name.value)) {
            alert("Le nom contient des caractères spéciaux");
            return false;
        }

        // Le nom est > 30 caractères
        if (name.value.length > 30) {
            alert("Nom invalide (le nombre de caractères est trop grand)");
            return false;
        }

        // le type contient des caractères spéciaux
        if (!reg.test(type.value)) {
            alert("Le type contient des caractères spéciaux");
            return false;
        }

        // le type est > 30 caractères
        if (type.value.length > 30) {
            alert("Type invalide (le nombre de caractères est trop grand)");
            return false;
        }

        // la marque contient des caractères spéciaux
        if (!reg.test(brand.value)) {
            alert("La marque contient des caractères spéciaux");
            return false;
        }

        // la marque est > 30 caractères
        if (brand.value.length > 30) {
            alert("Marque invalide (le nombre de caractères est trop grand)");
            return false;
        }

        // la version a moins de 3 caractères
        if (version.value.length < 3) {
            alert("Version invalide, elle doit contenit au moins 3 caractères");
            return false;
        }

        // la version contient des caractères spéciaux
        if (!reg.test(version.value)) {
            alert("La version contient des caractères spéciaux");
            return false;
        }


        // la version contient plus de 15 caractères
        if (version.value.length > 15) {
            alert("Version invalide (le nombre de caractères est trop grand)");
            return false;
        }

        // Le numéro de téléphone ne fait pas 10 caractères
        console.log(phoneNumber.value);
        console.log(phoneNumber.value.length);
        if (phoneNumber.value.length != 10 && phoneNumber.value.length != 0) {
            alert("Numéro de téléphone invalide");
            return false;
        }

        return true;
    } else {
        alert ("Veuillez remplir les champs Nom, Version, Reference et Marque");
        return false;
    }
}
