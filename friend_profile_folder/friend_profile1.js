"use strict";
const list1 = document.querySelector(".li-1");
const list2 = document.querySelector(".li-2");
const list3 = document.querySelector(".li-3");
const list4 = document.querySelector(".li-4");
const list5 = document.querySelector(".li-5");
const navImg = document.querySelector(".nav-img");
const header_image1 = document.querySelector(".header-img1");
const header_image2 = document.querySelector(".header-img2");
const header_btn_1 = document.querySelector(".add_friend_btn_1");
const header_btn_3 = document.querySelector(".header-btn5");
const header_btn_4 = document.querySelector(".header-btn6");
const modal1 = document.querySelector(".modal-div-2");
const pBIo = document.querySelector(".p-bio");
const notificationBell = document.querySelector(".notification-bell");
const modal2 = document.querySelector(".modal-div-1");
const cancelNotification = document.querySelector(".cancel-notification");
const formCancel = document.querySelector(".form-cancel");
const modal3 = document.querySelector(".modal-div-3");
const commentCancel = document.querySelector(".comment-cancel");
const modal4 = document.querySelector(".modal-div-4");
const modal5 = document.querySelector(".modal-div-5");
const moreCancel = document.querySelector(".more-cancel");
const modal6 = document.querySelector(".modal-div-6");
const like_btn = document.querySelector(".like-btn");
const commentView = document.querySelectorAll(".comment-btn");
const storyCommentView = document.querySelectorAll(".story-comment-btn");
const commentDiv = document.querySelector(".comment-div");
const commentContainer = document.querySelector(".comment-container-div");
const notificationDivBell = document.querySelector(".notification-div-bell");
const notificationBtn = document.querySelector(".notification-btn1");
const notificationDiv = document.querySelector(".notification-div");
const notificationBackBtn = document.querySelector(".personal-back-btn");
const notificationPersonDiv = document.querySelector(".notification-personal-div");

const storyTextInput = document.querySelectorAll(".story-text-input");
const storyForm = document.querySelectorAll(".story-form");
const postForm = document.querySelectorAll(".post-form");
const postTextInput = document.querySelectorAll(".post-text-input");
const notificationBell1 = document.querySelector(".notification-bell-1");

notificationBell1.addEventListener("click", () => {
  window.open(".././notification.php", "_self");
});

navImg.addEventListener("click", () => {
  window.open("../user_profile_folder/user_profile.php", "_self");
});

if(header_btn_1) {
  header_btn_1.addEventListener("click", () => {
    header_btn_1.classList.add("hidden");
    header_btn_3.classList.remove("hidden");
  });
}

header_btn_3.addEventListener("click", () => {
  header_btn_3.classList.add("hidden");
  header_btn_1.classList.remove("hidden");
});

if(header_btn_4) {
  header_btn_4.addEventListener("click", () => {
    header_btn_4.classList.add("hidden");
    window.location.reload();
  });
}

function isOverflown() {
  if (commentContainer.scrollHeight > commentContainer.clientHeight) {
    return true
  }
} 

function overflowElement() {
if(isOverflown()) {
  commentDiv.style.overflowY = "hidden";
  commentDiv.style.overflowX = "hidden";
} else {
  commentDiv.style.overflowY = "scroll";
  commentDiv.style.overflowX = "hidden";
}
}

commentView.forEach(comment => {
comment.addEventListener("click", () => {
  modal5.classList.remove("hidden");
  overflowElement();
  // isOverflown();
})
});

storyCommentView.forEach(comment => {
comment.addEventListener("click", () => {
  modal5.classList.remove("hidden");
  overflowElement();
  // isOverflown();
})
});



list1.addEventListener("click", () => {
  list2.classList.remove("line-1");
  list3.classList.remove("line-1");
  list4.classList.remove("line-1");
  list5.classList.remove("line-1");
  list1.classList.add("line-1");
});

list2.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list3.classList.remove("line-1");
  list4.classList.remove("line-1");
  list5.classList.remove("line-1");
  list2.classList.add("line-1");
});

list3.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list2.classList.remove("line-1");
  list4.classList.remove("line-1");
  list5.classList.remove("line-1");
  list3.classList.add("line-1");
});

list4.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list2.classList.remove("line-1");
  list3.classList.remove("line-1");
  list5.classList.remove("line-1");
  list4.classList.add("line-1");
});

list5.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list2.classList.remove("line-1");
  list3.classList.remove("line-1");
  list4.classList.remove("line-1");
  list5.classList.add("line-1");
});

header_image1.addEventListener("click", () => {
    modal1.classList.remove("hidden");
});

header_image2.addEventListener("click", (e) => {
    modal1.classList.remove("hidden");
});

modal1.addEventListener("click", () => {
  modal1.classList.add("hidden");
});

notificationBtn.addEventListener("click", () => {
  notificationDiv.classList.add("hidden");
  notificationPersonDiv.classList.remove("hidden");
})

notificationBackBtn.addEventListener("click", () => {
  notificationDiv.classList.remove("hidden");
  notificationPersonDiv.classList.add("hidden");
})

notificationDivBell.addEventListener("click", () => {
  modal2.classList.remove("hidden");
});

cancelNotification.addEventListener("click", () => {
  modal2.classList.add("hidden");
});

formCancel.addEventListener("click", () => {
  modal3.classList.add("hidden");
});

commentCancel.addEventListener("click", () => {
  modal4.classList.add("hidden");
});

moreCancel.addEventListener("click", () => {
    modal5.classList.add("hidden");
});


modal6.addEventListener("click", () => {
  modal6.classList.add("hidden");
});


storyForm.forEach(element => {
  element.addEventListener("submit", () => {
  const timesubmit = setInterval(() => {
  
      storyTextInput.forEach(element1 => {
        element1.value = "";
      });
      clearInterval(timesubmit);
    }, 1000);

  });
});

postForm.forEach(element => {
  element.addEventListener("submit", () => {
  const timesubmit = setInterval(() => {
  
      postTextInput.forEach(element1 => {
        element1.value = "";
      });
      clearInterval(timesubmit);
    }, 1000);

  });
});

