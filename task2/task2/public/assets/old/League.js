document.addEventListener("DOMContentLoaded", function() {
  fetch("http://localhost/Assignment1/League.json")
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      // Process the fetched JSON data
      console.log("Fetched JSON data:", data);

      // Render teams table and top scorers table
      renderTeamsTable(data.teams);
      // renderTopScorersTable(data.topScorers);
    })
    .catch(error => {
      console.error("Error fetching or parsing data:", error);
    });
});

function renderTeamsTable(teams) {
  const teamsTable = document.getElementById("teams-table");
  teams.forEach(team => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${team.name}</td>
      <td>${team.played}</td>
      <td>${team.points}</td>
      <td>${team.goalDifference}</td>
    `;
    teamsTable.appendChild(row);
  });
}

// add new record
document.addEventListener("DOMContentLoaded", function() {
  const addTeamForm = document.getElementById("add-team-form");

  addTeamForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Retrieve form data
    const teamName = document.getElementById("team-name").value;
    const gamesPlayed = parseInt(document.getElementById("games-played").value);
    const points = parseInt(document.getElementById("points").value);
    const goalDifference = parseInt(document.getElementById("goal-difference").value);

    // Construct new team object
    const newTeam = {
      "name": teamName,
      "played": gamesPlayed,
      "points": points,
      "goalDifference": goalDifference
    };
console.log(newTeam);
    // Send POST request to server-side script
    fetch("http://localhost/Assignment1/updateTeams.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(newTeam)
    })
    .then(response => {
      if (response.ok) {
        // Reload the page to reflect updated data
        location.reload();
      } else {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
    })
    .catch(error => {
      console.error("Error adding new team:", error);
    });
  });
});


