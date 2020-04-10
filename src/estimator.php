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
    $numberOfDays =0;
    $severeImpact = [];
    $severeImpact['currentlyInfected'] = $data['reportedCases'] * 50;
    $severeImpact['infectionsByRequestedTime'] = getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $severeImpact['currentlyInfected']);
    
    //challenge 2
    $severeImpact['severeCasesByRequestedTime'] = floor(0.15 * $severeImpact['infectionsByRequestedTime']);
    
    $severeImpact['hospitalBedsByRequestedTime'] = intval((0.35 * $data['totalHospitalBeds']) - $severeImpact['severeCasesByRequestedTime']);
    //challenge 3
    $severeImpact['casesForICUByRequestedTime'] = floor(0.05 * $severeImpact['infectionsByRequestedTime']);

    $severeImpact['casesForVentilatorsByRequestedTime'] =intval( 0.02 * $severeImpact['infectionsByRequestedTime']);

   
if ($data['periodType'] === 'days') {
    $numberOfDays = $data['timeToElapse'];
  } else if ($data['periodType'] === 'weeks') {
    $numberOfDays = 7 * $data['timeToElapse'];
  }
  if ($data['periodType'] === 'months') {
    $numberOfDays = 30 * $data['timeToElapse'];
  }

    
    $severeImpact['dollarsInFlight']=number_format(($severeImpact['infectionsByRequestedTime'] * $data['region']['avgDailyIncomePopulation']* $data['region']['avgDailyIncomeInUSD'] * $numberOfDays ), 2);

    
    return $severeImpact;
}
function getImpact($data)
{
    $numberOfDays=0;
    $impact = [];
    $impact['currentlyInfected'] = $data['reportedCases'] * 10;
    $impact['infectionsByRequestedTime'] = getInfectionsByRequestedTime($data['periodType'], $data['timeToElapse'], $impact['currentlyInfected']);
  
  //challenge 2
    $impact['severeCasesByRequestedTime'] = floor(0.15 * $impact['infectionsByRequestedTime']);

    $impact['hospitalBedsByRequestedTime'] =  intval((0.35 * $data['totalHospitalBeds']) - $impact['severeCasesByRequestedTime']);
// challenge 3
$impact['casesForICUByRequestedTime'] = intval( 0.05 * $impact['infectionsByRequestedTime']);
$impact['casesForVentilatorsByRequestedTime'] =intval( 0.02 * $impact['infectionsByRequestedTime']);

if ($data['periodType'] === 'days') {
    $numberOfDays = $data['timeToElapse'];
  } else if ($data['periodType'] === 'weeks') {
    $numberOfDays = 7 ;
  }
  if ($data['periodType'] === 'months') {
    $numberOfDays = 30 ;
  }


$impact['dollarsInFlight']=number_format(($impact['infectionsByRequestedTime'] * $data['region']['avgDailyIncomePopulation']* $data['region']['avgDailyIncomeInUSD'] * $numberOfDays), 2);

    return $impact;
}

function covid19ImpactEstimator($data)
{

  $result= array('data' =>$data ,'impact'=>getImpact($data),'severeImpact'=>getSevereImpact($data) );

    return $result;
   
}

