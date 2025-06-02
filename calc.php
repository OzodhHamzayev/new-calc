<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_SESSION['input'] ?? '';

    // POST dan qiymatlarni aniqlaymiz
    $value = $_POST['num'] ?? ($_POST['oper'] ?? '');

    // Clear bosilganda inputni tozalash
    if ($value === 'c') {
        $input = '';
    }

    // Operator bosilsa va oldin ham operator bo‘lsa — eski operatorni olib tashlab yangi qo‘shiladi
    elseif (in_array($value, ['+', '-', '*', '/'])) {
        $lastChar = substr($input, -1);
        if (in_array($lastChar, ['+', '-', '*', '/'])) {
            $input = substr($input, 0, -1); // eski operatorni o‘chirish
        }
        $input .= $value;
    }

    // Tenglik (=) bosilsa hisoblaymiz
    elseif (isset($_POST['equal'])) {
        // Operator va sonlarni ajratamiz (foydalanuvchi faqat 2 son va 1 operator kiritdi deb faraz qilamiz)
        preg_match('/(\d+)([\+\-\*\/])(\d+)/', $input, $matches);

        $num1 = $matches[1];
        $operator = $matches[2] ?? '+';
        $num2 = $matches[3];

        switch ($operator) {
            case '+':
                $input = $num1 + $num2;
                break;
            case '-':
                $input = $num1 - $num2;
                break; 
            case '*':
                $input = $num1 * $num2;
                break;
            case '/':
                $input = $num1 / $num2;
                break;
            default:
                $input = 'Error';
                break;
        }
    }

    else {
        $input .= $value;
    }

    $_SESSION['input'] = $input;
}

header('Location:index.php');
exit;
