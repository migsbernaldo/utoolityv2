fetch("http://iot.comteq.edu.ph")
  .then(response => {
    if (response.ok) {
      // http://iot.comteq.edu.ph is available
      console.log("http://iot.comteq.edu.ph:50001 is working");
      // Perform any desired actions
    } else {
      // http://iot.comteq.edu.ph is not available
      console.log("http://iot.comteq.edu.ph:50001 is not working");
      // Perform any desired actions
    }
  })
  .catch(error => {
    // An error occurred while checking availability
    console.error("Error:", error);
    // Perform any desired actions
  });
////////////////////////////////////////commands that send to Arduino//////////////////////////////////////////////////////////////
///////////////////////////desktop//////////////////////////////////
const ACUBreakerButton = document.getElementById("ACUBreakerButton");
ACUBreakerButton.addEventListener("click", function() {
  toggleButton(ACUBreakerButton);
});

const LightBreakerButton = document.getElementById("LightBreakerButton");
LightBreakerButton.addEventListener("click", function() {
  toggleButton(LightBreakerButton);
});

const RemoteButton = document.getElementById("RemoteButton");
RemoteButton.addEventListener("click", function() {
  toggleButton(RemoteButton);
});

const TempIncButton = document.getElementById("TempIncButton");
TempIncButton.addEventListener("click", function() {
  toggleButton(TempIncButton);
});

const TempDecButton = document.getElementById("TempDecButton");
TempDecButton.addEventListener("click", function() {
  toggleButton(TempDecButton);
});

const PairingButton = document.getElementById("PairingButton");
PairingButton.addEventListener("click", function() {
  toggleButton(PairingButton);
});

///////////////////////////mobile//////////////////////////////////
const ACUBreakerButtonM = document.getElementById("ACUBreakerButtonM");
ACUBreakerButtonM.addEventListener("click", function() {
  toggleButton(ACUBreakerButtonM);
});

const LightBreakerButtonM = document.getElementById("LightBreakerButtonM");
LightBreakerButtonM.addEventListener("click", function() {
  toggleButton(LightBreakerButtonM);
});

const RemoteButtonM = document.getElementById("RemoteButtonM");
RemoteButtonM.addEventListener("click", function() {
  toggleButton(RemoteButtonM);
});

const TempIncButtonM = document.getElementById("TempIncButtonM");
TempIncButtonM.addEventListener("click", function() {
  toggleButton(TempIncButtonM);
});

const TempDecButtonM = document.getElementById("TempDecButtonM");
TempDecButtonM.addEventListener("click", function() {
  toggleButton(TempDecButtonM);
});

const PairingButtonM = document.getElementById("PairingButtonM");
PairingButtonM.addEventListener("click", function() {
  toggleButton(PairingButtonM);
});
//////////////////////////////////////////////////////////////////////////
function toggleButton(button) {
  const isButtonOn = button.style.backgroundColor === "rgb(21, 115, 71)";
  let message = "";

  if (
    button.id === "LightBreakerButton" ||
    button.id === "LightBreakerButtonM"
  ) {
    message = isButtonOn ? "lightsOff" : "lightsOn";
  } else if (
    button.id === "ACUBreakerButton" ||
    button.id === "ACUBreakerButtonM"
  ) {
    message = isButtonOn ? "acuOff" : "acuOn";
  } else if (button.id === "RemoteButton" || button.id === "RemoteButtonM") {
    message = isButtonOn ? "remoteOff" : "remoteOn";
  } else if (button.id === "TempIncButton" || button.id === "TempIncButtonM") {
    message = "tempInc";
  } else if (button.id === "TempDecButton" || button.id === "TempDecButtonM") {
    message = "tempDec";
  } else if (button.id === "PairingButton" || button.id === "PairingButtonM") {
    showLoadingAnimation();
    message = "pairing";
  }

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `http://iot.comteq.edu.ph:50001?${encodeURIComponent(message)}`,
    true
  );
  xhr.send();
}

////////////////////////////////////////coloring based on last state data//////////////////////////////////////////////////////////////
fetch("http://iot.comteq.edu.ph/iot/php_color/acu.php")
  .then(response => response.text())
  .then(data => {
    const state = data.trim().toLowerCase();
    const color =
      state === "1"
        ? "rgb(21, 115, 71)" // On color
        : "rgb(172, 6, 0)"; // Off color
    ACUBreakerButton.style.backgroundColor = color;
    ACUBreakerButtonM.style.backgroundColor = color;
    const acuButton = document.getElementById("ACUBreakerButton");
    const acuButtonM = document.getElementById("ACUBreakerButtonM");
    if (
      acuButton.style.backgroundColor === "rgb(172, 6, 0)" ||
      acuButtonM.style.backgroundColor === "rgb(172, 6, 0)"
    ) {
      RemoteButton.disabled = true;
      TempIncButton.disabled = true;
      TempDecButton.disabled = true;
      PairingButton.disabled = true;
      RemoteButtonM.disabled = true;
      TempIncButtonM.disabled = true;
      TempDecButtonM.disabled = true;
      PairingButtonM.disabled = true;
    }
  })
  .catch(error => console.error(error));

