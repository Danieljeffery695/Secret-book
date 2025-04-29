"use strict";

const navigationDiv = document.querySelector(".navigation-div");
const homeNavigation = document.querySelector(".home-container-div-nav");
const navImg = document.querySelector(".nav-img");
const mainContainerDiv = document.querySelector(".main-container-div");
const mainDiv1 = document.querySelector(".main-div1");
const mainDiv2 = document.querySelector(".main-div2");
const mainDiv3 = document.querySelector(".main-div3");
const mainDiv4 = document.querySelector(".main-div4");
const mainDiv5 = document.querySelector(".main-div5");
const mainDiv6 = document.querySelector(".main-div6");
const friendRequestContainer = document.querySelector(".main-container-friend-request");
const suggestionContainer = document.querySelector(".suggestion-container-div");
const allFriendContainer = document.querySelector(".all-friend-container");
const mainContainer2 = document.querySelector(".main-container-2");
const mainContainer4 = document.querySelector(".main-container-4");
const friendAvailable = document.querySelector(".friend-available-div");
const birthdayContainer = document.querySelector(".birthday-container");
const customContainer = document.querySelector(".custom-container");
const container_p1 = document.querySelector(".no-friend-p-1");
const container_p2 = document.querySelector(".no-friend-p-2");
const container_p3 = document.querySelector(".no-friend-p-3");
const container_p4 = document.querySelector(".no-friend-p-4");
const container_p5 = document.querySelector(".no-friend-p-5");
const backArrow1 = document.querySelector(".friend-nav-1");
const backArrow2 = document.querySelector(".suggestion-nav-1");
const backArrow3 = document.querySelector(".all-friend-nav-1");
const acceptedText = document.querySelectorAll(".accepted-h2");
const friendAcceptAdd = document.querySelectorAll(".friend-request-add-btn");
const friendAcceptRemove = document.querySelectorAll(".friend-request-remove-btn");
const acceptedText1 = document.querySelectorAll(".accepted-h2-1");
const removeText = document.querySelectorAll(".remove-h2");
const friendAcceptAdd1 = document.querySelectorAll(".friend-request-add-btn-1");
const friendAcceptRemove1 = document.querySelectorAll(".friend-request-remove-btn-1");
const removeText1 = document.querySelectorAll(".remove-h2-1");

const cancelSuggestionRequest = document.querySelectorAll(".cancel-suggestion-request-div");
const cancelSuggestionBtn = document.querySelectorAll(".cancel-suggestion-request-btn");
const suggestionRequestBtn = document.querySelectorAll(".suggestion-request-btn");
const suggestionBtnDiv = document.querySelectorAll(".suggestion-btn-div");
const suggestionRemoveBtn = document.querySelectorAll(".suggestion-remove-btn");
const cancelSuggestionRemoveDiv = document.querySelectorAll(".cancel-remove-suggestion-div");
const cancelSuggestionRemoveBtn = document.querySelectorAll(".cancel-remove-suggestion-btn");
const friendRequestBtnDiv = document.querySelectorAll(".friend-card-btn-div");
const friendRequestBtnDiv1 = document.querySelectorAll(".friend-card-btn-div-1");
const friendRequestBtn = document.querySelectorAll(".friend-request-btn");
const friendRequestBtn1 = document.querySelectorAll(".friend-request-btn-1");
const cancelFriendRequestDiv = document.querySelectorAll(".cancel-friend-request-div");
const cancelFriendRequestBtn = document.querySelectorAll(".cancel-friend-request-btn");
const cancelFriendRequestDiv1 = document.querySelectorAll(".cancel-friend-request-div-1");
const cancelFriendRequestBtn1 = document.querySelectorAll(".cancel-friend-request-btn-1");
const cancelRemoveRequest = document.querySelectorAll(".cancel-remove-request-div");
const cancelRemoveRequest1 = document.querySelectorAll(".cancel-remove-request-div-1");
const cancelRemoveRequestBtn = document.querySelectorAll(".cancel-remove-request-btn");
const cancelRemoveRequestBtn1 = document.querySelectorAll(".cancel-remove-request-btn-1");
const friendRemoveBtn = document.querySelectorAll(".remove-btn-1");
const friendRemoveBtn1 = document.querySelectorAll(".remove-btn-2");

