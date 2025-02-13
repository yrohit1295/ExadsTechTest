<?php

$designId = isset($_GET['design']) ? intval($_GET['design']) : 0;

$designs = [
    1 => "<h1>Design1</h1>",
    2 => "<h1>Design2</h1>",
    3 => "<h1>Design3</h1>",
];

echo $designs[$designId] ?? "<h1>Design Not Found</h1>";
