<?php
header('content-type: text/html; charset=utf-8'); 
?>
<!doctype html>
<html>
<head>

<script src="jquery.js"></script>
<script type="text/javascript">
var intId;
var intId2;
var v1="news";
var counter;
var myTimer;
var myquery="";
function main_page()
{
	document.getElementById('content_wrapper').style.height="900px";
}
function show_subpages(v)
{
	document.getElementById('one').style.color="#999";
	document.getElementById('two').style.color="#999";
	document.getElementById('three').style.color="#999";
	document.getElementById('four').style.color="#999";
	document.getElementById('five').style.color="#999";
	
	document.getElementById(v).style.color="#000";
	intId =setInterval(effect,1000);
	 
	if(v=='one')
	{
		document.getElementById('content_wrapper').style.height="770px";
		document.getElementById('content_wrapper').style.backgroundImage="none";
		document.getElementById('news').style.height="835px";
		show_einrichtungen();
	}
	
	if(v=='two')
	{
		show_themen();
	}
	
}

function show_einrichtungen()
	{
		document.getElementById("map1").style.display="";
		document.getElementById("search_query").style.display="";
			counter=0;
		$("#title").hide();
		
		document.getElementById("description_home").style.display="none";
		document.getElementById("description_them").style.display="none";
		document.getElementById("description_enr").style.display="";
		document.getElementById("description_enr").style.margin="176px 0px 0px 0px";
		//document.getElementById("description").style.width="40%";
		//document.getElementById("content_wrapper").style.minHeight="130%";
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			var my_categories=JSON.parse(xmlhttp.responseText);
			
			var str="<ul>";
			for(var i=0;i<my_categories.length;i++)
			{
				var data=my_categories[i].split(',');
				str=str+"<li id='l"+i+"' onclick='display("+data[0]+")'><strong>"+data[1]+"</strong></li>";
				str=str+"<div style='display:none;' id='opt_"+data[0]+"'></div>";
				counter++;	
			}
			str=str+"</ul>";
			
			
			document.getElementById("items_div").innerHTML=str;
			
			
			
		}
		}
		xmlhttp.open("POST","getsubjects.php",true);
		xmlhttp.send();
	
	}

function show_themen()
{
	
		
			counter=0;
		$("#title").hide();
		
		document.getElementById("description_home").style.display="none";
		document.getElementById("description_enr").style.display="none";
		document.getElementById("description_them").style.display="";
		
		document.getElementById("description_them").style.margin="176px 0px 0px 0px";
		//document.getElementById("description").style.width="40%";
		//document.getElementById("content_wrapper").style.minHeight="130%";
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			var my_categories=JSON.parse(xmlhttp.responseText);
			
			var str="<ul>";
			for(var i=0;i<my_categories.length;i++)
			{
				var data=my_categories[i].split(',');
				data[1]=data[1].replace("@","ä");
				data[1]=data[1].replace("*","ö");
				data[1]=data[1].replace("_","ü");
				
				str=str+"<li id='l"+i+"' onclick='display("+data[0]+")'><strong>"+data[1]+"</strong></li>";
				str=str+"<div style='display:none;' id='opt_"+data[0]+"'></div>";
				counter++;	
			}
			str=str+"</ul>";
			
			
			document.getElementById("items_div").innerHTML=str;
			
			
			
		}
		}
		xmlhttp.open("POST","get_themen.php",true);
		xmlhttp.send();
}
function load_queried_uni()
{
	
	var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			var my_categories1=JSON.parse(xmlhttp.responseText);
			
			var str="<ul>";
			for(var i=0;i<my_categories1.length;i++)
			{
				var data=my_categories1[i].split(',');
				str=str+"<li onclick='display("+data[0]+")'><strong>"+data[1]+"</strong></li>";
				str=str+"<div style='display:none;' id='opt_"+data[0]+"'></div>";
				counter++;	
			}
			str=str+"</ul>";
			
			document.getElementById("items_div").innerHTML=str;
			
			
			
		}
		}
		xmlhttp.open("POST","getsubjects1.php?"+myquery,true);
		xmlhttp.send();
}
function display(id)
{
		
		for(var i=1;i<=counter;i++)
		{
			if(document.getElementById("opt_"+i))
				document.getElementById("opt_"+i).style.display="none";
		}
	
		var obj;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		obj=new XMLHttpRequest();
		
		}
		else
		{// code for IE6, IE5
		obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		obj.onreadystatechange=function()
		{
		if (obj.readyState==4 && obj.status==200)
		{
			
			var my_categories=JSON.parse(obj.responseText);
			var list="<ul style='width:230px;' id='ul_"+id+"'>";
			for(var i=0;i<my_categories.length;i++)
			{
				list=list+"<li>"+my_categories[i]+"</li>";
			}
			list=list+"</ul>";
			
			
			//var ht="<li>"+document.getElementById("li_"+id).innerHTML+"</li>";
			document.getElementById("opt_"+id).innerHTML=list;
			document.getElementById("opt_"+id).style.display="";
		
		}
		}
		obj.open("POST","get_subheadings.php?cat_id="+id,true);
		obj.send();
		
	
}
function effect()
{
	$("#menu").hide(1000);
	document.getElementById(v1).style.margin="0px 0px 0px 0px";
	$("#menu1").slideToggle("slow");
	$("#menu2").slideToggle("slow");
	clearInterval(intId);  
	
}

function show_home()
{
	intId2 =setInterval(effect_home,1000);
}
function effect_home()
{
	$("#menu1").hide(900);
	$("#menu2").hide(300);
	document.getElementById(v1).style.margin="20% 0px 0px 0px";
	$("#menu").slideToggle("slow");
	$("#map1").hide();
	$("#search_query").hide();
	document.getElementById("title").style.display="";
	
	
	document.getElementById("description_home").style.display="";
	document.getElementById("description_enr").style.display="none";
	
	clearInterval(intId2);  
	
}
function act()
{
	alert("hello");
}

function load_city_queried_uni(city,qu)
{
	
	var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			var my_categories1=JSON.parse(xmlhttp.responseText);
			
			var str="<ul>";
			for(var i=0;i<my_categories1.length;i++)
			{
				var data=my_categories1[i].split(',');
				str=str+"<li onclick='display("+data[0]+")'><strong>"+data[1]+"</strong></li>";
				str=str+"<div style='display:none;' id='opt_"+data[0]+"'></div>";
				counter++;	
			}
			str=str+"</ul>";
			
			document.getElementById("items_div").innerHTML=str;
			
			
			
		}
		}
		
		var t1="";var q="";
		if(qu=="")
		{
			t1="city="+escape(city);
			q=qu;
			
		}
		else
		{
			t1=" &city="+escape(city);
			q=qu;
			
		}	
			
		
			xmlhttp.open("POST","getsubjects1.php?"+q+t1,true);
		
		xmlhttp.send();
}


