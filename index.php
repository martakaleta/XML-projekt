<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodni sustav elemenata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Prilagođeni CSS za postavljanje veličine fonta na 7pt jer bootstrap nema opciju za tu veličinu */
        .text-7 {
            font-size: 7pt !important;
        }

        /* CSS za postavljanje teksta unutar button-a jedan ispod drugog*/
        .btn-content {
            display: block;
            text-align: center;
        }
        
    </style>
</head>

<body>

<!-- Čitnaje XML fajla -->
<?php
$xml = simplexml_load_file('elementi.xml');
?>

<header>
    <h1 class="mt-3 display-4 text-center">PERIODNI SUSTAV ELEMENATA</h1>
</header>

<div class="container mt-3">
    <table id="PSE" class="container">
        <thead>
            <tr>
                <th></th> <!-- Prazna ćelija za lijevi gornji kut tablice -->
                <?php
                // Generiranje stupaca od 1. do 18.
                for ($col = 1; $col <= 18; $col++) {
                    echo "<th class='bg-danger text-white p-1 text-center border border-white'>$col</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Definiramo index i table_switch za kasnije
            $index = 0;
            $table_switch = 0;
            // Generiranje redova
            for ($row = 1; $row <= 10; $row++) {
                echo "<tr>";
                // Prvi stupac s brojem reda
                if ($row < 8) {
                    echo "<th class='bg-danger text-white p-2 text-center border border-white'>$row</th>";
                } else {
                    echo "<th></th>";
                }
                // Generiranje ćelija s dugmićima
                for ($col = 1; $col <= 18; $col++) {
                    // Uvijeti za ćelije tablice u kojima nema elemenata
                    if (($row == 1 && $col >= 2 && $col <= 17) || 
                        ($row >= 2 && $row <= 3 && $col >= 3 && $col <= 12) ||
                        ($row == 8) ||
                        ($row >= 9 && $row <= 10 && $col <= 3)
                    ) {
                        echo "<td style='height:20px'></td>"; // Ostavljamo te ćelije prazne
                    } else {
                        // Učitavanje podataka iz XML fajla pomoću indexa
                        $number = $xml->element[$index]->number;
                        $symbol = $xml->element[$index]->symbol;
                        $mass = number_format((float)$xml->element[$index]->mass, 2, '.', ''); // Zaokružujemo broj na dvije decimale
                        $family = (string) $xml->element[$index]->family; // Dohvaćamo obitelj elementa kao string

                        // Dodajemo klasu za boju s obzirom na vrstu elementa (učitano iz XML fajla)
                        $btnClass = '';
                        if ($family == 'metal' ||
                            $family == 'alkalijski metal' ||
                            $family == 'zemnoalkalijski metal' ||
                            $family == 'prijelazni metal' ||
                            $family == 'lantanoid' ||
                            $family == 'aktinoid'
                        ) {
                            $btnClass = 'btn-info';

                        } elseif ($family == 'polumetal') {
                            $btnClass = 'btn-success';

                        } elseif ($family == 'nemetal' ||
                            $family == 'halogeni element' ||
                            $family == 'plemeniti plin'
                        ) {
                            $btnClass = 'btn-warning';
                        }
                        
                        //Stvaranje button-a za svaki element i dodavanje linka na taj element
                        echo "<td>";
                        echo "<a href=elementi.php#d-$index-d class='btn btn-secondary btn-block $btnClass'>";
                        echo "<span class='btn-content text-7'>$number</span>";
                        echo "<span class='btn-content font-weight-bold'>$symbol</span>";
                        echo "<span class='btn-content text-7'>$mass</span>";
                        echo "</a>";
                        echo "</td>";

                        // Promjena indexa na idući element
                        $index++;

                        // Promjena indexa kako bi se tablica pravilno ispunila za lantanoide i aktinoide
                        if ($index == 57 || $index == 89) {
                            $index += 14;
                        }

                        if ($index == 118) {
                            $index = 57;
                            $table_switch = 1;
                        }

                        if ($table_switch == 1) {
                            if ($index == 72) {
                                $index = 89;
                            }
                        }

                    }
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
