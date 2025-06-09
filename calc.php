<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_SESSION['input'] ?? '';

    $value = $_POST['num'] ?? ($_POST['oper'] ?? '');

    if ($value === 'c') {
        $input = '';
    }

    elseif (in_array($value, ['+', '-', '*', '/'])) {
        $lastChar = substr($input, -1);
        if (in_array($lastChar, ['+', '-', '*', '/'])) {
            $input = substr($input, 0, -1); 
        }
        $input .= $value;
    }

    elseif (isset($_POST['equal'])) {
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
