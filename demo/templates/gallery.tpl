<html>
<head>
<title>Photo Gallery</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
{literal}
<script>
function initialize()
{
  var file_id = document.getElementById("file_id");
  file_id.value=0;
}
</script>
{/literal}
<body>
<form name="form1" method="post" action="">
  <table width="100%">
    <tr>
      <td width="47%"><h1>Photo Gallery </h1></td>
        <input name="file_id" type="hidden" id="file_id">
      <td width="53%" align="right">&nbsp;Page :
<select name=page>
    {html_options options=$pages}
</select>
         <input type="submit" name="Submit" value="Go"
onfocus="initialize();"></td>
    </tr>
  </table>
</form>
<hr size="0">
<table width="100%">
  <tr>
    <td width="47%" valign="top">{html_table loop=$linked_files}
</td>
    <td width="53%" align="right"><img width="450" height="400" border="1"
src="/Smarty1/demo/bday/{$current_file}"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

