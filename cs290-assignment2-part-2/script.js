//after struggling with thie assignment, I found this code: https://github.com/emcclured/cs290-assignment3-part2/blob/master/cs290Assignment3Part2Scripts.js#L230
//I wish I found this earlies
//refference:
//thompsonkt/cs290-assignment3_part2 – script.js 
//blueshedfriends/Hello – sql-panel.js 
//and other refference provided in the document

//http://stackoverflow.com/questions/28094136/bash-function-to-search-git-repository-for-a-filename-that-matches-regex
function searchGit() {
	//element is a reference to an Element object, or null if an element with the specified ID is not in the document.
	//significant portion is code is taken from https://developer.mozilla.org/en-US/docs/Web/API/document.getElementById
	var pages = document.getElementById("pages");
	var i;
	var httpRequest;
	var response;
	var ReadyState = function () {
		//http://www.w3schools.com/dom/dom_http.asp
		//4: request finished and response is ready 
		if (httpRequest.readyState === 4) {
			//Returns the status-number (e.g. "404" for "Not Found" or "200" for "OK")
			if (httpRequest.status === 200) {
				//per hint in the assignment; GitHub returns JSON results. JavaScript has a method JSON.parse() to convert JSON into an object. 
				//http://www.w3schools.com/json/json_eval.asp
				response = JSON.parse(httpRequest.responseText);
				Loading_information(response, i);
			} 
			//this is the indication that the page was not loaded successfully
			else {
				alert('There was a problem with the request.');
			}
		}
	};
	//looping from the pages, depeding on the value indicated by the user
	for (i = 1; i <= pages.value; i++) {
		//The XMLHttpRequest object is used to exchange data with a server behind the scenes. 
		//This means that it is possible to update parts of a web page, without reloading the whole page.
		//code is talek from http://www.w3schools.com/ajax/ajax_xmlhttprequest_create.asp
		if (window.XMLHttpRequest) {
			httpRequest = new XMLHttpRequest();
		} 
		else if (window.ActiveXObject) {
			httpRequest = new window.ActiveXObject("Microsoft.XMLHTTP");
		}
		if (!httpRequest) {
			alert('Could not create httpRequest');
		}
		
		httpRequest.onreadystatechange = ReadyState;
		/*The API is similar to open weather map. Sending a GET request to https://api.github.com with the 
		appended path will return results. For example a GET request to https://api.github.com/gists returns a page of Gists.
		Under the overview of the GitHub API there in information on pagination which will be required in order to return 
		more than 1 page of results. */
		//used some code from https://gist.github.com/jamesrwhite/9949798
		httpRequest.open('GET', 'https://api.github.com/gists', false);
		httpRequest.send("page=" + i);
	}
}

