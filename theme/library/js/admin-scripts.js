

function checkAdminMenuSimplifiedCookie(){
  var theCookie = getCookie("adminMenuSimplified")
  document.getElementById("hide-admin-menus").checked = theCookie;
  if(theCookie)
    document.body.classList.add('simplify-admin');
  else
    document.body.classList.remove('simplify-admin');
}
checkAdminMenuSimplifiedCookie()


document.getElementById("hide-admin-menus").addEventListener("click", toggleSimplifyAdminMenus);

function toggleSimplifyAdminMenus(e){
  setCookie("adminMenuSimplified", e.currentTarget.checked);
  checkAdminMenuSimplifiedCookie()
}


function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}