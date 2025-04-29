"use strict";
const list1 = document.querySelector(".li-1");
const list2 = document.querySelector(".li-2");
const list3 = document.querySelector(".li-3");
const list4 = document.querySelector(".li-4");
const list5 = document.querySelector(".li-5");
const bodyCoin = document.querySelector(".body-container");
const header_image1 = document.querySelector(".header-img1");
const header_image2 = document.querySelector(".header-img2");
const modal1_1 = document.querySelector(".modal-div-2");
const pBIo = document.querySelector(".p-bio");
const notificationBell = document.querySelector(".notification-bell");
const modal2 = document.querySelector(".modal-div-1");
const cancelNotification1 = document.querySelector(".cancel-notification");
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

const storyTextInput = document.querySelectorAll(".story-text-input");
const storyForm = document.querySelectorAll(".story-form");
const postForm = document.querySelectorAll(".post-form");
const postTextInput = document.querySelectorAll(".post-text-input");
const friendAboutDiv = document.querySelector(".friend-profile-about-div");
const friendPhotoDiv = document.querySelector(".friend-profile-photo-div");
const friendListDiv = document.querySelector(".friend-profile-list-div");
const notificationForwardBtn1 = document.querySelector(".notification-see-all-btn");


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

  bodyCoin.classList.remove("hidden");
  friendPhotoDiv.classList.add("hidden");
  friendAboutDiv.classList.add("hidden");
  friendListDiv.classList.add("hidden");
});

list2.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list3.classList.remove("line-1");
  list4.classList.remove("line-1");
  list5.classList.remove("line-1");
  list2.classList.add("line-1");

  bodyCoin.classList.add("hidden");
  friendPhotoDiv.classList.add("hidden");
  friendAboutDiv.classList.remove("hidden");
  friendListDiv.classList.add("hidden");
});

list3.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list2.classList.remove("line-1");
  list4.classList.remove("line-1");
  list5.classList.remove("line-1");
  list3.classList.add("line-1");
  bodyCoin.classList.add("hidden");
  friendPhotoDiv.classList.add("hidden");
  friendAboutDiv.classList.add("hidden");
  friendListDiv.classList.remove("hidden");
});

list4.addEventListener("click", () => {
  list1.classList.remove("line-1");
  list2.classList.remove("line-1");
  list3.classList.remove("line-1");
  list5.classList.remove("line-1");
  list4.classList.add("line-1");

  bodyCoin.classList.add("hidden");
  friendAboutDiv.classList.add("hidden");
  friendPhotoDiv.classList.remove("hidden");
  friendListDiv.classList.add("hidden");
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

modal1_1.addEventListener("click", () => {
  modal1.classList.add("hidden");
});

notificationForwardBtn.addEventListener("click", () => {
  window.open(".././notification.php");
})

cancelNotification1.addEventListener("click", () => {
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

