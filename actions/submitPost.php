<?php
//getAll qwestions
$getEvaluations =  $traMod->getEvaluationQwestions(0);
for($i=0;$i<sizeof($getEvaluations);$i++)
{
    $answre = $_POST[$getEvaluations[$i]->id];
    $insertAnswres = $traMod->insertEvaluationAnsuresPost($userTraningID,$getEvaluations[$i]->id,$answre);
}

if($insertAnswres)
{
    $checkIfCertificationNeeded = $traMod->getEvaluationAnswresPost($userTraningID, 0);
    if (sizeof($checkIfCertificationNeeded) > 0) {
        //generate user certification
        $traMod->generateNewCertification($tr_userID);
    }
    $S = 'لقد تم تسجيل جميع أجوبتك على التقيم البعدي,لقد تم إصدار شهادتك';
}

?>