const friendNameDiv = document.querySelectorAll(".all-friend-name-div");
const friendProfileDiv1 = document.querySelector(".friend-profile-div-1");
const friendProfileContainer = document.querySelector(".friend-profile-container");
const seeAll = document.querySelector(".see-all-p");

const mainContainerDiv2 = document.querySelector(".main-container-div-2");
const mainContainerDiv3 = document.querySelector(".main-container-div-3");
const mainContainerDiv4 = document.querySelector(".main-container-div-4");
const friendBtn1 = document.querySelector(".friend-btn-1");
const friendBtn2 = document.querySelector(".friend-btn-2");
const backBtn = document.querySelector(".back-btn-div");
const backBtn1 = document.querySelector(".back-btn-div-1");
const friendRequestDiv2 = document.querySelector(".second-friend-request-div");
const allFriendContainer2 = document.querySelector(".all-friend-container-div");
const mainContainerNotification = document.querySelector(".main-container-notification-1");
const modal1 = document.querySelector(".modal-div-1");
const notificationDivBell = document.querySelector(".notification-div-bell");
const notificationBell1 = document.querySelector(".notification-bell-1");
const cancelNotification = document.querySelector(".cancel-notification");
const notificationBtn = document.querySelector(".notification-btn1");
const notificationDiv = document.querySelector(".notification-div");
const notificationBackBtn = document.querySelector(".personal-back-btn");
const notificationPersonDiv = document.querySelector(".notification-personal-div");
const notificationForwardBtn = document.querySelector(".notification-see-all-btn");
const modal11 = document.querySelector(".modal-div-11");
const searchResultDiv = document.querySelector(".search-result-div");
const searchDiv1 = document.querySelector(".search-div-1");
const searchCancelX = document.querySelector(".search-cancel-x");
const searchInput = document.querySelector(".search-input-div");
const searchRecentDiv = document.querySelector(".search-recent-div");
const searchSeeAllP = document.querySelector(".search-see-all-p");
const searchSeeAllX = document.querySelector(".search-see-all-x");
const modal12 = document.querySelector(".modal-div-12");
const searchIcon = document.querySelector(".search-icon");
const modal13 = document.querySelector(".modal-div-13");
const closedMessageX = document.querySelector(".close-message-x");
const messageUserDiv = document.querySelector(".message-users-div");
const navMessageBtn = document.querySelector(".nav-message-btn");
const navMessageBtn1 = document.querySelector(".nav-message-btn-1");
const newMessageI = document.querySelector(".new-message-i");
const navMessageBtn2 = document.querySelector(".nav-message-btn-2")


navImg.addEventListener("click", () => {
    window.open("../user_profile_folder/user_profile.php", "_self");
});

notificationBell1.addEventListener("click", () => {
    window.open(".././notification.php", "_self");
});

searchCancelX.addEventListener("click", () => {
    modal11.classList.add("hidden");
});
  
searchInput.addEventListener("click", () => {
    modal11.classList.remove("hidden");
});

function check(el) {
    let curOverf = el.style.overflow;
  
    if (!curOverf || curOverf === "visible") el.style.overflow = "hidden";
  
    let isOverflowing =
      el.clientWidth < el.scrollWidth || el.clientHeight < el.scrollHeight;
  
    el.style.overflow = curOverf;
  
    return isOverflowing;
}
  
if(searchSeeAllP) {
    searchSeeAllP.addEventListener("click", () => {
      modal11.classList.add("hidden");
      modal12.classList.remove("hidden");
  
      if (check(searchRecentDiv)) {
        searchRecentDiv.style.overflowY = "scroll";
      } else {
          console.log("Not overflow");
      }
      
    })
}
  
searchSeeAllX.addEventListener("click", () => {
    modal12.classList.add("hidden");
});

searchIcon.addEventListener("click", () => {
    window.open(".././search_file1.php", "_self");
})

