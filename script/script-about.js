const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
});

document.querySelectorAll('.feature-item, .card').forEach(el => observer.observe(el));

function openModal() {
    document.getElementById('doctorModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('doctorModal').style.display = 'none';
}

// Optional: Close modal when clicking outside modal content
window.onclick = function(event) {
    var modal = document.getElementById('doctorModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};

function openHospitalModal() {
    document.getElementById('hospitalModal').style.display = 'block';
}

function closeHospitalModal() {
    document.getElementById('hospitalModal').style.display = 'none';
}

// Close modal if clicked outside
window.onclick = function(event) {
    var doctorModal = document.getElementById('doctorModal');
    var hospitalModal = document.getElementById('hospitalModal');

    if (event.target === doctorModal) {
        doctorModal.style.display = 'none';
    }
    if (event.target === hospitalModal) {
        hospitalModal.style.display = 'none';
    }
};


// document.addEventListener('DOMContentLoaded', () => {
//   const stars = document.querySelectorAll('.star');
//   const ratingInput = document.getElementById('rating') || document.createElement('input');
//   const form = document.getElementById('testimonialForm');
//   const status = document.getElementById('form-status');
//   const doctorModal = document.getElementById("doctorModal");
//   const doctorCard = document.getElementById('doctorCard');
//   const closeBtn = document.querySelector('.modal .close');

//   // Buka modal saat card diklik
//   if (doctorCard && doctorModal && closeBtn) {
//     doctorCard.addEventListener('click', () => {
//       doctorModal.style.display = "block";
//     });

//     // Tutup modal saat tombol X diklik
//     closeBtn.addEventListener('click', () => {
//       doctorModal.style.display = "none";
//     });

//     // Tutup modal jika klik di luar kontennya
//     window.addEventListener('click', (e) => {
//       if (e.target === doctorModal) {
//         doctorModal.style.display = "none";
//       }
//     });
//   }


//   // Tambahkan input hidden rating jika belum ada
//   if (!document.getElementById('rating')) {
//     ratingInput.type = "hidden";
//     ratingInput.id = "rating";
//     form.appendChild(ratingInput);
//   }

//   // Klik bintang
//   stars.forEach((star, index) => {
//     star.addEventListener('click', () => {
//       const rating = index + 1;
//       ratingInput.value = rating;

//       stars.forEach((s, i) => {
//         s.classList.toggle('filled', i < rating);
//       });
//     });
//   });

//   // Kirim form
//   form.addEventListener('submit', function(e) {
//     e.preventDefault();

//     const name = document.getElementById('name').value.trim();
//     const message = document.getElementById('message').value.trim();
//     const rating = ratingInput.value;

//     if (!name || !message || rating == 0) {
//       status.textContent = "Please complete all fields and select a rating.";
//       status.style.color = "red";
//       return;
//     }

//     // Kirim ke PHP dengan AJAX
//     const formData = new FormData();
//     formData.append('name', name);
//     formData.append('message', message);
//     formData.append('rating', rating);

//     fetch('submit_testimoni.php', {
//       method: 'POST',
//       body: formData
//     })
//       .then(response => response.text())
//       .then(result => {
//         if (result === 'success') {
//           status.textContent = "Thank you for your feedback!";
//           status.style.color = "green";
//           form.reset();
//           ratingInput.value = 0;
//           stars.forEach(s => s.classList.remove('filled'));
//         } else {
//           status.textContent = "There was an error. Please try again.";
//           status.style.color = "red";
//         }
//       })
//       .catch(() => {
//         status.textContent = "Server error. Please try later.";
//         status.style.color = "red";
//       });
//   });
// });