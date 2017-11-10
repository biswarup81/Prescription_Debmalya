<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Online Prescription, Digital Prescription, Prescription, ePrescription, Online doctor appointment, Dr. Soumyabrata Roy Choudhuri, Health Management Software">
	<meta name="keywords" content="Online Prescription, Digital Prescription, Prescription, ePrescription, Online doctor appointment, Dr. Soumyabrata Roy Choudhuri">
	<meta name="author" content="P.G.INFOSERVICES">
    <link rel="icon" href="./inc/favicon.ico">

    <title>Online Prescription, Prescription, ePrescription, Online doctor appointment, Health Management Software, Digital Prescription</title>


	<link href="css/style_hindol.css" rel="stylesheet">

    <script type="text/ecmascript">

	function func_print(docname) { 
		alert(docname);
	  var disp_setting="toolbar=no,location=no,directories=yes,menubar=no,"; 
	      disp_setting+="scrollbars=yes, width=900, height=600, resize=yes"; 
	  var content_vlue = document.getElementById("printArea").innerHTML; 
	  
	  var docprint=window.open("","",disp_setting); 
	   docprint.document.open(); 
	   docprint.document.write('<html><head><title>:: '+docname+' :: Prescription Management</title>'); 
	
	   docprint.document.write('<link href="css/style_hindol.css" rel="stylesheet">');
	   docprint.document.write('</head><body onLoad="self.print()">');          
	   docprint.document.write(content_vlue);          
	   docprint.document.write('</body></html>'); 
	   docprint.document.close(); 
	   docprint.focus(); 
	}	

</script>  
  </head>