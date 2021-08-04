<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100% !important;}
        .content {width: 100%; max-width: 700px;}
        .innerpadding {padding: 30px 30px 30px 30px; background-color: #ffffff; border-radius: 4px;}
        .hmargin {height: 30px;}
    </style>
</head>
<body yahoo bgcolor="#f2e8ff">
<table width="100%" bgcolor="#f2e8ff" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th></th>
        <th></th>
        <th></th>
    </tr>
        <?php foreach ($products as $product) { ?>
    <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->description}}</td>
        <?php }?>
    </tr>
</table>
</body>
</html>
