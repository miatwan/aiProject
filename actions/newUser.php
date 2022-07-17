<?php
$check = true;
$accountType = $_POST['userType'];
$schoolName = $_POST['schoolName'];
$arName = $_POST['nameAr'];
$enName = $_POST['nameEn'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['userPassword1'];
$password2 = $_POST['userPassword2'];

$done = false;
if($password == $password2)
{
        if($userLogin->checkUserValidity($email)==0)
        {
            $addUser = $userLogin->addNewAdminUser($accountType,$schoolName,$arName, $enName, $email, $phone, password_hash($password, PASSWORD_DEFAULT));
            if ($addUser)
            {
                $S = $joz_sys_labels[22];
                $done = true;
                $usersNotifications->sendNotificationOnRigestier($addUser);
            } else
            {
                $F = 'حدث خلل غير معروف , لم يتم تسجيل المستخدم الجديد'.'<br>';
                $check = false;
            }
        }else
        {
            $F = 'البريد الالكتروني الذي قمت بإدخاله تم إستخدامه سابقا'.'<br>';
            $check = false;
        }
}else
{
    $F = 'كلمة المرور في الحقل الاول غير متطابقة مع الحقل الثاني'.'<br>';
    $check = false;
}