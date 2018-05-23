<?php

//Get current student's name for loading data
$currStudent = "student-files/" . $_GET['name'];

//Read in student data from XML file
$studentXML = new SimpleXMLElement($currStudent, $options = 0, $data_is_url = true);

//Get degrees list
$degrees = $studentXML->degrees->degree[0];
$i = 0;
if( !empty( $studentXML->degrees->degree ) )
{
    foreach( $studentXML->degrees->degree as $currDegree )
    {
        if( $i > 0 )
        {
            $degrees .= "<br/>";
            $degrees .= $currDegree;
        }
        $i += 1;
    }
}

//Get contact info
$schoolEmail = $studentXML->contactInfo->schoolEmail;
$personalEmail = $studentXML->contactInfo->personalEmail;
$phoneNum = $studentXML->contactInfo->phoneNum;

//Get courses list
$courses = "";
if( !empty( $studentXML->coursesList->course ) )
{
    foreach( $studentXML->coursesList->course as $currCourse )
    {
        $courses .= "<p class='course'>";
        $courses .= $currCourse;
        $courses .= "</p>";
    }
}

//Get student website from XML if present
if( !empty( $studentXML->studentWebsite ) )
{
    $studentWebsite = "<a class='link' href='$studentXML->studentWebsite'>Student Webpage</a><br/>";
}
else
{
    $studentWebsite = "";
}

//Get student LinkedIn account from XML if present
if( !empty( $studentXML->LinkedIn ) )
{
    $studentLinkedIn = "<a class='link' href='$studentXML->LinkedIn'>LinkedIn</a><br/>";
}
else
{
    $studentLinkedIn = "";
}

//Get student GitHub account from XML if present
if( !empty( $studentXML->GitHub ) )
{
    $studentGitHub = "<a class='link' href='$studentXML->GitHub'>GitHub</a><br/>";
}
else
{
    $studentGitHub = "";
}

//Get student KnewRecruit account from XML if present
if( !empty( $studentXML->KnewRecruit ) )
{
    $studentKnewRecruit = "<a class='link' href='$studentXML->KnewRecruit'>KnewRecruit</a><br/>";
}
else
{
    $studentKnewRecruit = "";
}

//Print formatted HTLM page filling in with XML data
echo <<<_END
    <html lang="en">
        <head>
            <title>$studentXML->name</title>
            <link rel="stylesheet" type="text/css" href="student.css" />
            <meta charset="utf-8"/>
        </head>
        
        <body>
            <!-- Fixed Header -->
            <div id="fixedheader">
                Header stuff
            </div>
            
            <!-- Student content pane -->
            <div id="studentContent">
            
                <!-- Student name & picture -->
                <h1 class="studentName">
                    <img class="student" src="profile-pictures/$studentXML->picture">
                    $studentXML->name
                </h1>
                <hr class="picture"/>
                
                <!-- Personal info pane -->
                <div id="personalInfo">
                
                    <!-- Degree information -->
                    <p>$degrees</p>
                    <p> <span class="emphasize">Graduation Date:</span> $studentXML->gradDate </p>
                    
                    <!-- Contact information -->
                    <p>
                        <span class="emphasize">School Email:</span> $schoolEmail<br/>
                        <span class="emphasize">Personal Email:</span> $personalEmail<br/>
                        <span class="emphasize">Phone Number:</span> $phoneNum<br/>
                    </p>
                
                </div>
                
                <!-- Course info pane -->
                <div id="coursesInfo">
                
                    <p class="subSection">Courses</p>
                    <hr/>
                    
                    <!-- List of courses -->
                    $courses
                    
                    <!-- Area of interest -->
                    <p class='course'><span class="emphasize"><br/>Area of Interest:</span> $studentXML->interestArea</p>
                
                </div>
                
                <!-- External Links -->
                <div id="externalLinks">
                
                    <p class="subSection">External Links</p>
                    <hr/>
                    
                    <!-- List of external links -->
                    $studentWebsite
                    $studentLinkedIn
                    $studentGitHub
                    $studentKnewRecruit
                
                </div>
           
                <!-- Edit Button -->
                <form action="edit-student.php" method="post">
                    <input type="hidden" name="fileName" value=$currStudent>
                    <input type="submit" value="Edit">
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