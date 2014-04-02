#!/usr/bin/env php
<?php

define("X", 20);
define("Y", 20);

system("clear");
run();

// Fonction principale du programme, c'est une boucle infinie.
function run() {
  $grid = init_grid(); // On remplit un tableau à deux dimensions de valeurs aléatoires comprises entre 0 et 1

  while (true) {
    evolve($grid); // On fait évoluer les cellules.
    draw_grid($grid); // On dessine l'état des cellules
    usleep(200000); // On coupe le programme pendant 0,2 secondes pour ne pas saturer le processeur
    system("clear"); // On efface le terminal
  }
}

function init_grid() {
  $grid = array();

  for ($j = 0; $j < Y; ++$j) {
    $grid[$j] = array();
    for ($i = 0; $i < X; ++$i) {
      $grid[$j][$i] = rand(0, 1);
    }
  }
  return $grid;
}

function draw_grid($grid) {
  for ($j = 0; $j < Y; ++$j) {
    for ($i = 0; $i < X; ++$i) {
      echo $grid[$j][$i];
    }
    echo "\n";
  }
}

function evolve(&$grid) //code de progression des cellules
{
  $grid_bis = $grid;
  for ($j = 0; $j < Y; $j++)
    for ($i = 0; $i < X; $i++)
      {
	$k = 0;
	for ($j_2 = ($j - 1); $j_2 <= ($j + 1); $j_2++)
	  for ($i_2 = ($i - 1); $i_2 <= ($i + 1); $i_2++)
	    if ($grid_bis[$j_2][$i_2] == 1)
	      $k++;
	$k -= $grid[$j][$i];
	if ($k == 3) 		// règle 1 naissance
	  $grid[$j][$i] = 1;
	else if ($k == 2) 	// règle 2 etat stable
	  $grid[$j][$i] = $grid[$j][$i];
	else 			// règle 3 mort
	  $grid[$j][$i] = 0;
      }
}
