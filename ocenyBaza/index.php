<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie ocen</title>
</head>
<body>
    <header>
        <h1>Dodawanie ocen</h1>
    </header>
    <main>
        <?php
        $connect=mysqli_connect("localhost","root","","4ti");
        if($connect){
            $zapytanie="SELECT * FROM przedmiot";
            $wynik=mysqli_query($connect,$zapytanie);
            while($wiersz=mysqli_fetch_array($wynik)){
                $przedmiot[]=$wiersz['nazwa'];
                $idprzedmiot[]=$wiersz['id'];
            }
            $zapytanie="SELECT * FROM dane";
            $wynik=mysqli_query($connect,$zapytanie);
            while($wiersz=mysqli_fetch_array($wynik)){
                $iduczen[]=$wiersz['id'];
                $imie[]=$wiersz['imie'];
                $nazwisko[]=$wiersz['nazwisko'];
            }
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $przedmiotID=$_POST["przedmiot"];
                $osoba=$_POST["uczen"];
                $ocena=$_POST["ocena"];
                $insert="INSERT INTO oceny VALUES (NULL,'$osoba','$przedmiotID','$ocena')";
                if(mysqli_query($connect,$insert)){
                    echo "Dodano dane do bazy";
                }else{
                    echo "Bład dodawania do bazy";
                }
            }
        else{
                echo "nie gut";
        }
        }
        mysqli_close($connect);
        ?>
        <form method="POST">
            <label for="przedmiot">Wybierz przedmiot</label>
            <select name="przedmiot" id="przedmiot">
                <?php 
                    for($i=0;$i<count($przedmiot);$i++){
                        echo "<option value=$idprzedmiot[$i]> $przedmiot[$i]</option>";
                    }
                ?>
            </select>
            <label for="uczen">Wybierz ucznia</label>
            <select name="uczen" id="uczen">
                <?php 
                    for($i=0;$i<count($iduczen);$i++){
                        echo "<option value=$iduczen[$i]> $imie[$i] $nazwisko[$i]</option>";
                    }
                ?>
            </select>
            <br>
            <label for="ocena">Wpisz ocene</label>
            <input type="number" id="ocena" name="ocena">
            <br>
            <input type="submit" value="Zapisz do bazy">
        </form>
    </main>
    <footer>
        <p>Stronę wykonał Łukasz Krupa</p>
    </footer>
</body>
</html>