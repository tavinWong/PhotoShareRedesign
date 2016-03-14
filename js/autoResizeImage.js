function setPreviewImage(file, image, maxWidth, maxHeight){
 var div = document.getElementById("NewImage_Div");
 if(file.files && file.files[0]){ //Internet Explorer
  var reader = new FileReader();
  reader.onload = function(evt){image.src = evt.target.result;}
  reader.readAsDataURL(file.files[0]);
 }
 else{ //Firefox
  var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
  file.select();
  var src = document.selection.createRange().text;
  div.innerHTML = "<input type = 'image' id = 'NewImage' onclick = 'ImageUpload.click();return false;'>";
  var img = document.getElementById('NewImage');
  img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
  var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
  status = ('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
  div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;margin-left:"+rect.left+"px;"+sFilter+src+"\"'></div>";
 }
}
function autoResizeImage(image, maxWidth, maxHeight){
 var img = new Image();
 img.src = image.src;
 img.onload = function(){
  var rect = clacImgZoomParam(maxWidth, maxHeight, img.width, img.height);
  image.width = rect.width;
  image.height = rect.height;
  image.style.marginLeft = rect.left + "px";
  image.style.marginRight = rect.left + "px";
  image.style.marginTop = rect.top + "px";
  image.style.marginBottom = rect.top + "px";
 }
}
function clacImgZoomParam(maxWidth, maxHeight, width, height){
 var param = {top:0, left:0, width:width, height:height};
 rateWidth = width / maxWidth;
 rateHeight = height / maxHeight;
 if(rateWidth > rateHeight){
  param.width =  maxWidth;
  param.height = Math.round(height / rateWidth);
 }
 else{
  param.width = Math.round(width / rateHeight);
  param.height = maxHeight;
 }
 param.left = Math.round((maxWidth - param.width) / 2);
 param.top = Math.round((maxHeight - param.height) / 2);
 return param;
}