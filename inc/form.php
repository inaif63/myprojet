<?php

$firstName =    $_POST['firstName']?? null;
$lastName =     $_POST['lastName']?? null;
$email =        $_POST['email']?? null;

$errors = [
    'firstNameError' => '',
    'lastNameError' => '',
    'emailError' => ''
];


if (isset($_POST['submit'])) 
{

$sql = "INSERT INTO users(firstName, lastName, email) 
        VALUES ('$firstName', '$lastName', '$email')";


//تحقق من الاسم الاول
if(empty($firstName))
{
    $errors['firstNameError'] = 'يرجى ادخال الاسم الاول';
}

//تحقق من الاسم الاخير

if(empty($lastName))
{
    $errors['lastNameError'] = 'يرجى ادخال الاسم الاخير';
 }



 //تحقق من البريد الالكتروني
 if(empty($email))
{
    $errors['emailError'] = 'يرجى ادخال الايميل';
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['emailError'] = 'يرجى ادخال إيميل صحيح';
}

//تحقق لا يوجد اخطاء
if(!array_filter($errors))
{
    $firstName =    mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName =     mysqli_real_escape_string($conn, $_POST['lastName']);
    $email =        mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO users(firstName, lastName, email) 
    VALUES ('$firstName', '$lastName', '$email')";

    if( mysqli_query($conn, $sql) )
    {
        header('Location:  index.php');
    }  
    else
    {
        echo 'Error:' . mysqli_error($conn);
    }

}

}
