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
const notificationBell1 = document.querySelector(".notification-bell-1");
const modal2 = document.querySelector(".modal-div-1");
const searchIcon = document.querySelector(".search-icon");
const cancelNotification = document.querySelector(".cancel-notification");
const commentCancel = document.querySelector(".comment-cancel");
const notificationDivBell = document.querySelector(".notification-div-bell");
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
// const modal7 = document.querySelector(".modal-div-7");
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
const modal13 = document.querySelector(".modal-div-13");
const closedMessageX = document.querySelector(".close-message-x");
const messageUserDiv = document.querySelector(".message-users-div");
const navMessageBtn = document.querySelector(".nav-message-btn");
const navMessageBtn1 = document.querySelector(".nav-message-btn-1");
const header_btn3 = document.querySelector(".header-btn3")
const newMessageI = document.querySelector(".new-message-i");


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



addStory_label.addEventListener("change", () => {
  if (addStory_pic.value !== "") {
    addStory_plus.classList.add("hidden");
    addStory_pic.classList.remove("hidden");
  }
});

header_btn1.addEventListener("click", () => {
  modal8.classList.remove("hidden");
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
  modal2.classList.remove("hidden");
});

addStory_exit.addEventListener("click", () => {
  modal8.classList.add("hidden");
});

// edit_label.addEventListener("change", () => {
//   if (edit_input.value !== "") {
//     edit_cover_plus.classList.add("hidden");
//     edit_input.classList.remove("hidden");
//   }
// });

// edit_label1.addEventListener("change", () => {
//   if (edit_input1.value !== "") {
//     edit_profile_plus.classList.add("hidden");
//     edit_input1.classList.remove("hidden");
//   }
// });

// edit_cancel_x.addEventListener("click", () => {
//   modal7.classList.add("hidden");
// });

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

notificationBell1.addEventListener("click", () => {
  window.open(".././notification.php", "_self");
});

cancelNotification.addEventListener("click", () => {
  modal2.classList.add("hidden");
});

searchIcon.addEventListener("click", () => {
  window.open(".././search_file1.php", "_self");
})

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

header_btn3.addEventListener("click", () => {
  window.open("../log_out_folder/log_out.php", "_self");
});

newMessageI.addEventListener("click", () => {
  window.open(".././message.php", "_self");
})

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