//initialize 

var current_time=new Date();//today's date
var this_month=current_time.getMonth()+1;//this month
var this_year=current_time.getFullYear();//this year

var current_week=new Week(current_time);//the whole week
var dateArray=current_week.getDates();//dates of each day in this week

var current_sunday =  dateArray[0].getMonth()+1 + "/" + dateArray[0].getDate();
var current_saturday =  dateArray[6].getMonth()+1 + "/" + dateArray[6].getDate();

document.getElementById("week_period").innerHTML = "Current Pay Period:"+current_sunday + "--" + current_saturday;


console.log(current_week);
console.log(this_month);


