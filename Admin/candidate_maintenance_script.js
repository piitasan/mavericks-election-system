document.querySelectorAll('.candidate-form select').forEach(select => {
    select.addEventListener('focus', () => {
        select.style.transition = 'transform 0.3s';
    });

    select.addEventListener('blur', () => {
        select.style.transform = 'rotateX(0deg)';
    });
});

document.getElementById('preview').style.display = 'block';

document.getElementById('candidate_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('candidateImagePreviewAdd').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

window.addEventListener('DOMContentLoaded', () => {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.classList.add('show');

        setTimeout(() => {
            notification.classList.remove('show');
        }, 2000);
    }
});
