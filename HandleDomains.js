let domains = [];
let validExtensions = ["com", "org", "net", "nl", "eu"];
let maxDomains = 10;

Check_Selected_Domains();

function Display_Domains() {
    let container = document.getElementById("domein-container");
    let selectedDomainsHTML = "";
    for (let i = 0; i < domains.length; i++) {
        selectedDomainsHTML += "<p>" +
            domains[i].name + "." + domains[i].extension +
            "  <form name='delete-domein"+ i +"'><input type='hidden' id='domain-name"+ i +"' name='domain-name"+ i +"' value='"+ domains[i].name +"'>" +
            "<input type='hidden' id='domain-extension"+ i +"' name='domain-extension"+ i +"' value='"+ domains[i].extension +"'>" +
            "<button type='button' onclick='Remove_Domain(\""+ i +"\")'>Verwijder domein van selectie</button></form> <br>";
    }
    selectedDomainsHTML += "</p>";
    container.innerHTML = selectedDomainsHTML;
    Set_Select_Form_Value();
    Check_Selected_Domains();
}

function Set_Select_Form_Value() {
    let formValues = document.getElementById("geselecteerde-domeinen");
    formValues.value = JSON.stringify(domains);
}

function Check_Selected_Domains() {
    let searchButton = document.getElementById("domein-zoekknop");
    if (domains.length === 0) {
        searchButton.disabled = true;
    } else if (domains.length > 0) {
        searchButton.disabled = false;
    }
}

function Add_Domain() {
    if (domains.length !== maxDomains && domains.length < maxDomains) {
        let name = document.getElementById("domein-naam").value;
        let extension = document.getElementById("domein-extensie").value;
        domains.push({"name": name, "extension": extension});
    }
    Display_Domains();
}

function Remove_Domain(id) {
    let domainName = document.getElementById("domain-name" + parseInt(id)).value;
    let domainExtension = document.getElementById("domain-extension" + parseInt(id)).value;
    var domainToRemove = 0;
    for (let i = 0; i < domains.length; i++) {
        if (domains[i].name === domainName && domains[i].extension === domainExtension) {
            domainToRemove = i;
        }
    }
    domains.splice(domainToRemove,1);
    Display_Domains();
}