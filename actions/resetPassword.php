<?php
$check = true;
$email = $_POST['email'];
$done = false;


if($publicFunctions->checkUserValidity($email)==1)
{
    $resetPass = $publicFunctions->resetPasswprd($email);
    if($resetPass)
    {
        $S = 'لقد تم إرسال بيانات إعادة تعين كلمة المرور, رجاء قم بفحص بريدك الالكتروني للدخول الى رابط اعادة تعين كلمة المرور';

    } else
    {
        $F = 'حدث خلل غير معروف , لم يتم اعادة تعين كلمة المرور'.'<br>';
        $check = false;
    }
}else
{
    $F = 'البريد الالكتروني الذي قمت بإدخاله غير موجود في قاعدة البيانات الرجاء التواصل مع مدير النظام للمساعدة, ننصحك بعدم إنشاء حساب جديد لكي تستكمل التدريب على حسابك المسجل ولا تفقد شهادتك'.'<br>';
    $check = false;
}