navMessageBtn.addEventListener("click", () => {
    modal13.classList.remove("hidden");
    if (check(messageUserDiv)) {
      messageUserDiv.style.overflowY = "scroll";
    } else {
        console.log("Not overflow");
    }
  });
  
  navMessageBtn1.addEventListener("click", function() {
    window.open(".././message.php", "_self");
  })
  
  closedMessageX.addEventListener("click", () => {
    modal13.classList.add("hidden");
  });
  
  newMessageI.addEventListener("click", () => {
    window.open(".././message.php", "_self");
  })
  
  navMessageBtn2.addEventListener("click", () => {
    window.open(".././message.php", "_self");
  })

for (let i = 0; i < friendRequestBtn.length; i++) {
    friendRequestBtn[i].addEventListener("click", () => {
        friendRequestBtnDiv[i].classList.add("hidden");
        cancelFriendRequestDiv[i].classList.remove("hidden");
    });

    friendRequestBtn1[i].addEventListener("click", () => {
        friendRequestBtnDiv1[i].classList.add("hidden");
        cancelFriendRequestDiv1[i].classList.remove("hidden");
    })

    cancelFriendRequestBtn[i].addEventListener("click", () => {
        friendRequestBtnDiv[i].classList.remove("hidden");
        cancelFriendRequestDiv[i].classList.add("hidden");
    });

    cancelFriendRequestBtn1[i].addEventListener("click", () => {
        friendRequestBtnDiv1[i].classList.remove("hidden");
        cancelFriendRequestDiv1[i].classList.add("hidden");
    });

}

for(let i = 0; i < friendRemoveBtn.length; i++) {
    friendRemoveBtn[i].addEventListener("click", () => {
        friendRequestBtnDiv[i].classList.add("hidden");
        cancelRemoveRequest[i].classList.remove("hidden");
    });

    friendRemoveBtn1[i].addEventListener("click", () => {
        friendRequestBtnDiv1[i].classList.add("hidden");
        cancelRemoveRequest1[i].classList.remove("hidden");
    });

    cancelRemoveRequestBtn[i].addEventListener("click", () => {
        friendRequestBtnDiv[i].classList.remove("hidden");
        cancelRemoveRequest[i].classList.add("hidden");
    });

    cancelRemoveRequestBtn1[i].addEventListener("click", () => {
        friendRequestBtnDiv1[i].classList.remove("hidden");
        cancelRemoveRequest1[i].classList.add("hidden");
    });
}


for(let ii = 0; ii < suggestionRequestBtn.length; ii++) {
    suggestionRequestBtn[ii].addEventListener("click", () => {
        suggestionBtnDiv[ii].classList.add("hidden");
        cancelSuggestionRequest[ii].classList.remove("hidden");
    });

    cancelSuggestionBtn[ii].addEventListener("click", () => {
        suggestionBtnDiv[ii].classList.remove("hidden");
        cancelSuggestionRequest[ii].classList.add("hidden");
    });
};

for(let i = 0; i < suggestionRemoveBtn.length; i++) {
    suggestionRemoveBtn[i].addEventListener("click", () => {
        suggestionBtnDiv[i].classList.add("hidden");
        cancelSuggestionRemoveDiv[i].classList.remove("hidden");
    });

    cancelSuggestionRemoveBtn[i].addEventListener("click", () => {
        suggestionBtnDiv[i].classList.remove("hidden");
        cancelSuggestionRemoveDiv[i].classList.add("hidden");
    });
}

for(let iii = 0; iii < friendAcceptAdd.length; iii++) {
    friendAcceptAdd[iii].addEventListener("click", () => {
        friendAcceptAdd[iii].classList.add("hidden");
        friendAcceptRemove[iii].classList.add("hidden");
        acceptedText[iii].classList.remove("hidden")
    });

    friendAcceptAdd1[iii].addEventListener("click", () => {
        friendAcceptAdd1[iii].classList.add("hidden");
        friendAcceptRemove1[iii].classList.add("hidden");
        acceptedText1[iii].classList.remove("hidden");
    });
};

for(let i = 0; i < friendAcceptRemove.length; i++) {
    friendAcceptRemove[i].addEventListener("click", () => {
        friendAcceptAdd[i].classList.add("hidden");
        friendAcceptRemove[i].classList.add("hidden");
        removeText[i].classList.remove("hidden");
    });

    friendAcceptRemove1[i].addEventListener("click", () => {
        friendAcceptAdd1[i].classList.add("hidden");
        friendAcceptRemove1[i].classList.add("hidden");
        removeText1[i].classList.remove("hidden");
    });
}

