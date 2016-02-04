function verifie_check_box(num)
{
    if(num == 1)
        if(document.getElementById('Juillet').checked)
        {
            document.getElementById('Août').checked=false;
        	document.getElementById('Septembre').checked=false;
    	}
    if(num == 2)
        if(document.getElementById('Août').checked)
        {
            document.getElementById('Juillet').checked=false;
        	document.getElementById('Septembre').checked=false;
    	}
    if(num == 3)
        if(document.getElementById('Septembre').checked)
        {
            document.getElementById('Août').checked=false;
        	document.getElementById('Juillet').checked=false;
    	}
    if(num == 4)
        if(document.getElementById('2013').checked)
            document.getElementById('2014').checked=false;
    if(num == 5)
        if(document.getElementById('2014').checked)
            document.getElementById('2013').checked=false;
    if(num == 6)
        if(document.getElementById('Homme').checked)
            document.getElementById('Femme').checked=false;
    if(num == 7)
        if(document.getElementById('Femme').checked)
            document.getElementById('Homme').checked=false;
}

function check_box_color(id)
{
	var elem = document.getElementById(id+"_td");
	if (elem.style.display == "none")
		elem.style.display = "block";
	else
		elem.style.display = "none";
}