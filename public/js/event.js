function campos (rol){
    if (rol==0) {
        document.getElementById('1').style.display="none";
        document.getElementById('2').style.display="none";
        document.getElementById('3').style.display="none";
    }
    if (rol==1) {
        document.getElementById('1').style.display="block";
        document.getElementById('2').style.display="none";
        document.getElementById('3').style.display="none";
    }
    if (rol==2) {
        document.getElementById('1').style.display="none";
        document.getElementById('2').style.display="block";
        document.getElementById('3').style.display="none";
    }
    if (rol==3) {
        document.getElementById('1').style.display="none";
        document.getElementById('2').style.display="none";
        document.getElementById('3').style.display="block";
    }
}