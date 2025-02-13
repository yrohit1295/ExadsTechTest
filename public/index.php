<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ABTest\ABTestDesign;

try {
    $promotionId = isset($_GET['promotion_id']) ? intval($_GET['promotion_id']) : 1;
    $abTest = new ABTestDesign($promotionId);
    $abTest->redirectToDesign();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
