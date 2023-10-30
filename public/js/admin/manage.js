/* Display popup */
document.addEventListener("click", function (event) {
    const popupOverlay = document.querySelector('.popup-overlay-edit');

    if (event.target === popupOverlay) {
        popupOverlay.style.display = "none";
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Lấy tham chiếu đến các phần tử
    const addUserBtn = document.getElementById('addUserBtn');
    const addUserPopup = document.getElementById('addUserPopup');
    const addUserForm = document.getElementById('addUserForm');

    // Xử lý sự kiện click để mở/đóng popup
    addUserBtn.addEventListener('click', () => {
        addUserPopup.style.display = 'block';
    });

    addUserPopup.addEventListener('click', (event) => {
        if (event.target === addUserPopup) {
            addUserPopup.style.display = 'none';
        }
    });

});

// Define variable "currentId" to assign value
let currentUserId;

const openPopupButtons = document.querySelectorAll('.open-popup-button');
const popupOverlayEdit = document.querySelector('.popup-overlay-edit');
openPopupButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        console.log(userId)
        const xhr = new XMLHttpRequest();
        const url = `api/user/${userId}`;
        xhr.open('GET', url, 'true');

        xhr.onload = function () {
            if (xhr.status === 200) {
                const userData = JSON.parse(xhr.responseText);
                console.log(userData);

                const editUserIdInput = document.getElementById('editUserId');
                const editRoleSelect = document.getElementById('editRole');
                const editEmailInput = document.getElementById('editEmail');
                const editNameInput = document.getElementById('editName');

                editUserIdInput.value = userData.id;
                editNameInput.value = userData.name;
                editEmailInput.value = userData.email;
                editRoleSelect.value = userData.role;

            } else {
                console.error('Failed to fetch User data');
            }
        }
        xhr.send();
        popupOverlayEdit.style.display = "block";
    });
});

