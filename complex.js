function radians(degrees){
    var pi = Math.PI;
    return degrees * (pi/180);
}
function degrees(radians){
    var pi = Math.PI;
    return radians * (180/pi);
}

function solarOffset(angle){
    var solarOrbitRadius= 1;
    var solarOrbitOffset=solarOrbitRadius*Math.tan(degrees(88+(1/60)));
    var angle=radians(angle);
    var angleSin=Math.sin(angle);
    var angleCos=Math.cos(angle);
    var opp=angleSin*3463;
    var adj=100000+(angleCos*3463);
    //not in degrees!
    var anglea= Math.atan(opp/adj);
    return degrees(anglea)*60; //in chalakim

}
console.log(solarOffset(90));