String.prototype.trim = function(){
 return this.replace(/(^\s*)|(\s*$)/g, "");
}
String.prototype.lTrim = function(){
 return this.replace(/(^\s*)/g, "");
}
String.prototype.rTrim = function(){
 return this.replace(/(\s*$)/g, "");
}
