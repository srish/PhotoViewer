<?php /* Smarty version 2.6.26, created on 2010-03-30 13:04:36
         compiled from gallery.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'gallery.tpl', 23, false),array('function', 'html_table', 'gallery.tpl', 33, false),)), $this); ?>
<html>
<head>
<title>Photo Gallery</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php echo '
<script>
function initialize()
{
  var file_id = document.getElementById("file_id");
  file_id.value=0;
}
</script>
'; ?>

<body>
<form name="form1" method="post" action="">
  <table width="100%">
    <tr>
      <td width="47%"><h1>Photo Gallery </h1></td>
        <input name="file_id" type="hidden" id="file_id">
      <td width="53%" align="right">&nbsp;Page :
<select name=page>
    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['pages']), $this);?>

</select>
         <input type="submit" name="Submit" value="Go"
onfocus="initialize();"></td>
    </tr>
  </table>
</form>
<hr size="0">
<table width="100%">
  <tr>
    <td width="47%" valign="top"><?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['linked_files']), $this);?>

</td>
    <td width="53%" align="right"><img width="450" height="400" border="1"
src="/Smarty1/demo/bday/<?php echo $this->_tpl_vars['current_file']; ?>
"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
