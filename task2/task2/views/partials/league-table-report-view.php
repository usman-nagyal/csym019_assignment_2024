<div>
    <div class="row">
      
        <!-- col-6 -->
        <div class="col-md-12">
          <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th colspan="9" class="text-uppercase">Premier League Table</th>
                        <th><button class="btn btn-secondary" onclick="printReport()">print Report</button></th>
                    </tr>
                    <tr>
                        <th title="season">season</th>
                        <th title="position">position</th>
                        <th title="team">team</th>
                        <th title="played">played</th>
                        <th title="won">won</th>
                        <th title="drawn">drawn</th>
                        <th title="lost">lost</th>
                        <th title="goals_for">goals_for</th>
                        <th title="goals_against">goals_against</th>
                        <th title="points">points</th>
                    </tr>
                </thead>
                <tbody id="league_data">
                    <?php 
                        foreach($premier_leagues as $premier_league){
                            echo <<<HTML
                                <tr>
                                    <td title="season">$premier_league->season</td>
                                    <td title="position">$premier_league->position</td>
                                    <td title="team">$premier_league->team</td>
                                    <td title="played">$premier_league->played</td>
                                    <td title="won">$premier_league->won</td>
                                    <td title="drawn">$premier_league->drawn</td>
                                    <td title="lost">$premier_league->lost</td>
                                    <td title="goals_for">$premier_league->goals_for</td>
                                    <td title="goals_against">$premier_league->goals_against</td>
                                    <td title="points">$premier_league->points</td>
                                </tr>
                            HTML;
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th title="season">season</th>
                        <th title="position">position</th>
                        <th title="team">team</th>
                        <th title="played">played</th>
                        <th title="won">won</th>
                        <th title="drawn">drawn</th>
                        <th title="lost">lost</th>
                        <th title="goals_for">goals_for</th>
                        <th title="goals_against">goals_against</th>
                        <th title="points">points</th>
                    </tr>
                </tfoot>
            </table>
        </div>

          <!-- col-6 -->
                <div class="col-md-6">

                        <!-- barchart card -->
                        
                            <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Bar CHart</h5>

                            <!-- Bar Chart -->
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                            

                            </div>
                        </div>


                        <!-- ends bar chart card -->
                       
                </div> <!--col-->

               <!-- pie chart -->
               <div class="col-md-6">
                    <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Pie Chart</h5>

                    <!-- Pie Chart -->
                    <canvas id="pieChart" style="max-height: 400px;"></canvas>
                    <!-- End Pie CHart -->

                    </div>
                </div>
               </div>
               <!-- pie chart -->
        <!-- col-6 -->
    </div>
</div>

    <!-- Charts JS -->
    <!-- <script src="./public/assets/js/chatjs/chart.js/chart.umd.js"></script>  -->
    <script src="./public/assets/vendor/chart.js/chart.umd.js"></script>

    <script>
        $(document).ready(function(){
            loadBarGraph();
            loadPieChart();
        });

        function printReport(){
            var divToPrint = document.getElementById('content');
            var anotherWindow = window.open('', 'Print-Window');
            anotherWindow.document.open();
            anotherWindow.document.write('<html><body onload=\'window.print()\'>' + divToPrint.innerHTML + '</body></html>');
            anotherWindow.document.close();
        }

        function loadPieChart(){
            new Chart(document.querySelector('#pieChart'), {
                            type: 'pie',
                            data: {
                            labels:[<?=join(',',$bargraph_data['clubs']);?>],
                            datasets: [{
                                label: 'My First Dataset',
                                data:[<?=join(',',$bargraph_data['points']);?>],
                                backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }]
                            }
                        });
        }

        function loadBarGraph(){
            new Chart(document.querySelector('#barChart'), {
                type: 'bar',
                data: {
                labels: [<?=join(',',$bargraph_data['clubs']);?>],
                datasets: [{
                    label: 'Bar Chart',
                    data: [<?=join(',',$bargraph_data['points']);?>],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });
        }

       
    </script>
                            <!-- End Bar CHart -->