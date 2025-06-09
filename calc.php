<?php
session_start();

if (!isset($_SESSION['input'])) {
    $_SESSION['input'] = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['num']) && $_POST['num'] === 'c') {
        $_SESSION['input'] = '';
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['num']) && $_POST['num'] !== 'c') {
        $_SESSION['input'] .= $_POST['num'];
    }

    if (isset($_POST['oper'])) {
        $lastChar = substr($_SESSION['input'], -1);

        while (in_array(substr($_SESSION['input'], -1), ['+', '-', '*', '/'])) {
            $_SESSION['input'] = substr($_SESSION['input'], 0, -1);
        }
        $_SESSION['input'] .= $_POST['oper'];
    }

    if (isset($_POST['equal']) && $_POST['equal'] === '=' && !empty($_SESSION['input'])) {
        $expression = $_SESSION['input'];

        preg_match_all('/\d+/', $expression, $numberMatches);
        preg_match_all('/[\+\-\*\/]/', $expression, $operatorMatches);

        $numbers = $numberMatches[0];
        $operators = $operatorMatches[0];

        if (preg_match('/[\+\-\*\/]{2,}/', $expression)) {
            echo $expression;
            exit();
        }

        for ($i = 0; $i < count($operators); $i++) {
            if ($operators[$i] === '*' || $operators[$i] === '/') {
                $a = (float)$numbers[$i];
                $b = (float)$numbers[$i + 1];

                if ($operators[$i] === '*') {
                    $res = $a * $b;
                } else {
                    if ($b == 0) {
                        echo "Xato: 0 ga bo‘lish mumkin emas.";
                        exit();
                    }   
                    $res = $a / $b;
                }
                $numbers[$i] = $res;
                array_splice($numbers, $i + 1, 1);
            }
        }

        $result = $numbers[0];
        for ($i = 0; $i < count($operators); $i++) {
            $b = $numbers[$i + 1];
            if ($operators[$i] === '+') {
                $result += $b;
            } elseif ($operators[$i] === '-') {
                $result -= $b;
            }
        }

        $_SESSION['input'] = $result;
    }
}

header('Location: index.php');
exit();
