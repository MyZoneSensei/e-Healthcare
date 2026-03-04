document.addEventListener("DOMContentLoaded", () => {
  const illnessSelect = document.getElementById("illness");
  const medicineSelect = document.getElementById("medicine");
  const priceAmount = document.getElementById("price-amount");
  const quantityInput = document.getElementById("quantity");
  const form = document.getElementById("pharmacy-form");
  const hiddenPrice = document.getElementById("hidden-price");
  const successMessage = document.getElementById("success-message");

  const illnessToMedicine = {
    flu: ["paracetamol", "antihistamine", "vitamin-c"],
    headache: ["ibuprofen", "acetaminophen"],
    allergy: ["cetirizine", "loratadine"],
    gastric: ["antacid", "ranitidine", "omeprazole"],
    diabetes: ["insulin", "metformin"]
  };

  const medicineLabels = {
    "paracetamol": "Paracetamol",
    "antihistamine": "Antihistamine",
    "vitamin-c": "Vitamin C",
    "ibuprofen": "Ibuprofen",
    "acetaminophen": "Acetaminophen",
    "cetirizine": "Cetirizine",
    "loratadine": "Loratadine",
    "antacid": "Antacid",
    "ranitidine": "Ranitidine",
    "omeprazole": "Omeprazole",
    "insulin": "Insulin",
    "metformin": "Metformin"
  };

  const medicinePrices = {
    "paracetamol": 10000,
    "antihistamine": 12000,
    "vitamin-c": 8000,
    "ibuprofen": 11000,
    "acetaminophen": 10000,
    "cetirizine": 15000,
    "loratadine": 16000,
    "antacid": 9000,
    "ranitidine": 13000,
    "omeprazole": 14000,
    "insulin": 50000,
    "metformin": 18000
  };

  function populateMedicines(illness) {
    medicineSelect.innerHTML = "";
    const meds = illnessToMedicine[illness] || [];

    meds.forEach(slug => {
      const label = medicineLabels[slug] || slug;
      medicineSelect.innerHTML += `<option value="${slug}">${label}</option>`;
    });

    updatePrice();
  }

  function updatePrice() {
    const selectedMed = medicineSelect.value;
    const qty = parseInt(quantityInput.value) || 1;
    const unitPrice = medicinePrices[selectedMed];
    const total = unitPrice ? unitPrice * qty : 0;

    if (unitPrice) {
      priceAmount.textContent = `Rp ${total.toLocaleString('id-ID')}`;
      hiddenPrice.value = total;
    } else {
      priceAmount.textContent = "-";
      hiddenPrice.value = 0;
    }
  }

  illnessSelect.addEventListener("change", () => populateMedicines(illnessSelect.value));
  medicineSelect.addEventListener("change", updatePrice);
  quantityInput.addEventListener("input", updatePrice);

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    fetch(form.action, {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      if (data.trim() === "success") {
        successMessage.style.display = "block";
        form.reset();
        medicineSelect.innerHTML = `<option value="">-- Select Illness First --</option>`;
        priceAmount.textContent = "-";
        hiddenPrice.value = 0;

        setTimeout(() => {
          successMessage.style.display = "none";
        }, 3000);
      } else {
        alert("Server error: " + data);
        console.error("Server error:", data);
      }
    })
    .catch(err => console.error("Fetch error:", err));
  });
});
