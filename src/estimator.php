<?php


function getInfectionsByRequestedTime($type, $duration, $currentlyInfected)
{
    $days = $duration; // assume the type is days
    switch ($type) {
        case 'weeks':
            $days = $duration * 7;
            break;
        case 'months':
            $days = $duration * 7 * 30;
            $days = $duration * 30;
            break;
    }
    $setOfThreeDays = floor($days / 3);
    $infectionsByRequestedTime = $currentlyInfected * pow(2, $setOfThreeDays);
    return $infectionsByRequestedTime;
}

function getSevereImpact($data)
{
    $severeImpact = [];
    $severeImpact['currentlyInfected'] = $data['reportedCases'] * 50;
    $severeImpact['infectionsByRequestedTime'] = getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $severeImpact['currentlyInfected']);
    
    //challenge 2
    $severeImpact['severeCasesByRequestedTime'] = (0.15 * getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $severeImpact['currentlyInfected']));
    $severeImpact['hospitalBedsByRequestedTime'] = $data['totalHospitalBeds'] - $severeImpact['severeCasesByRequestedTime'];
    $severeImpact['hospitalBedsByRequestedTime'] = (0.35 * $data['totalHospitalBeds']) - $severeImpact['severeCasesByRequestedTime'];
    //challenge 3
    $severeImpact['casesForICUByRequestedTime'] = floor(0.05 * $severeImpact['infectionsByRequestedTime']);
    $severeImpact['casesForICUByRequestedTime'] = 0.05 * $severeImpact['infectionsByRequestedTime'];
    $severeImpact['casesForVentilatorsByRequestedTime'] = 0.02 * $severeImpact['infectionsByRequestedTime'];
    
    return $severeImpact;
}
function getImpact($data)
{
    $impact = [];
    $impact['currentlyInfected'] = $data['reportedCases'] * 10;
    $impact['infectionsByRequestedTime'] = getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $impact['currentlyInfected']);
  
  //challenge 2
    $impact['severeCasesByRequestedTime'] = (0.15 * getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $impact['currentlyInfected']));
    $impact['hospitalBedsByRequestedTime'] = $data['totalHospitalBeds'] - $impact['severeCasesByRequestedTime'];
    $impact['hospitalBedsByRequestedTime'] = (0.35 * $data['totalHospitalBeds']) - $impact['severeCasesByRequestedTime'];
// challenge 3
$impact['casesForICUByRequestedTime'] = 0.05 * $impact['infectionsByRequestedTime'];

    return $impact;
}

function covid19ImpactEstimator($data)
{

  $result= array('data' =>$data ,'impact'=>getImpact($data),'severeImpact'=>getSevereImpact($data) );

    return $result;
   
}

