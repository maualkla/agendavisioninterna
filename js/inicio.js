function calendario() 
{
    document.title = 'Calendario';
  document.getElementById("calendario").style.display="block";
  document.getElementById("agenda").style.display="none";
  document.getElementById("notas").style.display="none";
  document.getElementById("cal").style.backgroundColor="#133e3c";
  document.getElementById("age").style.backgroundColor="#008B82";
  document.getElementById("not").style.backgroundColor="#008B82";
}
function agenda() 
{
    document.title = 'Agenda';
  document.getElementById("calendario").style.display="none";
  document.getElementById("agenda").style.display="block";
  document.getElementById("notas").style.display="none";
  document.getElementById("age").style.backgroundColor="#133e3c";
  document.getElementById("cal").style.backgroundColor="#008B82";
  document.getElementById("not").style.backgroundColor="#008B82";
}
function notas() 
{
    document.title = 'Notas';
  document.getElementById("calendario").style.display="none";
  document.getElementById("agenda").style.display="none";
  document.getElementById("notas").style.display="block";
  document.getElementById("not").style.backgroundColor="#133e3c";
  document.getElementById("age").style.backgroundColor="#008B82";
  document.getElementById("cal").style.backgroundColor="#008B82";
}
function nobackbutton()
{
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function()
   {
       window.location.hash="no-back-button";
   }
}
document.oncontextmenu = function()
{
    return false;
}
