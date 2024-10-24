<?php
// Fungsi enkripsi Vigenere Cipher
function vigenereEncrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $encryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // Abaikan karakter non-huruf
        if (!ctype_alpha($char)) {
            $encryptedText .= $char;
            continue;
        }

        // Hitung karakter baru berdasarkan Vigenere Cipher
        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $encryptedChar = chr((($charOffset + $keyCharOffset) % 26) + 65);

        $encryptedText .= $encryptedChar;
        $keyIndex++;
    }

    return $encryptedText;
}

// Fungsi dekripsi Vigenere Cipher
function vigenereDecrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $decryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // Abaikan karakter non-huruf
        if (!ctype_alpha($char)) {
            $decryptedText .= $char;
            continue;
        }

        // Hitung karakter asli berdasarkan Vigenere Cipher
        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $decryptedChar = chr(((($charOffset - $keyCharOffset) + 26) % 26) + 65);

        $decryptedText .= $decryptedChar;
        $keyIndex++;
    }

    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$key = "LIA"; // Ganti kunci enkripsi/dekripsi menjadi 'LIA'
$encryptedText = "";
$decryptedText = "";
$operation = "encrypt"; // Default operasi adalah enkripsi

// Memproses input saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $encryptedText = vigenereEncrypt($text, $key);
    } elseif ($operation == "decrypt") {
        $decryptedText = vigenereDecrypt($text, $key);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher - Blue Theme</title> <!-- Ubah warna tema -->
    <style>
        body {
            background-color: #e3f2fd;  /* Light blue background */
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #0d47a1; /* Dark blue text */
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #1976d2; /* Lighter blue for the heading */
        }

        textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #bbdefb; 
            border-radius: 10px;
            background-color: #e3f2fd; /* Light blue background for text area */
            color: #0d47a1; /* Dark blue for text */
            font-size: 16px;
            resize: none;
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background-color: #64b5f6; /* Blue button */
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #42a5f5;
        }

        .btn-secondary {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background-color: #90caf9; /* Light blue button */
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #64b5f6;
        }

        .result {
            background-color: #bbdefb; /* Light blue */
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
            text-align: center;
            color: #0d47a1;
            font-weight: bold;
            font-size: 18px;
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vigenere Cipher</h1>
        <form method="post" action="">
            <label for="text">Masukkan Teks:</label>
            <textarea id="text" name="text" rows="4" placeholder="Masukkan teks..."><?php echo htmlspecialchars($text); ?></textarea>
            <div class="radio-group">
                <label>
                    <input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>>
                    Enkripsi
                </label>
                <label>
                    <input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>>
                    Dekripsi
                </label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($encryptedText) || !empty($decryptedText)): ?>
            <div class="result">
                <?php if ($operation == "encrypt"): ?>
                    <h2>Hasil Enkripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($encryptedText); ?></p>
                <?php elseif ($operation == "decrypt"): ?>
                    <h2>Hasil Dekripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($decryptedText); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Button to go to Caesar Cipher -->
        <a href="Caesar.php"><button class="btn-secondary">Enkripsi Tahap Pertama</button></a>
    </div>
</body>
</html>
