<?php
    //Creates XML string and XML document using the DOM
    $dom = new DomDocument( "1.0", "UTF-8" );
    
    //Add faculty root
    $faculty = $dom->appendChild( $dom->createElement( "faculty" ) );
    
    //Add name element to faculty root
    $nodeName = $dom->createElement( "name", $_POST['name'] );
    $faculty->appendChild( $nodeName );
    
    //Add picture element to faculty root
    $nodePicture = $dom->createElement( "picture", $_POST['picture'] );
    $faculty->appendChild( $nodePicture );
    
    //Add degrees element to faculty root
    $nodeDegrees = $dom->createElement( "degrees", "" );
    $faculty->appendChild( $nodeDegrees );
    
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
    
    //Add contactInfo element to faculty root
    $nodeContactInfo = $dom->createElement( "contactInfo" );
    $faculty->appendChild( $nodeContactInfo );
    
    //Add schoolEmail element to contactInfo element
    $nodeSchoolEmail = $dom->createElement( "schoolEmail", $_POST['schoolEmail'] );
    $nodeContactInfo->appendChild( $nodeSchoolEmail );
    
    //Add personalEmail element to contactInfo element
    $nodePersonalEmail = $dom->createElement( "personalEmail", $_POST['personalEmail'] );
    $nodeContactInfo->appendChild( $nodePersonalEmail );
    
    //Add phoneNum element to contactInfo element
    $nodePhoneNum = $dom->createElement( "phoneNum", $_POST['phoneNum'] );
    $nodeContactInfo->appendChild( $nodePhoneNum );
    
    //Add courses element to faculty root
    $nodeCourses = $dom->createElement( "coursesList", "" );
    $faculty->appendChild( $nodeCourses );
    
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
    
    //Add researchArea element to faculty root
    $nodeResearchArea = $dom->createElement( "researchArea", $_POST['researchArea'] );
    $faculty->appendChild( $nodeResearchArea );
    
    //Add LinkedIn element to faculty root
    $nodeLinkedIn = $dom->createElement( "LinkedIn", $_POST['LinkedIn'] );
    $faculty->appendChild( $nodeLinkedIn );
    
    //Add GitHub element to faculty root
    $nodeGitHub = $dom->createElement( "GitHub", $_POST['GitHub'] );
    $faculty->appendChild( $nodeGitHub );
    
    //Save XML document
    $dom->formatOutput = true;
    $dom->save( $_POST['fileName'] );
    
    //After file is saved, redirect user to the related faculty page
    $returnLink = "/SDSMT_Web/faculty/faculty.php?name=" . substr( $_POST['fileName'], 14 );
    header( "Location: $returnLink" );
?>