"use strict";

const seeAllP = document.querySelector(".see-all-p");
const modal12 = document.querySelector(".modal-div-12");
const searchCancelX = document.querySelector(".search-see-all-x");
const searchRecentDiv = document.querySelector(".search-recent-div");
const addBtn = document.querySelectorAll(".add-btn");
const removeBtn = document.querySelectorAll(".remove-btn");
const cancelAddBtn = document.querySelectorAll(".cancel-add-btn");
const cancelAddDiv = document.querySelectorAll(".cancel-request-div");
const cancelAddBtn1 = document.querySelectorAll(".cancel-add-btn-1");
const cancelAddDiv1 = document.querySelectorAll(".cancel-request-div-1");
const peopleBtnDiv = document.querySelectorAll(".people-btn-div-1");
const peopleBtn = document.querySelector(".people-see-all-btn");

peopleBtn.addEventListener("click", () => {
  window.open("./friends_folder/friends.php", "_self");
});

for(let i = 0; i < addBtn.length; i++) {
  addBtn[i].addEventListener("click", function() {
    peopleBtnDiv[i].classList.add("hidden");
    cancelAddDiv[i].classList.remove("hidden");
  })
}

for(let i = 0; i < cancelAddBtn.length; i++) {
  cancelAddBtn[i].addEventListener("click", function() {
    peopleBtnDiv[i].classList.remove("hidden");
    cancelAddDiv[i].classList.add("hidden");
  })
}

for(let i = 0; i < removeBtn.length; i++) {
  removeBtn[i].addEventListener("click", function() {
    peopleBtnDiv[i].classList.add("hidden");
    cancelAddDiv1[i].classList.remove("hidden");
  })
}

for(let i = 0; i < cancelAddBtn1.length; i++) {
  cancelAddBtn1[i].addEventListener("click", function() {
    peopleBtnDiv[i].classList.remove("hidden");
    cancelAddDiv1[i].classList.add("hidden");
  })
}


function check(el) {
    let curOverf = el.style.overflow;
  
    if (!curOverf || curOverf === "visible") el.style.overflow = "hidden";
  
    let isOverflowing =
      el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight;
  
    el.style.overflow = curOverf;
  
    return isOverflowing;
  }

  

seeAllP.addEventListener("click", () => {
    modal12.classList.remove("hidden");

    if (check(searchRecentDiv)) {
        searchRecentDiv.style.overflowY = "scroll";
      } else {
          console.log("Not overflow");
    }
});

searchCancelX.addEventListener("click", () => {
    modal12.classList.add("hidden");
})