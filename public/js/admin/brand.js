document.addEventListener('DOMContentLoaded', () => {
    const editBrandButtons = document.querySelectorAll('.edit-Brand-btn');
    const popupOverlay = document.querySelector('.popup-overlay');
    const closeOverlayButton = document.querySelector('.close-overlay-button');
    const editBrandForm = document.getElementById('editBrandForm');
    const BrandIdInput = document.getElementById('Brand_id');
    const nameInput = document.getElementById('name');

    popupOverlay.addEventListener('click', (event) => {
        if (event.target === popupOverlay) {
            popupOverlay.style.display = 'none';
        }
    });

    editBrandButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.parentNode.parentNode;
            const BrandId = button.getAttribute('data-id');
            const BrandName = row.querySelector('.name').textContent;

            BrandIdInput.value = BrandId;
            nameInput.value = BrandName;

            popupOverlay.style.display = 'block';
        });
    });
});

//Add Brand popup
document.addEventListener('DOMContentLoaded', () => {
    // Lấy tham chiếu đến các phần tử
    const addBrandBtn = document.getElementById('addBrandBtn');
    const addBrandPopup = document.getElementById('addBrandPopup');
    const addBrandForm = document.getElementById('addBrandForm');

    // Xử lý sự kiện click để mở/đóng popup
    addBrandBtn.addEventListener('click', () => {
        addBrandPopup.style.display = 'block';
    });

    addBrandPopup.addEventListener('click', (event) => {
        if (event.target === addBrandPopup) {
            addBrandPopup.style.display = 'none';
        }
    });

});
