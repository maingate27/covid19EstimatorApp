<?php


function covid19ImpactEstimator($data){
        $name = $data["region"]["name"];
        $avgAge = $data["region"]["avgAge"];
        $avgDailyIncomeInUSD = $data["region"]["avgDailyIncomeInUSD"];
        $avgDailyIncomePopulation = $data["region"]["avgDailyIncomePopulation"];
        $periodType = $data["periodType"];
        $timeToElapse = $data["timeToElapse"];
        $reportedCases = $data["reportedCases"];
        $population = $data["population"];
        $totalHospitalBeds = $data["totalHospitalBeds"];
        $currentlyInfected = impactCurrentlyInfected($reportedCases);
        $severeCurrentlyInfected = severeCurrentlyInfected($reportedCases);
        $impactInfectionsByRequestedTime = infectionsByRequestedTime($currentlyInfected, $periodType, $timeToElapse);
        $severeInfectionsByRequestedTime = infectionsByRequestedTime($severeCurrentlyInfected, $periodType, $timeToElapse);;
        $impactSevereCasesByRequestedTime = 0.15 * $impactInfectionsByRequestedTime;
        $severeCasesByRequestedTime = 0.15 * $severeInfectionsByRequestedTime;
        $impactHospitalBedsByRequestedTime = availableHospitalBeds($totalHospitalBeds, $impactSevereCasesByRequestedTime);
        $severeHospitalBedsByRequestedTime = availableHospitalBeds($totalHospitalBeds, $severeCasesByRequestedTime);
        $casesForICUByRequestedTime = casesForICUByRequestedTime($impactInfectionsByRequestedTime);
        $severeCasesForICUByRequestedTime = casesForICUByRequestedTime($severeInfectionsByRequestedTime);
        $casesForVentilatorsByRequestedTime = casesForVentilatorsByRequestedTime($impactInfectionsByRequestedTime);
        $severeCasesForVentilatorsByRequestedTime = casesForVentilatorsByRequestedTime($severeInfectionsByRequestedTime);
        $dollarsInFlight = dollarsInFlight($impactInfectionsByRequestedTime,$periodType, $timeToElapse,
            $avgDailyIncomeInUSD, $avgDailyIncomePopulation);
        $severeDollarsInFlight = dollarsInFlight($severeInfectionsByRequestedTime,$periodType, $timeToElapse,
            $avgDailyIncomeInUSD, $avgDailyIncomePopulation);
        $responseImpact = array(
            "currentlyInfected" => $currentlyInfected,
            "infectionsByRequestedTime" => (int)$impactInfectionsByRequestedTime,
            "severeCasesByRequestedTime" => (int)$impactSevereCasesByRequestedTime,
            "hospitalBedsByRequestedTime" => (int)$impactHospitalBedsByRequestedTime,
            "casesForICUByRequestedTime" => (int)$casesForICUByRequestedTime,
            "casesForVentilatorsByRequestedTime" => (int)$casesForVentilatorsByRequestedTime,
            "dollarsInFlight" => $dollarsInFlight,
            "dollarsInFlight" => (int)$dollarsInFlight
        );

        $responseSevereImpact = array(
            "currentlyInfected" => $severeCurrentlyInfected,
            "infectionsByRequestedTime" => (int)$severeInfectionsByRequestedTime,
            "severeCasesByRequestedTime" => (int)$severeCasesByRequestedTime,
            "hospitalBedsByRequestedTime" => (int)$severeHospitalBedsByRequestedTime,
            "casesForICUByRequestedTime" => (int)$severeCasesForICUByRequestedTime,
            "casesForVentilatorsByRequestedTime" => (int)$severeCasesForVentilatorsByRequestedTime,
            "dollarsInFlight" => $severeDollarsInFlight,
            "dollarsInFlight" => (int)$severeDollarsInFlight
        );


       return array(
           "data" => $data,
           "impact" => $responseImpact,
               "severeImpact" => $responseSevereImpact
       );
    }
//print_r( covid19ImpactEstimator($decoded));
function periodConverter($periodType, $timeToElapse)
{
    $days = 0;
    switch (strtolower($periodType)) {
        case "months":
            $days = 30 * $timeToElapse;
            break;
        case "weeks":
            $days = 7 * $timeToElapse;
            break;
        case "days":
            $days = $timeToElapse;
            break;
        default:
            return "Please enter a valid period type or duration";
    }
    return $days;
}
function impactCurrentlyInfected($reportedCases)
{
    return $reportedCases * 10;
}
function severeCurrentlyInfected($reportedCases)
{
    return $reportedCases * 50;
}
function infectionsByRequestedTime($currentlyInfected, $periodType, $timeToElapse)
{
    $factor = floor(periodConverter($periodType, $timeToElapse) / 3);
    return $currentlyInfected * pow(2, $factor);
}
function availableHospitalBeds($totalHospitalBeds, $cases)
{
    //$availableBeds = floor(0.35 * $totalHospitalBeds);
    $availableBeds = 0.35 * $totalHospitalBeds;
    return $availableBeds - $cases;
}
function casesForICUByRequestedTime($infectionsByRequestedTime)
{
    return floor(0.05 * $infectionsByRequestedTime);
}
function casesForVentilatorsByRequestedTime($infectionsByRequestedTime)
{
    return floor(0.02 * $infectionsByRequestedTime);
}
function dollarsInFlight($infectionsByRequestedTime,$periodType, $timeToElapse,
                         $avgDailyIncomeInUSD, $avgDailyIncomePopulation)
{
    $days = floor(periodConverter($periodType, $timeToElapse));

   // $dollars =  $infectionsByRequestedTime * $avgDailyIncomeInUSD * $avgDailyIncomePopulation * $days;
    //return round($dollars, 1);
    $dollars =  ($infectionsByRequestedTime * $avgDailyIncomeInUSD * $avgDailyIncomePopulation) / $days;
    return floor($dollars);
} 
