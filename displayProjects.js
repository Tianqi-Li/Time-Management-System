// Keep the current date as a global variable
var current_time=new Date();//today's date
var this_month=current_time.getMonth()+1;//this month
var this_year=current_time.getFullYear();//this year

var current_week=new Week(current_time);//the whole week
var dateArray=current_week.getDates();//dates of each day in this week

for(var i in dateArray) {
    $year = dateArray[i].getFullYear();
    $month = dateArray[i].getMonth() + 1;
    $workday = dateArray[i].getDate();
    dateArray[i] = $year + "-" + $month + "-" + $workday;
}

var _veroq = _veroq || [];
    _veroq.push(['init', { api_key: '92bd6ca368b6997e73a877740f37dc24f3104854'} ]);
    (function() {var ve = document.createElement('script'); ve.type = 'text/javascript'; ve.async = true; ve.src = 'http://d3qxef4rp70elm.cloudfront.net/m.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ve, s);})();

$(document).ready(function() {
    
    checkEmailSend();
    fetchProjects();
    fetchTimesheets(dateArray[0],dateArray[6]);
    
    // Switch to previous and next week
    $("#next_week_btn").click(function(){
	    current_week = current_week.nextWeek();
	    var dateArray=current_week.getDates();//dates of each day in this week
	    // Update dates array
	    for(var i in dateArray) {
		$year = dateArray[i].getFullYear();
		$month = dateArray[i].getMonth() + 1;
		$workday = dateArray[i].getDate();
		dateArray[i] = $year + "-" + $month + "-" + $workday;
	    }
	    console.log(dateArray[0]);
	    fetchTimesheets(dateArray[0],dateArray[6]); 
	    
    });
    
    $("#prev_week_btn").click(function(){
	    current_week = current_week.prevWeek();
	    var dateArray=current_week.getDates();//dates of each day in this week
	    // Update dates array
	    for(var i in dateArray) {
		$year = dateArray[i].getFullYear();
		$month = dateArray[i].getMonth() + 1;
		$workday = dateArray[i].getDate();
		dateArray[i] = $year + "-" + $month + "-" + $workday;
	    }
	    fetchTimesheets(dateArray[0],dateArray[6]);
    });
    
   
    
});


 

// Check if sign up email is sent to the user
function checkEmailSend(event) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "getEmail.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", checkEmailSendCallback, false);
    xmlHttp.send(null);
}

function checkEmailSendCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    if (jsonData.needtosend) {
	var email = jsonData.email;
	_veroq.push(['user', {
	// Required attributes
	id: email, 
	email: email
	}]);
	_veroq.push(['track', 'Signs up']);  // Capture when a user signs up 
    }
}


// Display all the available events

function fetchProjects(event) {
    
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "getProjects.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", fetchProjectsCallback, false);
    xmlHttp.send(null);
}

function fetchProjectsCallback(event) {

    var jsonData = JSON.parse(event.target.responseText);
    var projectsParent = document.getElementById("allProjects");
    projectsParent.innerHTML = "";
    if(jsonData.projectExisted){
	var projects = jsonData.projects;
	for(var i in projects) {
	    var title = projects[i].title;
            var label = document.createElement("lable");
            var text = document.createTextNode(title);
            var button = document.createElement("button");
            button.id = title;
            button.setAttribute("class", "sign_up_btn");
            button.innerHTML = "+";
            
            label.appendChild(text);
            projectsParent.appendChild(label);
            projectsParent.appendChild(button);
            projectsParent.appendChild(document.createElement("br"));
            
            
	}
        
        $('.sign_up_btn').each(function(){
            $(this).click(function(){
                addProject(this.id);
            });
        });
        
        
    }else{
	console.log(jsonData.message);
    }
}

// Add a single project to time sheet
function addProject(project) {
    var dataString = "project=" + encodeURIComponent(project);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "addTimesheet.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", addProjectCallback, false);
    xmlHttp.send(dataString);
}

function addProjectCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    if (jsonData.success) {
        fetchTimesheets(dateArray[0],dateArray[6]);
        var title = jsonData.title;
        console.log("Get project" + title);
        document.getElementById("message").innerHTML = "You are in " + title;
    }
    else {
        alert(jsonData.message);
    }
}

// Display all the time sheets of the user, weekly view
function fetchTimesheets(sun,sat) {
    var dataString = "sunday=" + encodeURIComponent(sun) + "&saturday=" + encodeURIComponent(sat);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "getTimesheets.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", fetchTimesheetsCallback, false);
    xmlHttp.send(dataString);
}

function fetchTimesheetsCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    //console.log(jsonData.timesheets.length);
    var table = document.getElementById("timesheet_table");
    table.innerHTML = "";
    if (jsonData.success) {
        var length = jsonData.timesheets.length;
        //display time sheets in table
	/*var tblHead = document.createElement("tr");
        for (var i = 0; i < 8; i++) {
            var cell = document.createElement("td");
            switch (i) {
                case 0:   
                    var cellText = document.createTextNode("Project Title"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 1:   
                    var cellText = document.createTextNode("Sunday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 2:   
                    var cellText = document.createTextNode("Monday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 3:   
                    var cellText = document.createTextNode("Tuesday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 4:   
                    var cellText = document.createTextNode("Wednesday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 5:   
                    var cellText = document.createTextNode("Thursday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 6:   
                    var cellText = document.createTextNode("Friday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
                case 7:   
                    var cellText = document.createTextNode("Saturday"); 
                    cell.appendChild(cellText);
                    tblHead.appendChild(cell);
                    break;
            }
             
        }
        table.appendChild(tblHead);*/
	for(var i in jsonData.timesheets) {
	    var row = document.createElement("tr");
	    $title = jsonData.timesheets[i].title
	    for (var j = 0; j < 10; j++) {
		var cell = document.createElement("td");
		
		switch (j) {
		    case 0:   
			var cellText = document.createTextNode($title); 
			cell.appendChild(cellText);
			row.appendChild(cell);
			break;
		    case 1:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "1"; // set the class by project title
			input.value = jsonData.timesheets[i].sun;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 2:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "2"; // set the class by project title
			input.value = jsonData.timesheets[i].mon;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 3:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "3"; // set the class by project title
			input.value = jsonData.timesheets[i].tue;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 4:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "4"; // set the class by project title
			input.value = jsonData.timesheets[i].wed;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 5:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "5"; // set the class by project title
			input.value = jsonData.timesheets[i].thr;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 6:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "6"; // set the class by project title
			input.value = jsonData.timesheets[i].fri;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 7:   
			var input = document.createElement("input");
			input.type = "text";
			input.id = $title + "7"; // set the class by project title
			input.value = jsonData.timesheets[i].sat;
			cell.appendChild(input); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 8:
			var button = document.createElement("button");
			button.className = "save_btn";
			button.id = $title + "8";
			button.innerHTML = "Save";
			cell.appendChild(button);
			row.appendChild(cell);
			break;
		    case 9:
			var button = document.createElement("button");
			button.className = "quit_btn";
			button.id = $title + "9";
			button.innerHTML = "QUIT";
			cell.appendChild(button);
			row.appendChild(cell);
			break;
		}
	    }
	    table.appendChild(row);
	}
	
	// Add event listener to each edit button
	$('.save_btn').each(function(){
            $(this).click(function(){
                editTimesheet(this.id);
            });
        });
	$('.quit_btn').each(function(){
            $(this).click(function(){
                quitProject(this.id);
            });
        });
	
    } else {
        document.getElementById("hours").innerHTML = jsonData.message;
    }
    
}

// Allow worker to edit his own time sheets
function editTimesheet(project) {
    var title = project.slice(0,-1);
    var sun = document.getElementById(title + "1").value;
    var mon = document.getElementById(title + "2").value;
    var tue = document.getElementById(title + "3").value;
    var wed = document.getElementById(title + "4").value;
    var thr = document.getElementById(title + "5").value;
    var fri = document.getElementById(title + "6").value;
    var sat = document.getElementById(title + "7").value;

    var dataString = "title=" + encodeURIComponent(title) +
		     "&sundate=" + encodeURIComponent(dateArray[0]) +
		     "&sunhour=" + encodeURIComponent(sun) +
		     "&mondate=" + encodeURIComponent(dateArray[1]) +
		     "&monhour=" + encodeURIComponent(mon) +
		     "&tuedate=" + encodeURIComponent(dateArray[2]) +
		    "&tuehour=" + encodeURIComponent(tue) +
		    "&weddate=" + encodeURIComponent(dateArray[3]) +
		    "&wedhour=" + encodeURIComponent(wed) +
		    "&thrdate=" + encodeURIComponent(dateArray[4]) +
		    "&thrhour=" + encodeURIComponent(thr) +
		    "&fridate=" + encodeURIComponent(dateArray[5]) +
		    "&frihour=" + encodeURIComponent(fri) +
		    "&satdate=" + encodeURIComponent(dateArray[6]) +
		    "&sathour=" + encodeURIComponent(sat) ;
    console.log(dataString);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "editTimesheet.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", editTimesheetCallback, false);
    xmlHttp.send(dataString);
}

function editTimesheetCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    if (jsonData.success) {
        fetchTimesheets(dateArray[0],dateArray[6]);
	console.log(jsonData.title);
	alert("You have sucessfully sumit the time sheet!");
	
    } else {
	console.log(jsonData.message);
    }
}

//Worker quit a project
function quitProject(project) {
    var title = project.slice(0,-1);
    var dataString = "title=" + encodeURIComponent(title);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "quitProject.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", quitProjectCallback, false);
    xmlHttp.send(dataString);
}

function quitProjectCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    if (jsonData.success) {
        fetchTimesheets(dateArray[0],dateArray[6]);
	alert("You are now out of the project!");
	var email = jsonData.email;
	_veroq.push(['user', {
	// Required attributes
	id: email, 
	email: email
	}]);
	_veroq.push(['track', 'Signs up']);  // Capture when a user signs up 
    } else {
	alert(jsonData.message);
    }
}