function show_cir(obj)
{
	
	if(myTimer)
	{
		clearInterval(myTimer);	
	}
	var id=obj.getAttribute("id");
	
	  var k;
	  if(id.length==6)
	  		k=id.substr(2,2);
	  else if(id.length==5)
	 		 k=id.substr(2,1);
   
  for(var i=1;i<=90;i++)
  {
	document.getElementById("txt"+i).style.display="none";  
  }
	document.getElementById("txt"+k).style.display="";
	var city=$( "text#txt"+k ).text();
	var cx=obj.getAttribute("cx");
	var cy=obj.getAttribute("cy");
	cx=cx.toString();
	cy=cy.toString();
	
	 document.getElementById("ani_cir").setAttribute('cx', cx );
	  document.getElementById("ani_cir").setAttribute('cy', cy );
	var rad=10;
        var counter="up";
		
	load_city_queried_uni(city,myquery);
        myTimer=setInterval(function()
        {
           
            var v=rad.toString();
            document.getElementById("ani_cir").setAttribute('r', v );
            if(rad==30)
            {
                counter="down";
            }
            if(rad==10)
            {
                counter="up";
            }
           
            if(counter=="up")
            {
                rad=rad+1;
            }
            else if(counter=="down")
            {
                rad=rad-1;
            }
        },100);
}

var dark="false";
var light="false";
var yellow="false";
var blue="false";
var red="false";

function change_val_uni()
{
	for(var i=1;i<=90;i++)
  {
	document.getElementById("txt"+i).style.display="none";  
  }
	if(dark=="true")
	{
		dark="false";
		document.getElementById("s1").style.opacity="1";
	}
	else
	{
		dark="true";
		document.getElementById("s1").style.opacity="0.4";
	}
	load_cities();
}
function change_val_fach()
{
	for(var i=1;i<=90;i++)
  {
	document.getElementById("txt"+i).style.display="none";  
  }
  
	if(light=="true")
	{
		light="false";
		document.getElementById("s2").style.opacity="1";
	}
	else
	{
		light="true";
		document.getElementById("s2").style.opacity="0.4";
	}
	load_cities();
}
function change_val_enr()
{
	for(var i=1;i<=90;i++)
  {
	document.getElementById("txt"+i).style.display="none";  
  }
  
	if(yellow=="true")
	{
		yellow="false";
		document.getElementById("s3").style.opacity="1";
	}
	else
	{
		yellow="true";
		document.getElementById("s3").style.opacity="0.4";
	}
	load_cities();
}
function change_val_for()
{
	for(var i=1;i<=90;i++)
  {
	document.getElementById("txt"+i).style.display="none";  
  }
  
	if(blue=="true")
	{
		blue="false";
		document.getElementById("s4").style.opacity="1";
	}
	else
	{
		blue="true";
		document.getElementById("s4").style.opacity="0.4";
	}
	load_cities();
}
function change_val_ein()
{
	for(var i=1;i<=90;i++)
  {
	document.getElementById("txt"+i).style.display="none";  
  }
  
	if(red=="true")
	{
		red="false";
		document.getElementById("s5").style.opacity="1";
	}
	else
	{
		red="true";
		document.getElementById("s5").style.opacity="0.4";
	}
	load_cities();
}


function load_cities()
{
	clearInterval(myTimer);	
	 document.getElementById("ani_cir").setAttribute('r', "0" );
	var checked_opt=new Array();
	myquery="";
	var co=0;
	if(dark=="true")
	{
		checked_opt[co]="#060";
		if(myquery!="")
			myquery=myquery+"&d=true";
		else
			myquery="d=true";
		co=co+1;
	}
		if(light=="true")
	{
		checked_opt[co]="#090";
		if(myquery!="")
			myquery=myquery+"&l=true";
		else
			myquery="l=true";
		co=co+1;
	}
		if(yellow=="true")
	{
		checked_opt[co]="#FC3";
		if(myquery!="")
			myquery=myquery+"&y=true";
		else
			myquery="y=true";
		co=co+1;
	}
		if(blue=="true")
	{
		checked_opt[co]="#39F";
		if(myquery!="")
			myquery=myquery+"&b=true";
		else
			myquery="b=true";
		co=co+1;
	}
		if(red=="true")
	{
		checked_opt[co]="#603";
		if(myquery!="")
			myquery=myquery+"&r=true";
		else
			myquery="r=true";
		co=co+1;
	}
	
	
	
	var boool="false";
			for( var i=1;i<91;i++)
		{
			var vr="len"+i; 
			var op_length=document.getElementById(vr).value;
			
			var counter_2=1;
			for(var j=1;j<=op_length;j++)
			{
				var t="op"+i+"_"+j;
				t=document.getElementById(t);
				
				for(var ck=0;ck<checked_opt.length;ck=ck+1)
				{
					//alert(checked_opt[ck]);
					if(t.getAttribute("fill")==checked_opt[ck])
					 {
						 
						boool="true"; 
					 }
				}
				
				if(boool=="true")
				{
					//alert(t.getAttribute("id"));
					t.style.display="none";
					
					boool="false";
				}
				else
				{
					t.style.display="";
					
					
					
				}
				
			}
			
		}
}
</script>
<meta charset="UTF-8">
<title>UFZMap</title>
<link type="text/css" rel="stylesheet" href="css/style_window.css" />
</head>

