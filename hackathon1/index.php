<?php
session_start();
require_once ('../vendor/autoload.php');

require_once ('header.php');


use GuzzleHttp\Client;
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://cdn.rawgit.com/akabab/superhero-api/0.2.0/api/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);
$response = $client->request('GET', 'all.json');
$body = $response->getBody();
$characters = json_decode($body);

?>



<body>

    <?php //include 'header.php'?>



    <div class="container">
        <form action="fight.php" method="post">
            <div class="row">

                <div class="col-md-12  text-center p-3">
                    <button type="submit" class="btn btn-primary btn-lg col-md-8
                    text-center link-menu">Fight !!!</button>
                    <?php
                    if(isset($_GET['echec'])){
                        echo "<p>Merci de séléctionner 2 personnages</p>";
                    }
                    ?>
                </div>

            </div>
            <div class="row justify-content-md-center">
                <?php
                foreach ($characters as $character) {
                ?>
                <div class="col-md-2 col-sm-6 text-center m-3">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $character->images->sm; ?>" alt="Card image cap">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-card" data-toggle="modal"
                                    data-target="#modal<?php echo $character->id?>" name="modal">
                                Description
                            </button>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="<?php echo $character->id?>" id="<?php echo $character->id?>">
                                <label class="custom-control-label" for="<?php echo $character->id ?>"><h5
                                            class="h5-card"><?php echo $character->name; ?></h5>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="modal<?php echo $character->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="background-color: <?php
                            if ($character->appearance->gender  == 'Male'){
                                echo "#ffaa80";
                            } else {
                                echo "#f7c7f9";
                            }
                            ?>">
                                <div class="modal-header">
                                    <h2 class="modal-title text-center" id="exampleModalLongTitle"><?php if(isset($character)) { echo
                                        $character->name; }?></h2>
                                </div>
                                <div class="modal-body">
                                    <div class="row d-flex">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <img class="rounded " src="<?php if(isset($character)) { echo $character->images->sm; } ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <h6>Intelligence</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-intelligence" role="progressbar"
                                                     aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100" style="width:<?php echo $character->powerstats->intelligence
                                                ?>%"></div>
                                            </div>
                                            <h6>Force</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-strength" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100" style="width:<?php if(isset($character)) {echo
                                                $character->powerstats->strength; }
                                                ?>%"></div>
                                            </div>
                                            <h6>Vitesse</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-speed" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100" style="width:<?php echo $character->powerstats->speed
                                                ?>%"></div>
                                            </div>
                                            <h6>Resistence</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-durability" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100" style="width:<?php if(isset($character)) { echo
                                                $character->powerstats->durability; }
                                                ?>%"></div>
                                            </div>
                                            <h6>Pouvoir</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-power" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100" style="width:<?php if(isset($character)) { echo
                                                $character->powerstats->power; }
                                                ?>%"></div>
                                            </div>
                                            <h6>Combat</h6>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-combat" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100" style="width:<?php if(isset($character)) { echo
                                                $character->powerstats->combat; }
                                                ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-center h4-modalTitle">Pedigré</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <h6 class="p-pedigree">Taille</h6>
                                            <h6 class="p-pedigree">Poid</h6>
                                            <h6 class="p-pedigree">Sexe</h6>
                                        </div>
                                        <div class="col-2">
                                            <h6><?php if(isset($character)) { echo $character->appearance->height[1];} ?></h6>
                                            <h6><?php if(isset($character)) { echo $character->appearance->weight[1];} ?></h6>
                                            <h6><?php if(isset($character)) { echo $character->appearance->gender;} ?></h6>
                                        </div>
                                        <div class="col-5">
                                            <h6 class="p-pedigree">Couleur des yeux</h6>
                                            <h6 class="p-pedigree">Couleur des cheveux</h6>
                                            <h6 class="p-pedigree">Alias</h6>
                                        </div>
                                        <div class="col-3">
                                            <h6><?php if(isset($character)) { echo $character->appearance->eyeColor;} ?></h6>
                                            <h6><?php if(isset($character)) { echo $character->appearance->hairColor;} ?></h6>
                                            <h6><?php if(isset($character)) { echo $character->biography->aliases[0];} ?></h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>



                <?php
                }
                ?>
            </div>
        </form>
        <audio src="music/Let's%20Get%20Ready%20to%20Rumble!!%20___%20Michael%20Buffer.mp3" autoplay ></audio>



    </div>


    <div id="scrollUp">
        <a href="#top"><img src="Images/to_top.png"/></a>
    </div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="script.js"></script>


</body>

</html>
