"use strict";
const searchNav = document.querySelector(".search-icon-1");
const searchNav1 = document.querySelector(".nav-search-icon");
const navImg = document.querySelector(".nav-img");
const notificationNav = document.querySelector(".nav-notification-icon");
const navMessage = document.querySelector(".nav-message-icon");
const tablecellNav = document.querySelector(".nav-table-cell");
const createStoryInput = document.querySelector(".create-story-input");
const createStoryP = document.querySelector(".create-story-p");
const createStoryLabel = document.querySelector(".create-story-label");
const modal2 = document.querySelector(".modal-2");
const createStory_inputDiv = document.querySelector(".create-story-form-div");
const closeCreateStory = document.querySelector(".modal-2-div-1");
const addStoryLabel = document.querySelector(".add-story-label");
const whatOnInput = document.querySelector(".what-on-input");
const whatOnInputDiv = document.querySelector(".what-on-div-input-div");
const createElement = document.createElement("p");
const modal5 = document.querySelector(".modal-div-5");
const moreCancel = document.querySelector(".more-cancel")
const commentDiv = document.querySelector(".comment-div");
const commentContainer = document.querySelector(".comment-container-div");
const commentI = document.querySelectorAll(".comment-btn");
const storyCommentI = document.querySelectorAll(".story-comment-btn");
const modal6 = document.querySelector(".modal-div-6");
const modal6Cancel = document.querySelector(".modal-6-cancel");
const whatOnInput1 = document.querySelector(".what-on-input-1");
const colorPick1 = document.querySelector(".color-pick-1-i");
const colorPick2 = document.querySelector(".color-pick-2-i");
const colorPick3 = document.querySelector(".color-pick-3-i");
const colorPick4 = document.querySelector(".color-pick-4-i");
const colorPick5 = document.querySelector(".color-pick-5-i");
const colorPick6 = document.querySelector(".color-pick-6-i");
const fakeX = document.querySelectorAll(".fake-x");
const fakeXX = document.querySelectorAll('.fake-xx');
const deleteX = document.querySelectorAll(".delete-story");
const deleteXX = document.querySelectorAll(".delete-post");
const deleteXXX = document.querySelectorAll(".delete-story-1");
const deleteXXXX = document.querySelectorAll(".delete-post-1");
const modal7 = document.querySelector(".modal-div-7");
const cancelFakex = document.querySelector(".x-cancel-fake");
const storyTextInput = document.querySelectorAll(".story-text-input");
const storyForm = document.querySelectorAll(".story-form");
const postForm = document.querySelectorAll(".post-form");
const postTextInput = document.querySelectorAll(".post-text-input");
const storyTextInput1 = document.querySelectorAll(".story-text-input-1");
const storyForm1 = document.querySelectorAll(".story-form-1");
const postForm1 = document.querySelectorAll(".post-form-1");
const postTextInput1 = document.querySelectorAll(".post-text-input-1");
const notificationDivBell = document.querySelector(".notification-div-bell");
const notificationBell1 = document.querySelector(".notification-bell-1");
const cancelNotification = document.querySelector(".cancel-notification");
const modal1 = document.querySelector(".modal-div-1");
const notificationBtn = document.querySelector(".notification-btn1");
const notificationDiv = document.querySelector(".notification-div");
const notificationBackBtn = document.querySelector(".personal-back-btn");
const notificationPersonDiv = document.querySelector(".notification-personal-div");
const notificationForwardBtn = document.querySelector(".notification-see-all-btn");
const searchInput = document.querySelector(".search-input-div");
const modal11 = document.querySelector(".modal-div-11");
const searchResultDiv = document.querySelector(".search-result-div");
const searchDiv1 = document.querySelector(".search-div-1");
const searchCancelX = document.querySelector(".search-cancel-x");
const searchRecentDiv = document.querySelector(".search-recent-div");
const searchSeeAllP = document.querySelector(".search-see-all-p");
const searchSeeAllX = document.querySelector(".search-see-all-x");
const modal12 = document.querySelector(".modal-div-12");
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


addStoryLabel.addEventListener("click", () => {
  createStoryInput.classList.remove("hidden");
  whatOnInput.classList.add("hidden");
  whatOnInputDiv.classList.remove("hidden");
  // whatOnInputDiv.appendChild(createStoryInput);
})

createStoryLabel.addEventListener("click", () => {
  createStoryP.classList.add("hidden");
  createStoryInput.classList.remove("hidden");
  createElement.setAttribute("class", "create-story-input");
});

closeCreateStory.addEventListener("click", () => {
  createStoryInput.classList.add("hidden");
  createStoryP.classList.remove("hidden");
  modal2.style.visibility = "hidden";
  whatOnInput.classList.remove("hidden");
  window.location.reload();
});

