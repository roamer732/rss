function routeForm(){
 	var i,j=document.getElementById("snum").value;
	document.getElementById("id_").innerHTML="<hr>";
	document.getElementById("p_id").innerHTML="<strong><p id=\"title\">Enter Route Details :</p></strong>";
	var x,y;
	for(i=-2;i<=j;i++){
		
		//For halt numbers
		var stopn1=document.createElement("span");
		var stopn2=document.createElement("input");
		stopn2.setAttribute("id","haltId");
		stopn2.setAttribute("disabled","true");
		if(i>-2)
			stopn2.setAttribute("value",i+2);
		stopn1.appendChild(stopn2);
		document.getElementById("span_id").appendChild(stopn1);
        
		//For station code
		var stCode1=document.createElement("span");
		var stCode2=document.createElement("input");
		if(i<0||i==j)
		stCode2.setAttribute("disabled","true");
		if(i==-1){
			x=document.getElementById("srcId").value;
			stCode2.setAttribute("value",x);
		}
		else if(i==j){
			x=document.getElementById("dstId").value;
			stCode2.setAttribute("value",x);
		}
		stCode2.setAttribute("id","routeStatId");
		stCode2.setAttribute("name","stationCode[]");
		stCode2.setAttribute("type","text");
		stCode2.setAttribute("onkeypress","return isChar(event)");
		stCode2.setAttribute("oninput","maxLengthCheck(this)");
		stCode2.setAttribute("onkeydown","upperCase(this)");
		stCode2.setAttribute("maxLength","4");
		stCode2.setAttribute("placeholder","Station Code");
		stCode1.appendChild(stCode2);
		document.getElementById("span_id").appendChild(stCode1);
        
		//For station name
		var stName1=document.createElement("span");
		var stName2=document.createElement("input");
		if(i<0||i==j)
			stName2.setAttribute("disabled","true");
		if(i==-1){
			y=document.getElementById("srcNameId").value;
			stName2.setAttribute("value",y);
		}
		else if(i==j){
			y=document.getElementById("dstNameId").value;
			stName2.setAttribute("value",y);
		}
		stName2.setAttribute("onkeydown","upperCase(this)");
		stName2.setAttribute("id","routeStatNameId");
		stName2.setAttribute("type","text");
		stName2.setAttribute("name","stationName[]");
		stName2.setAttribute("onkeypress","return isChar(event)");
		stName2.setAttribute("placeholder","Station Name");
		stName1.appendChild(stName2);
		document.getElementById("span_id").appendChild(stName1);
        
		//For Arrival Time
		var atime1=document.createElement("span");
		var atime2=document.createElement("input");
		if(i<0)
			atime2.setAttribute("disabled","true");
		if(i==-1)
			atime2.setAttribute("value","NULL");					
		atime2.setAttribute("type","text");
		atime2.setAttribute("name","arr["+i+"]");
		atime2.setAttribute("placeholder","Arrival Time");
		atime2.setAttribute("maxLength","5");
		atime2.setAttribute("id","routeArrTimeId");
		atime2.setAttribute("onkeypress","return isNumeric(event)");
		atime2.setAttribute("oninput","maxLengthTime(this)");
		atime1.appendChild(atime2);
		/*var but=createElement("button");
		but.setAttribute("id",i);
		but.setAttribute("onclick","resetArrtime(this.id)");
		atime1.appendChild(but);
		but.insertAdjacentHTML('beforeend', '<i id="resetArr" class="fa">&#xf00d;</i>');*/
		document.getElementById("span_id").appendChild(atime1);
        
		//For Departure time
		var dtime1=document.createElement("span");
		var dtime2=document.createElement("input");
						
		if(i==-2||i==j)
			dtime2.setAttribute("disabled","true");
		if(i==j)
			dtime2.setAttribute("value","NULL");
		dtime2.setAttribute("type","text");
		dtime2.setAttribute("name","depart[]");
		dtime2.setAttribute("id","routeDepartTimeId");
		dtime2.setAttribute("placeholder","Departure Time");
		dtime2.setAttribute("maxLength","5");
		dtime2.setAttribute("onkeypress","return isNumeric(event)");
		dtime2.setAttribute("oninput","maxLengthTime(this)");
		dtime1.appendChild(dtime2);
		document.getElementById("span_id").appendChild(dtime1);
						
		//For Distance
		var dist1=document.createElement("span");
		var dist2=document.createElement("input");
		if(i<0)
			dist2.setAttribute("disabled","true");
		if(i==-1)
			dist2.setAttribute("value","0");
		var br=document.createElement("br");
		dist2.setAttribute("id","distId");
		dist2.setAttribute("type","text");
		dist2.setAttribute("name","dist[]"); 
		dist2.setAttribute("placeholder","Distance");
		dist1.appendChild(dist2);
		dist1.appendChild(br);
		document.getElementById("span_id").appendChild(dist1);
	}
}