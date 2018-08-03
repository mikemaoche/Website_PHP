<?php
require_once("database.php");
require_once("actionAppreciation.php");
$app = new Appreciation(new Database);
$app->trouverUsager($usagerId);