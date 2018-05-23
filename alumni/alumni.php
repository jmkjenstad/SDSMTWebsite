<?php

//Get current alumni's name for loading data
$currAlumni = "alumni-files/" . $_GET['name'];

//Read in alumni data from XML file
$alumniXML = new SimpleXMLElement($currAlumni, $options = 0, $data_is_url = true);

//Get degrees list
$degrees = $alumniXML->degrees->degree[0];
$i = 0;
if( !empty( $alumniXML->degrees->degree ) )
{
    foreach( $alumniXML->degrees->degree as $currDegree )
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
$companyEmail = $alumniXML->contactInfo->companyEmail;
$personalEmail = $alumniXML->contactInfo->personalEmail;
$phoneNum = $alumniXML->contactInfo->phoneNum;

//Get companies list
$companies = "";
if( !empty( $alumniXML->companyList->company ) )
{
    foreach( $alumniXML->companyList->company as $currCompany )
    {
        $companies .= "<p class='company'>";
        $companies .= $currCompany;
        $companies .= "</p>";
    }
}

//Get alumni LinkedIn account from XML if present
if( !empty( $alumniXML->LinkedIn ) )
{
    $alumniLinkedIn = "<a class='link' href='$alumniXML->LinkedIn'>LinkedIn</a><br/>";
}
else
{
    $alumniLinkedIn = "";
}

//Get alumni GitHub account from XML if present
if( !empty( $alumniXML->GitHub ) )
{
    $alumniGitHub = "<a class='link' href='$alumniXML->GitHub'>GitHub</a><br/>";
}
else
{
    $alumniGitHub = "";
}

//Print formatted HTLM page filling in with XML data
echo <<<_END
    <html lang="en">
        <head>
            <title>$alumniXML->name</title>
            <link rel="stylesheet" type="text/css" href="alumni.css" />
            <meta charset="utf-8"/>
        </head>
        
        <body>
            <!-- Fixed Header -->
            <div id="fixedheader">
                Header stuff
            </div>
            
            <!-- alumni content pane -->
            <div id="alumniContent">
            
                <!-- alumni name & picture -->
                <h1 class="alumniName">
                    <img class="alumni" src="profile-pictures/$alumniXML->picture">
                    $alumniXML->name
                </h1>
                <hr class="picture"/>
                
                <!-- Personal info pane -->
                <div id="personalInfo">
                
                    <!-- Degree information -->
                    <p>$degrees</p>
                    
                    <!-- Contact information -->
                    <p>
                        <span class="emphasize">Company Email:</span> $companyEmail<br/>
                        <span class="emphasize">Personal Email:</span> $personalEmail<br/>
                        <span class="emphasize">Phone Number:</span> $phoneNum<br/>
                    </p>
                
                </div>
                
                <!-- company info pane -->
                <div id="companiesInfo">
                
                    <p class="subSection">Current companies</p>
                    <hr/>
                    
                    <!-- List of companies -->
                    $companies
                    
                    <!-- Specialty area -->
                    <p class='company'><span class="emphasize"><br/>Specialty area:</span> $alumniXML->specialtyArea</p>
                
                </div>
                
                <!-- External Links -->
                <div id="externalLinks">
                
                    <p class="subSection">External Links</p>
                    <hr/>
                    
                    <!-- List of external links -->
                    $alumniLinkedIn
                    $alumniGitHub
                
                </div>
           
                <!-- Edit Button -->
                <form action="edit-alumni.php" method="post">
                    <input type="hidden" name="fileName" value=$currAlumni>
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