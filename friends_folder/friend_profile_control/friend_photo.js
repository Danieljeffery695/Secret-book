"use strict";
const firstPhotoDiv = document.querySelector(".first-photo-div");
const secondPhotoDiv = document.querySelector(".more-photo-container");
const firstBtn = document.querySelector(".first-btn-div");
const morePicsBtn = document.querySelector(".more-pics-btn");

morePicsBtn.addEventListener("click", () => {
    firstPhotoDiv.classList.add("hide-photo");
    firstBtn.classList.add("hide-photo");
    secondPhotoDiv.classList.remove("second-photo-div");
});