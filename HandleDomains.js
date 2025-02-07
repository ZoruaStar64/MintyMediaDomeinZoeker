let domains = [];
let validExtensions = ["com", "org", "net", "nl", "eu"];

function Display_Domains() {
    let container = document.getElementById("domein_container");
    let selectedDomainsHTML = "";
    for (let i = 0; i < domains.length; i++) {
        selectedDomainsHTML += "<p>" +
            domains[i].name + "." + domains[i].extension +
            "  <form name='delete-domein"+ i +"'><input type='hidden' id='domainName"+ i +"' name='domainName"+ i +"' value='"+ domains[i].name +"'>" +
            "<input type='hidden' id='domainExtension"+ i +"' name='domainExtension"+ i +"' value='"+ domains[i].extension +"'>" +
            "<button type='button' onclick='Remove_Domain(\""+ i +"\")'>Verwijder domein van selectie</button></form> <br>";
    }
    selectedDomainsHTML += "</p>";
    container.innerHTML = selectedDomainsHTML;
}

function Add_Domain() {
    let name = document.getElementById("domein-naam").value;
    let extension = document.getElementById("domein-extensie").value;
    domains.push({"name": name, "extension": extension});
    Display_Domains();
}

function Remove_Domain(id) {
    let domainName = document.getElementById("domainName" + parseInt(id)).value;
    let domainExtension = document.getElementById("domainExtension" + parseInt(id)).value;
    var domainToRemove = 0;
    for (let i = 0; i < domains.length; i++) {
        if (domains[i].name === domainName && domains[i].extension === domainExtension) {
            domainToRemove = i;
        }
    }
    domains.splice(domainToRemove,1);
    Display_Domains();
}