createStoryInput.addEventListener("change", () => {
  if(createStoryInput.value != "") {
    modal2.style.visibility = "visible";
    createElement.innerHTML = createStoryInput.value;
    createStory_inputDiv.appendChild(createElement);
    createStoryInput.classList.add("hidden");
  }
});

function myFunctionSize(x) {
    if (x.matches) { 
    searchNav.classList.remove("hidden");
    searchNav1.classList.add("hidden");
    notificationNav.classList.add("hidden");
    navMessage.classList.add("hidden");
    tablecellNav.style.display = "unset";
    } else {
    searchNav.classList.add("hidden");
    searchNav1.classList.remove("hidden");
    notificationNav.classList.remove("hidden");
    navMessage.classList.remove("hidden");
    tablecellNav.style.display = "none";
    }
  }

  tablecellNav.addEventListener("click", () => {
    window.open("bookmark.php", "_self");
  });

  searchNav.addEventListener("click", () => {
    window.open(".././search_file1.php", "_self");
  })
  
  // Create a MediaQueryList object
  var x = window.matchMedia("(max-width: 950px)");
  
  // Call listener function at run time
  myFunctionSize(x);
  
  // Attach listener function on state changes
  x.addEventListener("change", function() {
    myFunctionSize(x);
  });

  function iconAnimation(element) {
    element.classList.add("animate__bounce");
  }

  function isOverflown() {
    if (commentContainer.scrollHeight > commentContainer.clientHeight) {
      return true
    }
  } 

  notificationDivBell.addEventListener("click", () => {
    modal1.classList.remove("hidden");
  });

  notificationBell1.addEventListener("click", () => {
    window.open(".././notification.php", "_self");
  })

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
  

  cancelNotification.addEventListener("click", () => {
    modal1.classList.add("hidden");
  });
  
  
function overflowElement() {
  if(isOverflown()) {
    commentDiv.style.overflowY = "hidden";
    commentDiv.style.overflowX = "hidden";
  } else {
    commentDiv.style.overflowY = "scroll";
    commentDiv.style.overflowX = "hidden";
  }
}


moreCancel.addEventListener("click", () => {
  modal5.classList.add("hidden");
})

commentI.forEach(comment => {
  comment.addEventListener("click", () => {
    modal5.classList.remove("hidden");
    overflowElement();
    // isOverflown();
  })
});

storyCommentI.forEach(comment => {
  comment.addEventListener("click", () => {
    modal5.classList.remove("hidden");
    overflowElement();
    // isOverflown();
  })
});

whatOnInput.addEventListener("click", () => {
  modal6.classList.remove("hidden");
})

whatOnInput1.addEventListener("click", () => {
  modal6.classList.remove("hidden");
})

modal6Cancel.addEventListener("click", () => {
  modal6.classList.add("hidden");
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


fakeX.forEach(element_1 => {
  element_1.addEventListener("click", () => {
    fakeX.forEach(element_2 => {
      element_2.classList.add("hidden");
    })
    modal7.classList.remove("hidden")
    deleteX.forEach(element => {
      element.classList.remove("hidden");
    })
  });
});

fakeX.forEach(element_1 => {
  element_1.addEventListener("click", () => {
    fakeX.forEach(element_2 => {
      element_2.classList.add("hidden");
    })
    modal7.classList.remove("hidden")
    deleteXXX.forEach(element => {
      element.classList.remove("hidden");
    })
  });
});


fakeXX.forEach(element_1 => {
  element_1.addEventListener("click", () => {
    fakeXX.forEach(element_2 => {
      element_2.classList.add("hidden");
    })
    modal7.classList.remove("hidden")
    deleteXX.forEach(element => {
      element.classList.remove("hidden");
    })
  });
});

fakeXX.forEach(element_1 => {
  element_1.addEventListener("click", () => {
    fakeXX.forEach(element_2 => {
      element_2.classList.add("hidden");
    })
    modal7.classList.remove("hidden")
    deleteXXXX.forEach(element => {
      element.classList.remove("hidden");
    })
  });
});


cancelFakex.addEventListener("click", () => {
  modal7.classList.add("hidden");
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

storyForm1.forEach(element => {
  element.addEventListener("submit", () => {
  const timesubmit = setInterval(() => {
  
      storyTextInput1.forEach(element1 => {
        element1.value = "";
      });
      clearInterval(timesubmit);
    }, 1000);

  });
});

postForm1.forEach(element => {
  element.addEventListener("submit", () => {
  const timesubmit = setInterval(() => {
  
      postTextInput1.forEach(element1 => {
        element1.value = "";
      });
      clearInterval(timesubmit);
    }, 1000);

  });
});