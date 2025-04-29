"use strict";
const userPwdInput = document.querySelector(".user-password");
const checkPwd = document.querySelector(".check-pwd");

function showPwd() {
    if(userPwdInput.type == "password") { 
        userPwdInput.type = "text";
    }else {
        userPwdInput.type = "password";
    }
}
