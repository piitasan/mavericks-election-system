function toggleDropdown() {
    document.getElementById("profileDropdown").classList.toggle("show");
}

function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("active");
}

window.onclick = function(event) {
    if (!event.target.matches('.profile-img')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
document.addEventListener('DOMContentLoaded', () => {
  const blocks = document.querySelectorAll('.notification-block');

  blocks.forEach(block => {
    const header = block.querySelector('h3');
    header.addEventListener('click', () => {
      block.classList.toggle('active');
    });
  });
});
