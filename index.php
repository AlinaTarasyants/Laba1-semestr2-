<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laba1</title>
</head>
<body>
    <?php
        $pdo=new PDO("mysql:host=localhost;dbname=laba1;", "root", ""); 
        $leagues=array();
        $players=array();

        $res1=$pdo->query("SELECT `LEAGUE` FROM `TEAM`");
        $res2=$pdo->query("SELECT `NAME` FROM `PLAYER`");

        while($row=$res1->fetch()){
            if(in_array($row['LEAGUE'],$leagues)==false){
            array_push($leagues,$row['LEAGUE']);
            }
        }

        while($row=$res2->fetch()){
            array_push($players,$row['NAME']);
        }
    ?>

    <form action="res.php" method="post">
        <span>Выберите лигу: </span><select name="lg" id="lg">
        <?php
                for($i=0;$i<count($leagues);$i++){
                    echo "<option value='".$leagues[$i]."'>".$leagues[$i]."</option>";
                }
        ?>
        </select>
        <br>
        <span>Выберите игрока: </span><select name="pl" id="pl">
        <?php
                for($i=0;$i<count($players);$i++){
                    echo "<option value='".$players[$i]."'>".$players[$i]."</option>";
                }
        ?>
        </select>

        <br>
        <span>Дата матча. От: </span><input type="date" name="dt1" required><span>&nbsp;По: </span><input type="date" name="dt2" required>

        <br>
        <button type="submit">Поиск</button>
    </form>
</body>
</html>