"use strict";

const addFriendBtn = document.querySelectorAll(".add-friend-btn");
const cancelFriendBtn = document.querySelectorAll('.cancel-friend-btn');


for(let i = 0; i < addFriendBtn.length; i++) {
    addFriendBtn[i].addEventListener("click", () => {
        addFriendBtn[i].classList.add("hidden");
        cancelFriendBtn[i].classList.remove("hidden");
    });

    cancelFriendBtn[i].addEventListener("click", () => {
        addFriendBtn[i].classList.remove("hidden");
        cancelFriendBtn[i].classList.add("hidden");
    })
}