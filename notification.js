"use strict";

const containerDiv = document.querySelector(".notification-container-div");
const usualDiv = document.querySelectorAll(".usual-div");
const personalDiv = document.querySelectorAll(".personal-div");
const secondNavDiv = document.querySelector(".second-nav-div");
const secondNavDiv1 = document.querySelector(".second-nav-div-1");
const personalBtn = document.querySelector(".personal-btn");
const allBtn = document.querySelector(".all-btn");
const searchIcon = document.querySelector(".search-icon");
const tableCell = document.querySelector(".table-cells-icon");
const searchInput = document.querySelector(".search-input-div");
const modal11 = document.querySelector(".modal-div-11");
const searchCancelX = document.querySelector(".search-cancel-x");
const searchSeeAll = document.querySelector(".search-see-all-p");
const modal12 = document.querySelector(".modal-div-12");
const searchCancelX1 = document.querySelector(".search-see-all-x");
const searchRecentDiv = document.querySelector(".search-recent-div");

searchCancelX1.addEventListener("click", () => {
  modal12.classList.add("hidden");
})

function check(el) {
  let curOverf = el.style.overflow;

  if (!curOverf || curOverf === "visible") el.style.overflow = "hidden";

  let isOverflowing =
    el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight;

  el.style.overflow = curOverf;

  return isOverflowing;
}

if(searchSeeAll) {
  searchSeeAll.addEventListener("click", () => {
    modal11.classList.add("hidden");
    modal12.classList.remove("hidden");

    if (check(searchRecentDiv)) {
      searchRecentDiv.style.overflowY = "scroll";
    } else {
        console.log("Not overflow");
    }
    
  })
}

searchCancelX.addEventListener("click", () => {
  modal11.classList.add("hidden");
})

searchInput.addEventListener("click", () => {
  modal11.classList.remove("hidden");
})

searchIcon.addEventListener("click", () => {
  window.open("./search_file1.php", "_self");
});

tableCell.addEventListener("click", () => {
  window.open("./user_home_folder/bookmark.php", "_self");
});


function check(el) {
  let curOverf = el.style.overflow;

  if (!curOverf || curOverf === "visible") el.style.overflow = "hidden";

  let isOverflowing =
    el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight;

  el.style.overflow = curOverf;

  return isOverflowing;
}

if (check(containerDiv)) {
  containerDiv.style.height = "100%";
} else {
    console.log("Not overflow");
}

secondNavDiv.addEventListener("click", () => {
  for(let i = 0; i < usualDiv.length; i++) {
    usualDiv[i].classList.remove("hidden");
  };

  for(let i = 0; i < personalDiv.length; i++) {
    personalDiv[i].classList.add("hidden");
  }
});

secondNavDiv1.addEventListener("click", () => {
  for(let i = 0; i < personalDiv.length; i++) {
    personalDiv[i].classList.remove("hidden");
  }

  for(let i = 0; i < usualDiv.length; i++) {
    usualDiv[i].classList.add("hidden");
  }
});

personalBtn.addEventListener("click", () => {
  personalBtn.classList.add('hidden');
  allBtn.classList.remove("hidden");

  for(let i = 0; i < personalDiv.length; i++) {
    personalDiv[i].classList.remove("hidden");
  }

  for(let i = 0; i < usualDiv.length; i++) {
    usualDiv[i].classList.add("hidden");
  }
});

allBtn.addEventListener("click", () => {
  personalBtn.classList.remove("hidden");
  allBtn.classList.add("hidden");

  for(let i = 0; i < usualDiv.length; i++) {
    usualDiv[i].classList.remove("hidden");
  }

  for(let i = 0; i < personalDiv.length; i++) {
    personalDiv[i].classList.add("hidden");
  }

})
                 