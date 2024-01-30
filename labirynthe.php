<?php
session_start();

$map = [
    [1, 4, 4, 4, 2, 4, 4, 4, 4, 4],
    [4, 4, 2, 4, 4, 4, 2, 2, 4, 4],
    [4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
    [4, 2, 4, 4, 2, 2, 2, 4, 4, 4],
    [4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
    [4, 4, 2, 4, 4, 4, 3, 4, 4, 4],
    [4, 2, 4, 4, 2, 4, 4, 4, 4, 4],
    [4, 4, 4, 4, 4, 4, 4, 2, 4, 4],
    [4, 4, 2, 2, 4, 4, 4, 2, 4, 4],
    [4, 4, 4, 4, 4, 4, 4, 2, 4, 4],
];
$mapTwo = [
    [1, 4, 4, 4, 2, 2, 4, 2, 4, 3],
    [4, 2, 4, 4, 4, 2, 2, 4, 4, 4],
    [4, 2, 2, 2, 4, 4, 4, 4, 2, 2],
    [4, 4, 4, 4, 2, 4, 2, 2, 4, 4],
    [4, 2, 2, 2, 4, 4, 2, 4, 2, 4],
    [4, 4, 4, 4, 2, 4, 4, 4, 2, 4],
    [4, 4, 4, 4, 2, 4, 4, 4, 2, 4],
    [4, 4, 2, 4, 2, 4, 2, 2, 2, 4],
    [4, 4, 4, 4, 2, 2, 2, 4, 4, 4],
    [4, 2, 4, 4, 4, 4, 4, 4, 4, 4],
];
$mapThree = [
    [1, 4, 4, 4, 2, 2, 4, 2, 4, 4],
    [4, 2, 4, 4, 4, 2, 2, 4, 3, 4],
    [4, 2, 2, 2, 4, 4, 4, 4, 2, 2],
    [4, 4, 4, 4, 2, 4, 2, 2, 4, 4],
    [4, 2, 2, 2, 4, 4, 2, 4, 2, 4],
    [4, 4, 4, 4, 2, 4, 4, 4, 2, 4],

];
$mapFog = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
];
$mapFogThree = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
];
$multiMap = [$map, $mapTwo, $mapThree];
$multiFogMap = [$mapFog, $mapFog, $mapFogThree];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labirynthe</title>
</head>


