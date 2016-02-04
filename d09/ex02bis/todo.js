var list = $('#ft_list');
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
			first = $('#ft_list');
			first.prepend("<div id=\"" + a + "\" >" + b + "</div>");
			$("#" + a).click (function ()
					{
						if (confirm('You Wanna Delete'))
						{
							this.remove();
							setCookie("div" + this.id, "", -1);
						}
					});
			a = a + 1;
		}
	}
}

$("button").click(function()
{
	var yo = prompt("Enter your todo", "");
	var first = $('#ft_list');
	first.prepend("<div id=\"" + a + "\">" + yo + "</div>");
	setCookie("div" + a, yo, 1);
	$("#" + a).click (function ()
		{
			if (confirm('You Wanna Delete'))
			{
				this.remove();
				setCookie("div" + this.id, "", 0);
			}
		});
	a = a + 1;
});

