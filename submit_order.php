<?php
    require 'connect.php';

    $full_name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $medicine_slug = $_POST['medicine'];
    $quantity = intval($_POST['quantity']);
    $total_price = intval($_POST['total_price']);

    $medicine_name = ucwords(str_replace("-", " ", $medicine_slug));

    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status']; // default: pending


    //CEK ID OBAT BERDASARKAN NAMA 
    $sql_med = "SELECT id_medicines FROM medicines WHERE name = ?";
    $stmt_med = $conn->prepare($sql_med);
    $stmt_med->bind_param("s", $medicine_name);
    $stmt_med->execute();
    $result_med = $stmt_med->get_result();

    if ($result_med->num_rows === 0) {
        die("Medicine not found");
    }
    $id_medicines = $result_med->fetch_assoc()['id_medicines'];
    $stmt_med->close();

    //CEK APAKAH PASIEN SUDAH ADA
    $stmt_pat = $conn->prepare("SELECT id_patients FROM patients WHERE full_name = ? AND dob = ?");
    $stmt_pat->bind_param("ss", $full_name, $dob);
    $stmt_pat->execute();
    $res_pat = $stmt_pat->get_result();

    if ($res_pat->num_rows > 0) {
        $id_patients = $res_pat->fetch_assoc()['id_patients'];
    } else {
        $stmt_insert_pat = $conn->prepare("INSERT INTO patients (full_name, dob, address, phone) VALUES (?, ?, ?, ?)");
        $stmt_insert_pat->bind_param("ssss", $full_name, $dob, $address, $phone);
        $stmt_insert_pat->execute();
        $id_patients = $stmt_insert_pat->insert_id;
        $stmt_insert_pat->close();
    }
    $stmt_pat->close();

    //MEMASUKKAN KE TABEL ORDERS
    $stmt_order = $conn->prepare("INSERT INTO orders (id_patients, id_medicines, quantity, total_price, payment_method, payment_status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_order->bind_param("iiisss", $id_patients, $id_medicines, $quantity, $total_price, $payment_method, $payment_status);
    $success = $stmt_order->execute();
    $stmt_order->close();
    
    $conn->close();

    ob_clean();
    echo $success ? "success" : "Failed to submit order.";

?>