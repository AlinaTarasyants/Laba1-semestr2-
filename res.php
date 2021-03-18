<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Laba1</title>

    <style>
        table{
            border:2px solid  black;
        }
        th,td{
            border:2px solid black;
        }
    </style>
</head>

<body>
    <?php
        $pdo=new PDO("mysql:host=localhost;dbname=laba1;", "root", "");
        $sql="SELECT c.FID_TEAM1, c.FID_TEAM2, c.SCORE FROM `PLAYER` a JOIN `TEAM` b ON a.FID_TEAM=b.Id JOIN `GAME` c ON b.Id=c.FID_TEAM2 OR b.Id=c.FID_TEAM1 WHERE a.NAME=:pl";
        $res=$pdo->prepare($sql);
        $res->execute(['pl'=>$_POST['pl']]);
    ?> 

    Таблица матчей игрока <b><?php echo $_POST['pl'];?></b>:<br>
    <table>
        <tr>
            <th>Team1</th>
            <th>Team2</th>
            <th>Score</th>
        </tr>

        <?php
            while($row=$res->fetch()){
                echo "<tr>";

                $name1="";
                $name2="";

                $temp1="SELECT a.TNAME FROM TEAM a JOIN GAME b ON a.Id=b.FID_TEAM1 WHERE b.FID_TEAM1=:tn1";
                $temp2="SELECT a.TNAME FROM TEAM a JOIN GAME b ON a.Id=b.FID_TEAM2 WHERE b.FID_TEAM2=:tn2";

                $temp_res1=$pdo->prepare($temp1);
                $temp_res2=$pdo->prepare($temp2);

                $temp_res1->execute(['tn1'=>$row['FID_TEAM1']]);
                $temp_res2->execute(['tn2'=>$row['FID_TEAM2']]);


                while($row2=$temp_res1->fetch()){
                    $name1=$row2['TNAME'];
                }
                while($row2=$temp_res2->fetch()){
                    $name2=$row2['TNAME'];
                }
                echo "<td>".$name1."</td>";
                echo "<td>".$name2."</td>";
                echo "<td>".$row['SCORE']."</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <?php

        $sql2="SELECT DISTINCT b.FID_TEAM1, b.FID_TEAM2, b.SCORE FROM `TEAM` a JOIN `GAME` b ON a.Id=b.FID_TEAM1 OR a.Id=b.FID_TEAM2 WHERE a.LEAGUE=:lg";

        $res2=$pdo->prepare($sql2);

        $res2->execute(['lg'=>$_POST['lg']]);
        
    ?>
    <br>
    Таблица чемпионата для лиги <b><?php echo $_POST['lg'];?></b>:
    <table>
        <tr>
            <th>Team1</th>
            <th>Team2</th>
            <th>Score</th>
        </tr>
        <?php      
            while($row=$res2->fetch()){
                echo "<tr>";
                $name1="";
                $name2="";
                $temp1="SELECT a.TNAME FROM TEAM a JOIN GAME b ON a.Id=b.FID_TEAM1 WHERE b.FID_TEAM1=:tn1";
                $temp2="SELECT a.TNAME FROM TEAM a JOIN GAME b ON a.Id=b.FID_TEAM2 WHERE b.FID_TEAM2=:tn2";

                $temp_res1=$pdo->prepare($temp1);
                $temp_res2=$pdo->prepare($temp2);

                $temp_res1->execute(['tn1'=>$row['FID_TEAM1']]);
                $temp_res2->execute(['tn2'=>$row['FID_TEAM2']]);


                while($row2=$temp_res1->fetch()){
                    $name1=$row2['TNAME'];
                }
                while($row2=$temp_res2->fetch()){
                    $name2=$row2['TNAME'];
                }
                $score=$row['SCORE']==null?'Матч не проведен':$row['SCORE'];
                echo "<td>".$name1."</td>";
                echo "<td>".$name2."</td>";
                echo "<td>".$score."</td>";
                echo "</tr>";   
            }
        ?>
    </table>


    <?php
        $sql3="SELECT DISTINCT b.FID_TEAM1, b.FID_TEAM2, b.SCORE, b.DAT FROM `TEAM` a JOIN `GAME` b ON a.Id=b.FID_TEAM1 OR a.Id=b.FID_TEAM2 WHERE b.DAT BETWEEN :dt1 AND :dt2";
        $res3=$pdo->prepare($sql3);

        $res3->execute(['dt1'=>$_POST['dt1'], 'dt2'=>$_POST['dt2']]);
    ?>
    <span id="sp"><br>Матчи за период времени <b>[<?php echo $_POST['dt1'].";".$_POST['dt2'];?>]</b></span>
    <table id="tbl">
        <tr>
            <th>Team1</th>
            <th>Team2</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
        <?php
            while($row=$res3->fetch()){
                echo "<tr>";
                $name1="";
                $name2="";
                $temp1="SELECT a.TNAME FROM TEAM a JOIN GAME b ON a.Id=b.FID_TEAM1 WHERE b.FID_TEAM1=:tn1";
                $temp2="SELECT a.TNAME FROM TEAM a JOIN GAME b ON a.Id=b.FID_TEAM2 WHERE b.FID_TEAM2=:tn2";

                $temp_res1=$pdo->prepare($temp1);
                $temp_res2=$pdo->prepare($temp2);

                $temp_res1->execute(['tn1'=>$row['FID_TEAM1']]);
                $temp_res2->execute(['tn2'=>$row['FID_TEAM2']]);


                while($row2=$temp_res1->fetch()){
                    $name1=$row2['TNAME'];
                }
                while($row2=$temp_res2->fetch()){
                    $name2=$row2['TNAME'];
                }
                $score=$row['SCORE']==null?'Матч не проведен':$row['SCORE'];
                echo "<td>".$name1."</td>";
                echo "<td>".$name2."</td>";
                echo "<td>".$score."</td>";
                echo "<td>".$row['DAT']."</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <script>
        $(function(){
            var count=$('#tbl tr').length;
            if(count===1){
                $('#tbl').remove(); // если таблица будет пустой, то она удаляется. Чтобы она осталась - задавать валидные значения даты 
                $('#sp').remove();
            }
        })
    </script>
    
</body>
</html>