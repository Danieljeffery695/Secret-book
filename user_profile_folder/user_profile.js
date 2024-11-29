"use strict";
const list1 = document.querySelector(".li-1");
const list2 = document.querySelector(".li-2");
const list3 = document.querySelector(".li-3");
const list4 = document.querySelector(".li-4");
const list5 = document.querySelector(".li-5");
const header_image1 = document.querySelector(".header-img1");
const header_image2 = document.querySelector(".header-img2");
const modal1 = document.querySelector(".modal-div-2");
const bio_btn = document.querySelector(".add-bio-btn");
const bioINput = document.querySelector(".bio-input");
const bioForm = document.querySelector(".bio-form");
const bioSendBtn = document.querySelector(".bio-send-btn");
const bioCancel_btn = document.querySelector(".bio-cancel-btn");
const pBIo = document.querySelector(".p-bio");
const notificationBell = document.querySelector(".notification-bell");
const modal2 = document.querySelector(".modal-div-1");
const cancelNotification = document.querySelector(".cancel-notification");
const formCancel = document.querySelector(".form-cancel");
const modal3 = document.querySelector(".modal-div-3");
const searchIcon = document.querySelector(".search-icon");
const commentCancel = document.querySelector(".comment-cancel");
const modal4 = document.querySelector(".modal-div-4");
const modal5 = document.querySelector(".modal-div-5");
const moreCancel = document.querySelector(".more-cancel");
const tableCell = document.querySelector(".table-cells-icon");
const modal6 = document.querySelector(".modal-div-6");
const edit_label = document.querySelector(".edit-cover-label");
const edit_input = document.querySelector(".edit-cover-input");
const edit_cover_plus = document.querySelector(".edit-cover-plus");
const edit_label1 = document.querySelector(".edit-profile-label");
const edit_input1 = document.querySelector(".edit-profile-input");
const edit_profile_plus = document.querySelector(".edit-profile-plus");
const edit_cancel_x = document.querySelector(".edit-profile-div2");
const modal7 = document.querySelector(".modal-div-7");
const modal8 = document.querySelector(".modal-div-8");
const header_btn1 = document.querySelector(".header-btn1");
const header_btn2 = document.querySelector(".header-btn2");
const like_btn = document.querySelector(".like-btn");
const addStory_exit = document.querySelector(".add-story-div1");
const addStory_label = document.querySelector(".add-story-label");
const addStory_pic = document.querySelector(".add-story-pics");
const addStory_plus = document.querySelector(".add-story-plus");
const commentView = document.querySelectorAll(".comment-btn");
const storyCommentView = document.querySelectorAll(".story-comment-btn");
const commentDiv = document.querySelector(".comment-div");
const commentContainer = document.querySelector(".comment-container-div");
const modal9Cancel = document.querySelector(".modal-9-cancel");
const modal9 = document.querySelector(".modal-div-9");
const formInput1 = document.querySelector(".form-input-1")
const colorPick1 = document.querySelector(".color-pick-1-i");
const colorPick2 = document.querySelector(".color-pick-2-i");
const colorPick3 = document.querySelector(".color-pick-3-i");
const colorPick4 = document.querySelector(".color-pick-4-i");
const colorPick5 = document.querySelector(".color-pick-5-i");
const colorPick6 = document.querySelector(".color-pick-6-i");
const storyTextInput = document.querySelectorAll(".story-text-input");
const storyForm = document.querySelectorAll(".story-form");
const postForm = document.querySelectorAll(".post-form");
const postTextInput = document.querySelectorAll(".post-text-input");
const fakeX = document.querySelectorAll(".fake-x");
const fakeXX = document.querySelectorAll('.fake-xx');
const deleteX = document.querySelectorAll(".delete-story");
const deleteXX = document.querySelectorAll(".delete-post");
const modal10 = document.querySelector(".modal-div-10");
const cancelFakex = document.querySelector(".x-cancel-fake");


function isOverflown() {
  if (commentContainer.scrollHeight > commentContainer.clientHeight) {
    commentDiv.style.overflowY = "hidden";
    commentDiv.style.overflowX = "hidden";
  } else {
    commentDiv.style.overflowY = "scroll";
    commentDiv.style.overflowX = "hidden";
  }
}

storyCommentView.forEach(element => {
  element.addEventListener("click", () => {
    modal5.classList.remove("hidden");
    isOverflown();
    });
});

commentView.forEach(element => {
  element.addEventListener("click", () => {
    modal5.classList.remove("hidden");
    isOverflown();
    });
});

addStory_label.addEventListener("change", () => {
  if (addStory_pic.value !== "") {
    addStory_plus.classList.add("hidden");
    addStory_pic.classList.remove("hidden");
  }
});

header_btn1.addEventListener("click", () => {
  modal8.classList.remove("hidden");
});

addStory_exit.addEventListener("click", () => {
  modal8.classList.add("hidden");
});

edit_label.addEventListener("change", () => {
  if (edit_input.value !== "") {
    edit_cover_plus.classList.add("hidden");
    edit_input.classList.remove("hidden");
  }
});

edit_label1.addEventListener("change", () => {
  if (edit_input1.value !== "") {
    edit_profile_plus.classList.add("hidden");
    edit_input1.classList.remove("hidden");
  }
});

edit_cancel_x.addEventListener("click", () => {
  modal7.classList.add("hidden");
});

header_btn2.addEventListener("click", () => {
  modal7.classList.remove("hidden");
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

bio_btn.addEventListener("click", () => {
  bioForm.classList.remove("hidden");
});

bioCancel_btn.addEventListener("click", (e) => {
  e.preventDefault();
  bioForm.classList.add("hidden");
});

notificationBell.addEventListener("click", () => {
  modal2.classList.remove("hidden");
});

cancelNotification.addEventListener("click", () => {
  modal2.classList.add("hidden");
});

searchIcon.addEventListener("click", () => {
  modal3.classList.remove("hidden");
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

tableCell.addEventListener("click", () => {
  modal6.classList.remove("hidden");
});

modal6.addEventListener("click", () => {
  modal6.classList.add("hidden");
});

formInput1.addEventListener("click", () => {
  modal9.classList.remove("hidden");
})

modal9Cancel.addEventListener("click", () => {
  modal9.classList.add("hidden");
});

colorPick1.addEventListener("click", () => {
  colorPick1.style.border = "2px solid lightskyblue";
});

colorPick2.addEventListener("click", () => {
  colorPick2.style.border = "2px solid lightgreen";
});

colorPick3.addEventListener("click", () => {
  colorPick3.style.border = "2px solid yellowgreen";
});

colorPick4.addEventListener("click", () => {
  colorPick4.style.border = "2px solid purple";
});

colorPick5.addEventListener("click", () => {
  colorPick5.style.border = "2px solid brown";
});

colorPick6.addEventListener("click", () => {
  colorPick6.style.border = "2px solid darkgray";
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

cancelFakex.addEventListener("click", () => {
  modal10.classList.add("hidden");
});

fakeX.forEach(element_1 => {
  element_1.addEventListener("click", () => {
    fakeX.forEach(element_2 => {
      element_2.classList.add("hidden");
    })
    modal10.classList.remove("hidden")
    deleteX.forEach(element => {
      element.classList.remove("hidden");
    })
  });
});

fakeXX.forEach(element_1 => {
  element_1.addEventListener("click", () => {
    fakeXX.forEach(element_2 => {
      element_2.classList.add("hidden");
    })
    modal10.classList.remove("hidden")
    deleteXX.forEach(element => {
      element.classList.remove("hidden");
    })
  });
});