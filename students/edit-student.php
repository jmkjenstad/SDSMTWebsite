<?php
//Get current student's file for editing
$currStudent = $_POST['fileName'];

//Read in student data from XML file
$studentXML = new SimpleXMLElement( $currStudent, $options = 0, $data_is_url = true );

//Get list of degrees
$degreesString = "";
if( !empty( $studentXML->degrees->degree ) )
{
    foreach( $studentXML->degrees->degree as $currDegree )
    {
        $degreesString .= $currDegree . ";";
    }
}

//Get list of courses
$coursesString = "";
if( !empty( $studentXML->coursesList->course ) )
{
    foreach( $studentXML->coursesList->course as $currCourse )
    {
        $coursesString .= $currCourse . ";";
    }
}

//Get contact info
$schoolEmail = $studentXML->contactInfo->schoolEmail;
$personalEmail = $studentXML->contactInfo->personalEmail;
$phoneNum = $studentXML->contactInfo->phoneNum;

//Build link back to page being edited
$returnLink = "/SDSMT_Web/students/student.php?name=" . substr( $_POST['fileName'], 14 );

echo <<<_END
<html lang="en">
    <head>
        <title>$studentXML->name</title>
        <link rel="stylesheet" type="text/css" href="student.css" />
        <script type="text/javascript" src="student-scripts.js" > </script>
        <meta charset="utf-8"/>
    </head>
    
    <body>
        <!-- Fixed Header -->
        <div id="fixedheader">
            Header stuff
        </div>

        <!-- Student content pane -->
        <div id="studentContent">
            <form name="editStudent" action="save-file.php" method="post">
                <!-- Hidden element used to pass on file name to PHP script -->
                <input type="hidden" name="fileName" value="$currStudent">

                <!-- Student name & picture fields -->
                Name: <input type="text" name="name" value="$studentXML->name"><br/>
                Picture Link: <input type="text" name="picture" value="$studentXML->picture"><br/>
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
                Graduation Date: <input type="text" name="gradDate" value="$studentXML->gradDate"><br/>
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
                Area of Interest: <input type="text" name="interestArea" value="$studentXML->interestArea"><br/>
                <br/>
                
                <!-- External Links -->
                Student Webpage: <input type="text" size="50" name="studentWebsite" value="$studentXML->studentWebsite"><br/>
                LinkedIn: <input type="text" size="50" name="LinkedIn" value="$studentXML->LinkedIn"><br/>
                GitHub: <input type="text" size="50" name="GitHub" value="$studentXML->GitHub"><br/>
                KnewRecruit: <input type="text" size="50" name="KnewRecruit" value="$studentXML->KnewRecruit"><br/>
                
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