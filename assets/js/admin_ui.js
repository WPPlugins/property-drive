function jtg_open_content(evt, jtgContentName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("jtgcontentlink");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("jtgmenulink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" jtg-admin-menu-item-active", ""); 
  }
  document.getElementById(jtgContentName).style.display = "block";
  evt.currentTarget.className += " jtg-admin-menu-item-active";
}
document.getElementById("jtg-default-open").click();