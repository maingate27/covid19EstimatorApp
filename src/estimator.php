<?php


function getImpact($data)
{
    $impact = new stdClass();
    $impact->currentlyInfected = $reportedCases * 10;
    $impact->infectionsByRequestedTime = getInfectionsByRequestedTime($periodType, $timeToElapse, $impact->currentlyInfected);
    $impact->currentlyInfected = $data->reportedCases * 10;
    $impact->infectionsByRequestedTime = getInfectionsByRequestedTime($data->periodType, $data->timeToElapse, $impact->currentlyInfected);
    return $impact;
}

function getSevereImpact($data)
{
    $severeImpact = new stdClass();
    $severeImpact->currentlyInfected = $reportedCases * 50;
    $severeImpact->infectionsByRequestedTime = getInfectionsByRequestedTime($periodType, $timeToElapse, $severeImpact->currentlyInfected);
    $severeImpact->currentlyInfected = $data->reportedCases * 50;
    $severeImpact->infectionsByRequestedTime = getInfectionsByRequestedTime($data->periodType, $data->timeToElapse, $severeImpact->currentlyInfected);
    return $severeImpact;


function covid19ImpactEstimator($data)
{

  $data = (Object)($data);
    $data1 = (Object)($data);
    $data = (Array)($data);
    $return = new stdClass();
    $return->data = $data;
    $return->impact = getImpact($data);
    $return->severeImpact = getSevereImpact($data);
    $return->impact = getImpact($data1);
    $return->severeImpact = getSevereImpact($data1);
    return $return;
}