<body>
    <?php
    include("header.php");
    ?>
    <main>
        <div class="map">
            <?php
            // Fonction mémoire SESSION
            $_SESSION['map'] = isset($_SESSION['map']) ? $_SESSION['map'] : $map;
            // Afficher la map 
            function displayMap($array)
            {
                foreach ($array as $line) {
                    echo "<div class='line'>";
                    foreach ($line as $cell) {
                        switch ($cell) {
                            case 1:
                                echo "<div class='cell'><img class='grinch' src='assets/images/grinch.png' alt='grinch'></div>";
                                break;
                            case 0:
                                echo "<div class='cell'><img class='cloud' src='assets/images/brouillard.png' alt='cloud'></div>";
                                break;
                            case 2:
                                echo "<div class='cell'><img class='wall' src='assets/images/mur.png' alt='wall'></div>";
                                break;
                            case 3:
                                echo "<div class='cell'><img class='mouse' src= 'assets/images/chauve-souris.png' alt='mouse'></div>";
                                break;
                            case 4:
                                echo "<div id ='cell'></div>";
                                break;

                        }
                    }
                    echo "</div>";
                }

            }
            function removefog($arrMap, $arrFog)
            {
                $i = isset($_SESSION['grinch']) ? $_SESSION['grinch'][0] : 0;
                $j = isset($_SESSION['grinch']) ? $_SESSION['grinch'][1] : 0;
                $arrFog[$i][$j] = $arrMap[$i][$j];
                if ($i != 0) {
                    $arrFog[$i - 1][$j] = $arrMap[$i - 1][$j];
                }
                if ($i != count($arrFog) - 1) {
                    $arrFog[$i + 1][$j] = $arrMap[$i + 1][$j];
                }
                if ($j != 0) {
                    $arrFog[$i][$j - 1] = $arrMap[$i][$j - 1];
                }
                if ($j != count($arrFog) - 1) {
                    $arrFog[$i][$j + 1] = $arrMap[$i][$j + 1];
                }
                return $arrFog;

            }
            // Mise en mouvement du joueur 
            function move($direction, $arr)
            {
                foreach ($arr as $i => $li) {
                    foreach ($li as $j => $cel) {
                        if ($arr[$i][$j] === 1) {
                            $_SESSION['grinch'] = [$i, $j];
                            switch ($direction) {
                                //DEPLACEMENT VERS LE HAUT
                                case 'haut':
                                    if (isset($arr[$i - 1][$j])) {
                                        if ($arr[$i - 1][$j] === 2) {
                                            $GLOBALS['msg'] = " Il y a mur !!";
                                        } else if ($arr[$i - 1][$j] === 4) {
                                            $_SESSION['grinch'] = [$i - 1, $j];
                                            $arr[$i - 1][$j] = 1;
                                            $arr[$i][$j] = 4;
                                        } else {
                                            $GLOBALS['msg'] = "Vous avez trouvez la souris YOUPIIIIII !!!";
                                        }
                                    } else {
                                        $GLOBALS['msg'] = "Vous ne pouvez pas aller dans cette direction!!";
                                    }

                                    $_SESSION['map'] = $arr;
                                    break;
                                //DEPLACEMENT VERS LA DROITE
                                case 'droite':
                                    if (isset($arr[$i][$j + 1])) {
                                        if ($arr[$i][$j + 1] === 2) {
                                            $GLOBALS['msg'] = "Il y a mur !!";
                                        } else if ($arr[$i][$j + 1] === 4) {
                                            $_SESSION['grinch'] = [$i, $j + 1];
                                            $arr[$i][$j + 1] = 1;
                                            $arr[$i][$j] = 4;
                                        } else {
                                            $GLOBALS['msg'] = "Vous avez trouvez la souris YOUPIIIIII !!!";
                                        }
                                    } else {
                                        $GLOBALS['msg'] = "Vous ne pouvez pas aller dans cette direction!!";
                                    }

                                    $_SESSION['map'] = $arr;
                                    break;
                                // DEPLACEMENT VERS LE BAS
                                case 'bas':
                                    if (isset($arr[$i + 1][$j])) {
                                        if ($arr[$i + 1][$j] === 2) {
                                            $GLOBALS['msg'] = "Il y a mur !!";
                                        } else if ($arr[$i + 1][$j] === 4) {
                                            $_SESSION['grinch'] = [$i + 1, $j];
                                            $arr[$i + 1][$j] = 1;
                                            $arr[$i][$j] = 4;
                                        } else {
                                            $GLOBALS['msg'] = "Vous avez trouvez la souris YOUPIIIIII !!!";
                                        }
                                    } else {
                                        $GLOBALS['msg'] = "Vous ne pouvez pas aller dans cette direction!!";
                                    }
                                    $_SESSION['map'] = $arr;
                                    break;
                                // DEPLACEMENT VERS LA GAUCHE
                                case 'gauche':
                                    if (isset($arr[$i][$j - 1])) {
                                        if ($arr[$i][$j - 1] === 2) {
                                            $GLOBALS['msg'] = "Il y a mur !!";
                                        } else if ($arr[$i][$j - 1] === 4) {
                                            $_SESSION['grinch'] = [$i, $j - 1];
                                            $arr[$i][$j - 1] = 1;
                                            $arr[$i][$j] = 4;
                                        } else {
                                            $GLOBALS['msg'] = "Vous avez trouvez la souris YOUPIIIIII !!!";
                                        }
                                    } else {
                                        $GLOBALS['msg'] = "Vous ne pouvez pas aller dans cette direction!!";
                                    }
                                    $_SESSION['map'] = $arr;
                                    break;
                            }
                            return;
                        }

                    }
                }
            }
            if(isset($_POST['direction'])){
                move($_POST['direction'], $_SESSION['map']);
                displayMap(removefog($_SESSION['map'], $_SESSION['fogMap']));
            }
            else{
                if(isset($_POST['reset'])){
                    header("refresh:0");
                }
                $rand = rand(0, count($multiMap) - 1);
                $_SESSION['map'] = $multiMap[$rand];
                $_SESSION['fogMap'] = $multiFogMap[$rand];
                $_SESSION['grinch'] = [0,0];
                displayMap(removefog($_SESSION['map'], $multiFogMap[$rand]));
            }


            // if (isset($_POST['direction'])) {
            //     // Au bouton reset
            //     if ($_POST['direction'] === "reset") {
            //         header('refresh:0');
            //         $rand = rand(0, count($multiMap) - 1);
            //         $_SESSION['map'] = $multiMap[$rand];
            //         $_SESSION['fogMap'] = $multiFogMap[$rand];
            //         $_SESSION['grinch'] = [0,0];
            //         displayMap(removefog($_SESSION['map'], $multiFogMap[$rand]));

            //     }
            //     // Au bouton de déplacement
            //     else{
            //         move($_POST['direction'], $_SESSION['map']);
            //         displayMap(removefog($_SESSION['map'], $_SESSION['fogMap']));
            //     }
            //     // Si aucun bouton n'a été clické (donc 1ère génération de la page)
            // } else {
            //     $rand = rand(0, count($multiMap) - 1);
            //     $_SESSION['map'] = $multiMap[$rand];
            //     $_SESSION['fogMap'] = $multiFogMap[$rand];
            //     $_SESSION['grinch'] = [0,0];
            //     displayMap(removefog($_SESSION['map'], $multiFogMap[$rand]));
            // }


            ?>
        </div>
        <form class="buttonContainer" method="POST">

            <button id="up" type="submit" name="direction" value="haut"></button>
            <div class="buttContTwo">
                <button id="left" type="submit" name="direction" value="gauche"></button>
                <button id="right" type="submit" name="direction" value="droite"></button>
            </div>
            <button id="down" type="submit" name="direction" value="bas"></button>
            <div id="reset">
                <button id="resetBut" type="submit" name="reset" value="reset">Rénitialiser</button>
            </div>
            <div id="warningMsg">
                <?php

                echo isset($GLOBALS['msg']) ? $GLOBALS['msg'] : '';
                echo isset($rand) ? "Tableau" . $rand : '';
                ?>
            </div>
        </form>
    </main>



</body>

</html>