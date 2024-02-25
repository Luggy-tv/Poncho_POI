const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

function obtenerLocalizacion() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;

        var mensajeLocalizacion = `Esta es mi ubicación actual! Latitud ${latitud}, Longitud ${longitud}`;
        var mapaLink = `https://www.google.com/maps?q=${latitud},${longitud}`;
        mensajeLocalizacion += `<br> Ver en el mapa: <a href="${mapaLink}" target="_blank">Abrir en Google Maps</a>`;

        document.getElementById("messageInput").value = mensajeLocalizacion;
        sendBtn.classList.add("active");
      },
      function (error) {
        console.error("Error al obtener la ubicación:", error);
      }
    );
  } else {
    alert("La geolocalización no está soportada por este navegador.");
  }
}

form.onsubmit = (e) => {
  e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        scrollToBottom();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id=" + incoming_id);
}, 500);

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

function abrirModal() {
  document.getElementById("myModal").style.display = "block";
}

function cerrarModal() {
  document.getElementById("myModal").style.display = "none";
}

function enviarCorreo() {
  var asunto = document.getElementById("asunto").value;
  var mensaje = document.getElementById("mensaje").value;
  var incoming_id = document.getElementById("incoming_id").value;

  var datosCorreo = {
    asunto: asunto,
    mensaje: mensaje,
    incoming_id: incoming_id
  };

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/correo.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {
          console.log(data);
        } else {
          console.log(data);

        }
      }
    }
  };
  xhr.send(JSON.stringify(datosCorreo));


  cerrarModal();
}
