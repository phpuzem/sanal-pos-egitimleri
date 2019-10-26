<html>
<head>
    <title>3D SECURE PAGE</title>
</head>
<body>

<form name="downloadForm" action="{{$data->ACSUrl}}" method="POST">

    <input type="hidden" name="PaReq" value="{{$data->PaReq}}">
    <input type="hidden" name="TermUrl" value="{{$data->TermUrl}}">
    <input type="hidden" name="MD" value="{{$data->MD}}">

</form>


<script language="JavaScript"> document.downloadForm.submit();</script>


</body>
</html>