for(let iv = 0; iv < friendNameDiv; iv++) {
    friendNameDiv[iv].addEventListener("click", () => {
        friendProfileDiv1.classList.add("hidden");
        container_p3.classList.add("hidden");
    });
}


function backclickFunction(clicked_element, element_to_back, element_hidden_1, element_hidden_2, element_hidden_3) {
    clicked_element.addEventListener("click", () => {
        element_hidden_1.classList.add("hidden");
        element_hidden_2.classList.add("hidden");
        element_hidden_3.classList.add("hidden");
        element_to_back.classList.remove("hidden");
    })
}
backclickFunction(backArrow1, mainContainerDiv, friendRequestContainer, suggestionContainer, allFriendContainer);
backclickFunction(backArrow2, mainContainerDiv, friendRequestContainer, suggestionContainer, allFriendContainer);
// backclickFunction(backArrow3, mainContainerDiv, friendRequestContainer, suggestionContainer, allFriendContainer);

backArrow3.addEventListener("click", () => {
    window.open("friends.php", "_self");
});

notificationForwardBtn.addEventListener("click", () => {
    window.open(".././notification.php");
})

notificationBtn.addEventListener("click", () => {
    notificationDiv.classList.add("hidden");
    notificationPersonDiv.classList.remove("hidden");
})
  
notificationBackBtn.addEventListener("click", () => {
    notificationDiv.classList.remove("hidden");
    notificationPersonDiv.classList.add("hidden");
})
  
notificationDivBell.addEventListener("click", () => {
    modal1.classList.remove("hidden");
});

cancelNotification.addEventListener("click", () => {
    modal1.classList.add("hidden");
});
  


mainDiv2.addEventListener("click", () => {
    mainDiv2.style.backgroundColor = "gainsboro";
    mainDiv3.style.backgroundColor = "white";
    mainDiv4.style.backgroundColor = "white";
    mainDiv5.style.backgroundColor = "white";
    mainDiv6.style.backgroundColor = "white";
    if(mainContainer2) {
        container_p1.classList.add("hidden");
        container_p2.classList.remove("hidden");
        mainContainer2.classList.remove("hidden");
    } else {
        friendAvailable.classList.remove("hidden");
    }
    
    mainDiv2.childNodes[1].style.color = "blue";
    mainDiv1.childNodes[1].style.color = "black";
    mainDiv3.childNodes[1].style.color = "black";
    mainDiv4.childNodes[1].style.color = "black";
    mainDiv5.childNodes[1].style.color = "black";
    mainDiv6.childNodes[1].style.color = "black";
    friendRequestContainer.classList.remove("hidden");
    mainContainerDiv.classList.add("hidden");
    suggestionContainer.classList.add("hidden");
    allFriendContainer.classList.add("hidden");
    birthdayContainer.classList.add("hidden");
    customContainer.classList.add("hidden");
    mainContainer4.classList.add("hidden");
    friendProfileContainer.classList.add("hidden");
});

mainDiv3.addEventListener("click", () => {
    mainDiv3.style.backgroundColor = "gainsboro";
    mainDiv2.style.backgroundColor = "white";
    mainDiv4.style.backgroundColor = "white";
    mainDiv5.style.backgroundColor = "white";
    mainDiv6.style.backgroundColor = "white";
    if(mainContainer2) {
        container_p1.classList.add("hidden");
        container_p2.classList.remove("hidden");
        mainContainer2.classList.remove("hidden");
    } else {
        friendAvailable.classList.remove("hidden");
    }
    mainDiv3.childNodes[1].style.color = "blue";
    mainDiv1.childNodes[1].style.color = "black";
    mainDiv2.childNodes[1].style.color = "black";
    mainDiv4.childNodes[1].style.color = "black";
    mainDiv5.childNodes[1].style.color = "black";
    mainDiv6.childNodes[1].style.color = "black";
    friendRequestContainer.classList.add("hidden");
    mainContainerDiv.classList.add("hidden");
    suggestionContainer.classList.remove("hidden");
    allFriendContainer.classList.add("hidden");
    birthdayContainer.classList.add("hidden");
    customContainer.classList.add("hidden");
    mainContainer4.classList.add("hidden");
    friendProfileContainer.classList.add("hidden");
});

