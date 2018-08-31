				//to convert lowerCase to upperCase
				function upperCase(a){
					setTimeout(function(){
					a.value = a.value.toUpperCase();
					},1);
				}
				
				$(function()
						{
							$("#srcId").autocomplete({
								source: "getStationCodeUtil.php",
								autoFocus:true
							});
							
							$("#dstId").autocomplete({
								source: "getStationCodeUtil.php",
								autoFocus:true
							});
						});
						
				function maxLengthTime(object) {
					setTimeout(function(){
						if((object.value.length==2)&&object.value[object.value.length-1]!=':')
							object.value=object.value.concat(":");
							},1);
				
					if (object.value.length > object.maxLength)
						object.value = object.value.slice(0, object.maxLength)
				}
				
				function maxLengthCheck(object) {
					if (object.value.length > object.maxLength)
						object.value = object.value.slice(0, object.maxLength)
				}
    
				function isNumeric(evt) {
					var theEvent = evt || window.event;
					var key = theEvent.keyCode || theEvent.which;
					key = String.fromCharCode (key);
					var regex = /[0-9]|\./;
					if ( !regex.test(key) ) {
						theEvent.returnValue = false;
					if(theEvent.preventDefault) theEvent.preventDefault();
					}
				}
				
				function isChar(evt) {
					var theEvent = evt || window.event;
					var key = theEvent.keyCode || theEvent.which;
					key = String.fromCharCode (key);
					var regex = /[a-zA-Z_ ]/;
					if ( !regex.test(key)) {
						theEvent.returnValue = false;
					if(theEvent.preventDefault) theEvent.preventDefault();
					}
				}
				
				function check(str){
					var y="classInputId"+str;
					var x=document.getElementById(y);
					if(x.style.display==="inline-block")
						x.style.display="none";
					else
						x.style.display="inline-block";
				}