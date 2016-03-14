var flag = true;
function advancedSelect(text){
 if(flag){
  text.select();
  flag = false;
 }
 else{
  text.focus();
  flag = true;
 }
}