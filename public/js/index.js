"use strict";
function generatePassword() {
    const length = 10;
    const charset =
        "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let password = "";
    for (let i = 0, n = charset.length; i < length; i++) {
        password += charset.charAt(Math.floor(Math.random() * n));
    }
    return password;
}

function changeOption(value) {
    let select = document.getElementById("expiry");
    let opts = select.options;
    for (let opt, i = 0; (opt = opts[i]); i++) {
        if (opt.value == value) {
            select.selectedIndex = i;
            break;
        }
    }
}

function checkEmpty(textArea) {
    if (textArea.value.trim() == "") {
        return false;
    }
    return true;
}

function validate() {
    let sumbitButton = document.getElementById("paste__submit");
    let textArea = document.getElementById("paste-text");
    let res = checkEmpty(textArea);
    if (res === true) {
        textArea.style.borderColor = "yellowgreen";
        textArea.style.boxShadow = "0 0 0 0.15rem yellowgreen";
        sumbitButton.removeAttribute("disabled");
    } else {
        textArea.style.borderColor = "red";
        textArea.style.boxShadow = "0 0 0 0.15rem red";
        sumbitButton.setAttribute("disabled", "");
    }
}

// function validate() {
//     let textArea = document.getElementById("paste-text");
//     if (textArea.value.trim() == "") {
//         textArea.focus();
//         textArea.style.boxShadow = "0 0 0 0.15rem red";
//         textArea.style.borderColor = "red";
//     } else {
//         alert("empty");
//     }
// }

function uncheck() {
    let selected = document.getElementById("expiry");
    if (selected.value != "bar") {
        let cb = document.getElementById("burn-after-read");
        cb.checked = false;
    } else {
        cb.checked = true;
    }
}

// function populateList() {
//     const optionsList = [
//         "Burn after read",
//         "10 Minutes",
//         "1 Hour",
//         "1 Day",
//         "1 Week",
//         "2 Weeks",
//         "1 Month",
//         "6 Months",
//         "1 Year",
//     ];
//     const select = document.querySelector(".dropdown-menu");

//     for (let i = 0; i < optionsList.length; i++) {
//         let option = optionsList[i];
//         let el = document.createElement("li");
//         el.innerHTML = `<button class="dropdown-item" type="button">${option}</button>`;
//         el.value = option;
//         select.appendChild(el);
//     }
// }
// populateList();
