<?php

//Get current faculty's name for loading data
$currFaculty = "faculty-files/" . $_GET['name'];

//Read in faculty data from XML file
$facultyXML = new SimpleXMLElement($currFaculty, $options = 0, $data_is_url = true);

//Get degrees list
$degrees = $facultyXML->degrees->degree[0];
$i = 0;
if( !empty( $facultyXML->degrees->degree ) )
{
    foreach( $facultyXML->degrees->degree as $currDegree )
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
$schoolEmail = $facultyXML->contactInfo->schoolEmail;
$personalEmail = $facultyXML->contactInfo->personalEmail;
$phoneNum = $facultyXML->contactInfo->phoneNum;

//Get courses list
$courses = "";
if( !empty( $facultyXML->coursesList->course ) )
{
    foreach( $facultyXML->coursesList->course as $currCourse )
    {
        $courses .= "<p class='course'>";
        $courses .= $currCourse;
        $courses .= "</p>";
    }
}

//Get faculty LinkedIn account from XML if present
if( !empty( $facultyXML->LinkedIn ) )
{
    $facultyLinkedIn = "<a class='link' href='$facultyXML->LinkedIn'>LinkedIn</a><br/>";
}
else
{
    $facultyLinkedIn = "";
}

//Get faculty GitHub account from XML if present
if( !empty( $facultyXML->GitHub ) )
{
    $facultyGitHub = "<a class='link' href='$facultyXML->GitHub'>GitHub</a><br/>";
}
else
{
    $facultyGitHub = "";
}

//Print formatted HTLM page filling in with XML data
echo <<<_END
    <html lang="en">
        <head>
            <title>$facultyXML->name</title>
            <link rel="stylesheet" type="text/css" href="faculty.css" />
            <meta charset="utf-8"/>
        </head>
        
        <body>
            <!-- Fixed Header -->
            <div id="fixedheader">
                Header stuff
            </div>
            
            <!-- faculty content pane -->
            <div id="facultyContent">
            
                <!-- faculty name & picture -->
                <h1 class="facultyName">
                    <img class="faculty" src="profile-pictures/$facultyXML->picture">
                    $facultyXML->name
                </h1>
                <hr class="picture"/>
                
                <!-- Personal info pane -->
                <div id="personalInfo">
                
                    <!-- Degree information -->
                    <p>$degrees</p>
                    
                    <!-- Contact information -->
                    <p>
                        <span class="emphasize">School Email:</span> $schoolEmail<br/>
                        <span class="emphasize">Personal Email:</span> $personalEmail<br/>
                        <span class="emphasize">Phone Number:</span> $phoneNum<br/>
                    </p>
                
                </div>
                
                <!-- Course info pane -->
                <div id="coursesInfo">
                
                    <p class="subSection">Current Courses</p>
                    <hr/>
                    
                    <!-- List of courses -->
                    $courses
                    
                    <!-- Research area -->
                    <p class='course'><span class="emphasize"><br/>Research area:</span> $facultyXML->researchArea</p>
                
                </div>
                
                <!-- External Links -->
                <div id="externalLinks">
                
                    <p class="subSection">External Links</p>
                    <hr/>
                    
                    <!-- List of external links -->
                    $facultyLinkedIn
                    $facultyGitHub
                
                </div>
           
                <!-- Edit Button -->
                <form action="edit-faculty.php" method="post">
                    <input type="hidden" name="fileName" value=$currFaculty>
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