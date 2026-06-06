<?php

session_start();

require_once '../models/Favorito.php';

$model = new Favorito();

$model->adicionar(1,1);

echo "Favorito inserido";