var modalSearch = document.querySelector(".modal-search");
var searchLink = document.querySelector(".search-hover");
var loginLink = document.querySelector(".login-hover");
var modalLogin = document.querySelector(".modal-login");
var bucketLink = document.querySelector(".bucket-hover");
var modalBucket = document.querySelector(".modal-bucket");
var contactButton = document.querySelector(".contact-form-button");
var modalFeedback = document.querySelector(".modal-feedback");
var modalclose = document.querySelector(".modal-close");
var email = document.querySelector(".user-email");
var form = document.querySelector(".login-form");
var wrapperForm=document.querySelector(".modal-login-wrapper")
var feedbackForm = document.querySelector(".feedback-form");
var feedname = feedbackForm.querySelector("[name=name]");
var feedMail = feedbackForm.querySelector("[name=email]");
var feedText = feedbackForm.querySelector("[name=feedback-text]");
var password = document.querySelector(".user-password");
var overlay = document.querySelector(".overlay");
var isStorageSupport = true;
var storage = "";
var registerButton = document.querySelector(".registration-user");
var registerForm = document.querySelector(".modal-reg");
try {
  storage = localStorage.getItem("email");
} catch (err) {
  isStorageSupport = false;
}


searchLink.addEventListener("click", function (evt) {
  evt.preventDefault();
  modalSearch.classList.add("modal-show-search");
});
window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (modalSearch.classList.contains("modal-show-search")) {
      modalSearch.classList.remove("modal-show-search");
      modalSearch.classList.remove("modal-error");
    }
  }
});

loginLink.addEventListener("click", function (evt) {
  modalLogin.classList.add("modal-show-login");
});
registerButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  registerForm.classList.add("modal-show-feedback");
  overlay.classList.add("overlay-show");
  if (modalLogin.classList.contains("modal-show-login")) {
    modalLogin.classList.remove("modal-show-login");
    modalLogin.classList.remove("modal-error");
  }
});
form.addEventListener("submit", function (evt) {
  if (!email.value || !password.value) {
    evt.preventDefault();
    wrapperForm.classList.remove("modal-error");
    wrapperForm.offsetWidth = wrapperForm.offsetWidth;
    wrapperForm.classList.add("modal-error");
    if (storage) {
      email.value = storage;
      password.focus();
    } else {
      password.focus();
    }
  } else {
    if (isStorageSupport) {
      localStorage.setItem("email", email.value);
    }
  }
});

window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (modalLogin.classList.contains("modal-show-login")) {
      modalLogin.classList.remove("modal-show-login");
      modalLogin.classList.remove("modal-error");
    }
  }
});
bucketLink.addEventListener("click", function (evt) {
  evt.preventDefault();
  modalBucket.classList.add("modal-show-bucket");
});
window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();
    if (modalBucket.classList.contains("modal-show-bucket")) {
      modalBucket.classList.remove("modal-show-bucket");
      modalBucket.classList.remove("modal-show-bucket");
    }
  }

});

contactButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  modalFeedback.classList.add("modal-show-feedback");
  overlay.classList.add("overlay-show");

});


feedbackForm.addEventListener("submit", function (evt) {
  if (!feedname.value || !feedMail.value || !feedText.value) {
    evt.preventDefault();
    feedbackForm.classList.remove("modal-error");
    feedbackForm.offsetWidth = feedbackForm.offsetWidth;
    feedbackForm.classList.add("modal-error");
  }
});


modalclose.addEventListener("click", function (evt) {
  evt.preventDefault();
  modalFeedback.classList.remove("modal-show-feedback");
  overlay.classList.remove("overlay-show");
});