document.addEventListener('DOMContentLoaded', function () {
    const wishlistButtons = document.querySelectorAll('.cart-btn');

    wishlistButtons.forEach(button => {
        button.addEventListener('click', function () {
            const idOlehOleh = this.getAttribute('data-id');
            addTocart(idOlehOleh);
        });
    });
});

function addTocart(idOlehOleh) {
    fetch('process_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_oleh_oleh: idOlehOleh })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Item berhasil ditambahkan ke keranjang.', 'success');
        } else {
            showNotification('Gagal menambahkan item ke keranjang: ' + data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Terjadi kesalahan: ' + error, 'error');
    });
}



function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerText = message;

    document.body.appendChild(notification);

    // Hapus notifikasi setelah beberapa detik
    setTimeout(() => {
        notification.remove();
    }, 2000);
}
