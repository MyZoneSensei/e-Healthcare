<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pharmacy | eHealthCare</title>
  <link rel="stylesheet" href="static/style.css" />
</head>

<body>
    <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
    ?>

  <section class="pharmacy-form">
    <h2>Pharmacy Order Form</h2>
    <div id="success-message" style="display: none; color: green; margin-bottom: 15px;">
      ✅ Your order has been successfully submitted!
    </div>
    
    <form action="submit_order.php" method="POST" id="pharmacy-form">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required />

      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" required />

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required />

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" required />

      <label for="illness">Type of Illness:</label>
      <select id="illness" name="illness" required>
        <option value="">-- Select Illness --</option>
        <option value="flu">Flu / Cold</option>
        <option value="headache">Headache</option>
        <option value="allergy">Allergy</option>
        <option value="gastric">Gastric / Ulcer</option>
        <option value="diabetes">Diabetes</option>
      </select>

        <label for="medicine">Recommended Medicine:</label>
        <select id="medicine" name="medicine" required>
            <option value="">-- Select Illness First --</option>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1" required />
        

        <div id="price-detail" class="price-info">
            <strong>Price: </strong><span id="price-amount">-</span>
        </div>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
          <option value="">-- Select Payment Method --</option>
          <option value="transfer_bank">Transfer Bank</option>
          <option value="ovo">OVO</option>
          <option value="gopay">GoPay</option>
          <option value="dana">DANA</option>
        </select>


        <input type="hidden" id="hidden-price" name="total_price" />
        <input type="hidden" name="payment_status" value="pending" />

        
        <button type="submit">Order Medicine</button>
    </form>
  </section>

  <?php
    // Memasukkan (include) file footer.php
    include 'footer.php';
  ?>
  <script src="script/pharmacy.js"></script>
</body>
</html>
