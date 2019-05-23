function showshit(myID1) //First is ID that is to be shown or hidden, second is button
		{
		hiddenTarget = document.getElementById(myID1);
		if (hiddenTarget.style.visibility == "hidden")
			{
				hiddenTarget.style.visibility = "visible";
				hiddenTarget.style.display = "inline";
			}
		else
			{
				hiddenTarget.style.visibility = "hidden";
				hiddenTarget.style.display = "none";
			}
		}