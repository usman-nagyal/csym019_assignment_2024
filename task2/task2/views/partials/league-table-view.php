<div>
    <div class="row">
        <!-- col-6 -->
        <div class="col-md-4 bg-light p-4 " style="border-radius: 12px;">
        
            <form method="post" id='form_league_table' onsubmit="return false;" class="row g-3">
                <div class="col-md-6">
                    <label for="inputhometeam4" class="form-label text-capitalize">season</label>
                    <input type='text' onkeyup="checkRequired()" id='season' name="season" class="form-control" id="season">
                </div>
                <div class="col-md-6">
                    <label for="inputawayteam4" class="form-label text-capitalize">position</label>
                    <input type='text' onkeyup="checkRequired()" id='position' name="position" class="form-control" id="position">
                </div>
                <div class="col-md-6">
                    <label for="inputhomescore4" class="form-label text-capitalize">team</label>
                    <input type='text' onkeyup="checkRequired()" id='team' name="team" class="form-control" id="team">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label text-capitalize">played</label>
                    <input type='text' onkeyup="checkRequired()" id='played' name="played" class="form-control" id="played">
                </div>
                <div class="col-md-6">
                    <label for="inputhomescore4" class="form-label text-capitalize">won</label>
                    <input type='text' onkeyup="checkRequired()" id='won' name="won" class="form-control" id="won">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label text-capitalize">drawn</label>
                    <input type='text' onkeyup="checkRequired()" id='drawn' name="drawn" class="form-control" id="drawn">
                </div>
                <div class="col-md-6">
                    <label for="inputhomescore4" class="form-label text-capitalize">lost</label>
                    <input type='text' onkeyup="checkRequired()" id='lost' name="lost" class="form-control" id="lost">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label text-capitalize">goals for</label>
                    <input type='text' onkeyup="checkRequired()" id='goals_for' name="goals_for" class="form-control" id="goals_for">
                </div>
                <div class="col-md-6">
                    <label for="inputhomescore4" class="form-label text-capitalize">goals against</label>
                    <input type='text' onkeyup="checkRequired()" id='goals_against' name="goals_against" class="form-control" id="goals_against">
                </div>
                <div class="col-md-6">
                    <label for="inputawayscore4" class="form-label text-capitalize">points</label>
                    <input type='text' onkeyup="checkRequired()" id='points' name="points" class="form-control" id="points">
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
                        <th colspan="11" class="text-uppercase">Premier League Table</th>
                    </tr>
                    <tr>
                        <th>#</th>
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
                    <form id="form_view_report" onsubmit="return false;">
                    <?php 
                        foreach($premier_leagues as $premier_league){
                            echo <<<HTML
                                <tr>
                                    <td><input type='checkbox' class='chkbx' name='chck_ids[]' value="$premier_league->id"></td>
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
                    <tr>
                        <td colspan='11'>
                            <button class="btn btn-primary" onclick="viewReport()">Show Report</button>
                        </td>
                    </tr>
                 </form>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
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
            <div class="mb-3">
                <?php 
                if($_SESSION['errors2']){
                    foreach($_SESSION['errors2'] as $error){
                        echo "<div class='text-danger p-1'>".$error."</div>";
                    }
                    unset($_SESSION['errors2']);
                }
                ?>
             </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function(){
        checkRequired();
    });
    function submitForm() {
        var form = $('#form_league_table')[0];
  
        var formData = new FormData(form);
       
        sendData('./league_table_create',formData)
    }

    function viewReport() {
        var league_ids=new Array();
         var x=0;
        $('.chkbx').each(function(){
            var checked=$(this).prop('checked');
            var item_value=$(this).val();

            if(checked){
                league_ids[x]=item_value;
                x+=1;
            }
            
        });
        let data={ids:league_ids.toString()};

        sendData2('./league_table_report',data)
    }

    function checkRequired(){
        
        if($('#season').val()!='' && $('#position').val()!='' && $('#played').val()!='' && $('#won').val()!='' && $('#drawn').val()!='' && $('#lost').val()!='' && $('#goals_for').val()!='' && $('#goals_against').val()!='' && $('#points').val()!='' ){
            $('#submitButton').prop('disabled',false);
        }else{
            $('#submitButton').prop('disabled',true);
        }     
        
    }
    
</script>