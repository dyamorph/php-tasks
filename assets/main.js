const deleteBtns = document.querySelectorAll('.delete-btn');

deleteBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        window.confirm('Удалить пользователя?');
    })
})