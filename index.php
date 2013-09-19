<!doctype html>
<html>
    <head>
        <title>Usage Examples</title>
        <style type="text/css">
            #wrapper{width:900px; margin: 20px auto;}
            .content_calc{width:400px; margin:auto;}
            h2.calc, h3.calc { text-align: center;}
        </style>
    </head>
    <body>
        <div id="wrapper">
            <h3>Usage Instructions:</h3>
            <p>Set db configuration in config.php file </p>
            <p>include on page: require_once 'jit/JitCRUD.php';</p>
            <p>Creating Object: $jitObj = new JitCRUD($tablename[optional]); </p>
            <p>Fetch a row: $jitObj->fetch(array('condition'=>array()); //optional parameter</p>
        </div>
    </body>
</html>