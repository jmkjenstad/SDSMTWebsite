<?php
//Get current alumni's file for editing
$currAlumni = $_POST['fileName'];

//Read in alumni data from XML file
$alumniXML = new SimpleXMLElement( $currAlumni, $options = 0, $data_is_url = true );

//Get list of degrees
$degreesString = "";
if( !empty( $alumniXML->degrees->degree ) )
{
    foreach( $alumniXML->degrees->degree as $currDegree )
    {
        $degreesString .= $currDegree . ";";
    }
}

//Get list of companies
$companiesString = "";
if( !empty( $alumniXML->companyList->company ) )
{
    foreach( $alumniXML->companyList->company as $currCompany )
    {
        $companiesString .= $currCompany . ";";
    }
}

//Get contact info
$companyEmail = $alumniXML->contactInfo->companyEmail;
$personalEmail = $alumniXML->contactInfo->personalEmail;
$phoneNum = $alumniXML->contactInfo->phoneNum;

//Build link back to page being edited
$returnLink = "/SDSMT_Web/alumni/alumni.php?name=" . substr( $_POST['fileName'], 13 );

echo <<<_END
<html lang="en">
    <head>
        <title>$alumniXML->name</title>
        <link rel="stylesheet" type="text/css" href="alumni.css" />
        <script type="text/javascript" src="alumni-scripts.js" > </script>
        <meta charset="utf-8"/>
    </head>
    
    <body>
        <!-- Fixed Header -->
        <div id="fixedheader">
            Header stuff
        </div>

        <!-- alumni content pane -->
        <div id="alumniContent">
            <form name="editalumni" action="save-file.php" method="post">
                <!-- Hidden element used to pass on file name to PHP script -->
                <input type="hidden" name="fileName" value="$currAlumni">

                <!-- alumni name & picture fields -->
                Name: <input type="text" name="name" value="$alumniXML->name"><br/>
                Picture Link: <input type="text" name="picture" value="$alumniXML->picture"><br/>
                <br/>
                
                <!-- Degrees -->
                <div id="degreeContainer">
                    Degrees:
                    <input type="hidden" id="degreesString" value="$degreesString"/>
                    <script>
                        initDegrees(document.getElementById('degreesString'));
                    </script>
                </div>
                <input type="button" id="addDegreeBtn" value="Add Degree" onclick="addDegree('');"/><br/>
                <br/>
                
                <!-- Contact Information -->
                Company Email: <input type="text" size="30" name="companyEmail" value="$companyEmail"><br/>
                Personal Email: <input type="text" size="30" name="personalEmail" value="$personalEmail"><br/>
                Phone Number: <input type="text" name="phoneNum" value="$phoneNum"><br/>
                <br/>
                
                <!-- Companies & Interest Area -->
                <div id="companyContainer">
                    Companies:
                    <input type="hidden" id="companiesString" value="$companiesString"/>
                    <script>
                        initCompanies(document.getElementById('companiesString'));
                    </script>
                </div>
                <input type="button" id="addCompanyBtn" value="Add Company" onclick="addCompany('');"/><br/>
                Specialty Area: <input type="text" name="specialtyArea" value="$alumniXML->specialtyArea"><br/>
                <br/>
                
                <!-- External Links -->
                LinkedIn: <input type="text" size="50" name="LinkedIn" value="$alumniXML->LinkedIn"><br/>
                GitHub: <input type="text" size="50" name="GitHub" value="$alumniXML->GitHub"><br/>
                
                <!-- Save, Reset, & Cancel buttons -->
                <br/><input type="submit" value="Save"/>
                <input type="reset"/>
                <a href=$returnLink><input type="button" value="Cancel"></a>
            </form>
            
        </div>
        
        <!-- Fixed Footer -->
        <div id="fixedfooter">
            Footer stuff
        </div>
    </body>
</html>
_END;
?>