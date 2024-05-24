function goBack() {
    location.href = "../index.php";
}
function notif() {
    location.href = "notification.php";
}
function profile() {
    location.href = "profile.php";
}
function dashboard() {
  location.href = "dashboard.php";
}
function admin_dashboard() {
  location.href = "admin_dashboard.php";
}
function pending() {
  location.href = "pending.php";
}
function edit() {
  location.href = "editProfile.php";
}
function indigency() {
  location.href = "indigency.php";
}
function login() {
    var inpot1 = form.email.value;
    var inpot2 = form.pass.value;
    if(inpot1 === "admin@gmail.com" && inpot2 === "admin") {
        location.href = "hyperlinks/dashboard.html";
    }
    else {
        alert("Something went wrong!");
    }
}
function popup() {
  document.getElementById('popup').style.display = 'block';
}
function closeee() {
  document.getElementById('popup').style.display = 'none';
}
function popup1() {
  document.getElementById('popup1').style.display = 'block';
}
function closeee1() {
  document.getElementById('popup1').style.display = 'none';
}
document.getElementById('open-popup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'block';
  });
  
  document.getElementById('close-popup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none';
  });
  document.getElementById('open-popup1').addEventListener('click', function() {
    document.getElementById('popup1').style.display = 'block';
  });
  
  document.getElementById('close-popup1').addEventListener('click', function() {
    document.getElementById('popup1').style.display = 'none';
  });
  function clek() {
    document.getElementById('fileInput').click();
}

function uploadFile(event) {
    const file = event.target.files[0];
    console.log('File uploaded:', file.name);
    // You can add further processing logic here, for example:
    // display the image
    const reader = new FileReader();
    reader.onload = function() {
        const imgElement = document.getElementById('image');
        imgElement.src = reader.result;
    }
    reader.readAsDataURL(file);
}
function downloadPDF(id) {
  document.getElementById("pdfInput").value = id;
  document.getElementById("pdfSubmit").click();
}
function downloadImg(id) {
  document.getElementById("pdfInput1").value = id;
  document.getElementById("pdfSubmit1").click();
}
function downloadImgg(id) {
  document.getElementById("pdfInput2").value = id;
  document.getElementById("pdfSubmit2").click();
}
function accept(id) {
  document.getElementById("pdfInput3").value = id;
}
function accept1(id) {
  document.getElementById("pdfInput31").value = id;
  document.getElementById("accept").click();
}
function decline(id) {
  document.getElementById("pdfInput4").value = id;
}
function decline1(id) {
  document.getElementById("pdfInput41").value = id;
  document.getElementById("decline").click();
}
function clk() {
  document.getElementById("clk").click();
}
function clkk() {
  document.getElementById("clkk").click();
}
function completee(id) {
  document.getElementById("pdfInput5").value = id;
}
function complete1(id) {
  document.getElementById("pdfInput51").value = id;
  document.getElementById("complete").click();
}
function deletee(id) {
  document.getElementById("pdfInput6").value = id;
}
function deletee1(id) {
  document.getElementById("pdfInput61").value = id;
  document.getElementById("delete").click();
}
function in_proc() {
  location.href = "in_proc.php";
}
function completed() {
  location.href = "completed.php";
}
function userm() {
  location.href = "users.php";
}
function usermanage() {
  location.href = "user_management.php";
}
function anotif() {
  location.href = "admin_notification.php";
}
function submit() {
  document.getElementById("submit").click();
}
function change(checkbox) {
  var medicalElements = document.getElementsByClassName("medical");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change1(checkbox) {
  var medicalElements = document.getElementsByClassName("financial");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change2(checkbox) {
  var medicalElements = document.getElementsByClassName("burial");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change3(checkbox) {
  var medicalElements = document.getElementsByClassName("pao");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change4(checkbox) {
  var medicalElements = document.getElementsByClassName("educ");

 if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change5(checkbox) {
  var medicalElements = document.getElementsByClassName("good");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change6(checkbox) {
  var medicalElements = document.getElementsByClassName("residency");

 if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change7(checkbox) {
  var medicalElements = document.getElementsByClassName("guard");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change8(checkbox) {
  var medicalElements = document.getElementsByClassName("solo");

 if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change9(checkbox) {
  var medicalElements = document.getElementsByClassName("pwd");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function change10(checkbox) {
  var medicalElements = document.getElementsByClassName("garage");

if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
}
  }
}
function change11(checkbox) {
  var medicalElements = document.getElementsByClassName("build");

  if (checkbox.checked) {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "block";
          medicalElements[i].setAttribute('required', 'required');
      }
  } else {
      for (var i = 0; i < medicalElements.length; i++) {
          medicalElements[i].style.display = "none";
          medicalElements[i].removeAttribute('required');
      }
  }
}
function popup1(id) {
  document.getElementById('popup').style.display = 'block';
  document.getElementById("hello").value = id;
}