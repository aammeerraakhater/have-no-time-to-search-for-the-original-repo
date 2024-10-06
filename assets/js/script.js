function changeStatus(elementID, id, status) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(elementID).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&serviceStatus=" + status, true);
    xmlhttp.send();
}
function changeNotes(id, note) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("note").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&Notes=" + note, true);
    xmlhttp.send();
}
function changetechnician(elementID, id, technician) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(elementID).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&technician=" + technician, true);
    xmlhttp.send();
}
function confirmOrder(elementID, id, state) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(elementID).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?orderID=" + id + "&state=" + state, true);
    xmlhttp.send();

}
function addAlternitave(city, id, showedEleID, showedEleName) {
    var element = document.getElementById(id);
    if (city == 'أخرى') {
        element.classList.remove("hidden");
        document.getElementById(showedEleID).name = showedEleName;
        document.getElementById(showedEleID).required = true;
    } else {
        element.classList.add("hidden");
        document.getElementById(showedEleID).name = '';
        document.getElementById(showedEleID).required = false;

    }
}
function viewWorkerThings(workerType, id1, id2, showedEleID1, showedEleID2) {
    var element1 = document.getElementById(id1);
    var element2 = document.getElementById(id2);
    if (workerType =='1' || workerType=='2'|| workerType=='4') {
        element1.classList.remove("hidden");
        element2.classList.remove("hidden");
        document.getElementById(showedEleID1).required = true;
        document.getElementById(showedEleID2).required = true;
    } else {
        element1.classList.add("hidden");
        element2.classList.add("hidden");
        document.getElementById(showedEleID1).required = false;
        document.getElementById(showedEleID2).required = false;
    }
}
// function shareXlsx(q) {
//     var xmldownloadrequest = new XMLHttpRequest();
//     xmldownloadrequest.open("GET", "saveXlsx.php?q=" + q, true);
//     xmldownloadrequest.send();
// }
function capture() {
    const captureElement = document.querySelector('#capture') // Select the element you want to capture. Select the <body> element to capture full page.
    html2canvas(captureElement)
        .then(canvas => {
            canvas.style.display = 'none'
            document.body.appendChild(canvas)
            return canvas
        })
        .then(canvas => {
            const image = canvas.toDataURL('image/png')
            const a = document.createElement('a')
            a.setAttribute('download', 'my-image.png')
            a.setAttribute('href', image)
            a.click()
            canvas.remove()
        })
}

$(function () {
    $("span.pw-toggle, span.pw-toggle2").click(function () {
        var $pwField = $($(this).data().target);
        var TorP = $pwField.attr('type') == 'password' ? 'text' : 'password';
        $(this).text(TorP === "password" ? "visibility" : "visibility_off")
        $pwField.attr('type', TorP);
    });
});
