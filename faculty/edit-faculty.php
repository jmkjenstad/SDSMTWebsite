<?php
//Get current faculty's file for editing
$currfaculty = $_POST['fileName'];

//Read in faculty data from XML file
$facultyXML = new SimpleXMLElement( $currfaculty, $options = 0, $data_is_url = true );

//Get list of degrees
$degreesString = "";
if( !empty( $facultyXML->degrees->degree ) )
{
    foreach( $facultyXML->degrees->degree as $currDegree )
    {
        $degreesString .= $currDegree . ";";
    }
}

//Get list of courses
$coursesString = "";
if( !empty( $facultyXML->coursesList->course ) )
{
    foreach( $facultyXML->coursesList->course as $currCourse )
    {
        $coursesString .= $currCourse . ";";
    }
}

//Get contact info
$schoolEmail = $facultyXML->contactInfo->schoolEmail;
$personalEmail = $facultyXML->contactInfo->personalEmail;
$phoneNum = $facultyXML->contactInfo->phoneNum;

//Build link back to page being edited
$returnLink = "/SDSMT_Web/faculty/faculty.php?name=" . substr( $_POST['fileName'], 14 );

echo <<<_END
<html lang="en">
    <head>
        <title>$facultyXML->name</title>
        <link rel="stylesheet" type="text/css" href="faculty.css" />
        <script type="text/javascript" src="faculty-scripts.js" > </script>
        <meta charset="utf-8"/>
    </head>
    
    <body>
        <!-- Fixed Header -->
        <div id="fixedheader">
            Header stuff
        </div>

        <!-- faculty content pane -->
        <div id="facultyContent">
            <form name="editfaculty" action="save-file.php" method="post">
                <!-- Hidden element used to pass on file name to PHP script -->
                <input type="hidden" name="fileName" value="$currfaculty">

                <!-- faculty name & picture fields -->
                Name: <input type="text" name="name" value="$facultyXML->name"><br/>
                Picture Link: <input type="text" name="picture" value="$facultyXML->picture"><br/>
                <br/>
                
                <!-- Degrees & Graduation Date -->
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
                School Email: <input type="text" size="30" name="schoolEmail" value="$schoolEmail"><br/>
                Personal Email: <input type="text" size="30" name="personalEmail" value="$personalEmail"><br/>
                Phone Number: <input type="text" name="phoneNum" value="$phoneNum"><br/>
                <br/>
                
                <!-- Courses & Interest Area -->
                <div id="courseContainer">
                    Courses:
                    <input type="hidden" id="coursesString" value="$coursesString"/>
                    <script>
                        initCourses(document.getElementById('coursesString'));
                    </script>
                </div>
                <input type="button" id="addCourseBtn" value="Add Course" onclick="addCourse('');"/><br/>
                Research Area: <input type="text" name="researchArea" value="$facultyXML->researchArea"><br/>
                <br/>
                
                <!-- External Links -->
                LinkedIn: <input type="text" size="50" name="LinkedIn" value="$facultyXML->LinkedIn"><br/>
                GitHub: <input type="text" size="50" name="GitHub" value="$facultyXML->GitHub"><br/>
                
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