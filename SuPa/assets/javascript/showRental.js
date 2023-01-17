document.addEventListener('DOMContentLoaded', function () {

    let objectBoxes = document.getElementsByClassName("objectBox");
    let row = document.getElementsByClassName("row")[0];

    while (row.children.length > 6){
        row.lastElementChild.remove();
    }


    let input = document.createElement("input");
    input.type = "button";
    input.value = "Mehr";
    input.onclick = loadMore;

    let section = document.getElementsByClassName("allObjects")[0];
    section.appendChild(input);




});

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

    let aBuchen = document.createElement("a");
    aBuchen.classList.add("btn");
    aBuchen.textContent = "Buchen";
    objectBoxText.appendChild(aBuchen);

    let aMehr = document.createElement("a");
    aMehr.classList.add("btn");
    aMehr.textContent = "Mehr";
    objectBoxText.appendChild(aMehr);

    row.appendChild(objectBox);

}

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



















