"use strict";

// const addAbout1 = document.querySelector(".div-about-h4-1");
// const addAbout2 = document.querySelector(".div-about-h4-2");
// const addAbout3 = document.querySelector(".about-h4-3");
// const addAbout4 = document.querySelector(".about-h4-4");
// const addAbout5 = document.querySelector(".about-h4-5");
// const addAbout6 = document.querySelector(".about-h4-6");
// const user_about_form = document.querySelector(".user-about-form");
// const user_about_form1 = document.querySelector(".user-about-form1");
// const user_about_form2 = document.querySelector(".user-about-form3");
// const user_about_form3 = document.querySelector(".user-about-form4");
// const user_about_form4 = document.querySelector(".user-about-form5");
// const user_about_form5 = document.querySelector(".user-about-form6");
const about_p_1 = document.querySelector(".about-p");
const div_about_3 = document.querySelector(".div-about-3");
const div_about_4 = document.querySelector(".div-about-4");
const div_about_5 = document.querySelector(".div-about-5");
const div_about_6 = document.querySelector(".div-about-6");
const div_about_7 = document.querySelector(".div-about-7");
const div_about_8 = document.querySelector(".div-about-8");
const user_about_input = document.querySelector(".user_about_input");
const userLocation = document.querySelector(".user-about-1");
const userWork = document.querySelector(".user-about-2");
const userLived = document.querySelector(".user-about-3");
const userRelationship = document.querySelector(".user-about-4");
const userHome = document.querySelector(".user-about-5");
const userDetail = document.querySelector(".user-about-6");



// addAbout1.addEventListener("click", () => {
// addAbout1.classList.add("hiddens");
// user_about_form.classList.remove("hiddens");
// });

// addAbout2.addEventListener("click", () => {
// addAbout2.classList.add("hiddens");
// user_about_form1.classList.remove("hiddens");
// });

// addAbout3.addEventListener("click", () => {
// addAbout3.classList.add("hiddens");
// user_about_form2.classList.remove("hiddens");
// });

// addAbout4.addEventListener("click", () => {
// addAbout4.classList.add("hiddens");
// user_about_form3.classList.remove("hiddens");
// });

// addAbout5.addEventListener("click", () => {
// addAbout5.classList.add("hiddens");
// user_about_form4.classList.remove("hiddens");
// });

// addAbout6.addEventListener("click", () => {
// addAbout6.classList.add("hiddens");
// user_about_form5.classList.remove("hiddens");
// });
                                                
        


userLocation.addEventListener("click", () => {
    div_about_8.classList.add("hiddens");
    div_about_7.classList.add("hiddens");
    div_about_6.classList.add("hiddens");
    div_about_5.classList.add("hiddens");
    div_about_4.classList.add("hiddens");
    div_about_3.classList.remove("hiddens");
    // colors
    userLocation.classList.add("div-text-colors");
    userDetail.classList.remove("div-text-colors");
    userHome.classList.remove("div-text-colors");
    userLived.classList.remove("div-text-colors");
    userRelationship.classList.remove("div-text-colors");
    userWork.classList.remove("div-text-colors");
});

userDetail.addEventListener("click", ()=> {
    div_about_3.classList.add("hiddens");
    div_about_4.classList.add("hiddens");
    div_about_5.classList.add("hiddens");
    div_about_6.classList.add("hiddens");
    div_about_7.classList.add("hiddens");
    div_about_8.classList.remove("hiddens");
    // colors
    userDetail.classList.add("div-text-colors");
    userHome.classList.remove("div-text-colors");
    userLived.classList.remove("div-text-colors");
    userLocation.classList.remove("div-text-colors");
    userRelationship.classList.remove("div-text-colors");
    userWork.classList.remove("div-text-colors");
});

userHome.addEventListener("click", () => {
    div_about_8.classList.add("hiddens");
    div_about_6.classList.add("hiddens");
    div_about_5.classList.add("hiddens");
    div_about_4.classList.add("hiddens");
    div_about_3.classList.add("hiddens");
    div_about_7.classList.remove("hiddens");
    // colors
    userHome.classList.add("div-text-colors");
    userDetail.classList.remove("div-text-colors");
    userLocation.classList.remove("div-text-colors");
    userRelationship.classList.remove("div-text-colors");
    userWork.classList.remove("div-text-colors");
    userLived.classList.remove("div-text-colors");
});

userLived.addEventListener("click", () => {
    div_about_8.classList.add("hiddens");
    div_about_7.classList.add("hiddens");
    div_about_6.classList.add("hiddens");
    div_about_4.classList.add("hiddens");
    div_about_3.classList.add("hiddens");
    div_about_5.classList.remove("hiddens");
    // colors
    userDetail.classList.remove("div-text-colors");
    userHome.classList.remove("div-text-colors");
    userLocation.classList.remove("div-text-colors");
    userRelationship.classList.remove("div-text-colors");
    userWork.classList.remove("div-text-colors");
    userLived.classList.add("div-text-colors");
});

userRelationship.addEventListener("click", () => {
    div_about_8.classList.add("hiddens");
    div_about_7.classList.add("hiddens");
    div_about_5.classList.add("hiddens");
    div_about_4.classList.add("hiddens");
    div_about_3.classList.add("hiddens");
    div_about_6.classList.remove("hiddens");
    // colors
    userDetail.classList.remove("div-text-colors");
    userHome.classList.remove("div-text-colors");
    userLived.classList.remove("div-text-colors");
    userLocation.classList.remove("div-text-colors");
    userWork.classList.remove("div-text-colors");
    userRelationship.classList.add("div-text-colors");
});

userWork.addEventListener("click", () => {
    div_about_8.classList.add("hiddens");
    div_about_7.classList.add("hiddens");
    div_about_6.classList.add("hiddens");
    div_about_5.classList.add("hiddens");
    div_about_3.classList.add("hiddens");
    div_about_4.classList.remove("hiddens");
    // colors
    userDetail.classList.remove("div-text-colors");
    userHome.classList.remove("div-text-colors");
    userLived.classList.remove("div-text-colors");
    userLocation.classList.remove("div-text-colors");
    userRelationship.classList.remove("div-text-colors");
    userWork.classList.add("div-text-colors");
});