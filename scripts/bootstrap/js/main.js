function get_data(commander,div){
	//var sel=document.getElementById('class');

	//commander=commander+"?class="+sel.value;
//alert(commander);
	var get_control_panelObject = false;
//alert(commander);
//create the object, depending on the type of browser
	
	if (window.XMLHttpRequest){
		get_control_panelObject = new XMLHttpRequest();
	}else if (window.ActiveXObject){
			get_control_panelObject = new ActiveXObject('Microsoft.XMLHTTP');										
		}

	if(get_control_panelObject){

		//the target div
		var get_control_panelobj = document.getElementById(div);
		
			get_control_panelObject.open('GET', commander);
			
			get_control_panelObject.onreadystatechange = function(){
				
					if (get_control_panelObject.readyState == 4 && get_control_panelObject.status == 200){

						if(get_control_panelObject.responseText.length >5){
							get_control_panelobj.innerHTML = get_control_panelObject.responseText;
						}	

					}	
				}	
			get_control_panelObject.send(null);
		}
}




function show() {
	//alert("ok");
	var btn=document.getElementById('btnAdd');
	var btnBack=document.getElementById('btnBack');
	btn.style.display="block";
	btnBack.style.display="block";
}

					


var msg=new Array();
function validator() {
	alert("i am here");
	var password=document.getElementById("password");
	var cpassword=document.getElementById("cpassword");
	var email=document.getElementById("email");
	var school_name=document.getElementById("school_name");
	var address=document.getElementById("address");
	
	confirm_password(password,cpassword);
	val_email(email);
	val_length(address,'address');
	val_length(school_name,'school name');

	if (msg.length == 0) {
		return true;
	}else{
		document.getElementById("error").innerHTML=msg;
		return false;
	}
}


function val_text(text,name){
	
	if(text.value == '' || text.value == null)
	{
		msg.unshift('Please enter valid inputs in '+ name);
		return false;
	}
		
	return (true);

}



function val_email(email)	{
	
	if(email.value == '' || email.value == null){
			msg.unshift('Please Enter A Valid Email Address');
			return (false);
		}
		
	if (email.value != ''){
					
		apos=email.value.indexOf('@');
		dotpos=email.value.lastIndexOf('.');
				  
		if (apos < 1 || dotpos-apos < 2){
			msg.unshift('Please Enter a valid Email address.');
			return (false);
			
		}
		
	}	

	return (true);
	
}


function val_select(option){
	
	if(option.value == "default" || option.value == null){
		msg.unshift('Please this selection is not valid.');
		return (false);
	}

	return (true);
	
}



function val_length(field,name){
	
		if(field.value.length < 3){
				msg.unshift(name+" is too short");
				//field.focus();;
				return(false);
			}

}

function confirm_password(password,cpassword) {

	val_length(password,'password');
	val_length(cpassword,'confirm password');

	if(password.value !== cpassword.value){
		msg.unshift("Password mismatch.");
		//password.focus();
		return(false);
	}
}
	
			
				

	
				 		

function back(){
	history.back();
}


function confirm_action(action,thing) {
	if (action == null) {
		return true;
	}else{
		var answer=confirm("Are you sure you want to " + action + " " + thing + "?");
		if (answer) {
			return true;
			//window.location=commander;
		}else{
			return false;
		}
	}
 	
}

count = 0;
function mark_all(div){
  count++;
  var box = document.getElementsByName(div);
  if (count%2 == 1) {
    box.forEach(val => {
      val.checked = true;
    });
  }else{
    box.forEach(val => {
      val.checked = false;
    });
  }
  
}

// function to export html tables to excel
function fnExcelExport(div){
	var tab_text = "<table border='2px'>"+
										"<tr bgcolor='#87AFC6'>";

	tab = document.getElementById(div);  // id of the table
	
	for (let j = 0; j < tab.rows.length; j++) {
		//const element = tab.rows[j];
		tab_text = tab_text + tab.rows[j].innerHTML+"</tr>";
		// tab_text = tab_text+"</tr>";
		
	}

	tab_text = tab_text+"</table>";
	tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g,""); // remove if you want links in your table
	tab_text = tab_text.replace(/<img[^>]*>/gi,"");  // remove if you want images in your table
	tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi,"");  // removes input params

	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
		txtArea1.document.open("txt/html","replace");
		txtArea1.document.write(tab_text);
		txtArea1.document.close();
		txtArea1.focus();

		sa = txtArea1.document.execCommand("SaveAs",true,"data.xls");

	}else{
		sa = window.open("data:application/vnd.ms-excel,"+encodeURIComponent(tab_text));
		
	
	}

	return sa;
}



function exportToExcel(div) {

	var tab_text = "<table border='2px'>"+
										"<tr bgcolor='#87AFC6'>";

	tab = document.getElementById(div);  // id of the table
	
	for (let j = 0; j < tab.rows.length; j++) {
		//const element = tab.rows[j];
		tab_text = tab_text + tab.rows[j].innerHTML+"</tr>";
		// tab_text = tab_text+"</tr>";
		
	}

	tab_text = tab_text+"</table>";
	tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g,""); // remove if you want links in your table
	tab_text = tab_text.replace(/<img[^>]*>/gi,"");  // remove if you want images in your table
	tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi,"");  // removes input params

	var htmls = "";
	var uri = 'data:application/vnd.ms-excel;base64,';
		var base64 = function (s) {
			return window.btoa(unescape(encodeURIComponent(s)))
		};

		var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook><xml><![endif]--></head><body><table>{table}</table></body></html>';
		var format = function(s,c){
			return s.replace(/{(\w+)}/g, function(m,p){return c[p];
			})
		};

		htmls = tab_text;
		var ctx = {
			worksheet : 'Worksheet',
			table : htmls
		}

		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");

		if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
			txtArea1.document.open("txt/html","replace");
			txtArea1.document.write(tab_text);
			txtArea1.document.close();
			txtArea1.focus();
	
			sa = txtArea1.document.execCommand("SaveAs",true,"export.xls");
	
		}else{
			var link = document.createElement("a");
			link.download = "export.xls";
			link.href = uri + base64(format(template,ctx));
			link.click();
		}

}


/* jq=$.noConflict();
jq(document).ready(function(){
  jq("#mark_all").change(function(){alert("i am checked");
    jq("input[type='checkbox']").toggleAttribute("checked");
  });
}); */