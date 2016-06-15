var the_year; //2016 
var the_month; //6
var the_month_name; //June

var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

//month digits
function getMonthDigits( yearMonth )
{
	var month = yearMonth.slice(-2);
	month = parseInt(month, 10);
	return month;
}

function setMonthDigits( yearMonth )
{
	the_month = getMonthDigits(yearMonth);
} 


//month name
function setMonthName( yearMonth )
{
	the_month_name = getMonthName(yearMonth);
}

function getMonthName( yearMonth )
{
	var month = getMonthDigits(yearMonth);
	var monthName = months[month-1];
	return monthName;
}


// year
function getYear( yearMonth )
{
	var year = yearMonth.slice(4);
	return year;	
}

function setYear( yearMonth )
{
	the_year = getYear(yearMonth);
}


function getPrevMonth( yearMonth )
{
	var month_digits = getMonthDigits(yearMonth);
	var year = getYear(yearMonth);

	if(month_digits == 1){
		the_year = year-1;
		the_month = 12;
	} else {
		the_month = the_month-1;
	}

	the_month_name = months[the_month-1];
} 


function getNextMonth( yearMonth )
{
	var month_digits = getMonthDigits(yearMonth);
	var year = getYear(yearMonth);

	if(month_digits == 12){
		the_year = year+1;
		the_month = 1;
	} else {
		the_month = the_month+1;
	}

	the_month_name = months[the_month-1];
}





