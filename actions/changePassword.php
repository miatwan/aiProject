<?php
$check = true;
$accountType = 3;
$password = $_POST['password'];
$password2 = $_POST['confirm'];


$done = false;

if($password == $password2)
{

    if($publicFunctions->checkPasswordResetTokenValidity($_GET['par1'])==1)
    {
        $userIS = $publicFunctions->changeUserPassword(password_hash($password, PASSWORD_DEFAULT),$_GET['par1']);
        if ($userIS)
        {
            $S = 'لقد تم التسجيل';
            $done = true;
            $usersNotifications->sendNotificationOnPassChanged($userIS);
        } else
        {
            $F = 'حدث خلل غير معروف , لم يتم تسجيل المستخدم الجديد'.'<br>';
            $check = false;
        }
    }else
    {
        $F = 'رابط منهي الصلاحيةو الرجاء طلب غعادة تعين كلمة المرور مرة اخرى'.'<br>';
        $check = false;
    }

}else
{
    $F = 'كلمة المرور في الحقل الاول غير متطابقة مع الحقل الثاني'.'<br>';
    $check = false;
}
