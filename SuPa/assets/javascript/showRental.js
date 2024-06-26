/***
 * Author Hendrik Lendeckel
 * deleting all Rentals except the first 6 (in case JS is aktiv)
 */
document.addEventListener('DOMContentLoaded', function () {

    let row = document.getElementsByClassName("row")[0];

    while (row.children.length > 6){
        row.lastElementChild.remove();
    }

    // adding Button
    let input = document.createElement("input");
    input.type = "button";
    input.value = "Mehr";

    // calling the function load more to print the next 6 Rentals
    input.onclick = loadMore;

    let section = document.getElementsByClassName("allObjects")[0];
    section.appendChild(input);




});


/***
 * Author Hendrik Lendeckel
 * prints a new Rental
 * @param data
 */
function addObjectBox(data){

    let row = document.getElementsByClassName("row")[0];

    let objectBox = document.createElement("div");
    objectBox.classList.add("objectBox");

    let img = document.createElement("img");
    img.src = data["Path"];
    img.alt = data["Path"];

    objectBox.appendChild(img);

    let objectBoxText = document.createElement("div");
    objectBoxText.classList.add("objectBoxText");

    objectBox.appendChild(objectBoxText);

    let h2 = document.createElement("h2");
    h2.textContent = data["Type"];

    objectBoxText.appendChild(h2);

    let table = document.createElement("table");
    objectBoxText.appendChild(table);

    let tbody = document.createElement("tbody");
    table.appendChild(tbody);

    let column1 = ["Schlafzimmer:", "Bäder:", "Küchen:", "Max. Gäste:", "Quadratmeter:"];
    let column2 = ["Bedroom", "Bathroom", "Kitchen", "MaxVisitor", "SqrMeter"];

    for (let i = 0; i < 5; i++) {
        let tr = document.createElement("tr");
        tbody.appendChild(tr);
        let td = document.createElement("td");
        tr.appendChild(td);
        td.textContent = column1[i];
        let td2 = document.createElement("td");
        tr.appendChild(td2);
        td2.textContent = data[column2[i]];
    }

    let tr = document.createElement("tr");
    tbody.appendChild(tr);
    let td = document.createElement("td");
    td.textContent = data["OutdoorSeating"];
    tr.appendChild(td);

    let aBuchen = document.createElement("input");
    aBuchen.type = "button";
    aBuchen.textContent = "Buchen";
    aBuchen.value="BUCHEN"
    objectBoxText.appendChild(aBuchen);

    let aMehr = document.createElement("input");
    aMehr.type = "button";
    aMehr.textContent = "Mehr";
    aMehr.value ="MEHR";
    objectBoxText.appendChild(aMehr);

    row.appendChild(objectBox);

}


/***
 * Author Hendrik Lendeckel
 * loading the next 6 Rentals
 */
function loadMore(){

    let formData = new FormData();
    let row = document.getElementsByClassName("row")[0];
    formData.append("rentalCount", row.children.length.toString());


    fetch("index.php?page=rental&logic=showMoreRentals", {method:"POST", body:formData})
        .then((response) => response.json())
        .then((data) => {
            for (const json of data){
                addObjectBox(json);
            }
        } );

}



















