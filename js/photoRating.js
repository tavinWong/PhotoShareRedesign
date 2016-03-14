//Usage: Use this javascript after all div elements(<div class = "photorating">Number</div>).
var r, g, b;
var array = document.getElementsByClassName("photorating");
for(var i = 0; i < array.length; i++){
 var rating = parseInt(array[i].innerHTML);
 if(rating >=50 && rating <= 100){
  r = Math.round(2 * (100 - rating) / 100 * 205 + 50);
  g = 255;
  b = 50;
 }
 else if(rating >= 0){
  r = 255;
  g = Math.round(2 * rating / 100 * 205 + 50);
  b = 50;
 }
 var rgb = "rgb(" + r + "," + g + "," + b + ")";
 array[i].style.color = rgb;
}