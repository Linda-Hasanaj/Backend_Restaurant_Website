const teamMembers = 54;
const locations = 10;
const awards = 63;
const michelinStars = 31;

let currentTeamMembers = 0;
let currentLocations = 0;
let currentAwards = 0;
let currentMichelinStars = 0;

const observer2 = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
            console.log(entry);
            if(entry.isIntersecting){
                const teamMembersCounter = setInterval(() => {
                    document.getElementById("teamMembers").innerHTML = currentTeamMembers;
                    currentTeamMembers++;
                    if (currentTeamMembers === teamMembers) {
                        clearInterval(teamMembersCounter);
                    }
                }, 50);
                
                const locationsCounter = setInterval(() => {
                    document.getElementById("locations").innerHTML = currentLocations;
                    currentLocations++;
                    if (currentLocations === locations + 1) {
                        clearInterval(locationsCounter);
                    }
                }, 50);
                
                const awardsCounter = setInterval(() => {
                    document.getElementById("awards").innerHTML = currentAwards;
                    currentAwards++;
                    if (currentAwards === awards + 1) {
                        clearInterval(awardsCounter);
                    }
                }, 50);
                
                const michelinStarsCounter = setInterval(() => {
                    document.getElementById("michelinStars").innerHTML = currentMichelinStars;
                    currentMichelinStars++;
                    if (currentMichelinStars === michelinStars + 1) {
                        clearInterval(michelinStarsCounter);
                    }
                }, 50);
                
            }else{
                currentTeamMembers = 0;
                currentLocations = 0;
                currentAwards = 0;
                currentMichelinStars = 0;
            }
    });
});


const sectionFive = document.querySelector('.five-grid');
observer2.observe(sectionFive);