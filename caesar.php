<?php
// Tabel substitusi karakter
$encryptionTable = [
    'A' => 'L', 'B' => 'I', 'C' => 'A', 'D' => 'B', 'E' => 'C', 'F' => 'D', 'G' => 'E',
    'H' => 'F', 'I' => 'G', 'J' => 'H', 'K' => 'J', 'L' => 'K', 'M' => 'M', 'N' => 'N',
    'O' => 'O', 'P' => 'P', 'Q' => 'Q', 'R' => 'R', 'S' => 'S', 'T' => 'T', 'U' => 'U',
    'V' => 'V', 'W' => 'W', 'X' => 'X', 'Y' => 'Y', 'Z' => 'Z',
    'a' => 'l', 'b' => 'i', 'c' => 'a', 'd' => 'b', 'e' => 'c', 'f' => 'd', 'g' => 'e',
    'h' => 'f', 'i' => 'g', 'j' => 'h', 'k' => 'j', 'l' => 'k', 'm' => 'm', 'n' => 'n',
    'o' => 'o', 'p' => 'p', 'q' => 'q', 'r' => 'r', 's' => 's', 't' => 't', 'u' => 'u',
    'v' => 'v', 'w' => 'w', 'x' => 'x', 'y' => 'y', 'z' => 'z',
    '0' => '5', '1' => '6', '2' => '7', '3' => '8', '4' => '9', '5' => '0', '6' => '1',
    '7' => '2', '8' => '3', '9' => '4'
];

// Fungsi untuk mengenkripsi teks
function encryptText($text, $table) {
    $encryptedText = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (array_key_exists($char, $table)) {
            $encryptedText .= $table[$char];
        } else {
            $encryptedText .= $char;
        }
    }
    return $encryptedText;
}

// Fungsi untuk mendekripsi teks
function decryptText($text, $table) {
    $decryptedText = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $originalChar = array_search($char, $table);
        if ($originalChar !== false) {
            $decryptedText .= $originalChar;
        } else {
            $decryptedText .= $char;
        }
    }
    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$processedText = "";
$operation = "encrypt"; // Default operation is encryption
$errorMessage = ""; // Pesan error untuk input kosong

// Memproses input saat formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["text"])) {
        $errorMessage = "Teks tidak boleh kosong!";
    } else {
        $text = $_POST["text"];
        $operation = $_POST["operation"];
        if ($operation == "encrypt") {
            $processedText = encryptText($text, $encryptionTable);
        } elseif ($operation == "decrypt") {
            $processedText = decryptText($text, $encryptionTable);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enkripsi dan Dekripsi Teks - Caesar Cipher</title>
    <style>
        body {
            background-color: #e0f7fa; /* Biru muda */
            font-family: Arial, sans-serif;
            color: #006064; /* Teal gelap */
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #00796b; /* Teal sedang */
        }

        textarea, input[type="radio"] {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 2px solid #00796b; /* Border teal */
            border-radius: 5px;
            box-sizing: border-box;
        }

        .radio-inline {
            margin-right: 20px;
        }

        .btn-primary {
            background-color: #00bcd4; /* Biru cerah */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #00838f; /* Biru gelap */
        }

        .result {
            background-color: #e0f7fa; /* Biru muda */
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
            color: #006064; /* Teal gelap */
            max-width: 100%;
            overflow-wrap: break-word; /* Allow breaking long words */
            word-wrap: break-word; /* Older browsers support */
            white-space: pre-wrap; /* Preserve whitespace and wrap text */
            max-height: 200px; /* Set a max height */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
        }

        .btn-default {
            background-color: #b2ebf2; /* Biru pastel */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #006064; /* Teal gelap */
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .btn-default:hover {
            background-color: #80deea; /* Biru pastel lebih gelap */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Caesar Cipher</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="text">Masukkan Teks:</label>
                <textarea class="form-control" rows="5" id="text" name="text"><?php echo htmlspecialchars($text); ?></textarea>
                <?php if (!empty($errorMessage)): ?>
                    <div class="error"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="radio-inline"><input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>>Enkripsi</label>
                <label class="radio-inline"><input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>>Dekripsi</label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($processedText)) : ?>
            <div class="result">
                <?php if ($operation == "encrypt") : ?>
                    <h2>Hasil Enkripsi:</h2>
                <?php elseif ($operation == "decrypt") : ?>
                    <h2>Hasil Dekripsi:</h2>
                <?php endif; ?>
                <p><?php echo nl2br(htmlspecialchars($processedText)); ?></p>
            </div>
        <?php endif; ?>

        <a href="vigenere.php"><button class="btn-default">Enkripsi Tahap Kedua</button></a>
    </div>
</body>
</html>
