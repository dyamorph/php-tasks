const deleteBtns = document.querySelectorAll('.users-table-delete-btn');

deleteBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        window.confirm('Удалить пользователя?');
    })
})