mainDiv4.addEventListener("click", () => {
    mainDiv4.style.backgroundColor = "gainsboro";
    mainDiv2.style.backgroundColor = "white";
    mainDiv3.style.backgroundColor = "white";
    mainDiv5.style.backgroundColor = "white";
    mainDiv6.style.backgroundColor = "white";
    if(mainContainer4) {
        container_p4.classList.add("hidden");
        container_p3.classList.remove("hidden");
        container_p5.classList.add("hidden");
        mainContainer4.classList.remove("hidden");
        friendAvailable.classList.add("hidden");
        friendRequestContainer.classList.add("hidden");
        mainContainerDiv.classList.add("hidden");
        suggestionContainer.classList.add("hidden");
        allFriendContainer.classList.remove("hidden");
        birthdayContainer.classList.add("hidden");
        customContainer.classList.add("hidden");
    } else {
        friendAvailable.classList.remove("hidden");
        
    }
    mainDiv4.childNodes[1].style.color = "blue";
    mainDiv1.childNodes[1].style.color = "black";
    mainDiv3.childNodes[1].style.color = "black";
    mainDiv2.childNodes[1].style.color = "black";
    mainDiv5.childNodes[1].style.color = "black";
    mainDiv6.childNodes[1].style.color = "black";
    friendProfileContainer.classList.add("hidden");
});

mainDiv5.addEventListener("click", () => {
    mainDiv5.style.backgroundColor = "gainsboro";
    mainDiv2.style.backgroundColor = "white";
    mainDiv3.style.backgroundColor = "white";
    mainDiv4.style.backgroundColor = "white";
    mainDiv6.style.backgroundColor = "white";
    if(mainContainer2) {
        container_p1.classList.add("hidden");
        container_p2.classList.add("hidden");
        mainContainer2.classList.add("hidden");
    } else {
        friendAvailable.classList.add("hidden");
    }
    mainDiv5.childNodes[1].style.color = "blue";
    mainDiv1.childNodes[1].style.color = "black";
    mainDiv3.childNodes[1].style.color = "black";
    mainDiv4.childNodes[1].style.color = "black";
    mainDiv2.childNodes[1].style.color = "black";
    mainDiv6.childNodes[1].style.color = "black";
    friendRequestContainer.classList.add("hidden");
    mainContainerDiv.classList.remove("hidden");
    suggestionContainer.classList.add("hidden");
    allFriendContainer.classList.add("hidden");
    birthdayContainer.classList.remove("hidden");
    customContainer.classList.add("hidden");
    mainContainer4.classList.add("hidden");
    friendProfileContainer.classList.add("hidden");
});

mainDiv6.addEventListener("click", () => {
    mainDiv6.style.backgroundColor = "gainsboro";
    mainDiv2.style.backgroundColor = "white";
    mainDiv3.style.backgroundColor = "white";
    mainDiv4.style.backgroundColor = "white";
    mainDiv5.style.backgroundColor = "white";
    if(mainContainer2) {
        container_p1.classList.add("hidden");
        container_p2.classList.add("hidden");
        mainContainer2.classList.add("hidden");
    } else {
        friendAvailable.classList.add("hidden");
    }
    mainDiv6.childNodes[1].style.color = "blue";
    mainDiv1.childNodes[1].style.color = "black";
    mainDiv3.childNodes[1].style.color = "black";
    mainDiv4.childNodes[1].style.color = "black";
    mainDiv5.childNodes[1].style.color = "black";
    mainDiv2.childNodes[1].style.color = "black";
    friendRequestContainer.classList.add("hidden");
    suggestionContainer.classList.add("hidden");
    allFriendContainer.classList.add("hidden");
    birthdayContainer.classList.add("hidden");
    mainContainer4.classList.add("hidden");
    customContainer.classList.remove("hidden");
    friendProfileContainer.classList.add("hidden");
});


