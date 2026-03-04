let nomor = 1;

// memuat tabel agar dapat bertambah, namun belum terkoneksi ke database
function tambahBooking() {
    const nama = prompt("Masukkan nama:");
    const telepon = prompt("Masukkan no. telepon:");
    const email = prompt("Masukkan email:");
    const tanggal = prompt("Masukkan tanggal booking (YYYY-MM-DD):");
    const dokter = prompt("Masukkan nama dokter:");

    if (nama && telepon && email && tanggal && dokter) {
        const table = document.getElementById("bookingTableBody");
        const row = document.createElement("tr");

        row.innerHTML = `
      <td>${nomor++}</td>
      <td>${nama}</td>
      <td>${telepon}</td>
      <td>${email}</td>
      <td>${tanggal}</td>
      <td>${dokter}</td>
    `;

        table.appendChild(row);
    } else {
        alert("Semua field harus diisi!");
    }
}

// menandakan page aktif agar dapat dihighlight di sidebar page admin
document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop();
    const links = document.querySelectorAll(".sidebar nav a");

    links.forEach(link => {
        const linkHref = link.getAttribute("href");
        if (linkHref === currentPage) {
            link.classList.add("active");
        }
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        setTimeout(() => {
            sidebar.classList.add('active');
        }, 100);
    }
});

// Animasi pop up form admin
function openPopup() {
    const popup = document.getElementById("popupForm");
    popup.style.display = "flex";
}

function closePopup() {
    const popup = document.getElementById("popupForm");
    popup.style.display = "none";
}

document.addEventListener("DOMContentLoaded", () => {
    const tambahBtn = document.querySelector(".btn-database");
    if (tambahBtn) {
        tambahBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openPopup();
        });
    }
});