<?php
function parseNumbers(string $input): array
{
    preg_match_all('/\d+(\.\d+)?/', $input, $numbers);

    preg_match_all('/[+\-]/', $input, $operators);

    $numberArray = array_map('floatval', $numbers[0]);
    $operatorArray = $operators[0];

    return [$numberArray, $operatorArray];
}
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = '';
    $input = $_POST['input'];

    if (isset($_POST['num'])) {
        $numbers = [];
        $numbers = $_POST['num'];
        $input .= $numbers;
    }
    if (isset($_POST['oper'])) {
        $oper = '';
        $oper = $_POST['oper'];
        $input .= $oper;
    }

    if (isset($_POST['equal']) || $_POST['equal'] == "equal" && !empty($_POST['input'])) {
        $numbers = $_POST['input'];

        $result = parseNumbers($numbers);
        $numbers = $result[0];
        $operators = $result[1];

        foreach ($numbers as $key => $number1) {
            $operator = $operators[$key] ?? null;
            $number2 = $numbers[$key + 1] ?? null;

            if (! $number2) {
                continue;
            }

            $r = match ($operator) {
                '+' => $number1 + $number2,
                '-' => $number1 - $number2,
                '/' => $number1 / $number2,
            };


            if ($result == null) {
                $result = $r;
          
        }
    }

    if ($_POST['num'] == "c") {
        unset($input);
    }

    $_SESSION['input'] = $input;
}
}
header('Location:index.php');
exit();
