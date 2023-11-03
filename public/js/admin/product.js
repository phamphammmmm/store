//Add Product popup
document.addEventListener('DOMContentLoaded', () => {
    // Lấy tham chiếu đến các phần tử
    const addProductBtn = document.getElementById('addProductBtn');
    const addProductPopup = document.getElementById('addProductPopup');
    const addProductForm = document.getElementById('addProductForm');

    // Xử lý sự kiện click để mở/đóng popup
    addProductBtn.addEventListener('click', () => {
        addProductPopup.style.display = 'block';
    });

    addProductPopup.addEventListener('click', (event) => {
        if (event.target === addProductPopup) {
            addProductPopup.style.display = 'none';
        }
    });

});

