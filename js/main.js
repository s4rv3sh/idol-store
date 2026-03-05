const CURRENCY = '₹';

// Format price utility
function formatPrice(price) {
    return CURRENCY + parseFloat(price).toFixed(2);
}

// Ensure images have a fallback
function handleImageError(img) {
    img.onerror = null; // Prevent infinite loops
    img.src = 'images/placeholder.svg';
}

// Cart State Management via LocalStorage
const CartManager = {
    getCart: function () {
        const cart = localStorage.getItem('idol_cart');
        return cart ? JSON.parse(cart) : {};
    },
    saveCart: function (cart) {
        localStorage.setItem('idol_cart', JSON.stringify(cart));
        this.updateCartBadge();
    },
    addItem: function (productId, quantity = 1) {
        const cart = this.getCart();
        cart[productId] = (cart[productId] || 0) + quantity;
        this.saveCart(cart);
    },
    updateItem: function (productId, quantity) {
        const cart = this.getCart();
        if (quantity <= 0) {
            delete cart[productId];
        } else {
            cart[productId] = quantity;
        }
        this.saveCart(cart);
    },
    removeItem: function (productId) {
        const cart = this.getCart();
        delete cart[productId];
        this.saveCart(cart);
    },
    clearCart: function () {
        localStorage.removeItem('idol_cart');
        this.updateCartBadge();
    },
    getCartCount: function () {
        const cart = this.getCart();
        let count = 0;
        for (const id in cart) {
            count += cart[id];
        }
        return count;
    },
    updateCartBadge: function () {
        const badge = document.querySelector('.cart-badge');
        const count = this.getCartCount();

        if (count > 0) {
            if (badge) {
                badge.textContent = count;
            } else {
                const navCart = document.querySelector('.nav-cart');
                if (navCart) {
                    const newBadge = document.createElement('span');
                    newBadge.className = 'cart-badge';
                    newBadge.textContent = count;
                    navCart.appendChild(newBadge);
                }
            }
        } else {
            if (badge) {
                badge.remove();
            }
        }
    }
};

// Initialize common UI elements like cart badge
document.addEventListener('DOMContentLoaded', () => {
    CartManager.updateCartBadge();
});
