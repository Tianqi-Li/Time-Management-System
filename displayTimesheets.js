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


$(document).ready(function() {
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


// Display all the time sheets of the user, weekly view
function fetchTimesheets(sun,sat) {
    var dataString = "sunday=" + encodeURIComponent(sun) + "&saturday=" + encodeURIComponent(sat);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "managerViewTimesheets.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", fetchTimesheetsCallback, false);
    xmlHttp.send(dataString);
}

function fetchTimesheetsCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    var table = document.getElementById("timesheet_table");
    table.innerHTML = "";
    if (jsonData.success) {
        var length = jsonData.timesheets.length;
        //display time sheets in table
	var tblHead = document.createElement("tr");
        for (var i = 0; i < 8; i++) {
            var cell = document.createElement("td");
            switch (i) {
                case 0:   
                    var cellText = document.createTextNode("Worker Name"); 
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
        table.appendChild(tblHead);
	for(var i in jsonData.timesheets) {
	    var row = document.createElement("tr");
	    $workername = jsonData.timesheets[i].workername;
	    for (var j = 0; j < 9; j++) {
		var cell = document.createElement("td");
		
		switch (j) {
		    case 0:   
			var cellText = document.createTextNode($workername); 
			cell.appendChild(cellText);
			row.appendChild(cell);
			break;
		    case 1:   
			var cellText = document.createTextNode(jsonData.timesheets[i].sun);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 2:   
			var cellText = document.createTextNode(jsonData.timesheets[i].mon);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 3:   
			var cellText = document.createTextNode(jsonData.timesheets[i].tue);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 4:   
			var cellText = document.createTextNode(jsonData.timesheets[i].wed);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 5:   
			var cellText = document.createTextNode(jsonData.timesheets[i].thr);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 6:   
			var cellText = document.createTextNode(jsonData.timesheets[i].fri);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 7:   
			var cellText = document.createTextNode(jsonData.timesheets[i].sat);
			cell.appendChild(cellText); // put it into the DOM
			row.appendChild(cell);
			break;
		    case 8:
			var button = document.createElement("button");
			cell.appendChild(button);
			row.appendChild(cell);
			break;
		}
	    }
	    table.appendChild(row);
	}
	
    } else {
        document.getElementById("message").innerHTML = jsonData.message;
    }
    
}