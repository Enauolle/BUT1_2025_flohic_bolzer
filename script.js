const popup = document.getElementById('formPopup');
const openBtn = document.getElementById('openFormBtn');
const closeBtn = document.getElementById('closePopup');

openBtn.addEventListener('click', () => {
    popup.classList.remove('popup-hidden');
    popup.classList.add('popup-visible');
});

closeBtn.addEventListener('click', () => {
    popup.classList.remove('popup-visible');
    popup.classList.add('popup-hidden');
});

window.addEventListener('click', (e) => {
    if (e.target === popup) {
        popup.classList.remove('popup-visible');
        popup.classList.add('popup-hidden');
    }
});
