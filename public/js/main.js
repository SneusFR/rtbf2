

window.onload = () => {

    const stars = document.querySelectorAll(".la-star");

    const note = document.querySelector("#note");

    // On boucle sur les étoiles pour leur ajouter des écouteurs d'événéments

    for(star of stars) {
        // on écoute le survole

        star.addEventListener("mouseover", function() {
            resetStars();
            this.style.color= "yellow";
            this.classList.add("las");
            this.classList.remove("lar");


            // l'élément précédent dans le Dom (de même niveau, ou balise soeur)
            let previousStar = this.previousElementSibling;
            while(previousStar) {
                previousStar.classList.add("las");
                previousStar.classList.remove("lar");
                previousStar.style.color = "yellow";
                previousStar = previousStar.previousElementSibling;

            }
        });

        // On écoute le clic

        star.addEventListener("click", function() {
            note.value = this.dataset.value;
            this.classList.add("las");
            this.classList.remove("lar");

            let previousStar = this.previousElementSibling;
            while(previousStar) {
                previousStar.classList.add("las");
                previousStar.classList.remove("lar");


                previousStar = previousStar.previousElementSibling;
                }
        });

        star.addEventListener("mouseout", function() {
            resetStars(note.value);

        });
    }

    function resetStars(note = 0) {
        for (star of stars) {
            if(star.dataset.value > note) {
                star.classList.add("lar");
                star.classList.remove("las");
                star.style.color = "black";
            }
            else {
                star.classList.add("las");
                star.classList.remove("lar");
                star.style.color = "yellow";
            }

        }

    }

}
