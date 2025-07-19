window.addEventListener("load", () => {
    document.getElementById("preloader").style.display = "none";
});

const messages = [
    "Welcome to UniVote: a Digital Ballot Management System",
    "Developed by Driven by Maverick Studios",
    "Make A Meaningful Vote.",
    "Make A Meaningful Change."
];

let index = 0;
let charIndex = 0;
let isDeleting = false;
const baseSpeed = window.innerWidth <= 768 ? 40 : 60;
const pause = 1500;
const typewriterText = document.getElementById("typewriter-text");

function typeEffect() {
    const currentText = messages[index];

    typewriterText.style.opacity = "1";

    if (isDeleting) {
        typewriterText.textContent = currentText.substring(0, charIndex--);
        if (charIndex < 0) {
            isDeleting = false;
            index = (index + 1) % messages.length;
            setTimeout(typeEffect, 500);
        } else {
            setTimeout(typeEffect, baseSpeed / 2);
        }
    } else {
        typewriterText.textContent = currentText.substring(0, charIndex++);
        if (charIndex > currentText.length) {
            isDeleting = true;
            setTimeout(typeEffect, pause);
        } else {
            setTimeout(typeEffect, baseSpeed);
        }
    }
}

window.addEventListener("load", () => {
    setTimeout(typeEffect, 800);
});
