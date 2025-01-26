<?php
include 'connect.php';

$query = "SELECT * FROM countries ORDER BY totalGold DESC, totalSilver DESC, totalBronze DESC";
$countries = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Olympic Games Medals</title>
    <link rel="icon" type="image/x-icon" href="images/iconImage.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid mx-5 py-1">
            <a class="navbar-brand" href="#">
                <img src="images/image 3.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-0">
        <img src="images/Group 4.png" alt="" class="img-fluid">
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-1" style="font-family: OlympicHeadline-Regular;">THE OLYMPIC GAMES</h1>
                <p class="lead" style="font-family: OlympicSans">The Olympic Games are an international sporting event featuring summer and winter sports competitions, in which thousands of athletes from around the world participate in various contests. The Games are widely regarded as the world's foremost sports competition and are held every four years, alternating between summer and winter Olympics every two years.</p>
                <h2 class="display-4" style="font-family: OlympicHeadline-Regular;">ORIGINS OF THE OLYMPICS</h2>
                <p class="lead" style="font-family: OlympicSans">The Olympic Games trace their origins back to ancient Greece, nearly 3,000 years ago. The first recorded Games were held in 776 BCE in Olympia, a sanctuary site in the Peloponnesus dedicated to the Greek god Zeus.</p>
                <p class="lead" style="font-family: OlympicSans">The Olympics embody values such as excellence, respect, and friendship. They promote unity among nations and highlight the importance of sportsmanship and perseverance.</p>
            </div>
        </div>
    </div>

    <div class="container Medals my-5">
        <div class="row justify-content-center pt-5">
            <div class="col-12 d-flex justify-content-between align-items-center" style="width: 1100px; height: 96.82px;">
                <div class="">
                    <img src="images/olympicsWhiteLogo.png" alt="" style="max-width: 100%; height: auto; max-height: 85px;">
                </div>
                <div class="">
                    <h1 class="display-1" style="color: white; font-family: OlympicHeadline-Regular">MEDALS</h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-between align-items-end p-2 pt-0" style="width: 1170px; height: 96.82px;">
                <div class=""><p class="lead justify-content-end" style="color: white; margin: 0; font-family: OlympicSans;">#</p></div>
                <div class=""><p class="lead" style="color: white; margin: 0; font-family: OlympicSans;">Teams/NOCs</p></div>
                <div class="justify-content-between">
                    <img src="images/goldMedal.png" alt="Gold Medal" class="me-3" style="width: 40px; height: 40px; margin: 0;">
                </div>
                <div class="justify-content-between">
                    <img src="images/silverMedal.png" alt="Silver Medal" class="me-3" style="width: 40px; height: 40px; margin: 0;">
                </div>
                <div class="justify-content-between">
                    <img src="images/bronzeMedal.png" alt="Bronze Medal" class="me-3" style="width: 40px; height: 40px; margin: 0;">
                </div>
                <div class="justify-content-between">
                    <img src="images/medals.png" alt="Medals" class="me-3" style="width: 45px; height: 40px; margin: 0;">
                </div>
            </div>
        </div>

        <?php
        $rank = 1; 
        while ($row = mysqli_fetch_assoc($countries)): 
            $totalMedals = $row['totalGold'] + $row['totalSilver'] + $row['totalBronze'];
        ?>
            <div class="row justify-content-center mb-5">
                <div class="col-12 custom-box d-flex align-items-center">
                    <div class="col-2 lead text-center" style="width: 35px; font-family: OlympicSans;">
                        <?php echo $rank++; ?>
                    </div>
                    <div class="col-2 d-flex align-items-center m-2" style="width: 403px;">
                        <img src="images/<?php echo $row['countryImage']; ?>" alt="countryFlag" style="width: 101px; height: 53px;">
                        <p class="lead p-2 m-0" style="font-family: OlympicSans;"><?php echo $row['countryName']; ?></p>
                    </div>
                    <div class="col-2" style="width: 217px;"><p class="lead p-2 m-0" style="font-family: OlympicSans"><?php echo $row['totalGold']; ?></p></div>
                    <div class="col-2" style="width: 215px;"><p class="lead p-2 m-0" style="font-family: OlympicSans"><?php echo $row['totalSilver']; ?></p></div>
                    <div class="col-2" style="width: 222px;"><p class="lead p-2 m-0" style="font-family: OlympicSans"><?php echo $row['totalBronze']; ?></p></div>
                    <div class="col-2" style="width: 61px;"><p class="lead p-2 m-0" style="font-family: OlympicSans"><?php echo $totalMedals; ?></p></div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display-1" style="font-family: OlympicHeadline-Regular;">HIGHLIGHTS & REPLAYS</h1>
                <hr style="border: 1px solid #ddd; margin-bottom: 40px;">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/btWIF0LignA?si=Di1Pf2KRqtWQOo4c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6 mb-4">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/O1TuqSwjpFI?si=NI_yQO8cnwuoTLUg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center p-3">
        <p class="lead" style="font-family: OlympicSans;">&copy; 2025 International Olympic Committee. All rights reserved.</p>
        <img src="images/image 3.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
