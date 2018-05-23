var numDegrees = 0; //Number of faculty degrees
var numCompanies = 0; //Number of faculty companies

////////////////////////////////////////////////////////////////////////////////
// Function: initDegrees( degrees )
//
// Description: Sets up initial degrees on edit-faculty page
//
// Parameter: degrees - string holding faculty degrees, seperated by a semicolon
////////////////////////////////////////////////////////////////////////////////
function initDegrees( degrees ) { 
    //Get index of first ; in degree string
    var index = degrees.value.indexOf( ";" );
    
    //Loop over all semicolons in degrees string
    while( index > 0 )
    {
        //Add a field for current degree
        addDegree( degrees.value.substring(0, index ) );
        
        //Trim degrees string to remove current degree
        degrees.value = degrees.value.substring( index+1, degrees.value.length )
        
        //Find index of next ; in remaining degree string
        index = degrees.value.indexOf( ";" );
    }
};


////////////////////////////////////////////////////////////////////////////////
// Function: addDegree( degreeName )
//
// Description: Adds a textbox to edit degree
//
// Parameter: degreeName - Name of degree to add
////////////////////////////////////////////////////////////////////////////////
function addDegree( degreeName ) {
    //Create new textbox
    var div = document.getElementById('degreeContainer');
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'degree_';
    input.name = input.name.concat( numDegrees++ );
    input.value = degreeName;
    input.size = 40;
    
    //Add textbox to HTML page
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
};


////////////////////////////////////////////////////////////////////////////////
// Function: initCompanies( companies )
//
// Description: Sets up initial companies on edit-faculty page
//
// Parameter: companies - string holding faculty companies, seperated by a semicolon
////////////////////////////////////////////////////////////////////////////////
function initCompanies( companies ) { 
    //Get index of first ; in companies string
    var index = companies.value.indexOf( ";" );
    
    //Loop over all semicolons in companies string
    while( index > 0 )
    {
        //Add a field for current company
        addCompany( companies.value.substring(0, index ) );
        
        //Trim companies string to remove current company
        companies.value = companies.value.substring( index+1, companies.value.length )
        
        //Find index of next ; in remaining companies string
        index = companies.value.indexOf( ";" );
    }
};


////////////////////////////////////////////////////////////////////////////////
// Function: addCompany( companyName )
//
// Description: Adds a textbox to edit company
//
// Parameter: companyName - Name of company to add
////////////////////////////////////////////////////////////////////////////////
function addCompany( companyName ) {
    //Create new textbox
    var div = document.getElementById('companyContainer');
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'company_';
    input.name = input.name.concat( numCompanies++ );
    input.value = companyName;
    input.size = 40;

    //Add textbox to HTML page
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
};