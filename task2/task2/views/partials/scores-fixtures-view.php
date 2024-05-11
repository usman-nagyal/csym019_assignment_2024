<div>
    <div class="row">
        <!-- col-6 -->
        <div class="col-md-4 bg-light p-4 " style="border-radius: 12px;">
            <form method="post" id='form_scores_fixtures' onsubmit="return false;" class="row g-3" >
                <div class="col-md-6">
                    <label for="inputhometeam4" class="form-label">Home Team</label>
                    <input type='text' onkeyup="checkRequired()" name="hometeam" class="form-control" id="hometeam">
                </div>
                <div class="col-md-6">
                    <label for="inputawayteam4" class="form-label">Away Team</label>
                    <input type='text' onkeyup="checkRequired()" name="awayteam" class="form-control" id="awayteam">
                </div>
                <div class="col-md-6">
                    <label for="inputhomescore4" class="form-label">Home Score</label>
                    <input type='text' onkeyup="checkRequired()" name="homescore" class="form-control" id="homescore">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label">Away Score</label>
                    <input type='text' onkeyup="checkRequired()" name="awayscore" class="form-control" id="awayscore">
                </div>
                <div class="col-12">
                    <button type="submit" id="submitButton" onclick="submitForm()"  class="btn btn-dark">Submit</button>
                </div>
            </form>
            <div class="mb-3">
                <?php 
                if($_SESSION['errors']){
                    foreach($_SESSION['errors'] as $error){
                        echo "<div class='text-danger p-1'>".$error."</div>";
                    }
                    unset($_SESSION['errors']);
                }
                ?>
             </div>
        </div>

        <!-- col-6 -->
        <div class="col-md-8">
          <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th colspan="9" class="text-uppercase">Football Scores & Fixtures</th>
                    </tr>
                    <tr>
                        <th title='home_team'>Home Team</th>
                        <th title='home_score'>Home Score</th>
                        <th title='away_team'>Away Team</th>
                        <th title='away_score'>Away Score</th>
                    </tr>
                </thead>
                <tbody id="league_data">
                    <?php 
                       foreach($scores_fixtures as $scores_fixture){
                        echo <<<HTML
                            <tr>
                            <td title='home_team'>$scores_fixture->home_team</td>
                            <td title='home_score'>$scores_fixture->home_score</td>
                            <td title='away_team'>$scores_fixture->away_team</td>
                            <td title='away_score'>$scores_fixture->away_score</td>
                            </tr>
                        HTML;
                       }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th title='home_team'>Home Team</th>
                        <th title='home_score'>Home Score</th>
                        <th title='away_team'>Away Team</th>
                        <th title='away_score'>Away Score</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<script>
    $(document).ready(function(){
        checkRequired();
    });

    function submitForm() {
        var form = $('#form_scores_fixtures')[0];
  
        var formData = new FormData(form);
       
        sendData('./scores_fixtures_create',formData);
    }

    function checkRequired(){
        
        if($('#hometeam').val()!='' && $('#awayteam').val()!='' && $('#homescore').val()!='' && $('#awayscore').val()!='' ){
            $('#submitButton').prop('disabled',false);
        }else{
            $('#submitButton').prop('disabled',true);
        }     
        
    }
    
</script>