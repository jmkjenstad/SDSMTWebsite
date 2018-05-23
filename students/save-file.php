<?php
    //Creates XML string and XML document using the DOM
    $dom = new DomDocument( "1.0", "UTF-8" );
    
    //Add student root
    $student = $dom->appendChild( $dom->createElement( "student" ) );
    
    //Add name element to student root
    $nodeName = $dom->createElement( "name", $_POST['name'] );
    $student->appendChild( $nodeName );
    
    //Add picture element to student root
    $nodePicture = $dom->createElement( "picture", $_POST['picture'] );
    $student->appendChild( $nodePicture );
    
    //Add degrees element to student root
    $nodeDegrees = $dom->createElement( "degrees", "" );
    $student->appendChild( $nodeDegrees );
    
    //Loop over degrees (assumed to be less than 10)
    for( $i = 0; $i < 10; $i++ )
    {
        //Check if current degree is non-empty
        if( !empty( $_POST["degree_" . $i] ) )
        {
            $nodeCurrDegree = $dom->createElement( "degree", $_POST["degree_" . $i] );
            $nodeDegrees->appendChild( $nodeCurrDegree );
        }
    }
    
    //Add gradDate element to student root
    $nodeGradDate = $dom->createElement( "gradDate", $_POST['gradDate'] );
    $student->appendChild( $nodeGradDate );
    
    //Add contactInfo element to student root
    $nodeContactInfo = $dom->createElement( "contactInfo" );
    $student->appendChild( $nodeContactInfo );
    
    //Add schoolEmail element to contactInfo element
    $nodeSchoolEmail = $dom->createElement( "schoolEmail", $_POST['schoolEmail'] );
    $nodeContactInfo->appendChild( $nodeSchoolEmail );
    
    //Add personalEmail element to contactInfo element
    $nodePersonalEmail = $dom->createElement( "personalEmail", $_POST['personalEmail'] );
    $nodeContactInfo->appendChild( $nodePersonalEmail );
    
    //Add phoneNum element to contactInfo element
    $nodePhoneNum = $dom->createElement( "phoneNum", $_POST['phoneNum'] );
    $nodeContactInfo->appendChild( $nodePhoneNum );
    
    //Add courses element to student root
    $nodeCourses = $dom->createElement( "coursesList", "" );
    $student->appendChild( $nodeCourses );
    
    //Loop over courses (assumed to be less than 25)
    for( $i = 0; $i < 25; $i++ )
    {
        //Check if current course is non-empty
        if( !empty( $_POST["course_" . $i] ) )
        {
            $nodeCurrCourse = $dom->createElement( "course", $_POST["course_" . $i] );
            $nodeCourses->appendChild( $nodeCurrCourse );
        }
    }
    
    //Add interestArea element to student root
    $nodeInterestArea = $dom->createElement( "interestArea", $_POST['interestArea'] );
    $student->appendChild( $nodeInterestArea );
    
    //Add studentWebsite element to student root
    $nodeStudentWebsite = $dom->createElement( "studentWebsite", $_POST['studentWebsite'] );
    $student->appendChild( $nodeStudentWebsite );
    
    //Add LinkedIn element to student root
    $nodeLinkedIn = $dom->createElement( "LinkedIn", $_POST['LinkedIn'] );
    $student->appendChild( $nodeLinkedIn );
    
    //Add GitHub element to student root
    $nodeGitHub = $dom->createElement( "GitHub", $_POST['GitHub'] );
    $student->appendChild( $nodeGitHub );
    
    //Add KnewRecruit element to student root
    $nodeKnewRecruit = $dom->createElement( "KnewRecruit", $_POST['KnewRecruit'] );
    $student->appendChild( $nodeKnewRecruit );
    
    //Save XML document
    $dom->formatOutput = true;
    $dom->save( $_POST['fileName'] );
    
    //After file is saved, redirect user to the related student page
    $returnLink = "/SDSMT_Web/students/student.php?name=" . substr( $_POST['fileName'], 14 );
    header( "Location: $returnLink" );
?>