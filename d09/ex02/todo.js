var list = document.getElementById('ft_list');
var a = 1;
getCookies();
function setCookie(cname, cvalue, exdays)
{
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname)
{
	var test = document.cookie;
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++)
	{
		console.log("ok");
		var c = ca[i];
		while (c.charAt(0) == ' ')
		{
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0)
			return (c.substring(name.length,c.length));
	}
	return "";
}

function getCookies()
{
	var b = "ok";
	var new_elem;
	var content;
	var first;

	while (b != "")
	{
		b = getCookie("div" + a);
		if (b != "")
		{
			new_elem = document.createElement('div');
			content = document.createTextNode(b);
			first = document.getElementById(a - 1);
			new_elem.setAttribute('id', a);
			new_elem.setAttribute('onclick', 'del(this);');
			new_elem.appendChild(content);
			list.insertBefore(new_elem, first);
			a = a + 1;
		}
	}
}

function addelem()
{
	var yo = prompt("Enter your todo", "");
	var new_elem = document.createElement('div');
	var content = document.createTextNode(yo);
	var first = document.getElementById(a - 1);
	new_elem.setAttribute('id', a);
	new_elem.setAttribute('onclick', 'del(this);');
	setCookie("div" + a, yo, 1);
	a = a + 1;
	new_elem.appendChild(content);
	list.insertBefore(new_elem, first);
}

function del(th)
{
	if (confirm('You Wanna Delete'))
	{
		th.parentNode.removeChild(th);
		setCookie("div" + th.id, "", 0);
	}
}
