window.onload = (event) => {
    var req=new XMLHttpRequest();
    req.open("GET","http://localhost/project/state_district.txt",true);
    req.send();
    req.onreadystatechange=function()
    {
        if(req.readyState==4 && req.status==200)
        {	
            var obj_of_txt = JSON.parse(this.responseText);
            console.log(obj_of_txt);
            var i;
            var select="<option value=''>----Select----</option>";
            for (i=0;i<obj_of_txt.states.length;i++)
            {
                select+="<option>"+obj_of_txt.states[i].state+"</option>";
            }
            document.getElementById("state_name").innerHTML=select;
        }
    };
    console.log('page is fully loaded');
};

function search_district(data){
    var req=new XMLHttpRequest();
    req.open("GET","http://localhost/project/state_district.txt",true);
    req.send();
    req.onreadystatechange=function()
    {
        if(req.readyState==4 && req.status==200)
        {	
            
            var obj_of_txt = JSON.parse(this.responseText);
            var select="<option value=''>----Select----</option>";
            for (var i=0;i<obj_of_txt.states.length;i++)
            {
                if (obj_of_txt.states[i].state==data)
                {
                    for (var j=0;j<obj_of_txt.states[i].districts.length;j++)
                    {
                        select+="<option>"+obj_of_txt.states[i].districts[j]+"</option>";
                    }
                    break;
                }
            }
            document.getElementById("city_name").innerHTML=select;
        }
    };
}