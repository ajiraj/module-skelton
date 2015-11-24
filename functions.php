<?php

/*   Autor: Ajiraj   *****/

$ROOT='';

/*   change below lines to reflect in the joomla admin area  **/

$AUTHOR='AjiRaj';
$DESC='Module Generated with module-skelton generator';
$DATE=date('d M y');


/*  No need to edit below this  **/

if(isset($_POST['mod_name']) && $_POST['mod_name'] != '')
{
	
	$moduleName_original=$_POST['mod_name'];
	$moduleName=str_replace(" ","_",$moduleName_original);
	
	$ROOT='./output/mod_'.$moduleName;
	createFloders($moduleName);
	createEntryPoint($moduleName);
	createXml($moduleName,$moduleName_original);
	createHelper($moduleName);
	createTemplate($moduleName);
	
	header('Location:complete.php');
}
else
	header('Location:index.php');






/**********************   Functions   **************************/
 function createFloders($moduleName,$moduleName_original)
 {
	global $ROOT;
	$structures = array($ROOT,$ROOT.'/tmpl',$ROOT.'/assets');
	
	foreach($structures as $structure)
	{
		if (!mkdir($structure, 0777, true)) {
				die('Failed to create folders...'.$structure);
		}else{
				
				$myfile = fopen($structure."/index.html", "w") or die("Unable to open file!");
				$txt = '<html><body bgcolor="#FFFFFF"></body></html>';
				fwrite($myfile, $txt);
				fclose($myfile);
		}
	}
 
 }
 
 
 function createEntryPoint($moduleName)
 {
	global $ROOT; 
	$myfile = fopen($ROOT."/mod_$moduleName.php", "w") or die("Unable to open file!");
	$txt = '<?php
	defined(\'_JEXEC\') or die;
	require_once dirname(__FILE__) . \'/helper.php\';

	$result = mod'.ucfirst($moduleName).'Helper::sampleFunction();

	require JModuleHelper::getLayoutPath(\'mod_'.$moduleName.'\');';
	
	fwrite($myfile, $txt);
	fclose($myfile);
 }
 
 function createXml($moduleName,$moduleName_original)
 {
	global $ROOT,$AUTHOR,$DATE,$DESC; 
	$myfile = fopen($ROOT."/mod_$moduleName.xml", "w") or die("Unable to open file!");
	$txt = '<?xml version="1.0" encoding="utf-8"?>
<extension type="module" version="1.0.0" client="site" method="upgrade">
    <name>'.$moduleName_original.'</name>
	<creationDate>'.$DATE.'</creationDate>
    <author>'.$AUTHOR.'</author>
    <version>1.0.0</version>
    <description><![CDATA[
<!--<p><img style=\'margin: 5px; float: left;\' alt=\'02_m_searchmodule-pro\' src=\'../modules/mod_country_listing/assets/img/country_icon.gif\' width=\'130\' height=\'200\'>-->
<p>'.$DESC.'</p>
<p>Version 1.0.0 </p>   ]]></description>
	
    <files>
        <filename module="mod_'.$moduleName.'">mod_'.$moduleName.'.php</filename>
        <filename>index.html</filename>
        <filename>helper.php</filename>
        <filename>tmpl/default.php</filename>
        <filename>tmpl/index.html</filename>
		<folder>assets</folder>
    </files>

    <config>
    </config>
</extension>';
	
	fwrite($myfile, $txt);
	fclose($myfile);
 }

 
 
 function createHelper($moduleName)
 {
	global $ROOT; 
	$myfile = fopen($ROOT."/helper.php", "w") or die("Unable to open file!");
	$txt = '<?php
 
class mod'.ucfirst($moduleName).'Helper
{
   
    public static function sampleFunction()
    {
		
			/*$db = JFactory :: getDBO();
			$db->setQuery(\'sample query\');
			$data = $db->loadAssocList();
			return $data;
			*/
			return "Sample data";
		
	}
//  Example Ajax function	
	public static function getSampleAjax()
	{
		    $db = JFactory :: getDBO();
			$db->setQuery("query");
			$data = $db->loadAssocList();
			return json_encode($data);
	}

	
}';
	
	fwrite($myfile, $txt);
	fclose($myfile); 
 }
 
 
 function createTemplate($moduleName)
 {
	global $ROOT; 
	$myfile = fopen($ROOT."/tmpl/default.php", "w") or die("Unable to open file!");
	$txt = '<?php 
defined(\'_JEXEC\') or die; 

echo "<h1>Module heading</h1>";
echo $result;

 ';
	
	fwrite($myfile, $txt);
	fclose($myfile);
 }
 
?>