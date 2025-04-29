"use strict";
const userPwdInput = document.querySelector(".user-password");
const checkPwd = document.querySelector(".check-pwd");
const input1_1 = document.querySelector(".input1_1");
const sign_up_plus = document.querySelector(".sign-up-plus");
const user_pic_label = document.querySelector(".user-pic");

function showPwd() {
    if(userPwdInput.type == "password") { 
        userPwdInput.type = "text";
    }else {
        userPwdInput.type = "password";
    }
}

user_pic_label.addEventListener("change", () => {
    if(input1_1.value !== "") {
        sign_up_plus.classList.add("hidden");
        input1_1.classList.remove("hidden");
    }
})