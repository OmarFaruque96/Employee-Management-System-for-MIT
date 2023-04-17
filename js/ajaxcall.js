function update_month($currentMonth,$currentYear){
  var year = $currentYear;
  var month = $currentMonth;
  var monthchange=new XMLHttpRequest();
    monthchange.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("showtotal_cost_per_month").innerHTML=this.responseText;
      }
    }
    monthchange.open("GET","ajax/update_month.php?month="+month+"&year="+year,true);
    monthchange.send();
}
function totalcost(month){
  
  var year = document.getElementById('currentYear').value;
  var totalcost=new XMLHttpRequest();
    totalcost.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("showtotal_cost_per_month").innerHTML=this.responseText;
      }
    }
    totalcost.open("GET","ajax/totalcostcal.php?month="+month+"&year="+year,true);
    totalcost.send();
}

function updateCostData(month){

   var year = document.getElementById('currentYear').value;

    if (month==""){
        var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("dailycostdata").innerHTML=this.responseText;
          }
      }
      xmlhttp.open("GET","ajax/ajaxdailycost.php?q=all&y="+year,true);
      xmlhttp.send();
    }else{

      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("dailycostdata").innerHTML=this.responseText;
          }
      }
      xmlhttp.open("GET","ajax/ajaxdailycost.php?q="+month+"&y="+year,true);
      xmlhttp.send();
    }
    
    
    }