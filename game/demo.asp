<!DOCTYPE html>
<html>
<body>
<%
dim firstname
firstname = Request.QueryStrong("fistname")
If firstname<>"" Then
	Response.Write(& firstname &)
End If
%>
</body>
</html>