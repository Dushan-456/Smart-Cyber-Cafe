    const tabs = document.querySelectorAll(".tab");
    const grids = document.querySelectorAll(".menu-grid");

    tabs.forEach(tab => {
      tab.addEventListener("click", () => {
        // Remove active from all tabs
        tabs.forEach(t => t.classList.remove("active"));
        tab.classList.add("active");

        // Show the corresponding grid
        grids.forEach(grid => {
          if (grid.id === tab.dataset.tab) {
            grid.classList.add("active");
          } else {
            grid.classList.remove("active");
          }
        });
      });
    });




     // Show the modal when page loads
  window.onload = function() {
    document.getElementById('loginModal').style.display = 'block';
  };

  // Close modal
  function closeModal() {
    document.getElementById('loginModal').style.display = 'none';
  }

  // Login action (demo)
  function login() {
    const user = document.getElementById('username').value;
    const pass = document.getElementById('password').value;
    alert("Logged in as: " + user);
    closeModal(); // hide modal after login
  }