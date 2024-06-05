<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodni sustav elemenata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
// Otvorite i pročitajte XML fajl
$xml = simplexml_load_file('elementi.xml');
?>

<header class="position-fixed w-100">
    <h1 class="display-4 p-3 text-center bg-white">ELEMENTI</h1>
</header>

<div>
    <?php
    $index = 0;
    foreach ($xml->element as $element) {
        // Dohvaćanje svih podataka o elementu
        $number = $element->number;
        $symbol = $element->symbol;
        $name = $element->name;
        $mass = $element->mass;
        $electronConfiguration = $element->electronConfiguration;
        $radius = $element->radius;
        $standardState = $element->standardState;
        $bondingType = $element->bondingType;
        $meltingPoint = $element->meltingPoint;
        $boilingPoint = $element->boilingPoint;
        $density = $element->density;
        $family = $element->family;
        $yearDiscovered = $element->yearDiscovered;

        //Uvjeti za boju pozadine kartice elementa
        $cardClass = '';
        if ($family == 'metal' ||
            $family == 'alkalijski metal' ||
            $family == 'zemnoalkalijski metal' ||
            $family == 'prijelazni metal' ||
            $family == 'lantanoid' ||
            $family == 'aktinoid'
        ) {

            $cardClass = 'bg-info';
        } elseif ($family == 'polumetal') {
            $cardClass = 'bg-success';

        } elseif ($family == 'nemetal' ||
            $family == 'halogeni element' ||
            $family == 'plemeniti plin'
        ) {
            $cardClass = 'bg-warning';
        }

        //Uvjeti za boju teksta
        $textClass = '';
        if ($family == 'nemetal' ||
            $family == 'halogeni element' ||
            $family == 'plemeniti plin'
        ) {$textClass = 'text-black';}
        else{$textClass = 'text-white';}

        //Uvjeti za boju buttona
        $btnClass = '';
        if ($family == 'nemetal' ||
            $family == 'halogeni element' ||
            $family == 'plemeniti plin'
        ) {$btnClass = 'btn-outline-dark';}
        else{$btnClass = 'btn-outline-light';}

        // Ispiši HTML za svaki element
        echo "<div id='d-$index-d' class='container p-3 h-20' ></div>";
        echo "<div class='container w-50 mt-5 p-5 $cardClass $textClass'>";
        echo "<h2 class='mb-3 display-4'>$name ($symbol)</h2>";
        echo "<ul>";
        echo "<li>Atomski broj: $number</li>";
        echo "<li>Relativna atomska masa: $mass</li>";
        echo "<li>Elektronska konfiguracija: $electronConfiguration</li>";
        echo "<li>Radijus: $radius pm</li>";
        echo "<li>Agregacijsko stanje pri s.u.: $standardState</li>";
        echo "<li>Vrsta veze: $bondingType</li>";
        echo "<li>Talište: $meltingPoint K</li>";
        echo "<li>Vrelište: $boilingPoint K</li>";
        echo "<li>Gustoća: $density g/cm3</li>";
        echo "<li>Vrsta: $family</li>";
        echo "<li>Godina otkrića: $yearDiscovered.</li>";
        echo "</ul>";
        echo "<a href=index.php#PSE class='btn btn-block p-3 $btnClass'>NATRAG</a>";
        echo "</div>";
        $index++;
    }
    ?>
</div>
</body>
</html>
