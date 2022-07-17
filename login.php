<?php
$check = true;
$accountType = 1;
$username = $_POST['username'];
$password = $_POST['password'];
$done = false;
if($userLogin->checkUser($username,1) == 1)
{
    $userInfo = $userLogin->checkUser($username,2);
    if($userInfo[0]->active ==1)
    {
        //check if the account verified
        if($userInfo[0]->verified ==1)
        {
            $start = $userLogin->openSessions($username, $password);
            if ($start != 0) {
                $S = 'لقد تم الدخول';
                $done = true;
            } else {
                $F = 'لم يتم تسجيل الدخول لسبب غير معروف, ربما لخل في كلمة المرور' . '<br>';
                $check = false;
            }
        }else
        {
            $F = 'عزيزي المستخدم, بيانات تسجيلك صحيحة, لكن حسابك غير مفعل, يتم تفعيل الحساب من خلال رسالة تصلك الى بريدك الالكتروني لحظة التسجيل, تحتوي الرسالة على رابط التفعيل, يتوجب عليك الضغط على الرابط لتفعيل الحساب, اذا لم تستطع إتباع الخطوات او لم تجد الرسالة, الرجاء التواصل مع مدير النظام'.'<br>';
            $check = false;
        }
    }else
    {
        $F = 'لقد تم إيقاف حسابك, الرجاء التواصل مع مدير النظام'.'<br>';
        $check = false;
    }
}else
{
    $F = 'إسم المستخدم الذي قمت بإدخاله غير موجود'.'<br>';
    $check = false;
}