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