fetch("http://iot.comteq.edu.ph/iot/php_color/lights.php")
  .then(response => response.text())
  .then(data => {
    const state = data.trim().toLowerCase();
    const color =
      state === "3"
        ? "rgb(21, 115, 71)" // On color
        : "rgb(172, 6, 0)"; // Off color
    LightBreakerButton.style.backgroundColor = color;
    LightBreakerButtonM.style.backgroundColor = color;
  })
  .catch(error => console.error(error));

fetch("http://iot.comteq.edu.ph/iot/php_color/remote.php")
  .then(response => response.text())
  .then(data => {
    const state = data.trim().toLowerCase();
    const color =
      state === "5"
        ? "rgb(21, 115, 71)" // On color
        : "rgb(172, 6, 0)"; // Off color .remote-icon
    RemoteButton.style.backgroundColor = color;
    RemoteButtonM.style.backgroundColor = color;

    if (
      RemoteButton.style.backgroundColor === "rgb(21, 115, 71)" ||
      RemoteButton.style.backgroundColor === "rgb(21, 115, 71)"
    ) {
      ACUBreakerButton.disabled = true;
      ACUBreakerButtonM.disabled = true;
    } else if (
      RemoteButton.style.backgroundColor === "rgb(172, 6, 0)" ||
      RemoteButton.style.backgroundColor === "rgb(172, 6, 0)"
    ) {
      TempIncButton.disabled = true;
      TempDecButton.disabled = true;
      PairingButton.disabled = true;
      TempIncButtonM.disabled = true;
      TempDecButtonM.disabled = true;
      PairingButtonM.disabled = true;
    }
  })
  .catch(error => console.error(error));

//////////////////////////////////////////temparature based on last data///////////////////////////////////////////////////////////
const tempUrl = "http://iot.comteq.edu.ph/iot/php_color/temp-value.php";
fetch(tempUrl)
  .then(response => response.text())
  .then(data => {
    const temp = parseFloat(data.trim());
    document.getElementById("temp-val-d").textContent = ` ${temp}`;
    document.getElementById("temp-val-m").textContent = ` ${temp}`;

    // Disable button if temp is 17
    if (temp === 17) {
      const buttonDec = document.getElementById("TempDecButton");
      buttonDec.disabled = true;
      const buttonDecM = document.getElementById("TempDecButtonM");
      buttonDecM.disabled = true;
    }
    // Disable button if temp is 30
    if (temp === 30) {
      const buttonInc = document.getElementById("TempIncButton");
      buttonInc.disabled = true;
      const buttonIncM = document.getElementById("TempIncButtonM");
      buttonIncM.disabled = true;
    }
  })
  .catch(error => console.error(error));

//////////////////////////////////////////this is for generating logs /////////////////////////////////////////////////////
function downloadCSV() {
  $.getJSON("http://iot.comteq.edu.ph/iot/json/all.json", function(data) {
    var csvContent =
      "data:text/csv;charset=utf-8," + Object.keys(data[0]).join(",") + "\r\n";

    data.forEach(function(item) {
      csvContent += Object.values(item).join(",") + "\r\n";
    });

    var link = document.createElement("a");
    link.href = encodeURI(csvContent);
    link.download = "data_logs.csv";
    link.style.display = "none";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });
}

////////////////////////////////////////////loading animation for pairing//////////////////////////////////////////////////////////////////////////////
function showLoadingAnimation() {
  var loadingContainer = document.getElementById("loading-container");
  loadingContainer.style.display = "flex";
  setTimeout(function() {
    loadingContainer.style.display = "none";
    window.location.replace("http://iot.comteq.edu.ph/iot/ui.php");
  }, 16000); // 15 seconds
}

//////////////////////////////////full name of the user//////////////////////////////////////////////////////////////////////////////////////////
const fullname = "http://iot.comteq.edu.ph/iot/php_color/fname.php";
fetch(fullname)
  .then(response => response.text())
  .then(data => {
    const user = data.trim();
    document.getElementById("user").textContent = ` ${user}`;
    document.getElementById("user-mobile").textContent = ` ${user}`;
  })
  .catch(error => console.error(error));
