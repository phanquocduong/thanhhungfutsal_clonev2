// Chọn tất cả tiêu đề tab và nội dung tab
const tabTitles = document.querySelectorAll('.tab-title__item');
const tabContents = document.querySelectorAll('.tab-title__content');

// Hàm xóa class 'active' khỏi tất cả tiêu đề và nội dung
function clearActiveClasses() {
    tabTitles.forEach(title => title.classList.remove('tab-title__item--active'));
    tabContents.forEach(content => content.classList.remove('tab-title__content--active'));
}

// Thêm sự kiện click cho từng tiêu đề tab
tabTitles.forEach((title, index) => {
    title.addEventListener('click', () => {
        // Xóa class 'active' trước đó
        clearActiveClasses();

        // Thêm class 'active' cho tab tiêu đề và nội dung hiện tại
        title.classList.add('tab-title__item--active');
        tabContents[index].classList.add('tab-title__content--active');
    });
});

const imgArr = document.querySelectorAll('.extra-images__item');
let index = 0;
function down() {
    index++;
    if (index == imgArr.length) {
        index = 0;
    }
    document.querySelector('.main-image-item').setAttribute('src', imgArr[index].src);
}
function up() {
    index--;
    if (index < 0) {
        index = imgArr.length - 1;
    }
    document.querySelector('.main-image-item').setAttribute('src', imgArr[index].src);
}

function changeMainImage(x) {
    var imgElement = x.getAttribute('src');
    var mainImg = document.querySelector('.main-image-item');
    mainImg.setAttribute('src', imgElement);
}

const sizeSelectors = document.querySelectorAll('.size-selection__item');
sizeSelectors.forEach(item => {
    item.addEventListener('click', () => {
        sizeSelectors.forEach(item => item.classList.remove('size-selection__item--selected'));
        item.classList.add('size-selection__item--selected');
    });
});

// Cập nhật số lượng sản phẩm
function updateQuantity(num) {
    let quantity = document.querySelector('.quantity-selection__action-edit');

    if (num > 0) {
        quantity.value = ++quantity.value;
    }

    if (num < 0 && quantity.value > 1) {
        quantity.value = --quantity.value;
    }
}

// Mở modal hiển thị ảnh lớn
function openImageModal(image) {
    const imageModalDisplay = document.querySelector('.image-modal__display');
    imageModalDisplay.src = image.src;
    imageModalDisplay.parentElement.classList.add('image-modal--active');
}

// Đóng modal khi người dùng click đóng
function closeImageModal() {
    document.querySelector('.image-modal').classList.remove('image-modal--active');
}

// Thêm vào giỏ hàng
document.querySelector('.add-basket-btn__title').addEventListener('click', function () {
    const id = this.getAttribute('data-product-id');
    const sizeElement = document.querySelector('.size-selection__item--selected');
    let size;
    if (sizeElement) {
        size = sizeElement.innerText;
    } else {
        size = null;
    }
    const quantity = document.querySelector('.quantity-selection__action-edit').value;

    fetch('/thanhhungfutsal_v2/add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id, size, quantity })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.header__cart-quantity').textContent = data.cartQuantity;
            }
        })
        .catch(error => console.error('Error:', error));
});