function Loading_information(response, page) {
	/* Check filters */
	var noFilter = true;
	//variable for 4 languages of interst
	//The getElementById() method accesses the first element with the specified id.
	var includePython = document.getElementById("Python").checked; //Specifies whether a checkbox should be checked or not.  see http://www.w3schools.com/jsref/prop_checkbox_checked.asp
	var includeJSON = document.getElementById("JSON").checked; //if the language matches the language of interest, the checkbox is checked
	var includeJS = document.getElementById("JavaScript").checked;
	var includeSQL = document.getElementById("SQL").checked;
	
	var table;
	var tableBody;
	var oldResultsTable;
	//if one of the language of interests change filter to false
	if (includePython || includeJSON || includeJS || includeSQL) {
		noFilter = false;
	}
	////The getElementById() method accesses the first element with the specified id.
	var resultsDiv = document.getElementById("searchResultsDiv");
	var rowid = 0;
	//looking at page #1
	if (page === 1) {
		oldResultsTable = document.getElementById("resultsTable");
		table = document.createElement("table");
		table.setAttribute('id', "resultsTable");
		// this is almost identical to the code above -- the one used in the favorite function
		var headingRow = document.createElement("tr"); // row is created
		tableBody = document.createElement("tbody");
		tableBody.setAttribute('id', "tableResults");
	} 
	//if there is more than one page, we need to get 30 more entries for each page
	else {
		rowid += 30;
		table = document.getElementById("resultsTable");
		tableBody = document.getElementById("tableResults");
	}
	var key;
	var include;
	var fileName;
	var fileObj;
	var row;
	var i;
	var cell;
	var button;
	var urlLink;
	var description;
	var urlDescription;
	
	//stackoverflow.com/questions/18238173/javascript-loop-through-json-array */
	//loop through the entries
	for (key in response) {
	//The hasOwnProperty() method returns a boolean indicating whether the object has the specified property, in our case its key
	if (response.hasOwnProperty(key)) {
		//Do not add if already the url is alreay in favorites 
		if (!localStorage.getItem(response[key].url)) {
			/* Filter Results */
			//reverse logic is used. if no filter is true - none of the languages that we are intersted in
			//then we will not include the link
			if (noFilter) {
				include = true;
			} 
			//if the language is the one that we are interested in
			else {
				//http://www.w3schools.com/jsref/prop_fileupload_files.asp
				for (fileName in response[key].files) {
					////The hasOwnProperty() method returns a boolean indicating whether the object has the specified property, in our case its key
					//checking if the language is the one we are interested in
					//code is self explanatory
					if (response[key].files.hasOwnProperty(fileName)) {
						fileObj = response[key].files[fileName];
						console.log(fileObj.language);
						if (fileObj.language === "JSON" && includeJSON) {
							include = true;
						} 
						else if (fileObj.language === "JavaScript" && includeJS) {
							include = true;

						} 
						else if (fileObj.language === "Python" && includePython) {
							include = true;
						} 
						else if (fileObj.language === "SQL" && includeSQL) {
							include = true;
						} 
						else {
							include = false;
						}
					}
				}
			}
			//this section of code is copy and past from the function displayFavorites() fucniton
			if (include) {
				row = document.createElement("tr");
				row.setAttribute('id', "rowid" + rowid);
						//creating favorite table
				//we need to create 2 headers, one for add to favorite button 
				//and another one for the description
				for (i = 0; i < 2; i++) {
					cell = document.createElement("td");
					if (i === 0) {
						button = document.createElement("input");
						button.setAttribute('type', "button");
						button.setAttribute('value', "Add the URL to Favorites");
						button.setAttribute('onclick', "addToFavorites('" +	response[key].description + "','" + response[key].url + "','" + rowid + "')");
						cell.appendChild(button);
					} 
					//for the rest of the rows, we need to create a link
					//see http://stackoverflow.com/questions/4772774/how-do-i-create-a-link-using-javascript
					
					else {
						//creating a link
						urlLink = document.createElement("a");
						//getting a description
						description = response[key].description;
						//if there is no description indicate that there is not description
						if (description === "") {
							description = "No Description";
						}
						urlDescription = document.createTextNode(description);
						//refference to the url
						//The href attribute specifies the URL of the page the link goes to.
						//http://www.w3schools.com/tags/att_a_href.asp
						urlLink.setAttribute('href', response[key].url);
						urlLink.appendChild(urlDescription);
						cell.appendChild(urlLink);
					}
					row.appendChild(cell);
				}
				tableBody.appendChild(row);
			}
		}
		}
		rowid++;
	}
	if (page === 1) {
		table.appendChild(tableBody);
		//replacing old table with the new table
		resultsDiv.replaceChild(table, oldResultsTable);
	}
}
	
