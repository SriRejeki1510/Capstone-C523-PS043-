function redirectToPage(time) {
    // Ganti 'nama_halaman.html' dengan nama halaman yang diinginkan
    window.location.href = 'nama_halaman.html?time=' + time;
}

// Tambahkan event listener untuk setiap tombol
document.getElementById('button6Jam').addEventListener('click', function () {
    redirectToPage(6);
});

document.getElementById('button8Jam').addEventListener('click', function () {
    redirectToPage(8);
});

document.getElementById('button10Jam').addEventListener('click', function () {
    redirectToPage(10);
});

document.getElementById('button12Jam').addEventListener('click', function () {
    redirectToPage(12);
});

document.getElementById('button14Jam').addEventListener('click', function () {
    redirectToPage(14);
});

document.getElementById('button16Jam').addEventListener('click', function () {
    redirectToPage(16);
});