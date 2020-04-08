<?php

function covid19ImpactEstimator($data)
{

  $return = ['data' => $data, 'impact' => getImpact($data), 'severeImpact' => getSevereImpact($data)];
    echo print_r($return);
    return $return;
}