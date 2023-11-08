document.addEventListener("DOMContentLoaded", function () {
  getuserlist();
});

const form = document.querySelector("form"), errorText = form.querySelector(".error-text");

//Form send to create the group
document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault();

  const selectedCheckboxes = document.querySelectorAll(
    'input[name="selected_users[]"]:checked'
  );

  if (selectedCheckboxes.length === 0) {
    alert("Debes seleccionar al menos un usuario para agregar al grupo.");
  } else {

    const selectedUserIds = [];

    

    selectedCheckboxes.forEach(function (checkbox) {
      const userId = checkbox.value;
      selectedUserIds.push(userId);
    });

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signupGroup.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          if (data === "success") {
            location.href = "users.php";
          } else {
            errorText.style.display = "block";
            errorText.textContent = data;
          }
        }
      }
    };
    let formData = new FormData(form);
    formData.append("selected_users", selectedUserIds.join(","));

    xhr.send(formData);
  }
});

usersList = document.querySelector(".users-list");

//Function to get current users in the chat app
function getuserlist() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/userlistCreateGroup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  };
  xhr.send();
}
