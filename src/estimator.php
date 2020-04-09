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
    return $severeImpact;
}
function getImpact($data)
{
    $impact = [];
    $impact['currentlyInfected'] = $data['reportedCases'] * 10;
    $impact['infectionsByRequestedTime'] = getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $impact['currentlyInfected']);
    return $impact;
}

function covid19ImpactEstimator($data)
{

  $test= array('data' =>$data ,'impact'=>getImpact($data),'severeImpact'=>getSevereImpact($data) );

    return $test;
   
}