function view_friend_profile_active() {
        mainDiv4.style.backgroundColor = "gainsboro";
        mainDiv2.style.backgroundColor = "white";
        mainDiv3.style.backgroundColor = "white";
        mainDiv5.style.backgroundColor = "white";
        mainDiv6.style.backgroundColor = "white";
        // if(mainContainer4) {

            friendProfileContainer.classList.remove("hidden");
            container_p4.classList.add("hidden");
            container_p5.classList.add("hidden");
            mainContainer4.classList.add("hidden");
            friendAvailable.classList.add("hidden");
            friendRequestContainer.classList.add("hidden");
            mainContainerDiv.classList.add("hidden");
            suggestionContainer.classList.add("hidden");
            allFriendContainer.classList.remove("hidden");
            birthdayContainer.classList.add("hidden");
            customContainer.classList.add("hidden");
        // } else {
            friendAvailable.classList.add("hidden");
            
        // }
        mainDiv4.childNodes[1].style.color = "blue";
        mainDiv1.childNodes[1].style.color = "black";
        mainDiv3.childNodes[1].style.color = "black";
        mainDiv2.childNodes[1].style.color = "black";
        mainDiv5.childNodes[1].style.color = "black";
        mainDiv6.childNodes[1].style.color = "black";
       
}


for(let i = 0; i < friendNameDiv.length; i++) {
  friendNameDiv[i].addEventListener("click", () => {
    view_friend_profile_active();
  });
};



friendBtn1.addEventListener("click", () => {
    navigationDiv.classList.add("hidden");
    homeNavigation.classList.add("hidden");
    mainContainerNotification.classList.add("hidden");
    mainContainerDiv2.classList.add("hidden");
    mainContainerDiv3.classList.add("hidden");
    mainContainerDiv4.classList.add("hidden");
    backBtn.classList.remove("hidden");
    friendRequestDiv2.classList.remove("hidden");
});

backBtn.addEventListener("click", () => {
    navigationDiv.classList.remove("hidden");
    homeNavigation.classList.remove("hidden");
    mainContainerNotification.classList.remove("hidden");
    mainContainerDiv2.classList.remove("hidden");
    mainContainerDiv3.classList.remove("hidden");
    mainContainerDiv4.classList.remove("hidden");
    backBtn.classList.add("hidden");
    friendRequestDiv2.classList.add("hidden");
})

friendBtn2.addEventListener("click", () => {
    navigationDiv.classList.add("hidden");
    homeNavigation.classList.add("hidden");
    mainContainerNotification.classList.add("hidden");
    mainContainerDiv2.classList.add("hidden");
    mainContainerDiv3.classList.add("hidden");
    mainContainerDiv4.classList.add("hidden");
    backBtn1.classList.remove("hidden");
    allFriendContainer2.classList.remove("hidden");
});

backBtn1.addEventListener("click", () => {
    navigationDiv.classList.remove("hidden");
    homeNavigation.classList.remove("hidden");
    mainContainerNotification.classList.remove("hidden");
    mainContainerDiv2.classList.remove("hidden");
    mainContainerDiv3.classList.remove("hidden");
    mainContainerDiv4.classList.remove("hidden");
    backBtn1.classList.add("hidden");
    allFriendContainer2.classList.add("hidden");
});

seeAll.addEventListener("click", () => {
    mainDiv3.style.backgroundColor = "gainsboro";
    mainDiv2.style.backgroundColor = "white";
    mainDiv4.style.backgroundColor = "white";
    mainDiv5.style.backgroundColor = "white";
    mainDiv6.style.backgroundColor = "white";
    if(mainContainer2) {
        container_p1.classList.add("hidden");
        container_p2.classList.remove("hidden");
        mainContainer2.classList.remove("hidden");
    } else {
        friendAvailable.classList.remove("hidden");
    }
    mainDiv3.childNodes[1].style.color = "blue";
    mainDiv1.childNodes[1].style.color = "black";
    mainDiv2.childNodes[1].style.color = "black";
    mainDiv4.childNodes[1].style.color = "black";
    mainDiv5.childNodes[1].style.color = "black";
    mainDiv6.childNodes[1].style.color = "black";
    friendRequestContainer.classList.add("hidden");
    mainContainerDiv.classList.add("hidden");
    suggestionContainer.classList.remove("hidden");
    allFriendContainer.classList.add("hidden");
    birthdayContainer.classList.add("hidden");
    customContainer.classList.add("hidden");
    mainContainer4.classList.add("hidden");
    friendProfileContainer.classList.add("hidden");
});






