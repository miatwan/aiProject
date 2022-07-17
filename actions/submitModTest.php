<?php
$module = $_POST['model'];
$chapter = $_POST['chapter'];
$exam = $_POST['exam'];

$getQwestionsOfExam = $traMod->getQwestionsOfExam($chapter, $exam);
for ($i = 0; $i < sizeof($getQwestionsOfExam); $i++) {
    $qwestionId = $getQwestionsOfExam[$i]->id;
    $getQwestionAnswre = $traMod->getAnswreOfQwestion($getQwestionsOfExam[$i]->id);

    $wrongRightStatus = 0;
    if ($getQwestionsOfExam[$i]->answerType == 1) {
        $multiAnswreUser = NULL;
        $multiAnswreSystem = NULL;
        $narrativeAnswreUser = $_POST[$getQwestionsOfExam[$i]->id];
        $narrativeAnswreSystem = $getQwestionAnswre[0]->narrative_answer;
        //check if the user give correct narrative answer
        if($traMod->correctingNartiveAnswers($narrativeAnswreUser,$narrativeAnswreSystem))
        {
            $wrongRightStatus = 1;
        }
    } else
        if ($getQwestionsOfExam[$i]->answerType == 2) {
            $multiAnswreUser = $_POST[$getQwestionsOfExam[$i]->id];
            $multiAnswreSystem = $getQwestionAnswre[0]->multiple_answer;
            $narrativeAnswreUser = NULL;
            $narrativeAnswreSystem = NULL;
            if ($multiAnswreUser == $multiAnswreSystem) {
                $wrongRightStatus = 1;
            }
        }


    //check if question exist or not to determine if its update or insert
    $checkMod = $traMod->checkIfQuestionRegistered($module, $chapter, $exam, $qwestionId);

        if(sizeof($checkMod)==1)
        {
            //update question
            $insertAnswres = $traMod->updateModulesAnswres($module, $chapter, $exam, $qwestionId, $multiAnswreUser, $multiAnswreSystem, $narrativeAnswreUser, $narrativeAnswreSystem, $wrongRightStatus,$checkMod[0]->id);
        }else
        {
            //register new answer
            $insertAnswres = $traMod->insertModulesAnswres($module, $chapter, $exam, $qwestionId, $multiAnswreUser, $multiAnswreSystem, $narrativeAnswreUser, $narrativeAnswreSystem, $wrongRightStatus);
        }
}

if ($insertAnswres) {
    $S = 'لقد تم تسجيل جميع أجوبتك ';
    ?>

<script>
    window.location.href = "<?php echo $relativePth_root; ?>index/trainingManager/default/";
</script>
<?php
}

?>
