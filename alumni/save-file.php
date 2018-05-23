<?php
    //Creates XML string and XML document using the DOM
    $dom = new DomDocument( "1.0", "UTF-8" );
    
    //Add alumni root
    $alumni = $dom->appendChild( $dom->createElement( "alumni" ) );
    
    //Add name element to alumni root
    $nodeName = $dom->createElement( "name", $_POST['name'] );
    $alumni->appendChild( $nodeName );
    
    //Add picture element to alumni root
    $nodePicture = $dom->createElement( "picture", $_POST['picture'] );
    $alumni->appendChild( $nodePicture );
    
    //Add degrees element to alumni root
    $nodeDegrees = $dom->createElement( "degrees", "" );
    $alumni->appendChild( $nodeDegrees );
    
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
    
    //Add contactInfo element to alumni root
    $nodeContactInfo = $dom->createElement( "contactInfo" );
    $alumni->appendChild( $nodeContactInfo );
    
    //Add companyEmail element to contactInfo element
    $nodecompanyEmail = $dom->createElement( "companyEmail", $_POST['companyEmail'] );
    $nodeContactInfo->appendChild( $nodecompanyEmail );
    
    //Add personalEmail element to contactInfo element
    $nodePersonalEmail = $dom->createElement( "personalEmail", $_POST['personalEmail'] );
    $nodeContactInfo->appendChild( $nodePersonalEmail );
    
    //Add phoneNum element to contactInfo element
    $nodePhoneNum = $dom->createElement( "phoneNum", $_POST['phoneNum'] );
    $nodeContactInfo->appendChild( $nodePhoneNum );
    
    //Add companies element to alumni root
    $nodeCompanies = $dom->createElement( "companyList", "" );
    $alumni->appendChild( $nodeCompanies );
    
    //Loop over companies (assumed to be less than 25)
    for( $i = 0; $i < 25; $i++ )
    {
        //Check if current company is non-empty
        if( !empty( $_POST["company_" . $i] ) )
        {
            $nodeCurrCompany = $dom->createElement( "company", $_POST["company_" . $i] );
            $nodeCompanies->appendChild( $nodeCurrCompany );
        }
    }
    
    //Add specialtyArea element to alumni root
    $nodeSpecialtyArea = $dom->createElement( "specialtyArea", $_POST['specialtyArea'] );
    $alumni->appendChild( $nodeSpecialtyArea );
    
    //Add LinkedIn element to alumni root
    $nodeLinkedIn = $dom->createElement( "LinkedIn", $_POST['LinkedIn'] );
    $alumni->appendChild( $nodeLinkedIn );
    
    //Add GitHub element to alumni root
    $nodeGitHub = $dom->createElement( "GitHub", $_POST['GitHub'] );
    $alumni->appendChild( $nodeGitHub );
    
    //Save XML document
    $dom->formatOutput = true;
    $dom->save( $_POST['fileName'] );
    
    //After file is saved, redirect user to the related alumni page
    $returnLink = "/SDSMT_Web/alumni/alumni.php?name=" . substr( $_POST['fileName'], 13 );
    header( "Location: $returnLink" );
?>