<body onLoad="main_page()">


	<div id="wrapper">
    
    	<div id="header" >
        	<img align='left' id="logo" src="images/logo.jpg" />
            <img align='right' id="helm" src="images/helm.jpg" />
        </div>
        
        <div id="content_wrapper">
        	 
            <div id="content">
            	<div id="wrap">
            		<h1 id="title">WASSERFORSCHUNG IN DEUTSCHLAND</h1>
                
                	<p id="description_home">
                		Wer forscht was, Wo und in Zusammenarbeit mit wem? Wo kann ich meinen Wunsch-Studiengang finden? Auf einen Blick erhalten sie hier eine Übersicht über Akteure, deren Vernetzung, Themen, Projeckte und Studiengänge im Bereich der Wasserforschung.<br/><br/>
                    	Projectinfo<br/>
                    	Das online-Portal Wasserforschung ist das Ergebnis des Projektes "Analyse der Wasserforschung in Deutschland", durchgeführt vom Helmholtz-Zentrum für Umweltforschung - UFZ, gefördert vom Bundesministerium für Bildung und Forschung (BMBF).<br/><br/>
                    
                    	Weitere Informationen unter
                    	http://www.watersciencealliance.de/online-portal
                	</p>
                    <p id="description_enr" style="display:none;">
                    Diese Karteä zeigt alle im Online-Portal erfassten, öffentlich geförderten Einrichtungen Deutschland. Klicken Sie auf einen der Punkte auf der Karte, erscheinen im rechten Feld die Forschungseinrichtungen, die an diesem Ort zu finden sind. Wenn Sie auf eine Einrichtung im rechten Feld klicken, werden die Organizationseinheiten dieser Einrichtung angezeigt, die einen Schwerpunkt im Bereich der Wasserforschung haben.
                    </p>
                    <p style="width:60%;" id="description_them" style="display:none;">
                    Hier sehen Sie die von den Wasserforschenden am häufigsten genannten thematischen Schlagworte, gruppiert in vier Themenbereiche. Beim Anklicken wird die Bedeutung  jedes Schlagwortes erklärt  und es erscheinen auf der rechten Seite die Einrichtungen, die diesen Themenschwerpunkt angegeben haben. Beim Klicken auf eine der Einrichtungen im rechten Feld, werden die Abteilungen der Einrichtung mit diesem Forschungsschwerpunkt angezigt. Die Skala auf der Nennungen des jeweiligen Schlagwortes.
                    </p>
              </div>
              
              <div id="map1" style="display:none;">
              		
                    
                    	
                    	<img style=" display:none;opacity:0; position:absolute;left:572;" src="images/deutschland.png" width="640" height="750" alt="Planets" usemap="#planetmap">
                        
                    <input type="hidden" id="len1" value="1" />
                    <input type="hidden" id="len2" value="2" />
                    <input type="hidden" id="len3" value="1" />
                    <input type="hidden" id="len4" value="1" />
                    <input type="hidden" id="len5" value="2" />
                    <input type="hidden" id="len6" value="1" />
                    <input type="hidden" id="len7" value="1" />
                    <input type="hidden" id="len8" value="1" />
                    <input type="hidden" id="len9" value="1" />
                    <input type="hidden" id="len10" value="1" />
                    
                     
                     <input type="hidden" id="len11" value="2" />
                    <input type="hidden" id="len12" value="1" />
                    <input type="hidden" id="len13" value="1" />
                    <input type="hidden" id="len14" value="1" />
                    <input type="hidden" id="len15" value="1" />
                    <input type="hidden" id="len16" value="1" />
                    <input type="hidden" id="len17" value="3" />
                    <input type="hidden" id="len18" value="1" />
                    <input type="hidden" id="len19" value="2" />
                    <input type="hidden" id="len20" value="1" />
                    
                    <input type="hidden" id="len21" value="2" />
                    <input type="hidden" id="len22" value="1" />
                    <input type="hidden" id="len23" value="1" />
                    <input type="hidden" id="len24" value="1" />
                    <input type="hidden" id="len25" value="1" />
                    <input type="hidden" id="len26" value="1" />
                    <input type="hidden" id="len27" value="1" />
                    <input type="hidden" id="len28" value="1" />
                    <input type="hidden" id="len29" value="3" />
                    <input type="hidden" id="len30" value="1" />
                    
                   <input type="hidden" id="len31" value="2" />
                    <input type="hidden" id="len32" value="1" />
                    <input type="hidden" id="len33" value="2" />
                    <input type="hidden" id="len34" value="1" />
                    <input type="hidden" id="len35" value="1" />
                    <input type="hidden" id="len36" value="1" />
                    <input type="hidden" id="len37" value="1" />
                    <input type="hidden" id="len38" value="1" />
                    <input type="hidden" id="len39" value="2" />
                    <input type="hidden" id="len40" value="2" />
                    
                    <input type="hidden" id="len41" value="4" />
                    <input type="hidden" id="len42" value="1" />
                    <input type="hidden" id="len43" value="2" />
                    <input type="hidden" id="len44" value="2" />
                    <input type="hidden" id="len45" value="1" />
                    <input type="hidden" id="len46" value="2" />
                    <input type="hidden" id="len47" value="3" />
                    <input type="hidden" id="len48" value="2" />
                    <input type="hidden" id="len49" value="1" />
                    <input type="hidden" id="len50" value="2" />
                    
                    <input type="hidden" id="len51" value="1" />
                    <input type="hidden" id="len52" value="1" />
                    <input type="hidden" id="len53" value="1" />
                    <input type="hidden" id="len54" value="1" />
                    <input type="hidden" id="len55" value="1" />
                    <input type="hidden" id="len56" value="1" />
                    <input type="hidden" id="len57" value="1" />
                    <input type="hidden" id="len58" value="1" />
                    <input type="hidden" id="len59" value="2" />
                    <input type="hidden" id="len60" value="1" />
                    
                    <input type="hidden" id="len61" value="2" />
                    <input type="hidden" id="len62" value="1" />
                    <input type="hidden" id="len63" value="3" />
                    <input type="hidden" id="len64" value="3" />
                    <input type="hidden" id="len65" value="1" />
                    <input type="hidden" id="len66" value="4" />
                    <input type="hidden" id="len67" value="2" />
                    <input type="hidden" id="len68" value="1" />
                    <input type="hidden" id="len69" value="1" />
                    <input type="hidden" id="len70" value="1" />
                    
                    <input type="hidden" id="len71" value="1" />
                    <input type="hidden" id="len72" value="3" />
                    <input type="hidden" id="len73" value="3" />
                    <input type="hidden" id="len74" value="2" />
                    <input type="hidden" id="len75" value="1" />
                    <input type="hidden" id="len76" value="1" />
                    <input type="hidden" id="len77" value="1" />
                    <input type="hidden" id="len78" value="4" />
                    <input type="hidden" id="len79" value="1" />
                    <input type="hidden" id="len80" value="1" />
                    
                    <input type="hidden" id="len81" value="1" />
                    <input type="hidden" id="len82" value="5" />
                    <input type="hidden" id="len83" value="1" />
                    <input type="hidden" id="len84" value="1" />
                    <input type="hidden" id="len85" value="1" />
                    <input type="hidden" id="len86" value="1" />
                    <input type="hidden" id="len87" value="1" />
                    <input type="hidden" id="len88" value="1" />
                    <input type="hidden" id="len89" value="1" />
                    <input type="hidden" id="len90" value="1" />
                    	<svg  style="position:absolute; left:572;width:640px;height:750px;z-index:999; background-image:url(images/deutschland.png); background-repeat:no-repeat;" xmlns="http://www.w3.org/2000/svg" version="1.1">
   
   								<circle id="ani_cir" cx="100" cy="50" r="0" stroke="black" stroke-width="0.5" fill="none" />
								
      								
     								
   								
								
   									<circle onClick="show_cir(op1_1)" id="op1_1"  cx="207" cy="260" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** OSNABRÜCK ****************/-->
									<text id="txt1" style="display:none;" font-size="10" font-family="Verdana"><tspan x="217" y="260">OSNABRÜCK</tspan> </text>
								
								
								<circle onClick="show_cir(op2_1)" id="op2_1"  cx="185" cy="300" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** MÜNSTER ****************/-->
								<circle onClick="show_cir(op2_2)" id="op2_2"  cx="185" cy="300" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** MÜNSTER ****************/-->
								<text id="txt2" style="display:none;" font-size="10" font-family="Verdana"><tspan x="195" y="300">MÜNSTER</tspan> </text>
								
								
								<circle onClick="show_cir(op3_1)" id="op3_1"  cx="250" cy="263" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** MINDEN ****************/-->
								<text id="txt3" style="display:none;" font-size="10" font-family="Verdana"><tspan x="260" y="263">MINDEN</tspan> </text>
								
								<circle onClick="show_cir(op4_1)" id="op4_1"  cx="250" cy="300" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** DETMOLD ****************/-->
								<text id="txt4" style="display:none;" font-size="10" font-family="Verdana"><tspan x="260" y="300">DETMOLD</tspan> </text>
								
								<circle onClick="show_cir(op5_1)" id="op5_1"  cx="248" cy="197" r="8" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BREMEN ****************/-->
								<circle onClick="show_cir(op5_2)" id="op5_2"  cx="248" cy="197" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** BREMEN ****************/-->
								<text id="txt5" style="display:none;" font-size="10" font-family="Verdana"><tspan x="258" y="197">BREMEN</tspan> </text>
								
								<circle onClick="show_cir(op6_1)" id="op6_1"  cx="216" cy="185" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** OLDENBURG ****************/-->
								<text id="txt6" style="display:none;" font-size="10" font-family="Verdana"><tspan x="226" y="185">OLDENBURG</tspan> </text>
								
								<circle onClick="show_cir(op7_1)" id="op7_1"  cx="205" cy="153" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** Wilhelmshaven ****************/-->
								<text id="txt7" style="display:none;" font-size="10" font-family="Verdana"><tspan x="215" y="153">Wilhelmshaven</tspan> </text>
								
								<circle onClick="show_cir(op8_1)" id="op8_1"  cx="235" cy="153" r="0" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** BREME ****************/-->
								<text id="txt8" style="display:none;" font-size="10" font-family="Verdana"><tspan x="245" y="153">BREME</tspan> </text>
								
								<circle  onClick="show_cir(op9_1)" id="op9_1"  cx="235" cy="153" r="0" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** BREME ****************/-->
								<text id="txt9" style="display:none;" font-size="10" font-family="Verdana"><tspan x="245" y="153">BREME</tspan> </text>
								
								<circle onClick="show_cir(op10_1)" id="op10_1"   cx="252" cy="97" r="0" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BREME ****************/-->
								<text id="txt10" style="display:none;" font-size="10" font-family="Verdana"><tspan x="262" y="97">BREME</tspan> </text>
								
								<circle onClick="show_cir(op11_1)" id="op11_1"   cx="165" cy="340" r="8" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BOCHUM ****************/-->
								<circle onClick="show_cir(op11_2)"  id="op11_2"  cx="165" cy="340" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** BOCHUM ****************/-->
								<text id="txt11" style="display:none;" font-size="10" font-family="Verdana"><tspan x="175" y="340">BOCHUM</tspan> </text>
								
								<circle onClick="show_cir(op12_1)" id="op12_1"  cx="161" cy="328" r="4" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** RECKLINGSHAUSEN ****************/-->
								<text id="txt12" style="display:none;" font-size="10" font-family="Verdana"><tspan x="171" y="328">RECKLINGSHAUSEN</tspan> </text>
								
								<circle onClick="show_cir(op13_1)" id="op13_1"   cx="180" cy="338" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** DORTMUND ****************/-->
								<text id="txt13" style="display:none;" font-size="10" font-family="Verdana"><tspan x="190" y="338">DORTMUND</tspan> </text>
								
								<circle  onClick="show_cir(op14_1)" id="op14_1"   cx="152" cy="343" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** ESSEN ****************/-->
								<text id="txt14" style="display:none;" font-size="10" font-family="Verdana"><tspan x="162" y="343">ESSEN</tspan> </text>
								
								<circle onClick="show_cir(op15_1)" id="op15_1"   cx="135" cy="346" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** DUISBURG ****************/-->
								<text id="txt15" style="display:none;" font-size="10" font-family="Verdana"><tspan x="145" y="346">DUISBURG</tspan> </text>
								
								<circle onClick="show_cir(op16_1)" id="op16_1"  id="cir16" cx="162" cy="365" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** WUPPERTAL ****************/-->
								<text id="txt16" style="display:none;" font-size="10" font-family="Verdana"><tspan x="172" y="375">WUPPERTAL</tspan> </text>
								
								<circle onClick="show_cir(op17_1)" id="op17_1"   cx="152" cy="399" r="12" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** BONN ****************/-->
								<circle onClick="show_cir(op17_2)" id="op17_2"  cx="152" cy="399" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** BONN ****************/-->
								<circle onClick="show_cir(op17_3)" id="op17_3"   cx="152" cy="399" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** BONN ****************/-->
								<text id="txt17" style="display:none;" font-size="10" font-family="Verdana"><tspan x="162" y="399">BONN</tspan> </text>
								
								<circle onClick="show_cir(op18_1)" id="op18_1"  cx="162" cy="393" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** HENNEE ****************/-->
								<text id="txt18" style="display:none;" font-size="10" font-family="Verdana"><tspan x="172" y="393">HENNEE</tspan> </text>
								
								<circle onClick="show_cir(op19_1)" id="op19_1"   cx="142" cy="381" r="8" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** KÖLN ****************/-->
								<circle onClick="show_cir(op19_2)" id="op19_2"   cx="142" cy="381" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** KÖLN ****************/-->
								<text id="txt19" style="display:none;" font-size="10" font-family="Verdana"><tspan x="152" y="381">KÖLN</tspan> </text>
								
								<circle onClick="show_cir(op20_1)" id="op20_1"   cx="119" cy="388" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** JÜLICH ****************/-->
								<text id="txt20" style="display:none;" font-size="10" font-family="Verdana"><tspan x="129" y="388">JÜLICH</tspan> </text>
								
								<circle  onClick="show_cir(op21_1)" id="op21_1"   cx="105" cy="405" r="8" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** AACHEN ****************/-->
								<circle onClick="show_cir(op21_2)" id="op21_2"   cx="105" cy="405" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** AACHEN ****************/-->
								<text id="txt21" style="display:none;" font-size="10" font-family="Verdana"><tspan x="115" y="405">OSNABRÜCK</tspan> </text>
								
								<circle onClick="show_cir(op22_1)" id="op22_1"   cx="205" cy="388" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** SIEGEN ****************/-->
								<text id="txt22" style="display:none;" font-size="10" font-family="Verdana"><tspan x="215" y="388">SIEGEN</tspan> </text>
								
								<circle onClick="show_cir(op23_1)" id="op23_1"   cx="215" cy="360" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** SCHMALLE ****************/-->
								<text id="txt23" style="display:none;" font-size="10" font-family="Verdana"><tspan x="225" y="360">SCHMALLE</tspan> </text>
								
								<circle onClick="show_cir(op24_1)" id="op24_1"   cx="178" cy="435" r="4" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** KOBLENZ ****************/-->
								<text id="txt24" style="display:none;" font-size="10" font-family="Verdana"><tspan x="188" y="435">KOBLENZ</tspan> </text>
								
								<circle onClick="show_cir(op25_1)" id="op25_1"   cx="250" cy="420" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** GIEßEN ****************/-->
								<text id="txt25" style="display:none;" font-size="10" font-family="Verdana"><tspan x="260" y="420">GIEßEN</tspan> </text>
								
								<circle onClick="show_cir(op26_1)" id="op26_1"   cx="254" cy="395" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** MARBURG ****************/-->
								<text id="txt26" style="display:none;" font-size="10" font-family="Verdana"><tspan x="264" y="395">MARBURG</tspan> </text>
								
								<circle onClick="show_cir(op27_1)" id="op27_1"   cx="269" cy="445" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** GELNHAUSEN ****************/-->
								<text id="txt27" style="display:none;" font-size="10" font-family="Verdana"><tspan x="279" y="445">GELNHAUSEN</tspan> </text>
								
								<circle onClick="show_cir(op28_1)" id="op28_1"   cx="279" cy="347" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** KASSEL ****************/-->
								<text id="txt28" style="display:none;" font-size="10" font-family="Verdana"><tspan x="289" y="347">KASSEL</tspan> </text>
								
								<circle onClick="show_cir(op29_1)" id="op29_1"   cx="238" cy="458" r="12" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** FRANKFURT ****************/-->
								<circle onClick="show_cir(op29_2)" id="op29_2"   cx="238" cy="458" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** FRANKFURT ****************/-->
								<circle onClick="show_cir(op29_3)" id="op29_3"   cx="238" cy="458" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** FRANKFURT ****************/-->
								<text id="txt29" style="display:none;" font-size="10" font-family="Verdana"><tspan x="248" y="458">FRANKFURT</tspan> </text>
								
								<circle onClick="show_cir(op30_1)" id="op30_1"  cx="248" cy="458" r="4" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** OFFENBACH ****************/-->
								<text id="txt30" style="display:none;" font-size="10" font-family="Verdana"><tspan x="258" y="458">OFFENBACH</tspan> </text>
								
								<circle onClick="show_cir(op31_1)" id="op31_1"   cx="215" cy="472" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** MAINZ ****************/-->
								<circle  onClick="show_cir(op31_2)" id="op31_2"   cx="215" cy="472" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** MAINZ ****************/-->
								<text id="txt31" style="display:none;" font-size="10" font-family="Verdana"><tspan x="225" y="472">MAINZ</tspan> </text>
								
								<circle onClick="show_cir(op32_1)"  id="op32_1"   cx="215" cy="462" r="4" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** WIESBADEN ****************/-->
								<text id="txt32" style="display:none;" font-size="10" font-family="Verdana"><tspan x="225" y="462">WIESBADEN</tspan> </text>
								
								<circle onClick="show_cir(op33_1)" id="op33_1"  cx="237" cy="483" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** DARMSTAD ****************/-->
								<circle onClick="show_cir(op33_2)" id="op33_2"   cx="237" cy="483" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** DARMSTAD ****************/-->
								<text id="txt33" style="display:none;" font-size="10" font-family="Verdana"><tspan x="247" y="483">DARMSTAD</tspan> </text>
								
								<circle onClick="show_cir(op34_1)" id="op34_1"   cx="227" cy="520" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** MANNHEIM ****************/-->
								<text id="txt34" style="display:none;" font-size="10" font-family="Verdana"><tspan x="237" y="520">MANNHEIM</tspan> </text>
							
								<circle onClick="show_cir(op35_1)"  id="op35_1"   cx="240" cy="526" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** HEIDELBERG ****************/-->
								<text id="txt35" style="display:none;" font-size="10" font-family="Verdana"><tspan x="250" y="526">HEIDELBERG</tspan> </text>
								
								<circle onClick="show_cir(op36_1)"  id="op36_1"  cx="240" cy="526" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** HEIDELBERG ****************/-->
								<text id="txt36" style="display:none;" font-size="10" font-family="Verdana"><tspan x="250" y="526">HEIDELBERG</tspan> </text>
								
								<circle onClick="show_cir(op37_1)" id="op37_1"   cx="210" cy="538" r="0" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** LANDU ****************/-->
								<text id="txt37" style="display:none;" font-size="10" font-family="Verdana"><tspan x="220" y="538">LANDU</tspan> </text>
								
								<circle onClick="show_cir(op38_1)" id="op38_1"   cx="185" cy="510" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** KAISERLAUTERN ****************/-->
								<text id="txt38" style="display:none;" font-size="10" font-family="Verdana"><tspan x="195" y="510">KAISERLAUTERN</tspan> </text>
								
								<circle onClick="show_cir(op39_1)" id="op39_1"   cx="148" cy="533" r="8" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** SAARBRÜCKEN ****************/-->								
								<circle onClick="show_cir(op39_2)" id="op39_2"   cx="148" cy="533" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** SAARBRÜCKEN ****************/-->
								<text id="txt39" style="display:none;" font-size="10" font-family="Verdana"><tspan x="158" y="533">SAARBRÜCKEN</tspan> </text>
								
								<circle onClick="show_cir(op40_1)" id="op40_1"  cx="132" cy="487" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** TRIER ****************/-->
								<circle onClick="show_cir(op40_2)" id="op40_2"   cx="132" cy="487" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** TRIER ****************/-->
								<text id="txt40" style="display:none;" font-size="10" font-family="Verdana"><tspan x="142" y="487">TRIER</tspan> </text>
								
								<circle onClick="show_cir(op41_1)" id="op41_1"   cx="225" cy="547" r="12" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** KARLSRUHE ****************/-->
								<circle onClick="show_cir(op41_2)" id="op41_2"   cx="225" cy="547" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** KARLSRUHE ****************/-->
								<circle onClick="show_cir(op41_3)" id="op41_3"   cx="225" cy="547" r="6" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** KARLSRUHE ****************/-->
								<circle onClick="show_cir(op41_4)" id="op41_4"  cx="225" cy="547" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** KARLSRUHE ****************/-->
								<text id="txt41" style="display:none;" font-size="10" font-family="Verdana"><tspan x="235" y="547">KARLSRUHE</tspan> </text>
								
								<circle onClick="show_cir(op42_1)" id="op42_1"   cx="218" cy="560" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** RASTATT ****************/-->
								<text id="txt42" style="display:none;" font-size="10" font-family="Verdana"><tspan x="228" y="560">RASTATT</tspan> </text>
								
								<circle onClick="show_cir(op43_1)"  id="op43_1"  cx="200" cy="645" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** FREIBURG ****************/-->
								<circle onClick="show_cir(op43_2)" id="op43_2"   cx="200" cy="645" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** FREIBURG ****************/-->
								<text id="txt43" style="display:none;" font-size="10" font-family="Verdana"><tspan x="210" y="645">FREIBURG</tspan> </text>
								
								<circle onClick="show_cir(op44_1)" id="op44_1"   cx="270" cy="665" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** KONSTANZ ****************/-->
								<circle onClick="show_cir(op44_2)" id="op44_2"   cx="270" cy="665" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** KONSTANZ ****************/-->
								<text id="txt44" style="display:none;" font-size="10" font-family="Verdana"><tspan x="280" y="665">KONSTANZ</tspan> </text>
								
								<circle onClick="show_cir(op45_1)" id="op45_1"   cx="295" cy="638" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** BIBERACH(RIß) ****************/-->
								<text id="txt45" style="display:none;" font-size="10" font-family="Verdana"><tspan x="305" y="638">BIBERACH(RIß)</tspan> </text>
								
								<circle onClick="show_cir(op46_1)" id="op46_1"   cx="270" cy="600" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** REUTLINGEN(RIß) ****************/-->								
								<circle onClick="show_cir(op46_2)" id="op46_2"   cx="260" cy="600" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** REUTLINGEN(RIß) ****************/-->
								<text id="txt46" style="display:none;" font-size="10" font-family="Verdana"><tspan x="280" y="600">REUTLINGEN(RIß)</tspan> </text>
								
								<circle onClick="show_cir(op47_1)" id="op47_1"   cx="265" cy="570" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** STUTTGART ****************/-->
								<circle onClick="show_cir(op47_2)"  id="op47_2"  cx="265" cy="570" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** STUTTGART ****************/-->
								<circle onClick="show_cir(op47_3)"  id="op47_3"  cx="275" cy="573" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** STUTTGART ****************/-->
								<text id="txt47" style="display:none;" font-size="10" font-family="Verdana"><tspan x="285" y="573">STUTTGART</tspan> </text>
								
								<circle onClick="show_cir(op48_1)"  id="op48_1"   cx="365" cy="615" r="8" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** AUGSBURG ****************/-->								
								<circle onClick="show_cir(op48_2)"  id="op48_2"  cx="365" cy="615" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** AUGSBURG ****************/-->
								<text id="txt48" style="display:none;" font-size="10" font-family="Verdana"><tspan x="375" y="615">AUGSBURG</tspan> </text>
								
								<circle onClick="show_cir(op49_1)"  id="op49_1"  cx="400" cy="635" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** NEUHERBERG ****************/-->
								<text id="txt49" style="display:none;" font-size="10" font-family="Verdana"><tspan x="410" y="635">NEUHERBERG</tspan> </text>
								
								<circle onClick="show_cir(op50_1)"  id="op50_1"  cx="400" cy="645" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** NEUBIBERG ****************/-->
								<circle onClick="show_cir(op50_2)"  id="op50_2"  cx="407" cy="652" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** NEUBIBERG ****************/-->
								<text id="txt50" style="display:none;" font-size="10" font-family="Verdana"><tspan x="417" y="652">NEUBIBERG</tspan> </text>
								
								<circle onClick="show_cir(op51_1)"  id="op51_1"  cx="370" cy="690" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** GARMISCH-PARTENKIRCHEN ****************/-->
								<text id="txt51" style="display:none;" font-size="10" font-family="Verdana"><tspan x="380" y="690">GARMISCH-PARTENKIRCHEN</tspan> </text>
								
								<circle onClick="show_cir(op52_1)"  id="op52_1"  cx="450" cy="575" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** DEGGENDORF ****************/-->
								<text id="txt52" style="display:none;" font-size="10" font-family="Verdana"><tspan x="460" y="575">DEGGENDORF</tspan> </text>
								
								<circle onClick="show_cir(op53_1)"  id="op53_1"  cx="380" cy="523" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** NÜRNBERG ****************/-->
								<text id="txt53" style="display:none;" font-size="10" font-family="Verdana"><tspan x="390" y="523">NÜRNBERG</tspan> </text>
								
								<circle onClick="show_cir(op54_1)"  id="op54_1"  cx="345" cy="545" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** WEIDENBACH ****************/-->
								<text id="txt54" style="display:none;" font-size="10" font-family="Verdana"><tspan x="355" y="545">WEIDENBACH</tspan> </text>
								
								<circle onClick="show_cir(op55_1)"  id="op55_1"  cx="372" cy="502" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** ERLANGEN ****************/-->
								<text id="txt55" style="display:none;" font-size="10" font-family="Verdana"><tspan x="382" y="502">ERLANGEN</tspan> </text>
								
								<circle onClick="show_cir(op56_1)"  id="op56_1"  cx="355" cy="475" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BAMBERG ****************/-->
								<text id="txt56" style="display:none;" font-size="10" font-family="Verdana"><tspan x="365" y="475">BAMBERG</tspan> </text>
								
								<circle onClick="show_cir(op57_1)"  id="op57_1"  cx="393" cy="465" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BAYREUTH ****************/-->
								<text id="txt57" style="display:none;" font-size="10" font-family="Verdana"><tspan x="403" y="465">BAYREUTH</tspan> </text>
								
								<circle onClick="show_cir(op58_1)"  id="op58_1"  cx="307" cy="490" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** WÜRZBURG ****************/-->
								<text id="txt58" style="display:none;" font-size="10" font-family="Verdana"><tspan x="317" y="490">WÜRZBURG</tspan> </text>
								
								<circle onClick="show_cir(op59_1)"  id="op59_1"  cx="393" cy="390" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** JENA ****************/-->								
								<circle onClick="show_cir(op59_2)"  id="op59_2"  cx="393" cy="390" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** JENA ****************/-->
								<text id="txt59" style="display:none;" font-size="10" font-family="Verdana"><tspan x="403" y="390">JENA</tspan> </text>
								
								<circle onClick="show_cir(op60_1)"  id="op60_1"  cx="375" cy="380" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** WEIMAR ****************/-->
								<text id="txt60" style="display:none;" font-size="10" font-family="Verdana"><tspan x="385" y="380">WEIMAR</tspan> </text>
								
								<circle onClick="show_cir(op61_1)"  id="op61_1"  cx="410" cy="330" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** HALLE(SAALE) ****************/-->								
								<circle onClick="show_cir(op61_2)"  id="op61_2"  cx="410" cy="330" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** HALLE(SAALE) ****************/-->
								<text id="txt61" style="display:none;" font-size="10" font-family="Verdana"><tspan x="420" y="330">HALLE(SAALE)</tspan> </text>
								
								<circle onClick="show_cir(op62_1)"  id="op62_1"  cx="423" cy="300" r="4" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** DESSAU-ROßLAU ****************/-->
								<text id="txt62" style="display:none;" font-size="10" font-family="Verdana"><tspan x="433" y="300">DESSAU-ROßLAU</tspan> </text>
								
								
								<circle onClick="show_cir(op63_1)"  id="op63_1"  cx="394" cy="275" r="12" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** MAGDEBURG ****************/-->	
								<circle onClick="show_cir(op63_2)"  id="op63_2"  cx="394" cy="275" r="8" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** MAGDEBURG ****************/-->								
								<circle onClick="show_cir(op63_3)"  id="op63_3"  cx="394" cy="275" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** MAGDEBURG ****************/-->
								<text id="txt63" style="display:none;" font-size="10" font-family="Verdana"><tspan x="404" y="275">MAGDEBURG</tspan> </text>
								
								<circle onClick="show_cir(op64_1)"  id="op64_1" cx="437" cy="347" r="12" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** LEIPZIG ****************/-->
								<circle onClick="show_cir(op64_2)"  id="op64_2"  cx="437" cy="347" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** LEIPZIG ****************/-->
								<circle onClick="show_cir(op64_3)"  id="op64_3"  cx="437" cy="347" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** LEIPZIG ****************/-->
								<text id="txt64" style="display:none;" font-size="10" font-family="Verdana"><tspan x="447" y="347">LEIPZIG</tspan> </text>
								
								<circle onClick="show_cir(op65_1)"  id="op65_1"  cx="492" cy="385" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** FREIBERG ****************/-->
								<text id="txt65" style="display:none;" font-size="10" font-family="Verdana"><tspan x="502" y="385">FREIBERG</tspan> </text>
								
								<circle onClick="show_cir(op66_1)"  id="op66_1"  cx="515" cy="370" r="14" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** DRESDEN ****************/-->
								<circle onClick="show_cir(op66_2)"  id="op66_2"  cx="515" cy="370" r="10" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** DRESDEN ****************/-->
								<circle onClick="show_cir(op66_3)"  id="op66_3"  cx="515" cy="370" r="6" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** DRESDEN ****************/-->
								<circle onClick="show_cir(op66_4)"  id="op66_4"  cx="515" cy="370" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** DRESDEN ****************/-->
								<text id="txt66" style="display:none;" font-size="10" font-family="Verdana"><tspan x="525" y="370">DRESDEN</tspan> </text>
								
								<circle onClick="show_cir(op67_1)" id="op67_1"   cx="540" cy="387" r="8" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** ZITTAU ****************/-->
								<circle onClick="show_cir(op67_2)" id="op67_2"   cx="540" cy="387" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** ZITTAU ****************/-->
								<text id="txt67" style="display:none;" font-size="10" font-family="Verdana"><tspan x="550" y="387">ZITTAU</tspan> </text>
								
								<circle onClick="show_cir(op68_1)" id="op68_1"   cx="540" cy="310" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** COTTBUS ****************/-->
								<text id="txt68" style="display:none;" font-size="10" font-family="Verdana"><tspan x="550" y="310">COTTBUS</tspan> </text>
								
								<circle onClick="show_cir(op69_1)" id="op69_1"   cx="527" cy="262" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BAD SAAROW ****************/-->
								<text id="txt69" style="display:none;" font-size="10" font-family="Verdana"><tspan x="537" y="262">BAD SAAROW</tspan> </text>
								
								<circle onClick="show_cir(op70_1)" id="op70_1"  cx="535" cy="240" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** MÜNCHBERG ****************/-->
								<text id="txt70" style="display:none;" font-size="10" font-family="Verdana"><tspan x="454" y="240">MÜNCHBERG</tspan> </text>
								
								<circle onClick="show_cir(op71_1)" id="op71_1"   cx="510" cy="250" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** ERKNER ****************/-->
								<text id="txt71" style="display:none;" font-size="10" font-family="Verdana"><tspan x="520" y="250">ERKNER</tspan> </text>
								
								<circle onClick="show_cir(op72_1)" id="op72_1"   cx="495" cy="235" r="12" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** BERLIN ****************/-->
								<circle onClick="show_cir(op72_2)" id="op72_2"  cx="495" cy="235" r="8" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** BERLIN ****************/-->
								<circle onClick="show_cir(op72_3)" id="op72_3"   cx="495" cy="235" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BERLIN ****************/-->
								<text id="txt72" style="display:none;" font-size="10" font-family="Verdana"><tspan x="505" y="235">BERLIN</tspan> </text>
								
								<circle onClick="show_cir(op73_1)" id="op73_1"   cx="482" cy="255" r="12" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** POTSDAM ****************/-->
								<circle onClick="show_cir(op73_2)" id="op73_2"   cx="482" cy="255" r="8" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** POTSDAM ****************/-->
								<circle onClick="show_cir(op73_3)" id="op73_3"   cx="482" cy="255" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** POTSDAM ****************/-->
								<text id="txt73" style="display:none;" font-size="10" font-family="Verdana"><tspan x="492" y="255">POTSDAM</tspan> </text>
								
								<circle onClick="show_cir(op74_1)" id="op74_1"  cx="325" cy="307" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** CLAUSTHAL-ZELLEREELD ****************/-->								
								<circle onClick="show_cir(op74_2)" id="op74_2"   cx="325" cy="307" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** CLAUSTHAL-ZELLEREELD ****************/-->
								<text id="txt74" style="display:none;" font-size="10" font-family="Verdana"><tspan x="335" y="207">CLAUSTHAL-ZELLEREELD</tspan> </text>
								
								<circle onClick="show_cir(op75_1)" id="op75_1"  cx="305" cy="327" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** GOTTINGEN ****************/-->
								<text id="txt75" style="display:none;" font-size="10" font-family="Verdana"><tspan x="315" y="327">GOTTINGEN</tspan> </text>
								
								<circle onClick="show_cir(op76_1)"  id="op76_1"  cx="305" cy="280" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** HILDESHEIM ****************/-->
								<text id="txt76" style="display:none;" font-size="10" font-family="Verdana"><tspan x="315" y="280">HILDESHEIM</tspan> </text>
								
								<circle onClick="show_cir(op77_1)" id="op77_1"   cx="340" cy="250" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** BRAUNSCHWEIG ****************/-->
								<text id="txt77" style="display:none;" font-size="10" font-family="Verdana"><tspan x="350" y="250">BRAUNSCHWEIG</tspan> </text>
								
								<circle onClick="show_cir(op78_1)" id="op78_1"   cx="295" cy="250" r="12" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** HANNOVER ****************/-->
								<circle onClick="show_cir(op78_2)" id="op78_2"  cx="295" cy="250" r="8" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** HANNOVER ****************/-->
								<circle onClick="show_cir(op78_3)" id="op78_3"   cx="295" cy="250" r="6" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** HANNOVER ****************/-->
								<circle onClick="show_cir(op78_4)" id="op78_4"   cx="295" cy="250" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** HANNOVER ****************/-->
								<text id="txt78" style="display:none;" font-size="10" font-family="Verdana"><tspan x="305" y="250">HANNOVER</tspan> </text>
								
								<circle onClick="show_cir(op79_1)" id="op79_1"   cx="340" cy="210" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** SUDERBURG ****************/-->
								<text id="txt79" style="display:none;" font-size="10" font-family="Verdana"><tspan x="350" y="210">SUDERBURG</tspan> </text>
								
								<circle onClick="show_cir(op80_1)" id="op80_1"   cx="330" cy="183" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** LÜNEBERG ****************/-->
								<text id="txt80" style="display:none;" font-size="10" font-family="Verdana"><tspan x="340" y="183">LÜNEBERG</tspan> </text>
								
								<circle onClick="show_cir(op81_1)" id="op81_1"   cx="335" cy="155" r="4" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** GÜLZOW ****************/-->
								<text id="txt81" style="display:none;" font-size="10" font-family="Verdana"><tspan x="345" y="155">GÜLZOW</tspan> </text>
								
								<circle onClick="show_cir(op82_1)" id="op82_1"  cx="315" cy="145" r="12" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** HAMBURG ****************/-->
								<circle onClick="show_cir(op82_2)" id="op82_2"   cx="315" cy="145" r="10" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** HAMBURG ****************/-->
								<circle onClick="show_cir(op82_3)" id="op82_3"   cx="315" cy="145" r="8" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** HAMBURG ****************/-->
								<circle onClick="show_cir(op82_4)" id="op82_4"   cx="315" cy="145" r="6" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** HAMBURG ****************/-->
								<circle onClick="show_cir(op82_5)" id="op82_5"  cx="315" cy="145" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** HAMBURG ****************/-->
								<text id="txt82" style="display:none;" font-size="10" font-family="Verdana"><tspan x="325" y="145">HAMBURG</tspan> </text>
								
								<circle onClick="show_cir(op83_1)"  id="op83_1"   cx="345" cy="120" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** LÜBECK ****************/-->
								<text id="txt83" style="display:none;" font-size="10" font-family="Verdana"><tspan x="355" y="120">LÜBECK</tspan> </text>
								
								<circle onClick="show_cir(op84_1)"  id="op84_1"  cx="313" cy="83" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** KIEL ****************/-->
								<text id="txt84" style="display:none;" font-size="10" font-family="Verdana"><tspan x="323" y="80">KIEL</tspan> </text>
								
								<circle onClick="show_cir(op85_1)"  id="op85_1"   cx="307" cy="88" r="4" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** FLINTBEK ****************/-->
								<text id="txt85" style="display:none;" font-size="10" font-family="Verdana"><tspan x="317" y="88">FLINTBEK</tspan> </text>
								
								<circle onClick="show_cir(op86_1)"  id="op86_1"   cx="390" cy="115" r="4" stroke="#090" stroke-width="2" fill="#090" />  <!--*********** WISMAR ****************/-->
								<text id="txt86" style="display:none;" font-size="10" font-family="Verdana"><tspan x="400" y="115">WISMAR</tspan> </text>
								
								<circle onClick="show_cir(op87_1)"  id="op87_1"   cx="435" cy="120" r="4" stroke="#FC3" stroke-width="2" fill="#FC3" />  <!--*********** GÜSTROW ****************/-->
								<text id="txt87" style="display:none;" font-size="10" font-family="Verdana"><tspan x="445" y="120">GÜSTROW</tspan> </text>
								
								<circle onClick="show_cir(op88_1)"  id="op88_1"   cx="425" cy="104" r="4" stroke="#39F" stroke-width="2" fill="#39F" />  <!--*********** ROSTOCK-WARNEMÜNDE ****************/-->
								<text id="txt88" style="display:none;" font-size="10" font-family="Verdana"><tspan x="425" y="104">ROSTOCK-WARNEMÜNDE</tspan> </text>
								
								<circle onClick="show_cir(op89_1)"  id="op89_1"  cx="490" cy="107" r="4" stroke="#060" stroke-width="2" fill="#060" />  <!--*********** GREIFSWALD ****************/-->
								<text id="txt89" style="display:none;" font-size="10" font-family="Verdana"><tspan x="500" y="107">GREIFSWALD</tspan> </text>
								
								<circle onClick="show_cir(op90_1)"  id="op90_1"   cx="495" cy="75" r="4" stroke="#603" stroke-width="2" fill="#603" />  <!--*********** PUTBUS ****************/-->
								<text id="txt90" style="display:none;" font-size="10" font-family="Verdana"><tspan x="505" y="75">PUTBUS</tspan> </text>
						</svg> 
                        
                        
                    
                 
                   
                        
                        
                     

              </div>
                
                
            </div>  <!-- content div ends here -->
            
            <div id="news">
            	  <ul id="menu">
                  	<li><a onClick="show_subpages('one')" href="#">EINRICHTUNGEN</a></li>
                      <li><a onClick="show_subpages('two')" href="#">THEMENSCHWERPUNKTE</a></li>
                      <li><a onClick="show_subpages('three')" href="#">LÄNDER UND PROJEKTE</a></li>
                      <li><a onClick="show_subpages('four')" href="#">VERNETZUNG</a></li>
                      <li><a onClick="show_subpages('five')" href="#">STUDIUM UND LEHRE</a></li>
                    
                </ul>
               <div id="menu2" style="display:none;"> 
               	<h3>EINRICHTUNGEN</h3>
               	<div id="items_div">
                		<ul>
                        	<li>EINRICHTUNGEN</li>
                         <li>EINRICHTUNGEN</li>
                         <li>EINRICHTUNGEN</li>
                         <li>EINRICHTUNGEN</li>
                         <li>EINRICHTUNGEN</li>
                         <li>EINRICHTUNGEN</li>   
                      </ul>
               	</div>  
                	<p><a id="home_link" href="index.php">HOME</a></p>
                	<ul id="menu1" style="display:none;">
                		
                  	<li><a id="one"  style="color:#000;"  href="#">EINRICHTUNGEN</a></li>
                      <li><a id="two" href="#">THEMENSCHWERPUNKTE</a></li>
                      <li><a id="three" href="#">LÄNDER UND PROJEKTE</a></li>
                      <li><a id="four" href="#">VERNETZUNG</a></li>
                      <li><a id="five" href="#">STUDIUM UND LEHRE</a></li>
                    
                	</ul>
               </div>
            </div>  <!-- news divs ends here -->
             
            
        </div> <!-- content_wrapper divs end here -->
        
        <div id="footer">
        		<div id="search_query" style="display:none;">
                	<ul id="search">
                    	<li id="s1"><a onClick="change_val_uni();load_queried_uni()">Universität</a></li>
                      <li id="s2" onClick="change_val_fach();load_queried_uni()">Fachhochschule</li>
                      <li id="s3" onClick="change_val_enr();load_queried_uni()">Enrichtung des Landes</li>
                      <li id="s4" onClick="change_val_for();load_queried_uni()">Forschungseinrichtung(außeruniversitär)</li>
                      <li id="s5" onClick="change_val_ein();load_queried_uni()">Einrichtung des Bundes/Ressortforschung</li>
                  </ul>
             	</div>
        	<p>stand der Datenerfassung: Januar 2013</p>
        </div>
        
    </div> <!-- wrapper divs end here -->

</body>
</html>