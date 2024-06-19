document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("myModal");
    const btn = document.getElementById("logouserBtn");
    const span = document.getElementsByClassName("close")[0];
    const logoutBtn = document.getElementById("logoutBtn");
  
    btn.onclick = function () {
      modal.style.display = "block";
    }
  
    span.onclick = function () {
      modal.style.display = "none";
    }
  
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  
    logoutBtn.onclick = function () {
      alert("Wylogowany");
      modal.style.display = "none";
      window.location.href = 'stronalogowania.html';
    }
  });
  