"use strict";
const messageProfile = document.querySelectorAll(".user-message-profile");
const chatNav = document.querySelector(".chat-container-nav-div");
const backIcon = document.querySelector(".back-icon");
const chatMain1 = document.querySelector(".chat-main-div-1");
const chatMain2 = document.querySelector(".chat-main-div-2");
const messageContainer = document.querySelector(".message-main-container");
const messageTextINput = document.querySelector(".message-text-input-div");
const messageForm = document.querySelector(".message-form");
const messageInput = document.querySelector(".message-input");
var idolo = document.getElementById("idolo");
const messageFresh = document.querySelector(".reload-message-page-div");


if(messageFresh) {
    messageFresh.addEventListener("click", () => {
        const timesubmit3 = setInterval(() => {        
            idolo.scrollTop = idolo.scrollHeight;
            clearInterval(timesubmit3);
        }, 1000);
    });
};



function check(el) {
    let curOverf = el.style.overflow;
  
    if (!curOverf || curOverf === "visible") el.style.overflow = "hidden";
  
    let isOverflowing =
      el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight;
  
    el.style.overflow = curOverf;
  
    return isOverflowing;
}
  

for (let i = 0; i < messageProfile.length; i++) {
    messageProfile[i].addEventListener("click", () => {
        chatNav.classList.remove("hidden");
        chatMain1.classList.add("hidden");
        chatMain2.classList.remove("hidden");

        if (check(messageContainer)) {
            messageContainer.style.overflowY = "scroll";

            const timesubmit1 = setInterval(() => {        
                idolo.scrollTop = idolo.scrollHeight;
                clearInterval(timesubmit1);
            }, 2000);

        } else {
            console.log("Not overflow");

            const timesubmit1 = setInterval(() => {        
                idolo.scrollTop = idolo.scrollHeight;
                clearInterval(timesubmit1);
            }, 1000);

        }

    });


    
}

backIcon.addEventListener("click", () => {
    chatNav.classList.add("hidden");
    chatMain1.classList.remove("hidden");
    chatMain2.classList.add("hidden");
});

messageTextINput.addEventListener("click", () => {
    if (check(messageContainer)) {
        messageContainer.style.overflowY = "scroll";
    } else {
        console.log("Not overflow");
    }
});

messageForm.addEventListener("submit", () => {
    const timesubmit2 = setInterval(() => {        
        idolo.scrollTop = idolo.scrollHeight;
        console.log("dkja");
        clearInterval(timesubmit2);
    }, 2000);

});

