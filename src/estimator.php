<?php

function covid19ImpactEstimator($data)
{

  $arr=json_decode($data,true);
  //echo $arr['region']['name'];
  
  #impact
  
  $result='{
    "impact":{
      "currentlyInfected": 0,
        "infectionsByRequestedTime": 0
    },
    "severeImpact":{
      "currentlyInfected": 0,
        "infectionsByRequestedTime": 0
    },
    
  }';
  
  $extract=json_decode($result,true);
  
  $extract['impact']['currentlyInfected']=$arr['reportedCases'] * 10;
  $extract['impact']['infectionsByRequestedTime']=$extract['impact']['currentlyInfected'] * 512;
  
  $extract['severeImpact']['currentlyInfected']=$arr['reportedCases'] * 50;
  $extract['severeImpact']['infectionsByRequestedTime']=$extract['severeImpact']['currentlyInfected'] * 512;
  return $result;
}