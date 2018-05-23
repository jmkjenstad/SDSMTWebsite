var numDegrees = 0; //Number of faculty degrees
var numCourses = 0; //Number of faculty courses

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
// Function: initCourses( courses )
//
// Description: Sets up initial courses on edit-faculty page
//
// Parameter: courses - string holding faculty courses, seperated by a semicolon
////////////////////////////////////////////////////////////////////////////////
function initCourses( courses ) { 
    //Get index of first ; in courses string
    var index = courses.value.indexOf( ";" );
    
    //Loop over all semicolons in courses string
    while( index > 0 )
    {
        //Add a field for current course
        addCourse( courses.value.substring(0, index ) );
        
        //Trim courses string to remove current course
        courses.value = courses.value.substring( index+1, courses.value.length )
        
        //Find index of next ; in remaining courses string
        index = courses.value.indexOf( ";" );
    }
};


////////////////////////////////////////////////////////////////////////////////
// Function: addCourse( courseName )
//
// Description: Adds a textbox to edit course
//
// Parameter: courseName - Name of course to add
////////////////////////////////////////////////////////////////////////////////
function addCourse( courseName ) {
    //Create new textbox
    var div = document.getElementById('courseContainer');
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'course_';
    input.name = input.name.concat( numCourses++ );
    input.value = courseName;
    input.size = 40;

    //Add textbox to HTML page
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
};