(function($) {

function pieChart(percentage, size, color) {
    var status = true;
    if(percentage == false){
        status = false;
        percentage = 0;
    }
    var svgns = "http://www.w3.org/2000/svg";
    var chart = document.createElementNS(svgns, "svg:svg");
    chart.setAttribute("width", size);
    chart.setAttribute("height", size);
    chart.setAttribute("viewBox", "0 0 " + size + " " + size);
    // Background circle
    var back = document.createElementNS(svgns, "circle");
    back.setAttributeNS(null, "cx", size / 2);
    back.setAttributeNS(null, "cy", size / 2);
    back.setAttributeNS(null, "r",  size / 2);
    var color = "#d0d0d0";
    if (size > 50) { 
        color = "#ebebeb";
    }
    back.setAttributeNS(null, "fill", color);
    chart.appendChild(back);
    // primary wedge
    var path = document.createElementNS(svgns, "path");
    var unit = (Math.PI *2) / 100;    
    var startangle = 0;
    var endangle = percentage * unit - 0.001;
    var x1 = (size / 2) + (size / 2) * Math.sin(startangle);
    var y1 = (size / 2) - (size / 2) * Math.cos(startangle);
    var x2 = (size / 2) + (size / 2) * Math.sin(endangle);
    var y2 = (size / 2) - (size / 2) * Math.cos(endangle);
    var big = 0;
    if (endangle - startangle > Math.PI) {
        big = 1;
    }
    var d = "M " + (size / 2) + "," + (size / 2) +  // Start at circle center
        " L " + x1 + "," + y1 +     // Draw line to (x1,y1)
        " A " + (size / 2) + "," + (size / 2) +       // Draw an arc of radius r
        " 0 " + big + " 1 " +       // Arc details...
        x2 + "," + y2 +             // Arc goes to to (x2,y2)
        " Z";                       // Close path back to (cx,cy)
    path.setAttribute("d", d); // Set this path 
    path.setAttribute("fill", '#f05f3b');
    chart.appendChild(path); // Add wedge to chart
    // foreground circle
    var front = document.createElementNS(svgns, "circle");
    front.setAttributeNS(null, "cx", (size / 2));
    front.setAttributeNS(null, "cy", (size / 2));
    front.setAttributeNS(null, "r",  (size * 0.30)); //about 34% as big as back circle 
    front.setAttributeNS(null, "fill", "#fff");
    chart.appendChild(front);

    if(status==true){
        var text = document.createElementNS(svgns,"text");
        text.setAttribute("x", (size / 2));
        text.setAttribute("y", (size * 0.56));
        text.setAttribute("class", 'sen-chart-number');
        text.setAttribute("style",'font-size:'+(size*0.32)+'px');
        var p = document.createTextNode(percentage.toString());
        text.appendChild(p);
        chart.appendChild(text);

        var text2 = document.createElementNS(svgns,"text");
        text2.setAttribute("x", (size / 2));
        text2.setAttribute("y", (size * 0.73));
        text2.setAttribute("class", 'sen-chart-percentage');
        text2.setAttribute("style",'font-size:'+(size*0.16)+'px');
        var p2 = document.createTextNode('%');
        text2.appendChild(p2);
        chart.appendChild(text2);
    }
    else{
        var text = document.createElementNS(svgns,"text");
        text.setAttribute("x", (size / 2));
        text.setAttribute("y", (size*0.62));
        text.setAttribute("class", 'sen-chart-percentage');
        text.setAttribute("style",'font-size:'+(size*0.40)+'px');
        var p = document.createTextNode('?');
        text.appendChild(p);
        chart.appendChild(text);
    }



    return chart;
}

  function matchingrateInCard(){
    $('.sen-card-career').each(function(){
        var matching_rate = ( $(this).data('matchingrate')!=undefined ) ? $(this).data('matchingrate') : false;
        //var matching_rate = $(this).data('matchingrate');
        $(this).find('.sen-chart-wrap').append(pieChart(matching_rate,70));
    });
  }

  function matchingrateInPage(){
    $('.sen-card-matchingrate').each(function(){
        var matching_rate = $(this).data('matchingrate');
        $(this).find('.sen-chart-wrap').append(pieChart(matching_rate,100));
    });
  }


  $(document).ready(function(){

    matchingrateInCard(); 

    matchingrateInPage();

  });
  


})(jQuery);
