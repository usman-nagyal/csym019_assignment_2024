<div>
    <div class="row">
        <!-- col-6 -->
        <div class="col-md-4 bg-light p-4 " style="border-radius: 12px;">
            <form method="post" id='form_top_scorers' onsubmit="return false;" class="row g-3">
            
                <div class="col-md-12">
                    <label for="inputhometeam4" class="form-label text-capitalize">season</label>
                    <input type='text' onkeyup="checkRequired()" name="season" class="form-control" id="season">
                </div>
                <div class="col-md-6">
                    <label for="inputawayteam4" class="form-label text-capitalize">rank</label>
                    <input type='text' onkeyup="checkRequired()"  name="rank" class="form-control" id="rank">
                </div>
                <div class="col-md-6">
                    <label for="inputhomescore4" class="form-label text-capitalize">player name</label>
                    <input type='text' onkeyup="checkRequired()" name="player_name" class="form-control" id="player_name">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label text-capitalize">team</label>
                    <input type='text' onkeyup="checkRequired()" name="team" class="form-control" id="team">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label text-capitalize">goals</label>
                    <input type='text' onkeyup="checkRequired()" name="goals" class="form-control" id="goals">
                </div>
                <div class="col-12">
                    <button type="submit" id='submitButton' onclick="submitForm()" class="btn btn-dark">Submit</button>
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
                        <th colspan="9" class="text-uppercase">Premier League Top Scorers</th>
                    </tr>
                    <tr>
                        <th title='season'>season</th>
                        <th title='rank'>rank</th>
                        <th title='player_name'>player_name</th>
                        <th title='team'>team</th>
                        <th title='goals'>goals</th>
                    </tr>
                </thead>
                <tbody id="league_data">
                    <?php 
                       foreach($data_top_scorers as $data_top_scorer){
                        echo <<<HTML
                            <tr>
                                <td>$data_top_scorer->season</td>
                                <td>$data_top_scorer->rank</td>
                                <td>$data_top_scorer->player_name</td>
                                <td>$data_top_scorer->team</td>
                                <td>$data_top_scorer->goals</td>
                            </tr>
                        HTML;
                       }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th title='season'>season</th>
                        <th title='rank'>rank</th>
                        <th title='player_name'>player_name</th>
                        <th title='team'>team</th>
                        <th title='goals'>goals</th>
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
        var form = $('#form_top_scorers')[0];
        var formData = new FormData(form);      
       sendData('./top_scorers_create',formData)      
    }


    function checkRequired(){
        
        if($('#season').val()!='' && $('#rank').val()!='' && $('#player_name').val()!='' && $('#team').val()!='' && $('#goals').val()!='' ){
            $('#submitButton').prop('disabled',false);
        }else{
            $('#submitButton').prop('disabled',true);
        }     
        
    }
    
</script>