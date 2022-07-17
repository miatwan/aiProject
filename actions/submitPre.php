<?php
//getAll qwestions
$getEvaluations =  $traMod->getEvaluationQwestions(0);
for($i=0;$i<sizeof($getEvaluations);$i++)
{
    $answre = $_POST[$getEvaluations[$i]->id];
    $insertAnswres = $traMod->insertEvaluationAnsuresPre($userTraningID,$getEvaluations[$i]->id,$answre,$answerPost=NULL,$getEvaluations[$i]->idealAnswre);
}

if($insertAnswres)
{
    $S = 'لقد تم تسجيل جميع أجوبتك على التقيم القبلي, يمكنك الان متابعة التدريب';
}

?>
