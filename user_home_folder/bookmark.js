"use strict";
const settingDiv = document.querySelector(".setting-div");
const settingDiv_1 = document.querySelector(".setting-div__1");
const settingNav = document.querySelector(".setting-div-nav");
const helpDiv_1 = document.querySelector(".help-div__1");
const helpDiv = document.querySelector(".help-div");
const helpNav = document.querySelector(".help-div-nav");
const otherDiv_1 = document.querySelector(".other-div__1");
const otherDiv = document.querySelector(".other-div")
const otherNav = document.querySelector(".other-div-nav");
const upSign = document.querySelector(".up-sign-1")
const upSign_1 = document.querySelector(".up-sign-2")
const upSign_2 = document.querySelector(".up-sign-3")
const leftSign = document.querySelector(".left-sign-1");
const leftSign_1 = document.querySelector(".left-sign-2");
const leftSign_2 = document.querySelector(".left-sign-3");
const backToHome = document.querySelector(".back-to-home");

backToHome.addEventListener("click", () => {
    window.history.back();
})

settingNav.addEventListener("click", (e) => {
    e.preventDefault();
    if(settingDiv_1.classList.contains("setting-div") == true) {
        settingDiv_1.classList.remove("setting-div");
        settingDiv_1.classList.add("dropdown");
        upSign.classList.add("hidden");
        leftSign.classList.remove("hidden");
    } else if(settingDiv_1.classList.contains("setting-div") == false) {
        settingDiv_1.classList.add("setting-div");
        settingDiv_1.classList.remove("dropdown");
        upSign.classList.remove("hidden");
        leftSign.classList.add("hidden");
    } else {
        console.log("hello world again");
    }
});

helpDiv.addEventListener("click", (e) => {
    e.preventDefault();
    if(helpDiv_1.classList.contains("help-div") == true) {
        helpDiv_1.classList.remove("help-div");
        helpDiv_1.classList.add("dropdown");
        upSign_1.classList.add("hidden");
        leftSign_1.classList.remove("hidden");
    } else if(helpDiv_1.classList.contains("help-div") == false) {
        helpDiv_1.classList.add("help-div");
        helpDiv_1.classList.remove("dropdown");
        upSign_1.classList.remove("hidden");
        leftSign_1.classList.add("hidden");
    } else {
        console.log("hello world again");
    }
});

otherNav.addEventListener("click", (e) => {
    e.preventDefault();
    if(otherDiv_1.classList.contains("other-div") == true) {
        otherDiv_1.classList.remove("other-div");
        otherDiv_1.classList.add("dropdown");
        upSign_2.classList.add("hidden");
        leftSign_2.classList.remove("hidden");
    } else if(otherDiv_1.classList.contains("other-div") == false) {
        otherDiv_1.classList.add("other-div");
        otherDiv_1.classList.remove("dropdown");
        upSign_2.classList.remove("hidden");
        leftSign_2.classList.add("hidden");
    } else {
        console.log("hello world again");
    }
})