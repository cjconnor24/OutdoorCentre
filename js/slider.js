
/**
 * CRUDE FUNTION TO CHANGE HERO HEADER IMAGE
 */
var i = 0;


setInterval(changeHeroImage, 5000);




function changeHeroImage(){

    var loop = 0;



    try {

        var heroBox = document.getElementsByClassName('hero')[0];
        var imagePath = "/img/";
        var heroImages = [
            "placeholder-2.jpg",
            "placeholder-3.jpg",
            "placeholder-4.jpg",
            "placeholder-1.jpg"
        ];

        heroBox.style.backgroundImage = 'url(' + imagePath + heroImages[i] + ')';

        if (i == 3) {
            i = 0;
        } else {
            i++;
        }

    } catch (err) {
    }



}