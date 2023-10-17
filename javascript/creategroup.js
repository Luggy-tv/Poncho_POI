document.addEventListener("DOMContentLoaded", function () {
  getuserlist();
});

document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault(); 
  const selectedCheckboxes = document.querySelectorAll(
    'input[name="selected_users[]"]:checked'
  );

  if (selectedCheckboxes.length === 0) {
    alert("Debes seleccionar al menos un usuario para agregar al grupo.");
  } else {selectedCheckboxes.forEach(function (checkbox) {
    const userId = checkbox.value;
    const userName = checkbox.parentElement.querySelector('span').textContent;
    console.log(`ID del usuario: ${userId}, Nombre del usuario: ${userName}`);
});
    
    // Si al menos un usuario está seleccionado, puedes continuar con la solicitud AJAX
    // Aquí puedes agregar tu código para realizar la solicitud AJAX
    // Por ejemplo:
    // - Obtener los valores de los checkboxes seleccionados
    // - Enviar los datos al servidor
    // - Procesar la respuesta del servidor
  }
});

usersList = document.querySelector(".users-list");

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
