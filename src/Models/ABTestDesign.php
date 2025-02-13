<?php

namespace App\Models;

use App\Helpers\LogHelper;
use App\Interfaces\ABTestInterface;
use Exads\ABTestData;
use Exception;

class ABTestDesign implements ABTestInterface
{
    private array $promotionData;

    public function __construct(int $promoId)
    {
        try {
            $abTest = new ABTestData($promoId);
            $this->promotionData = [
                'name' => $abTest->getPromotionName(),
                'designs' => $abTest->getAllDesigns(),
            ];
        } catch (Exception $e) {
            LogHelper::logMessage("ERROR", "Failed to retrieve A/B test data: " . $e->getMessage());
            throw new Exception("Could not fetch A/B test data.");
        }
    }

    /**
     * Selects a design based on split percentage
     */
    public function getDesign(): array
    {
        try {
            $designs = $this->promotionData['designs'];
            $random = rand(1, 100);
            $cumulativePercentage = 0;

            foreach ($designs as $design) {
                $cumulativePercentage += $design['splitPercent'];
                if ($random <= $cumulativePercentage) {
                    return $design;
                }
            }
            LogHelper::logMessage("ERROR", "No design selected, check split percentages.");
            throw new Exception("No valid design found.");

        } catch (Exception $e) {
            LogHelper::logMessage("ERROR", "Error selecting design: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Redirects user to the selected design
     */
    public function redirectToDesign():void
    {
        try {
            $selectedDesign = $this->getDesign();
            $designId = $selectedDesign['designId'];
            $designName = $selectedDesign['designName'];
            $url = "http://{$_SERVER['HTTP_HOST']}/design.php?design=" . $designId;
            LogHelper::logMessage("INFO", "Redirecting user to: $designName ($url)");
            header("Location: $url");
            exit();
        } catch (Exception $e) {
            LogHelper::logMessage("ERROR", "Redirection failed: " . $e->getMessage());
            echo "An error occurred. Please try again later.";
        }
    }
}

?>
