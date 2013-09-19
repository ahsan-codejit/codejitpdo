codejitpdo
==========

Usage Instructions:
Set db configuration in config.php file
include on page: require_once 'jit/JitCRUD.php';
Creating Object: $jitObj = new JitCRUD($tablename[optional]);
Fetch a row: $jitObj->fetch(array('condition'=>array()); //optional parameter
