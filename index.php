<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="calc.css">
    <title>Calculator</title>
</head>

<body>
    <div class="div_class">
        <form action="calc.php" method="POST">
            <input type="text" class="maininput" name="input" value="<?= $_SESSION['input'] ?? '' ?>"><br>
            <input type="submit" class="numbtn" name="oper" value="*"><br>
            <input type="submit" class="numbtn" name="num" value="7">
            <input type="submit" class="numbtn" name="num" value="8">
            <input type="submit" class="numbtn" name="num" value="9">
            <input type="submit" class="numbtn" name="oper" value="/"><br>
            <input type="submit" class="numbtn" name="num" value="4">
            <input type="submit" class="numbtn" name="num" value="5">
            <input type="submit" class="numbtn" name="num" value="6">
            <input type="submit" class="numbtn" name="oper" value="-"><br>
            <input type="submit" class="numbtn" name="num" value="1">
            <input type="submit" class="numbtn" name="num" value="2">
            <input type="submit" class="numbtn" name="num" value="3">
            <input type="submit" class="numbtn" name="oper" value="+"><br>
            <input type="submit" class="numbtn" name="num" value="c">
            <input type="submit" class="numbtn" name="num" value="0">
            <input type="submit" class="numbtn" name="num" value=".">
            <input type="submit" class="numbtn" name="equal" value="=">

        </form>
    </div>
</body>

</html>
<?php
?>