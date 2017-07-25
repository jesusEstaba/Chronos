@extends('project.project')
@section('sub-title', '')

@section('sub-content')

@section('titlePrincipal', $project->name)

  <div class="box">
    <div class="box-body">
  
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript" src="http://momentjs.com/downloads/moment.js"></script>

      <script type="text/javascript" src="http://www.cloudformatter.com/Resources/Pages/CSS2Pdf/Script/xepOnline.jqPlugin.js"></script>
  




<script type="text/javascript">

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}
 
function daysToMilliseconds(days) {
      //
      return days * 24 * 60 * 60 * 1000;
    }


  

      function getDateDiff(date1, date2) {
        var start = moment(date1);
        var end = moment(date2);
        
        return end.diff(start, "days");
      }

      function nextPos(pos) {
        let len = partities.lenght - 1

        if (partities[pos+1]) {
          let temp = partities[pos+1]
          partities[pos+1] = partities[pos]
          partities[pos] = temp

          drawChart()
        }
      }

      function moveChild(parent, current) {
        let daysParent = getDateDiff(parent[2], parent[3])
        let daysChild = getDateDiff(current[2], current[3])

        current[2] = parent[3]
        current[3] = current[2].addDays(daysChild)
      }

      function asDenpencency(pos) {
        if (!pos) {
          return;
        }

        if (partities[pos][6] == partities[pos-1][0]) {
          return;
        }

        partities[pos][6] = partities[pos-1][0] 

        moveChild(partities[pos-1], partities[pos])

        updateDepencencies(partities[pos])

        drawChart()
      }

      function updateDepencencies(parent) {
        partities.forEach(function(e) {
          if (parent[0] == e[6]) {
            moveChild(parent, e)
            updateDepencencies(e)
          }
        })
      }

      <?php
      function days($partitie)
      {
        $current = \Carbon\Carbon::parse($partitie->activity()->start);
        
        $qty = $partitie->quantity;
        $days = 0;

        while ($qty > 0) {
          $qty -= $partitie->yield;

          $days++;
        }

        // add 30 days to the current time
        $trialExpires = $current->addDays($days);

        //if sabado o domingo agregar 1 o dos dias respectivamente
        return $trialExpires->format('Y-m-d');
      }
    ?>

    var startDate = new Date("{{$project->start}}");


    var partities = [
        @foreach($projectPartities as $partitie)
          [
            '{{$partitie->id}}', 
            '{{$partitie->partitie()->name}}', 
            new Date("{{$partitie->activity()->start}}"),
            new Date("{{days($partitie)}}"), 
            null,  
            100,  
            @if($partitie->parent)
              "{{$partitie->parent}}"
            @else
              null
            @endif
          ],
        @endforeach
    ];

</script>




{{csrf_field()}}

  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt'], 'language': 'es'});
    google.charts.setOnLoadCallback(startChart);

    function startChart() {
      drawChart();

      let activities = '';

      partities.forEach(function(e){
        activities += `<option value="${e[0]}">${e[1]}</option>`
      })

      $('.activity').append(activities)
    }

    $(document).on('change', '.activity',function(event) {
      
      partitie = $(this).val()
      
      $('.dependency').html('')

      let activities = '<option value=""></option>';

      partities.forEach(function(e){
        let partitieArray;
        partities.forEach(function(f){
          if (f[0] == partitie) {
            partitieArray = f;
          }
        })

        if (partitieArray[6] == e[0]) {
          activities += `<option selected value="${e[0]}">${e[1]}</option>`
        } else if (partitie != e[0]) {
          activities += `<option value="${e[0]}">${e[1]}</option>`
        }
        
      })

      $('.dependency').append(activities)
    });

    $(document).on('change', '.dependency',function(event) {
      let activity = $('.activity').val()
      let dependency = $('.dependency').val()

      partities.forEach(function(e){
        if (e[0]==activity) {
            e[6]=dependency
        
            if (dependency=='') {
                let daysChild = getDateDiff(e[2], e[3])

                e[2] = startDate
                e[3] = e[2].addDays(daysChild)
            }


          partities.forEach(function(f){
            if (f[0]==dependency) {
              moveChild(f, e)
              updateDepencencies(e)
            }
          })

          
        }
      })



      

      drawChart()
    });

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows(partities);

      var options = {
        "height": 500,
        gantt: {
          "percentEnabled": false
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

      // Wait for the chart to finish drawing before calling the getImageURI() method.
     google.visualization.events.addListener(chart, 'ready', AddNamespaceHandler);  

      chart.draw(data, options);
    }
  </script>

  <script type="text/javascript">
    $(document).on('click', '.save-gantt',function(event) {
      event.preventDefault();
      /* Act on the event */

        $.post('/projects/gantt/{{$project->id}}', {
            partities: partities,
            "_token": $('[name="_token"]').val(),
        }, function(data){
            if (data.status == "success") {
                location.reload();
            }
        })
    });


    function AddNamespaceHandler(){
  var svg = jQuery('#chart_div svg');
  svg.attr("xmlns", "http://www.w3.org/2000/svg");
  svg.css('overflow','visible');
}



  </script>
<button style="margin-top: 1.5em;" class="btn btn-outline-danger pull-right" 
onclick="return xepOnline.Formatter.Format('JSFiddle', {
    render:'download', srctype:'svg', filename:'gantt_{{$project->id . date('Ymdhi')}}'
    })">
PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</button>
    <div class="form-group">
      <div class="row" style="margin:0 !important;">
        <div class="col-md-6">
            <small>Actividad</small>
          <select class="form-control activity">
        
          </select>
        </div>
        <div class="col-md-6">
            <small>Depende de</small>
          <select class="form-control dependency">
            <option value=""></option>
          </select>
        </div>
      </div>
      
      
    </div>
<div id="JSFiddle"><div id="chart_div"></div></div>
      

  <br>

  <br>
  <a href="/projects/{{$project->id}}" class="btn btn-outline-secondary">Atrás</a>

  <button class="save-gantt btn btn-outline-primary pull-right">Guardar</button>
    </div>
  </div>



@stop