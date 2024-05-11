$(document).ready(function(){

    var jsonUrl='League.json';
    
    fetchDataFromJson(jsonUrl);

   // automatic data updates at a realistic interval using setTimeout
     setInterval(function(){
        fetchDataFromJson(jsonUrl)
     },3000);
  })
  //script to extract data from the JSON file
  function fetchDataFromJson(jsonUrl) {
    $.getJSON(jsonUrl)
        .done(function(data) {
            getPremierLeagueTable(data);
            getTopScorers(data);
        })
        .fail(function(jqxhr, textStatus, error) {
            errorHandler(textStatus + ", " + error);
        });
}

 // Function to extract Premier League table
 function getPremierLeagueTable(data) {
    let table_data='';
   data.premier_league_table.map((obj)=>{
      
    table_data+=`<tr>
        <td>${obj.position}</td>
        <td style="width:300px;">${obj.team}</td>
        <td>${obj.played}</td>
        <td>${obj.won}</td>
        <td>${obj.drawn}</td>
        <td>${obj.lost}</td>
        <td>${obj.goals_for}</td>
        <td>${obj.goals_against}</td>
        <td>${obj.points}</td>                     
    </tr>`;

   });

   $('#league_data').html(table_data);

}

function getTopScorers(data) {
    let table_data='';
   data.premier_league_top_scorers.map((obj)=>{
      
    table_data+=`<tr>
        <td>${obj.rank}</td>
        <td style="width:300px;">${obj.player_name}</td>
        <td>${obj.team}</td>
        <td>${obj.goals}</td>                  
    </tr>`;

   });

   $('#top_scores_data').html(table_data);

}

function errorHandler(error) {

    alert(error);
 }