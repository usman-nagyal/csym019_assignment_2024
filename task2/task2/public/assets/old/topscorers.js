document.addEventListener("DOMContentLoaded", function() {
  fetch("http://localhost/Assignment1/League.json")
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      // Render top scorers table
      const topScorersTable = document.getElementById("top-scorers-table");
      data.topScorers.forEach(scorer => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${scorer.player}</td>
          <td>${scorer.team}</td>
          <td>${scorer.goals}</td>
        `;
        topScorersTable.appendChild(row);
      });
    })
    .catch(error => {
      console.error("Error fetching or parsing data:", error);
    });
});


// document.addEventListener("DOMContentLoaded", function() {
//   fetch("http://localhost/Assignment1/League.json")
//     .then(response => {
//       if (!response.ok) {
//         throw new Error(`HTTP error! Status: ${response.status}`);
//       }
//       return response.json();
//     })
//     .then(data => {
//       // Find the team with the most goals
//       let topScoringTeam = null;
//       let maxGoals = 0;
//       console.log(data.teams);
//       data.teams.forEach(team => {
//         if (team.goalDifference > maxGoals) {
//           maxGoals = team.goalDifference;
//           topScoringTeam = team.name;
//         }
//       });

//       // Render top scoring team
//       if (topScoringTeam) {
//           const row = document.createElement("tr");
//             row.innerHTML = `
//           <td>${scorer.player}</td>
//           <td>${scorer.topScoringTeam}</td>
//           <td>${scorer.maxGoals}</td>
//         `;
//         topScorersTable.appendChild(row);
//         console.log(topScoringTeam);
//         // const topScoringTeamElement = document.getElementById("top-scoring-team");
//         // topScoringTeamElement.innerHTML = `
//         //   <p>Top Scoring Team:</p>
//         //   <p>Name: ${topScoringTeam.name}</p>
//         //   <p>Goals: ${topScoringTeam.goals}</p>
//         // `;
//       } else {
//         console.error("No top scoring team found.");
//       }
//     })
//     .catch(error => {
//       console.error("Error fetching or parsing data:", error);
//     });
// });
