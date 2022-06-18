

<script>

setTimeout(function ()
    {
        @if (session()->has('success'))
            swal("Effectuer","{!! session()->get('success') !!}","success")
        @elseif (session()->has('error'))
            swal("Erreur","{!! session()->get('error') !!}","error")
        @endif
},10);
</script>







 <!--   Core   -->
 <script>
    window.onload = function () {

    var chart1 = new CanvasJS.Chart("chartContainer", {
      theme: "light",
    //  exportFileName: "Doughnut Chart",
     // exportEnabled: true,
      animationEnabled: true,
      title:{
        text: ""
      },
      legend:{
        cursor: "pointer",
        itemclick: explodePie
      },
      data: [{
        type: "doughnut",
        innerRadius: 90,
        showInLegend: true,
        toolTipContent: "<b>{name}</b>: {y} (#percent%)",
        indexLabel: "{name} - #percent%",
        dataPoints: [

          {
            y:
              2 , name: "Hatchback"
              },

          { y:
              0 , name: "Sedan | Saloon" },

          { y:
            1 , name: "Multi-Purpose Vehicle (MPV)" },

          { y:
            2, name: "Sports Utility Vehicle (SUV)" },

          { y:
            0 , name: "Crossover" },

          { y:
            1, name: "Coupe"},

          { y:
            1 , name: "Convertible" }
        ]
      }]
    });

    var chart2 = new CanvasJS.Chart("chartContainer1", {
      animationEnabled: true,
      title: {
        text: ""
      },
      data: [{
        type: "pie",
        startAngle: 240,
        yValueFormatString: "##0.00'%'",
        indexLabel: "{label} {y}",
        dataPoints: [
          {
            y:
              1 , label: "Hatchback" },

          { y:
              0 , label: "Sedan | Saloon" },

          { y:
            0 , label: "Multi-Purpose Vehicle (MPV)" },

          { y:
            0, label: "Sports Utility Vehicle (SUV)" },

          { y:
            0 , label: "Crossover" },

          { y:
            0, label: "Coupe"},

          { y:
            0 , label: "Convertible" }
        ]
      }]
    });
    chart1.render();
    chart2.render();

    function explodePie (e) {
      if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
        e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
      } else {
        e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
      }
      e.chart.render();
    }

    }
</script>
