function pieChart(percentage, size, color) {
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

    return chart;
}


(function($) {
/*
  function making_matching_rate_circle(id, matching_rate){
      var canvas = document.getElementById(id);

      var context = canvas.getContext('2d');
      var centerX = canvas.width / 2;
      var centerY = canvas.height / 2;
        var radius = 40;

        var rate_in_circle = (2 * Math.PI)*(75-matching_rate)/100;
        matching_rate += "%";


        context.beginPath();
        context.arc(centerX, centerY, radius, 0,2 * Math.PI, true);
        context.lineWidth = 2;
        context.strokeStyle = '#e1e1e1';
        context.stroke();

        //그래프 그리기
        context.beginPath();
        context.arc(centerX, centerY, radius, (2 * Math.PI)*75/100, rate_in_circle, true);
        context.lineWidth = 2;
              
        context.strokeStyle = '#00ace9';
        context.stroke();

        //그래프 안 매칭률 표시
        context.textAlign="center";
        context.textBaseline="middle";
            
        context.font="bold 25px Arial";
        context.fillText(matching_rate,centerX,centerY);
  }
  */

  $(document).ready(function(){

    $('.sen-card-career').each(function(){
      var matching_rate = $(this).data('matchingrate');
      $(this).find('.sen-chart-wrap').append(pieChart(matching_rate,70));
    });

    $('.sen-card-matchingrate').each(function(){
        var matching_rate = $(this).data('matchingrate');
        $(this).find('.sen-chart-wrap').append(pieChart(matching_rate,100));
    });

  });
  


})(jQuery);