function displayFavorites() {
	/* Replace existing table */
	//http://www.w3schools.com/jsref/met_doc_getelementbyid.asp
	var favoritesDiv = document.getElementById("favoritesDiv");
	var oldFavoritesTable = document.getElementById("favoritesTable");
	//http://www.w3schools.com/jsref/met_document_createelement.asp
	 var table = document.createElement("table");
	 //will add link to favorits
	table.setAttribute('id', "favoritesTable");
	//http://www.w3schools.com/jsref/met_document_createelement.asp
	// now we are looking at the  entries in the table
	var tableBody = document.createElement("tbody"); //body of the table is created
	var j, i, row, url, description, cell, button,urlLink, urlDescription;
	//With local storage, web applications can store data locally within the user's browser.
	//http://www.w3schools.com/html/html5_webstorage.asp
	//we are looking at the user broser
	for (j = 0; j < localStorage.length; j++) {
		row = document.createElement("tr");//row is created 
		//looking at the 
		url = localStorage.key(j);//http://stackoverflow.com/questions/18695317/how-to-delete-the-individual-item-from-the-localstorage-dynamically
		//http://www.mosync.com/files/imports/doxygen/latest/html5/localstorage.md.html
		//returns the name of the key at the position specified, in out case we are looping
		description = localStorage.getItem(localStorage.key(j));// retreive the URL. see  http://www.w3schools.com/html/html5_webstorage.asp
		
		//creating favorite table
		//we need to create 2 headers, one for remove from the favorite button 
		//and another one for the description
		for (i = 0; i < 2; i++) {
			cell = document.createElement("td"); // creating a data section in the table
			if (i === 0) {
				//creating an element input
				button = document.createElement("input");
				//we need to set an attribute per http://www.w3schools.com/jsref/dom_obj_text.asp
				button.setAttribute('type', "button");
				//define the value = text that will be displayed on the button
				button.setAttribute('value', "remove from favorite list");
				//The onclick event occurs when the user clicks on an element.
				//http://www.w3schools.com/jsref/event_onclick.asp
				button.setAttribute('onclick', "removeFromFavs('" + url + "')");
				cell.appendChild(button); // the text is appeneded per http://www.w3schools.com/jsref/met_node_appendchild.asp
			} 
			else {
			//for the rest of the rows, we need to create a link
			//see http://stackoverflow.com/questions/4772774/how-do-i-create-a-link-using-javascript
				urlLink = document.createElement("a");
				//if there is not description provided on the url, the description will be set to not description
				if (description === "") {
					description = "No Description Available";
				}
				//http://www.w3schools.com/jsref/met_document_createtextnode.asp-->
				urlDescription = document.createTextNode(description);
				//The href attribute specifies the URL of the page the link goes to.
				//http://www.w3schools.com/tags/att_a_href.asp
				urlLink.setAttribute('href', url);
				urlLink.appendChild(urlDescription);  //appends text to descrition
				cell.appendChild(urlLink); //appends text to description
			}
			row.appendChild(cell);
		}
		tableBody.appendChild(row);
	}
	table.appendChild(tableBody);
	favoritesDiv.replaceChild(table, oldFavoritesTable);
}
	
//By default, it is fired when the entire page loads, including its content (images, css, scripts, etc.)
//http://stackoverflow.com/questions/588040/window-onload-vs-document-onload
window.onload = function () {
		displayFavorites();
};
	
	
//adding to favorite
function addToFavorites(description, url, rowid) {
	//creating a local storage with the name ulr and value description
	//http://www.w3schools.com/html/html5_webstorage.asp
	localStorage.setItem(url, description);
	//function display favorites is called
	displayFavorites();
	//The getElementById() method accesses the first element with the specified id.
	//Gists which have been added to favorites should not show up in the list of Gists returned by the search.
	//code is taken from http://stackoverflow.com/questions/4967223/javascript-delete-a-row-from-a-table-by-id
	var row = document.getElementById("rowid" + rowid); 
	var tbody = row.parentNode;
	tbody.removeChild(row);
}


//fucntion removes from favorite
//http://www.w3schools.com/html/html5_webstorage.asp
function removeFromFavs(url) {
	localStorage.removeItem(url);
	//favorites are displayed
	displayFavorites();
}