// Cập nhật số lượng sản phẩm
function updateQuantity(button, delta) {
    const form = button.closest('.quantity-form');
    const quantityInput = form.querySelector('.quantity');
    const quantityValue = parseInt(quantityInput.value) + delta;
    const index = form.querySelector('input[name="index"]').value;

    if (quantityValue > 0) {
        quantityInput.value = quantityValue;

        fetch('/thanhhungfutsal_v2/update-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                index: index,
                quantity: quantityValue
            })
        })
            .then(response => response.json())
            .then(data => {
                const lineTotalElement = document.querySelector(`.line-item-total[data-index="${index}"]`);
                const grandTotalElement = document.querySelector('.total-price');
                if (lineTotalElement) {
                    lineTotalElement.textContent =
                        parseFloat(data.lineTotal)
                            .toFixed(0)
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '₫';
                }
                if (grandTotalElement) {
                    grandTotalElement.textContent =
                        parseFloat(data.grandTotal)
                            .toFixed(0)
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '₫';
                }
                document.querySelector('.header__cart-quantity').textContent = data.cartQuantity;
            })
            .catch(error => {
                console.error('Error updating cart:', error);
            });
    }
}

// Giảm số lượng sản phẩm
function decreaseQuantityInCart(button) {
    updateQuantity(button, -1);
}

// Tăng số lượng sản phẩm
function increaseQuantityInCart(button) {
    updateQuantity(button, 1);
}

// Xóa sản phẩm khỏi giỏ hàng
function deleteProduct(index) {
    const confirm = confirm('Bạn có chắc chắn muốn xóa không?');
    if (confirm) {
        window.location.href = `/thanhhungfutsal_v2/delete-cart/${index}`;
    }
}
