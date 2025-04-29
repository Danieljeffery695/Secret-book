"use strict";

const logBtn = document.querySelector(".log-btn-2");

logBtn.addEventListener("click", () => {
    const timesubmit = setInterval(() => {        
        window.open("../sign_up_folder/sign_in.php", "_self");
        window.close();
        clearInterval(timesubmit);
    }, 2000);
})