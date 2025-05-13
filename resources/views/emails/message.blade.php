<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>

    </style>
</head>

<body>
    <p>
        {{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->translatedFormat('l j F Y') }}
        {{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->translatedFormat('h:i A') }}
    </p>

    <p>مرفق لكم ملف الإسناد</p>
    <p>
        <a href="www.qatra.sa/storage/{{$file}}">
            www.qatra.sa/storage/{{$file}}
        </a>
    </p>

</body>
</html>
